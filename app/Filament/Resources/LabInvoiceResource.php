<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabInvoiceResource\Pages;
use App\Filament\Resources\LabInvoiceResource\RelationManagers;
use App\Models\LabInvoice;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabInvoiceResource extends Resource
{
    protected static ?string $model = LabInvoice::class;
    protected static ?string $navigationGroup = 'Bills';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patients_id')
                ->relationship('patient','name')
                ->required(),
                Forms\Components\TextInput::make('invoice_id')
                    ->required()
                    ->maxLength(255),
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
                Tables\Columns\TextColumn::make('invoice_id'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListLabInvoices::route('/'),
            'create' => Pages\CreateLabInvoice::route('/create'),
            'edit' => Pages\EditLabInvoice::route('/{record}/edit'),
        ];
    }
}
