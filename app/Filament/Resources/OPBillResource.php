<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Select;
use App\Filament\Resources\OPBillResource\Pages;
use App\Filament\Resources\OPBillResource\RelationManagers;
use App\Models\OPBill;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class OPBillResource extends Resource
{
    protected static ?string $model = OPBill::class;
    protected static ?string $navigationLabel = 'IP Bill';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patients_id')
                    ->relationship('patient', 'name')
                    ->required(),
                TextInput::make('gst_no')->label('GST No')->required(),
                TextInput::make('room_no')->label('Room Number')->required(),
                TextInput::make('bill_no')->label('Bill Number')->required(),
                TextInput::make('ip_number')->label('IP Number')->required(),
                DatePicker::make('do_admission')->label('DO Admission')->required(),
                DatePicker::make('do_discharge')->label('DO Discharge')->required(),
                Select::make('tests')
                    ->multiple()
                    ->relationship('tests', 'title')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.name'),
                Tables\Columns\TextColumn::make('patient.phone'),
                Tables\Columns\TextColumn::make('gst_no'),
                Tables\Columns\TextColumn::make('ip_number'),
                Tables\Columns\TextColumn::make('do_admission'),
                Tables\Columns\TextColumn::make('do_discharge'),
                Tables\Columns\TextColumn::make('bill_no'),
                Tables\Columns\TextColumn::make('room_no')

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
            'index' => Pages\ListOPBills::route('/'),
            'create' => Pages\CreateOPBill::route('/create'),
            'edit' => Pages\EditOPBill::route('/{record}/edit'),
        ];
    }
}
