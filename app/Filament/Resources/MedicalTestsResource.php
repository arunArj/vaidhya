<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalTestsResource\Pages;
use App\Filament\Resources\MedicalTestsResource\RelationManagers;
use App\Models\MedicalTests;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalTestsResource extends Resource
{
    protected static ?string $model = MedicalTests::class;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Fees & Panja karma';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('local_fee')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('indian_fee')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('int_fee')
                    ->label('International Fee')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('local_fee'),
                Tables\Columns\TextColumn::make('indian_fee'),
                Tables\Columns\TextColumn::make('int_fee'),
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
            'index' => Pages\ListMedicalTests::route('/'),
            'create' => Pages\CreateMedicalTests::route('/create'),
            'edit' => Pages\EditMedicalTests::route('/{record}/edit'),
        ];
    }
}
