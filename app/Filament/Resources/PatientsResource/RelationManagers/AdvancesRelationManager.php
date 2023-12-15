<?php

namespace App\Filament\Resources\PatientsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdvancesRelationManager extends RelationManager
{
    protected static string $relationship = 'advances';

    protected static ?string $recordTitleAttribute = 'bill_no';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                    Fieldset::make('Cashbook')
                    ->relationship('cashbook')
                    ->schema([
                        Select::make('category_id')
                        ->options([
                            '1' => 'Bills',

                        ])->default('1')
                        ->disabled()
                        ->label('Category')
                        ->required(),
                        Forms\Components\TextInput::make('purpose')
                        ->required()
                        ->default('Advance')
                        ->disabled()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('amount')
                        ->required()
                        ->maxLength(20),
                        Forms\Components\TextInput::make('payment_note')
                       ->nullable()
                        ->maxLength(20),
                        Forms\Components\TextInput::make('refund')
                       ->nullable()
                        ->maxLength(20),
                        Forms\Components\TextInput::make('refund_note')

                        ->maxLength(20),

                        Radio::make('type')
                            ->options([
                                '0' => 'Income',
                                '1' => 'Expense',
                            ])->default('0')
                            ->disabled()
                            ->inline()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cashbook.amount')->label('Advance'),
                Tables\Columns\TextColumn::make('cashbook.payment_note')->label('Payment Note'),
                Tables\Columns\TextColumn::make('cashbook.refund')->label('Refund'),
                Tables\Columns\TextColumn::make('cashbook.refund_note')->label('Refund Note'),

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
