<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdvancesResource\Pages;
use App\Filament\Resources\AdvancesResource\RelationManagers;
use App\Models\Advances;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdvancesResource extends Resource
{
    protected static ?string $model = Advances::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patients_id')
                    ->relationship('patients', 'mrd_no')
                    ->searchable()
                    ->required()
                    ->placeholder('Enter patient MRD number')
                    ->preload()
                    ->reactive(),
                    Fieldset::make('Details')
                    ->relationship('cashbook')
                    ->schema([
                        Select::make('category_id')
                        ->relationship('category','title')
                        ->searchable()
                        ->preload()
                        ->label('Category')
                        ->required(),
                        Forms\Components\TextInput::make('purpose')
                        ->required()
                        ->default('Advance')
                        ->disabled()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('amount')
                        ->required()
                        ->default(0)
                        ->maxLength(20),
                        Forms\Components\TextInput::make('payment_note')
                       ->nullable()
                        ->maxLength(20),
                        Forms\Components\TextInput::make('refund')
                       ->nullable()
                        ->maxLength(20),
                        Forms\Components\TextInput::make('refund_note')
                        ->nullable()
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
                Tables\Columns\TextColumn::make('patients.name')->label('Patient')->searchable(),
                Tables\Columns\TextColumn::make('patients.mrd_no')->label('MRD NO')->searchable(),
                Tables\Columns\TextColumn::make('cashbook.amount')->label('Advance'),
                Tables\Columns\TextColumn::make('cashbook.payment_note')->label('Payment Note'),
                Tables\Columns\TextColumn::make('cashbook.refund')->label('Refund'),
                Tables\Columns\TextColumn::make('cashbook.refund_note')->label('Refund Note'),
                Tables\Columns\TextColumn::make('created_at')->label('Created at'),


            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAdvances::route('/'),
            'create' => Pages\CreateAdvances::route('/create'),
            'edit' => Pages\EditAdvances::route('/{record}/edit'),
        ];
    }
}
