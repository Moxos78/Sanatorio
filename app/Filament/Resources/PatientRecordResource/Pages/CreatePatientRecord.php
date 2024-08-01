<?php

namespace App\Filament\Resources\PatientRecordResource\Pages;

use App\Filament\Resources\PatientRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePatientRecord extends CreateRecord
{
    //protected static string $resource = PatientRecordResource::class;

    protected static string $resource = PatientRecordResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (request()->has('patient_id')) {
            $data['patient_id'] = request()->get('patient_id');
        }
        return $data;
    }
    /*protected function getRedirectUrl(): string
    {
        $record = $this->record;

        // Construye la URL para generar el PDF
        $url = route('pdf.generate', ['id' => $record->id]);

        return "javascript:window.open('$url', '_blank');";
    }*/
    protected function getRedirectUrl(): string
    {
        $record = $this->record;

        // Construye la URL para generar el PDF
        $url = route('generate', ['id' => $record->id]);

        return "javascript:window.open('$url', '_blank');";
        //return $this->getResource()::getUrl('index');
    }
}
