<?php

namespace App\Filament\Resources\PatientsResource\RelationManagers;

use App\Models\BookAppointments;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookAppointmentRelationManager extends RelationManager
{
    protected static string $relationship = 'bookAppointment';
   // protected static ?string $inverseRelationship = 'patients';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('visit_date')
                    ->required(),

                Forms\Components\TextInput::make('fee')
                    ->required()
                    ->maxLength(255),
            Forms\Components\TextInput::make('opbill_no')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patients.name'),
                Tables\Columns\TextColumn::make('opbill_no'),
                Tables\Columns\TextColumn::make('fee'),
                Tables\Columns\TextColumn::make('visit_date'),
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
                Action::make('print')
                ->url(fn (BookAppointments $record): string => route('op-invoice', $record))
                ->openUrlInNewTab()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
