<?php

namespace App\Filament\Resources\PatientRecordResource\Pages;

use App\Filament\Resources\PatientRecordResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientRecords extends ListRecords
{
    protected static string $resource = PatientRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->url(fn () => route('filament.admin.resources.patient-records.create', ['patient_id' => request()->get('patient_id')])),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        if ($pacienteId = request()->query('patient_id')) {
            $query->where('patient_id', $pacienteId);
        }

        return $query;
    }

}
