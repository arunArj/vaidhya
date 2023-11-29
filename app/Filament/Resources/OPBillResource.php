<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Select;
use App\Filament\Resources\OPBillResource\Pages;
use App\Filament\Resources\OPBillResource\RelationManagers;
use App\Filament\Resources\OPBillResource\Widgets\CashBook;
use App\Models\MedicalTests;
use App\Models\OPBill;
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
use Filament\Tables\Actions\Action;

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
                    ->relationship('patients', 'mrd_no')
                    ->searchable()
                    ->placeholder('Enter patient MRD number')
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set,$get, $state) {

                        $set('admission_fee',0);
                       $set('consultaion_fee',0);
                       $set('room_rent',0);
                      $set('pshysio',0);
                        $set('nursing_fee',0);
                        $set('tests',null);
                        $set('total',0 );
                    })
                    ->required(),
                TextInput::make('gst_no')->label('GST No')->required(),
                TextInput::make('room_no')->label('Room Number')->required(),
                TextInput::make('bill_no')->label('Bill Number')->required(),
                TextInput::make('ip_number')->label('IP Number')->required(),
                DatePicker::make('do_admission')
                ->label('Date of Admission')->required(),
                DatePicker::make('do_discharge')->label('Date of Discharge')
                ->minDate(function (Closure $get,$set) {
                    $startDate = $get('do_admission');
                    return $startDate;
                })
                ->required(),
                TextInput::make('room_rent')->label('Room Rent/day')->required()->reactive(),
                TextInput::make('admission_fee')->label('Admission Fee')->required()->default(0)
                ->afterStateUpdated(function (Closure $set,$get, $state) {

                    $admin = $get('admission_fee');
                    $con = $get('consultaion_fee');
                    $rent = $get('room_rent');
                    $pshysio = $get('pshysio');
                    $nursing = $get('nursing_fee');
                    $total = $admin+$con+ $rent+ $pshysio+ $nursing;
                    $set('total',$total );
                })
                ->reactive(),
                TextInput::make('consultaion_fee')->label('Consulation Fee')
                ->required()->default(0)
                ->afterStateUpdated(function (Closure $set,$get, $state) {

                    $admin = $get('admission_fee');
                    $con = $get('consultaion_fee');
                    $rent = $get('room_rent');
                    $pshysio = $get('pshysio');
                    $nursing = $get('nursing_fee');
                    $total = $admin+$con+ $rent+ $pshysio+ $nursing;
                    $set('total',$total );
                })
                ->reactive(),
                TextInput::make('pshysio')->label('psysiotherapy fee')->required()
                ->reactive()
                ->afterStateUpdated(function (Closure $set,$get, $state) {

                    $admin = $get('admission_fee');
                    $con = $get('consultaion_fee');
                    $rent = $get('room_rent');
                    $pshysio = $get('pshysio');
                    $nursing = $get('nursing_fee');
                    $total = $admin+$con+ $rent+ $pshysio+ $nursing;
                    $set('total',$total );
                })
                ->default(0),
                TextInput::make('nursing_fee')->label('nursing fee')
                ->reactive()
                ->afterStateUpdated(function (Closure $set,$get, $state) {

                    $admin = $get('admission_fee');
                    $con = $get('consultaion_fee');
                    $rent = $get('room_rent');
                    $pshysio = $get('pshysio');
                    $nursing = $get('nursing_fee');
                    $total = $admin+$con+ $rent+ $pshysio+ $nursing;
                    $set('total',$total );
                })
                ->required()->default(0),
                Select::make('tests')
                ->multiple()
               ->reactive()
                ->preload()
                ->relationship('tests', 'title')

                 ->afterStateUpdated(function (Closure $set,$get, $state) {

                    $tests = MedicalTests::whereIn('id',$state)->get();
                    $fee=0;
                    foreach($tests as $item){
                        $fee = $fee+$item->local_fee;
                    }
                    $admin = $get('admission_fee');
                    $con = $get('consultaion_fee');
                    $rent = $get('room_rent');
                    $pshysio = $get('pshysio');
                    $nursing = $get('nursing_fee');
                    $total = $admin+$con+ $rent+ $pshysio+ $nursing+$fee;
                    $set('total',$total );
                })
                ,
                TextInput::make('total')->label('total')
                ->disabled()
                ->required()->default(0)
                ->reactive()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patients.name'),
                Tables\Columns\TextColumn::make('patients.mrd_no'),
                Tables\Columns\TextColumn::make('patients.phone'),
                Tables\Columns\TextColumn::make('gst_no'),
                Tables\Columns\TextColumn::make('ip_number'),
                Tables\Columns\TextColumn::make('do_admission'),
                Tables\Columns\TextColumn::make('do_discharge'),
                Tables\Columns\TextColumn::make('bill_no'),
                Tables\Columns\TextColumn::make('room_no'),
                Tables\Columns\TextColumn::make('total')

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
    public static function getWidgets(): array
    {
        return [
           CashBook::class
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
