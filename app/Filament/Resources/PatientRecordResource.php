<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientRecordResource\Pages;
use App\Filament\Resources\PatientRecordResource\RelationManagers;
use App\Models\Patient;
use App\Models\PatientRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function PHPUnit\Framework\isNull;

class PatientRecordResource extends Resource
{
    protected static ?string $model = PatientRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function getModelLabel(): string
    {
        return __('Patient Record');
    }
    public static function getNavigationLabel(): string
    {
        return __('Patient Records');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Select::make('patient_id')
                                ->relationship('patient', 'name')
                                ->default(request()->get('patient_id'))
                                ->options(Patient::all()->pluck('name', 'id'))
                                //->disabled(false)
                                ->disabled(function() {
                                    if ((request()->get('patient_id'))) {
                                        return true;
                                    }
                                    else {
                                        return false;
                                    }
                                    //return request()->get('patient_id') ?? false;
                                })
                                ->disabled(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord)
                                //->disabled(fn($get) => $get('patient_id') != null || !isset($state))
                                //->setCondition(fn($state) => $state === null, 'disabled')
                                ->translateLabel()
                                ->required()
                            ])
                            ->columns(1),
                        Forms\Components\Section::make(__('Case Description'))
                            ->schema([
                                Forms\Components\RichEditor::make('description_case')
                                ->required()
                                ->translateLabel()
                                ->columnSpanFull()
                                ->maxLength(255)

                            ])
                            ->columns(1),

                        Forms\Components\Section::make(__('Repose Information'))
                            ->schema([
                                Forms\Components\CheckboxList::make('repose_days')
                                    ->translateLabel()
                                    ->options([
                                        'monday' => __('days.monday'),
                                        'tuesday' => __('days.tuesday'),
                                        'wednesday' => __('days.wednesday'),
                                        'thursday' => __('days.thursday'),
                                        'friday' => __('days.friday'),
                                        'saturday' => __('days.saturday'),
                                        'sunday' => __('days.sunday'),
                                    ]),
                                Forms\Components\TimePicker::make('repose_schedules')
                                    ->translateLabel(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make(__('Consultation Details'))
                            ->schema([
                                Forms\Components\DatePicker::make('consultation_date')
                                    ->translateLabel()
                                    ->required(),
                                Forms\Components\DatePicker::make('reconsultation_date')
                                    ->translateLabel()
                                    ->required(),
                                Forms\Components\DateTimePicker::make('operation_date')
                                    ->translateLabel(),
                                ])
                                ->columns(1),

                        Forms\Components\Section::make(__('Recommendations and State'))
                            ->schema([
                                Forms\Components\Textarea::make('recommendations')
                                    ->required()
                                    ->translateLabel()
                                    ->maxLength(255),
                                Forms\Components\Select::make('patient_state')
                                    ->required()
                                    ->translateLabel()
                                    ->options([
                                        'stable' => __('patient_states.stable'),
                                        'severe_stable' => __('patient_states.severe_stable'),
                                        'severe_unstable' => __('patient_states.severe_unstable'),
                                        'critical' => __('patient_states.critical'),
                                    ]),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.name')
                    ->numeric()
                    ->translateLabel()
                    ->sortable(),


                Tables\Columns\TextColumn::make('consultation_date')
                    ->translateLabel()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reconsultation_date')
                    ->translateLabel()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('repose_schedules')
                    ->translateLabel(),
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
                    ->options(fn (): array => Patient::query()->pluck('name', 'id')->all()),



                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatientRecords::route('/'),
            'create' => Pages\CreatePatientRecord::route('/create'),
            'edit' => Pages\EditPatientRecord::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
