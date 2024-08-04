<?php

namespace App\Filament\Resources\PatientResource\Widgets;

use App\Models\Patient;
use App\Models\PatientRecord;
use Filament\Widgets\ChartWidget;

class PatientStatusDistributionWidget extends ChartWidget
{
    protected static ?string $heading = null;

    public function getHeading(): ?string
    {
        return __('patient_status_distribution');
    }

    protected function getData(): array
    {
        // Define el orden deseado de los estados
        $order = [
            'stable',
            'severe_stable',
            'severe_unstable',
            'critical',
        ];

        // Fetch the patient state counts
        $patientStates = Patient::query()
            ->with('latestPatientRecord')
            ->get()
            ->pluck('latestPatientRecord.patient_state')
            ->filter() // Elimina cualquier estado nulo
            ->countBy();

        // Reorder the states based on the defined order
        $orderedPatientStates = [];
        foreach ($order as $status) {
            if ($patientStates->has($status)) {
                $orderedPatientStates[$status] = $patientStates[$status];
            } else {
                $orderedPatientStates[$status] = 0;
            }
        }

        // Define colors for the chart
        $colors = [
            'stable' => 'rgb(75, 192, 192)',
            'severe_stable' => 'rgb(54, 162, 235)',
            'severe_unstable' => 'rgb(255, 205, 86)',
            'critical' => 'rgb(255, 99, 132)',
        ];

        return [
            'labels' => array_map(fn($status) => __('patient_states.' . $status), array_keys($orderedPatientStates)),
            'datasets' => [
                [
                    'label' => 'Patient States',
                    'data' => array_values($orderedPatientStates),
                    'backgroundColor' => array_values(array_intersect_key($colors, $orderedPatientStates)),
                    'hoverOffset' => 4,
                ],
            ],
        ];

    }

    protected function getType(): string
    {
        return 'pie';
    }
}
