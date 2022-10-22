<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FixtureResource\Pages;
use App\Filament\Resources\FixtureResource\RelationManagers;
use App\Models\Fixture;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FixtureResource extends Resource
{
    protected static ?string $model = Fixture::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\TextInput::make('id')
                                    ->required()
                                    ->disabled(),
                                Forms\Components\Select::make('home_team_id')
                                    ->relationship('homeTeam', 'name'),
                                Forms\Components\Select::make('away_team_id')
                                    ->relationship('awayTeam', 'name'),
                                Forms\Components\TextInput::make('venue_id'),
                                Forms\Components\DateTimePicker::make('date')
                                    ->timezone('Europe/Zurich'),
                                Forms\Components\TextInput::make('stage')
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columnSpan(['lg' => fn (?Fixture $record) => $record === null ? 3 : 2]),

                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Toggle::make('can_predict')
                                    ->required(),
                            ])
                            ->columnSpan(['lg' => 1])
                            ->hidden(fn (?Fixture $record) => $record === null),

                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Fixture $record): string => $record->created_at->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (Fixture $record): string => $record->updated_at->diffForHumans()),
                            ])
                            ->columnSpan(['lg' => 1])
                            ->hidden(fn (?Fixture $record) => $record === null),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('homeTeam.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('awayTeam.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('venue.name'),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime(timezone: 'Europe/Zurich')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stage'),
                Tables\Columns\IconColumn::make('can_predict')
                    ->boolean(),
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
            'index' => Pages\ListFixtures::route('/'),
            'create' => Pages\CreateFixture::route('/create'),
            'edit' => Pages\EditFixture::route('/{record}/edit'),
        ];
    }    
}
