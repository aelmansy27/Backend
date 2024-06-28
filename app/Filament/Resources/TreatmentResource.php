<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreatmentResource\Pages;
use App\Filament\Resources\TreatmentResource\RelationManagers;
use App\Models\Cow;
use App\Models\Treatment;
use App\Models\TreatmentStock;
use Faker\Provider\cs_CZ\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Treatments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\Select::make('cow_id')
                    ->label('Cow ID')
                    ->options(Cow::all()->pluck('cowId','id'))
                    ->searchable(),
                Forms\Components\Select::make('treatment_stock_id')
                    ->label('Treatment Stock Name')
                    ->options(TreatmentStock::all()->pluck('name','id'))
                    ->reactive()
                    ->afterStateUpdated(function ($state,callable $set){
                        $treatmentType=TreatmentStock::find($state);
                        if($treatmentType){
                            $set('type',$treatmentType->type);
                        }
                    })
                    ->searchable(),
                Forms\Components\TextInput::make('type')
                    ->disabled(),
                Forms\Components\Textarea::make('disease'),
                Forms\Components\Textarea::make('diagnose'),
                Forms\Components\TextInput::make('doses')
                    ->numeric(),
                Forms\Components\Fieldset::make('Doses Times')->schema([
                        Forms\Components\Repeater::make('treatmentDoseTimes')
                        ->relationship()
                        ->schema([
                            Forms\Components\DatePicker::make('date'),
                            Forms\Components\TimePicker::make('time'),
                            Forms\Components\Radio::make('is_taken')
                                ->options([
                                     '0'=>'Not taken',
                                     '1'=>'Taken'
                                ])
                        ])
                    ->columnSpan('full')
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('treatmentStock.name')
                    ->url(fn (Treatment $record) => TreatmentStockResource::getUrl('edit',['record'=>$record->treatmentStock]))
                    ->label('Name of treatment stock'),
                Tables\Columns\TextColumn::make('treatmentStock.type')
                    ->url(fn (Treatment $record) => TreatmentStockResource::getUrl('edit',['record'=>$record->treatmentStock]))
                    ->label('Type'),
                Tables\Columns\TextColumn::make('cow.cowId')
                    ->url(fn (Treatment $record) => CowResource::getUrl('edit',['record'=>$record->cow])),
                Tables\Columns\TextColumn::make('disease')
                    ->limit(50),
                Tables\Columns\TextColumn::make('doses')
                    ->numeric(),
                Tables\Columns\TextColumn::make('diagnose')
                    ->limit(50)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTreatments::route('/'),
            'create' => Pages\CreateTreatment::route('/create'),
            'edit' => Pages\EditTreatment::route('/{record}/edit'),
        ];
    }
}
