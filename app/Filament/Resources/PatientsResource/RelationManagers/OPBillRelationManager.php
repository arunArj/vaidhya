<?php

namespace App\Filament\Resources\PatientsResource\RelationManagers;

use App\Models\MedicalTests;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\Request;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class OPBillRelationManager extends RelationManager
{
    protected static string $relationship = 'OPBill';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('room_no')->label('Room Number')->required(),
                TextInput::make('bill_no')->label('Bill Number')->required(),
                TextInput::make('ip_number')->label('IP Number')->required(),

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
                Tables\Columns\TextColumn::make('bill_no'),
                Tables\Columns\TextColumn::make('ip_number'),
                Tables\Columns\TextColumn::make('do_admission')->date(),
                Tables\Columns\TextColumn::make('do_discharge')->date(),
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
            ->headerActions([
               // Tables\Actions\CreateAction::make()
                // ->before(function ($data,RelationManager $livewire) {
                //     $sum=0;
                //     foreach($data['fees'] as $key=>$item ){

                //      $tests = MedicalTests::where('id',$item['medical_tests_id'])->first();
                //      switch($livewire->ownerRecord->user_type){
                //              case '0':
                //                $fee = $tests['local_fee'];
                //                break;
                //              case '1':
                //                  $fee = $tests['indian_fee'];
                //                  break;
                //              case '2':
                //                  $fee = $tests['int_fee'];
                //                  break;
                //              default :
                //                  $fee = $tests['local_fee'];
                //          }
                //          $sum = $sum+($fee*$item['quantity']);
                //     // $this->data['fees'][$key]['fee'] = $fee;
                //      $out[] =['medical_tests_id'=>$tests->id,'quantity'=>$data['fees'][$key]['quantity'],'fee'=>$fee];
                //     }
                //     $data['fees'] = $out;
                //     $data['total'] =  $sum ;
                // })

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()

            ]);
    }
}
