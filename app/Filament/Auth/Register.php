<?php

namespace App\Filament\Auth;
use App\Models\School;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;

use Filament\Pages\Auth\Register as AuthRegister;

class Register extends AuthRegister{

    protected static string $view = 'filament/auth/register';


    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }
    
    protected function getFormColumns(): array
    {
        return [
            'sm' => 2,
            'md' => 3,
            'lg' => 4,
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make()
                ->columns($this->getFormColumns())
                ->schema([
                    TextInput::make('name')
                        ->label('Name'),
                    TextInput::make('email')
                        ->label('Email'),
                    Select::make('school_id')
                        ->label('School')
                        ->options(School::pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required(),
                    TextInput::make('password')
                        ->label('Password'),
                    TextInput::make('password_confirmation')
                        ->label('Password Confirmation'),
                ]),
        ];
    }
    
    public function form(Form $form): Form
    {
        return $form -> schema([
            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            Select::make('school_id')
                ->label("School")
                ->options(School::pluck('name', 'id'))
                ->searchable()
                ->preload()
                ->required(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
        ])
        ->statePath(path: 'data');
    }


}