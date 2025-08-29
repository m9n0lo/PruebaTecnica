<?php
namespace App\Filament\Resources\Productos\Tables;

use App\Models\Productos;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable(),
                TextColumn::make('precio')
                    ->numeric()
                    ->money('COP', true) 
                    ->sortable(),
                TextColumn::make('categorias.nombre')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('imagen')
                    ->circular()
                    ->grow(false),
                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->state(fn(Productos $r) => $r->agotado)
                    ->formatStateUsing(fn($state, Productos $r) => $state ? 'Agotado' : 'Disponible')
                    ->color(fn($state) => $state ? 'danger' : 'success'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('categorias')
                    ->label('Categoría')
                    ->relationship('categorias', 'nombre'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
