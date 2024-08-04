<?php

namespace App\Filament\Resources\PatientRecordResource\Widgets;

use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ConsultationsPerMonthWidget extends ChartWidget
{
    protected static ?string $heading = null;

    public function getHeading(): ?string
    {
        return __('consultations_per_month');
    }

    protected function getData(): array
    {
        // Obtener la fecha actual
    $now = Carbon::now();

    // Obtener el conteo de consultas por mes del año actual
    $consultations = DB::table('patient_records')
        ->select(DB::raw('EXTRACT(MONTH FROM consultation_date) as month'), DB::raw('COUNT(*) as count'))
        ->whereYear('consultation_date', $now->year)
        ->groupBy(DB::raw('EXTRACT(MONTH FROM consultation_date)'))
        ->orderBy(DB::raw('EXTRACT(MONTH FROM consultation_date)'))
        ->get();

    // Obtener las traducciones de los meses según el idioma actual
    $months = collect(range(1, 12))->map(function ($month) {
        return __('months.' . $month);
    })->toArray();

    // Preparar los datos para el gráfico
    $counts = array_fill(0, 12, 0);

    foreach ($consultations as $consultation) {
        $counts[$consultation->month - 1] = $consultation->count;
    }

    return [
        'labels' => $months,
        'datasets' => [
            [
                'label' => __('consultations_per_month'),
                'data' => $counts,
                'borderColor' => 'rgb(75, 192, 192)',
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                'borderWidth' => 1,
            ],
        ],
    ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
