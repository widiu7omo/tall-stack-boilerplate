<?php

namespace App\Http\Livewire\App\Auth;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LoginForm extends Component
{
    public ?string $email;
    public ?string $password;

    public function mount(): void
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole(['super_admin'])) {
                $this->redirect(route('filament.pages.dashboard'));
            } else {
                $this->redirect(route('app.home'));
            }
        }
    }

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6'
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $validatedData = $this->validate();
        $user = User::where($validatedData)->first();
        if ($user) {
            auth()->login($user);
            $this->redirect(route('app.home'));
        }
        $this->addError('login_failed', "Credentials doesn't match with our record");
        //TODO: login & redirect
    }

    public function render(): View
    {
        return view('livewire.app.auth.login-form')->layout('layouts.auth', ['title' => 'Login to access the features']);
    }
}
