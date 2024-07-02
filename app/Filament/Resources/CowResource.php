<?php

namespace App\Filament\Resources;

use App\Enums\ActivityType;
use App\Filament\Resources\CowResource\Pages;
use App\Filament\Resources\CowResource\RelationManagers;
use App\Models\ActivityPlace;
use App\Models\ActivitySystem;
use App\Models\BreadingSystem;
use App\Models\Cow;
use App\Models\Purpose;
use Cassandra\Exception\TimeoutException;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CowResource extends Resource
{
    protected static ?string $model = Cow::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cowId'),
                Forms\Components\TextInput::make('original_area'),
                Forms\Components\Fieldset::make('Systems')->schema([
                    Forms\Components\Select::make('activity_place_id')
                        ->label('Activity Place')
                        ->options(ActivityPlace::all()->pluck('name','id'))
                        ->searchable()
                        ->columnSpan(2),
                    Forms\Components\Select::make('activity_system_id')
                        ->label('Activity System')
                        ->options(ActivitySystem::all()->pluck('name','id'))
                        ->searchable()
                        ->columnSpan(2),
                    Forms\Components\Select::make('breading_system_id')
                        ->label('Breading System')
                        ->options(BreadingSystem::all()->pluck('name','id'))
                        ->searchable()
                        ->columnSpan(2),
                ]),

                Forms\Components\TextInput::make('appearance'),
                Forms\Components\FileUpload::make('image'),
                Forms\Components\DateTimePicker::make('birthday_date'),
                Forms\Components\DateTimePicker::make('entrance_date'),
                Forms\Components\TextInput::make('weight'),
                Forms\Components\Radio::make('gender')
                    ->options([
                        'bull'=>'Bull',
                        'heifer'=>'Heifer'
                    ]),
                Forms\Components\Radio::make('is_pregnant')
                    ->label('Pregnant Status')
                    ->options([
                        '0'=>'Not Pregnant',
                        '1'=>'Pregnant'
                    ]),
                Forms\Components\Select::make('purpose_id')
                    ->label('Purpose Name')
                    ->options(Purpose::all()->pluck('name','id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('cowId')->searchable(),
                Tables\Columns\TextColumn::make('activityPlace.name')
                    ->url(fn (Cow $record) => ActivityPlaceResource::getUrl('edit',['record'=>$record->activityPlace])),
                Tables\Columns\TextColumn::make('activitySystem.name')
                    ->url(fn (Cow $record) => ActivitySystemResource::getUrl('edit',['record'=>$record->activitySystem])),
                Tables\Columns\TextColumn::make('breadingSystem.name')
                    ->url(fn (Cow $record) =>BreadingSystemResource::getUrl('edit',['record'=>$record->breadingSystem])),
                Tables\Columns\TextColumn::make('purpose.name')
                    ->url(fn (Cow $record) => PurposeResource::getUrl('edit',['record'=>$record->purpose])),
                Tables\Columns\TextColumn::make('original_area'),
                Tables\Columns\TextColumn::make('appearance'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('birthday_date')->sortable(),
                Tables\Columns\TextColumn::make('entrance_date'),
                Tables\Columns\TextColumn::make('weight'),
                Tables\Columns\TextColumn::make('latitude'),
                Tables\Columns\TextColumn::make('longitude'),
                Tables\Columns\ToggleColumn::make('cow_status'),
                Tables\Columns\ToggleColumn::make('is_pregnant')
            ])
            ->defaultSort('birthday_date','desc')
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
            'index' => Pages\ListCows::route('/'),
            'create' => Pages\CreateCow::route('/create'),
            'edit' => Pages\EditCow::route('/{record}/edit'),
        ];
    }
}
