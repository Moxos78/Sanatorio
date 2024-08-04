<?php

namespace App\Filament\Resources\PatientRecordResource\Pages;

use App\Filament\Resources\PatientRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
class ViewPatientRecord extends ViewRecord
{
    protected static string $resource = PatientRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Print')
                ->translateLabel()
                ->color('success')
                ->icon('heroicon-o-printer')
                ->url(route('generate', ['id' => $this->data['id']]))
                ->openUrlInNewTab()
        ];
    }
}
/*protected function getRedirectUrl(): string
    {
        $record = $this->record;

        // Construye la URL para generar el PDF
        $url = route('generate', ['id' => $record->id]);

        return "javascript:window.open('$url', '_blank');";
        //return $this->getResource()::getUrl('index');
    }*/
