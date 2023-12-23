<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Select;
use App\Filament\Resources\OPBillResource\Pages;
use App\Filament\Resources\OPBillResource\RelationManagers;
use App\Filament\Resources\OPBillResource\Widgets\CashBook;
use App\Models\MedicalTests;
use App\Models\OPBill;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Tables\Actions\Action;
use App\Models\Patients;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Repeater;

class OPBillResource extends Resource
{
    protected static ?string $model = OPBill::class;
    protected static ?string $navigationLabel = 'IP Bill';
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
                DatePicker::make('do_admission')
                ->reactive()
                ->label('Date of Admission')->required(),
                DatePicker::make('do_discharge')->label('Date of Discharge')
                ->minDate(function (Closure $get,$set) {
                    $startDate = $get('do_admission');
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
                            TextInput::make('refund')->nullable(),
                            TextInput::make('refund_note')
                            ->label('Refound note')
                            ->nullable(),
                            TextInput::make('payment_note')->nullable(),
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
                Tables\Columns\TextColumn::make('do_admission')->date(),
                Tables\Columns\TextColumn::make('do_discharge')->date(),
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
                Action::make('print')
                ->url(fn (OPBill $record): string => route('ip-invoice', $record))
                ->openUrlInNewTab()
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
