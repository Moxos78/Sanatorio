<?php

namespace App\Http\Controllers;

use App\Models\PatientRecord;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
class PdfController extends Controller
{
    public function generatePdf($id,  $locale = 'es')
    {
        App::setLocale($locale);
        Carbon::setLocale($locale); // Establecer el idioma para Carbon
        $patientRecord = PatientRecord::with('patient')->find($id);
        if (!$patientRecord) {
            abort(404, 'Registro de paciente no encontrado');
        }
          // Traducir las fechas y los días de la semana
        $restDays = array_map(function($day) use ($locale) {
            return Carbon::parse($day)->translatedFormat('l');
        }, $patientRecord->repose_days);

            $data = [
                'number_prescription' => $patientRecord->id,
                'date_consulting' => Carbon::parse($patientRecord->consultation_date)->translatedFormat('l, d F Y'),
                'patient_name' => $patientRecord->patient->name . ' ' . $patientRecord->patient->lastname,
                'rest_days' => $restDays? implode(', ', $restDays): '-',
                'rest_schedule' => $patientRecord->repose_start_time. ' - '.$patientRecord->repose_end_time ,
                'recommendations' => $patientRecord->recommendations,
                'next_consultation' => Carbon::parse($patientRecord->reconsultation_date)->translatedFormat('l, d F Y'),
                'operation' => $patientRecord->operation_date ?
                Carbon::parse($patientRecord->operation_date)->translatedFormat('l, d F Y h:i:s A') : '-',
                'clinic_address' => __('Pampa Galana'),
                'clinic_phone' => __('+591 72978758'),
                'clinic_email' => __('fcalvariodelmilagro@gmail.com')
            ];

        $pdf = Pdf::loadView('document', $data);
        $pdf->setPaper([0, 0, 283.46, 425.2]);
        return $pdf->stream('recetario.pdf');
    }

}
