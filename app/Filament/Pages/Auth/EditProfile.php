<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Notifications\Notification;

class EditProfile extends BaseEditProfile
{


    protected static string $view = 'filament.pages.auth.edit-profile';
    protected static string $layout = 'filament-panels::components.layout.index';

        public function form(Form $form): Form
    {
        return $form
            ->schema([

                
                Section::make(' ')
                
                ->schema([
                     
                    $this->getNameFormComponent()->required(),
                    $this->getApellidoFormComponent()->required(),
                    $this->getEmailFormComponent()->required(),
                    $this->getPasswordFormComponent()->required(),
                    $this->getPasswordConfirmationFormComponent()->required(),
                ])
                ->aside('left')
            ]);
    }

    protected function getSavedNotification(): ?Notification
    {
        return  Notification :: make()
        ->success()
        ->title('¡Edición Exitoso!')
        ->body('Sus datos se han editado correctamente')
        ->seconds(15)
        ->send()
        ->icon('heroicon-o-pencil-square');
    }
}


