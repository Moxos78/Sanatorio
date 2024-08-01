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
                'rest_days' => implode(', ', $restDays),
                'rest_schedule' => $patientRecord->repose_schedules,
                'recommendations' => $patientRecord->recommendations,
                'next_consultation' => Carbon::parse($patientRecord->reconsultation_date)->translatedFormat('l, d F Y'),
                'clinic_address' => __('123 Fake Street, City'),
                'clinic_phone' => __('+123 456 7890'),
                'clinic_email' => __('contact@fakemail.com')
            ];

        $pdf = Pdf::loadView('document', $data);
        $pdf->setPaper([0, 0, 283.46, 425.2]);
        return $pdf->stream('recetario.pdf');
    }

}
