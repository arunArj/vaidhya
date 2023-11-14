<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookAppointmentsResource\Pages;
use App\Filament\Resources\BookAppointmentsResource\RelationManagers;
use App\Filament\Resources\BookAppointmentsResource\Widgets\AppointmentWidget;
use App\Models\BookAppointments;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookAppointmentsResource extends Resource
{
    protected static ?string $model = BookAppointments::class;
    protected static ?string $navigationGroup = 'Bills';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patients_id')
                ->relationship('patients','name'),
                Select::make('doctors_id')
                ->relationship('doctor','name'),
                TextInput::make('fee'),
                TextInput::make('invoice_no')->label('Bill Number'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
                TextColumn::make('invoice_no')->label('Invoice ID'),
                TextColumn::make('patients.name'),
                TextColumn::make('doctor.name'),
                TextColumn::make('fee'),
                TextColumn::make('patients.emp_code')
                ->label('Patient Code'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBookAppointments::route('/'),
            'create' => Pages\CreateBookAppointments::route('/create'),
            'edit' => Pages\EditBookAppointments::route('/{record}/edit'),
        ];
    }
    public static function getWidgets(): array
    {
        return [
            AppointmentWidget::class
        ];
    }
}
