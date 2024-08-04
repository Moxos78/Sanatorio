<?php

namespace App\Filament\Resources\PatientRecordResource\Pages;

use App\Filament\Resources\PatientRecordResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Http\Request;
class ListPatientRecords extends ListRecords
{
    protected static string $resource = PatientRecordResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->url(fn () => route('filament.admin.resources.patient-records.create', [
                    'patient_id' => $this->tableFilters['patient_id']['value'],
                ])),
        ];
    }


    /*protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        if ($pacienteId = request()->input('tableFilters.patient_id.value')) {
            $query->where('patient_id', $pacienteId);
        }

        return $query;
    }*/

}
