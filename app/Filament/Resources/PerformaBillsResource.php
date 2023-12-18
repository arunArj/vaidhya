<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerformaBillsResource\Pages;
use App\Filament\Resources\PerformaBillsResource\RelationManagers;
use App\Models\PerformaBills;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PerformaBillsResource extends Resource
{
    protected static ?string $model = PerformaBills::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListPerformaBills::route('/'),
            'create' => Pages\CreatePerformaBills::route('/create'),
            'edit' => Pages\EditPerformaBills::route('/{record}/edit'),
        ];
    }    
}
