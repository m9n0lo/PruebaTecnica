<?php
namespace App\Filament\Resources\Productos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductosForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required()
                    ->columnSpan(6)
                    ->maxLength(255),
                TextInput::make('precio')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->required()
                    ->columnSpan(3),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->columnSpan(3),
                Select::make('categoria_id')
                    ->relationship('categorias', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpan(6),
                    FileUpload::make('imagen')
                    ->label('Imagen')
                    ->image()
                    ->disk('public')
                    ->directory('productos') // storage/app/public/productos
                    ->imageEditor()
                    ->columnSpan(6),
                    RichEditor::make('descripcion')
                    ->label('Descripción')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold', 'italic', 'strike', 'link', 'h2', 'h3', 'blockquote', 'orderedList', 'bulletList', 'codeBlock',
                    ])
                    ->columnSpan(6),

            ]);
    }
}
