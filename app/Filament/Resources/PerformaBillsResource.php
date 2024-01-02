<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerformaBillsResource\Pages;
use App\Filament\Resources\PerformaBillsResource\RelationManagers;
use App\Models\MedicalTests;
use App\Models\PerformaBills;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PerformaBillsResource extends Resource
{
    protected static ?string $model = PerformaBills::class;
    protected static ?string $navigationGroup = 'Bills';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patients_id')
                ->relationship('patients', 'mrd_no')
                ->searchable()
                ->placeholder('Enter patient MRD number')
                ->preload()
                ->reactive()

                ->required(),

            TextInput::make('room_no')->label('Room Number')->required(),
            TextInput::make('bill_no')->label('Bill Number')->required(),
            TextInput::make('ip_number')->label('IP Number')->required(),


            ################################################################
            DatePicker::make('from_date')
            ->reactive()
            ->label('From Date')->required(),
            DatePicker::make('to_date')->label('To Date')
            ->minDate(function (Closure $get,$set) {
                $startDate = $get('from_date');
                return $startDate;
            })
            ->reactive()
            ->required(),

            Card::make()
            ->schema([
                Repeater::make('fees')
                ->schema([
                    Select::make('medical_tests_id')
                    ->label('test and fees')
                    ->options(MedicalTests::all()->pluck('title', 'id'))
                    ->searchable(),
                        TextInput::make('quantity')->required()->default('1'),
                        TextInput::make('fee')->hidden(function ($context){
                            if($context=='edit'){
                                return false;
                            }
                            return true;
                        }),
                    ])

                ->columns(3),

                    ]),
                    Card::make()
                    ->schema([
                        Fieldset::make('payment')
                        ->relationship('cashbook')
                        ->schema([
                            TextInput::make('refund')->nullable(),
                            Select::make('type')
                            ->options(
                                [
                                    '0'=>'Income'
                                ]
                            )
                            ->disabled()
                            ->default(0)
                            ->required(),
                            TextInput::make('refund_note')
                            ->label('Refound note')
                            ->nullable(),
                            TextInput::make('payment_note')->nullable(),
                            TextInput::make('purpose')->default('performa'),
                            TextInput::make('amount')->hidden()->default(0),
                            Select::make('category_id')
                            ->relationship('category','title')
                            ->searchable()
                            ->default(11)
                            ->preload()
                          //  ->getSearchResultsUsing(fn (string $search) => Category::where('title', 'like', "%{$search}%")->limit(50)->pluck('title', 'id'))
                            ->label('Category')

                            ->required(),

                        ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patients.name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('patients.mrd_no')->label('MRD Number')
                ->searchable(),

                Tables\Columns\TextColumn::make('bill_no'),
                Tables\Columns\TextColumn::make('ip_number'),
                Tables\Columns\TextColumn::make('from_date')->date()
                ->label('From date'),
                Tables\Columns\TextColumn::make('to_date')->date()->label('To date'),
                Tables\Columns\TextColumn::make('room_no'),
                Tables\Columns\TextColumn::make('total')->label('Bill Amount'),
                Tables\Columns\TextColumn::make('cashbook.refund')->label('Refund')
                ->formatStateUsing(function ( $state){
                    if(!$state){
                        return '0';
                    }
                    return $state;
                }),
                Tables\Columns\TextColumn::make('cashbook.amount')->label('Total')
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
