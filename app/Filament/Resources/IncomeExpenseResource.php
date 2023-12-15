<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeExpenseResource\Pages;
use App\Filament\Resources\IncomeExpenseResource\RelationManagers;
use App\Models\IncomeExpense;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomeExpenseResource extends Resource
{
    protected static ?string $model = IncomeExpense::class;
    protected static ?string $title = 'Custom Page Title';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Cashbook';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                ->relationship('category','title')
                ->label('Category')
                    ->required(),
                Forms\Components\TextInput::make('purpose')->label('Sub Category')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                ->required()
                ->maxLength(12),

                Forms\Components\TextInput::make('payment_note')->label('Payment note')
                ->nullable()
                ->maxLength(200),
                Forms\Components\TextInput::make('refund')->label('Refund')
                ->nullable()
                ->maxLength(12),
                Forms\Components\TextInput::make('refund_note')->label('Refund note')
                ->nullable()
                ->maxLength(200),
                Radio::make('type')
                    ->options([
                        '0' => 'Income',
                        '1' => 'Expense',
                    ])->default('0')
                    ->inline()


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                ->enum([
                    '0' => 'Income',
                    '1' => 'Expense',

                ]),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('category.title'),
                Tables\Columns\TextColumn::make('purpose')->label('Sub Category'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('Type')
                ->options([
                    '0' => 'Income',
                    '1' => 'Expense',
                ])
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
            'index' => Pages\ListIncomeExpenses::route('/'),
            'create' => Pages\CreateIncomeExpense::route('/create'),
            'edit' => Pages\EditIncomeExpense::route('/{record}/edit'),
        ];
    }
    protected function getTableRecordClassesUsing(): ?Closure
    {
        return fn (Model $record) => match ($record->type) {
            'Expense' => 'border-green-600',
            1 => 'border-orange-600',
            default => null,
        };
    }


}
