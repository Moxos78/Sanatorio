<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use App\Models\PatientRecord;
use Carbon\Carbon;
use DateTime;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    public static function getModelLabel(): string
    {
        return __('Patient');
    }
    public static function getNavigationLabel(): string
    {
        return __('Patients');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('code')
                        ->translateLabel()
                        ->unique()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('name')
                        ->translateLabel()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('lastname')
                        ->translateLabel()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('address')
                        ->translateLabel()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('cellphone')
                        ->translateLabel()
                        ->tel()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('birthday')
                        ->translateLabel()
                        ->required(),
                    Forms\Components\TextInput::make('residence')
                        ->translateLabel()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Toggle::make('notify')
                        ->translateLabel()
                        ->inline(false)
                        ->onColor('success')
                        ->offColor('danger')
                        ->required(),
                    ])
                    ->columns(2),
                ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lastname')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cellphone')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('birthday')->getStateUsing(function ($record) {
                        return Carbon::parse($record->birthday)->age;
                    })
                    ->translateLabel()
                    ->label('Age')
                    ->sortable(),
                Tables\Columns\TextColumn::make('residence')
                    ->translateLabel()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('notify')
                    ->translateLabel()
                    ->boolean()
                    ->sortable(),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('viewPatientRecord')
                    ->label('View patient record')
                    ->translateLabel()
                    ->url(fn (Patient $record) => route('filament.admin.resources.patient-records.index', ['tableFilters' => ['patient_id' => ['value' => $record->id]]])),
                    //->url(fn (Patient $record) => url('/admin/patient-records', ['tableFilters' => ['patient_id' => ['value' => $record->id]]])),
                    //->openUrlInNewTab(), // Para abrir la URL en una nueva pestaña
                Tables\Actions\Action::make('createPatientRecord')
                    ->label('Create Patient Record')
                    ->translateLabel()
                    ->url(fn (Patient $record) => route('filament.admin.resources.patient-records.create', ['patient_id' => $record->id])),
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
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
