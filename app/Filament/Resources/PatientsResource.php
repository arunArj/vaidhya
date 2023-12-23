<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookAppointmentsResource\RelationManagers\PatientsRelationManager;
use App\Filament\Resources\PatientsResource\Pages;
use App\Filament\Resources\PatientsResource\RelationManagers;
use App\Filament\Resources\PatientsResource\RelationManagers\AdvancesRelationManager;
use App\Filament\Resources\PatientsResource\RelationManagers\BookAppointmentRelationManager;
use App\Filament\Resources\PatientsResource\RelationManagers\OPBillRelationManager;
use App\Models\BookAppointments;
use App\Models\Patients;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientsResource extends Resource
{
    protected static ?string $model = Patients::class;
    protected static ?string $navigationGroup = 'Users';
    protected static ?string $recordTitleAttribute = 'Patients Record';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                  ,
                  DatePicker::make('date_of_birth')
                    ->required(),
                Radio::make('sex')
                    ->options([
                        '0' => 'Male',
                        '1' => 'Female',
                        '2' => 'Other'
                    ])->default('0')
                    ->inline()
                    ->label('Sex ?')
                    ->required(),
                Radio::make('user_type')
                    ->options([
                        '0' => 'Local',
                        '1' => 'Indian',
                        '2' => 'International'
                    ])->default('0')
                    ->inline()
                    ->label('Patient From ?')
                    ->required(),
                TextInput::make('phone')
                    ->required(),
                TextInput::make('mrd_no'),
                TextInput::make('advance')
                    ->label('Advance')
                    ->required(),
                TextInput::make('refund')
                        ->label('Refund')
                        ->required(),
                Textarea::make('address')
                    ->label('Address')
                    ->required(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('dob'),
                TextColumn::make('age')
                ->formatStateUsing(function ($record) {
                   return Carbon::parse($record->dob)->age;
                })->label('age'),
                TextColumn::make('phone'),
                TextColumn::make('mrd_no')
                ->searchable()
                    ->label('MRD Number'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
          //BookAppointmentRelationManager::class,
          AdvancesRelationManager::class,
          OPBillRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatients::route('/create'),
            'view' => Pages\ViewPatients::route('/{record}'),
            'edit' => Pages\EditPatients::route('/{record}/edit'),
        ];
    }
}
