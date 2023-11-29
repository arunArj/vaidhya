<?php

namespace App\Filament\Resources\BookAppointmentsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientsRelationManager extends RelationManager
{
    protected static string $relationship = 'patients';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('age')
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
                    ->numeric()
                    ->required(),
                TextInput::make('mrd_no')
                    ->label('MRD Number')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
