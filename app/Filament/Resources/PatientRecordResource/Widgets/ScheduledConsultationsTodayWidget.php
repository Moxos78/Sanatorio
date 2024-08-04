<?php

namespace App\Filament\Resources\PatientRecordResource\Widgets;

use App\Filament\Resources\PatientRecordResource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Resources\PatientRecordResource\Pages;
use App\Filament\Resources\PatientRecordResource\RelationManagers;
use App\Models\Patient;
use App\Models\PatientRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function PHPUnit\Framework\isNull;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;


class ScheduledConsultationsTodayWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = null;
    public function getTableHeading(): ?string
    {
        return __('scheduled_consultations_today');
    }

    //protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
        ->query(
            PatientRecordResource::getTableQuery()
        )
        ->columns([
            Tables\Columns\TextColumn::make('patient.name')

                ->getStateUsing(fn ($record) => "{$record->patient->name} {$record->patient->lastname}")
                ->translateLabel()
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('consultation_date')
                ->translateLabel()
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('reconsultation_date')
                ->translateLabel()
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('operation_date')
                ->translateLabel()
                ->dateTime()
                ->sortable(),

            Tables\Columns\TextColumn::make('patient_state')
                ->translateLabel()
                ->searchable()
                ->badge()
                ->colors([
                    'success' => __('patient_states.stable'),
                    'info' => __('patient_states.severe_stable'),
                    'warning' => __('patient_states.severe_unstable'),
                    'danger' => __('patient_states.critical'),
                ])
                ->getStateUsing(function ($record) {
                    return __('patient_states.' . $record->patient_state);
                }),

            Tables\Columns\TextColumn::make('created_at')
                ->translateLabel()
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->translateLabel()
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('deleted_at')
                ->translateLabel()
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            SelectFilter::make('patient_id')
            ->relationship(
                name: 'patient',
                titleAttribute: null,
                modifyQueryUsing: fn (Builder $query) => $query->orderBy('name')->orderBy('lastname'),
            )
            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name} {$record->lastname}")
            ->searchable()
            ->preload(),
            SelectFilter::make('patient_state')
                ->options([
                    'stable' => __('patient_states.stable'),
                    'severe_stable' => __('patient_states.severe_stable'),
                    'severe_unstable' => __('patient_states.severe_unstable'),
                    'critical' => __('patient_states.critical'),
                ])
                ->translateLabel(),


            Tables\Filters\TrashedFilter::make(),
        ])
        ->actions([
            ActionGroup::make([
            Tables\Actions\EditAction::make(),
            Tables\Actions\ViewAction::make(),
            Tables\Actions\Action::make('Print')
                ->translateLabel()
                ->color('success')
                ->icon('heroicon-o-printer')
                ->url(fn ($record) => route('generate', ['id' => $record->id]))
                ->openUrlInNewTab()
            ]),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]),
        ])
        ->defaultSort('created_at', 'desc');

    }
}
