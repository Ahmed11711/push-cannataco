<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function getNavigationLabel(): string
    {
        return __('blog.blogs');
    }
    public static function getModelLabel(): string
    {
        return __('blog.blog');
    }
    public static function getPluralModelLabel(): string
    {
        return __('blog.blogs');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Content Tabs')
                    ->tabs([
                        Tab::make('العربية')
                            ->schema([
                                TextInput::make('title.ar')->label('العنوان')->required(),
                                RichEditor::make('content.ar')->label('المحتوى'),
                            ]),
                        Tab::make('الإنجليزية')
                            ->schema([
                                TextInput::make('title.en')->label('Title')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn(string $operation, $state, Set $set) =>
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    )
                                    ->required(),
                                RichEditor::make('content.en')->label('Content'),
                            ]),
                    ])->columnSpanFull(),
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make('delete_image')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->iconButton()
                        ->action(fn(callable $set) => $set('image', null)),
                ]),
                FileUpload::make('image')
                    ->label('image')
                    ->image()
                    ->required()
                    ->imageEditor()
                    ->preserveFilenames()
                    ->directory('blog')
                    ->visibility('public')
                    ->enableOpen()
                    ->enableDownload()
                    ->enableOpen()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('image_alt'),
                TextInput::make('slug')
                    ->label('slug')
                    ->required()
                    ->reactive()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_published')
                    ->label('نشر المقال؟')
                    ->inline(false)
                    ->default(false),
                Group::make()
                    ->relationship('seo')
                    ->schema([
                        Card::make()
                            ->schema([
                                Tabs::make('Content Tabs')
                                    ->tabs([
                                        Tab::make('العربية')
                                            ->schema([
                                                TextInput::make('meta_title.ar')->label('العنوان')
                                                    ->label('عنوان الميتا'),
                                            ]),
                                        Tab::make('الإنجليزية')
                                            ->schema([
                                                TextInput::make('meta_title.en')->label('Title')
                                                    ->label('meta_title')

                                            ]),
                                    ])->columnSpanFull(),

                                TextInput::make('meta_keywords')
                                    ->columnSpanFull()
                                    ->label('meta_keywords'),
                                TextInput::make('canonical_url')
                                    ->label('canonical url'),
                                TextInput::make('meta_robots')
                                    ->label('meta robots')
                                    ->default('index, follow'),
                                Textarea::make('meta_description')
                                    ->label('meta description')
                                    ->columnSpanFull(),
                                FileUpload::make('og_image')
                                    ->label('og image')
                                    ->columnSpanFull()
                                    ->image()
                                    ->enableOpen()
                                    ->enableDownload()
                                    ->enableOpen()
                                    ->directory('seo/og_images')
                                    ->preserveFilenames()
                                    ->imageEditor()
                                    ->visibility('public'),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpanFull()
                    ->label('SEO'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('image')
                    ->getStateUsing(fn($record) => asset('storage/' . $record->image))
                    ->circular()
                    ->disk('public')
                    ->size(50),
                Tables\Columns\ImageColumn::make('image_alt')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
