<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreatmentDoseTimesResource\Pages;
use App\Filament\Resources\TreatmentDoseTimesResource\RelationManagers;
use App\Models\Treatment;
use App\Models\TreatmentDoseTimes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentDoseTimesResource extends Resource
{
    protected static ?string $model = TreatmentDoseTimes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Treatments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('treatment_id')
                    ->label('Treatment Name')
                    ->options(Treatment::all()->pluck('name','id'))
                    ->searchable(),
                Forms\Components\DatePicker::make('date'),
                Forms\Components\TimePicker::make('time'),
                Forms\Components\Radio::make('is_taken')
                    ->options([
                        '0'=>'Not taken',
                        '1'=>'Taken'
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('treatment.name')->sortable()->searchable()
                    ->url(fn (TreatmentDoseTimes $record) => TreatmentResource::getUrl('edit',['record'=>$record->treatment])),
                Tables\Columns\TextColumn::make('treatment.cow.cowId')->searchable(),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\ToggleColumn::make('is_taken')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTreatmentDoseTimes::route('/'),
        ];
    }
}
