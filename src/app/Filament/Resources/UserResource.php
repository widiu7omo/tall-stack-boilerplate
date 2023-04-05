<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;
use Widiu7omo\FilamentBandel\Actions\BanAction;
use Widiu7omo\FilamentBandel\Actions\BanBulkAction;
use Widiu7omo\FilamentBandel\Actions\UnbanAction;
use Widiu7omo\FilamentBandel\Actions\UnbanBulkAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = "Accounts";
    protected static ?string $label = "Accounts";
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->required(false)
                    ->maxLength(255),
                Forms\Components\Select::make('roles')->multiple()
                    ->relationship('roles', 'name')
                    ->getOptionLabelFromRecordUsing(fn(Role $record) => $record->name . " (" . $record->guard_name . ")")
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TagsColumn::make('roles.name'),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\CheckboxColumn::make('banned_at')->disabled()->label('Banned'),
                Tables\Columns\CheckboxColumn::make("email_verified_at")->disabled()->label("Email Verified")
            ])
            ->filters([
                Tables\Filters\Filter::make('Verified Email')->query(fn(Builder $query) => $query->whereNotNull("email_verified_at"))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                BanAction::make(),
                UnbanAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])->prependBulkActions([
                BanBulkAction::make('bulk-ban-model'),
                UnbanBulkAction::make('bulk-unban-model')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
