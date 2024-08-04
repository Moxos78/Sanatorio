<?php

namespace App\Filament\Resources\PatientResource\Widgets;

use App\Models\Patient;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class NewPatientsWidget extends ChartWidget
{
    //protected static ?string $heading = 'Chart';
    protected static ?string $heading = null;

    public function getHeading(): ?string
    {
        return __('new_patients_per_month');
    }

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->translatedFormat('F'); // Usar formato traducido
        });

        $patientsPerMonth = Patient::selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $data = $months->map(function ($monthName, $index) use ($patientsPerMonth) {
            return $patientsPerMonth->get($index + 1, 0); // Default to 0 if no data for the month
        });

        return [
            'datasets' => [
                [
                    'label' => __('New Patients'), // Traducción del título del gráfico
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
