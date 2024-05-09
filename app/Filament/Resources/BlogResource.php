<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Forms\Components;
use Filament\Forms\Components\RichEditor;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Card;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Create Blog')
            ->description('Blog Title, description and Meta details.')
            ->schema([
                Forms\Components\TextInput::make('title')
                ->live(debounce: '1000')
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                ->required(),
                Forms\Components\Textarea::make('excerpt')
                ->required(),
                Forms\Components\RichEditor::make('content')
                ->toolbarButtons([
                    'attachFiles',
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'h4',
                    'h5',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ])
                ->required(),
                Forms\Components\TextInput::make('seo_title')
                ->required(),
                Forms\Components\Textarea::make('meta_description')
                ->required(),
                Forms\Components\TagsInput::make('keyword')
                ->separator(','),
            ])->columnSpan(2),

            Section::make('Blog Status/Media')
            ->description('Check Blog status and upload featured Image.')
            ->schema([
                Forms\Components\Toggle::make('status')
                ->onColor('success')
                ->offColor('danger'),
                Forms\Components\FileUpload::make('image')
                ->required(),
                Forms\Components\CheckboxList::make('category')
                ->relationship('categories', 'name')
                ->searchable()
            ])->columnSpan(1),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\ToggleColumn::make('status')->onColor('success')->offColor('danger'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
