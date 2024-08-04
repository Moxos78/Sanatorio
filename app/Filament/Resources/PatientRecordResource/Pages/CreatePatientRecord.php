<?php

namespace App\Filament\Resources\PatientRecordResource\Pages;

use App\Filament\Resources\PatientRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePatientRecord extends CreateRecord
{
    protected static string $resource = PatientRecordResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (request()->has('tableFilters')) {
            $data['patient_id'] = request()->get('patient_id');
        }
        return $data;


    }

}
