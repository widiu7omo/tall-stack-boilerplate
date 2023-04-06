<?php

namespace App\Http\Livewire\App\Auth;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class RegisterForm extends Component
{
    public ?string $firstName;
    public ?string $lastName;
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

    protected array $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    private function fullName(): string
    {
        return $this->firstName . " " . $this->lastName;
    }

    public function register(): void
    {
        $validatedData = $this->validate();
        $newUser = User::create(['name' => $this->fullName(), ...$validatedData]);
        $newUser->assignRole(['filament_user']);
        auth()->login($newUser);
        $this->redirect(route('app.home'));
    }

    public function render(): View
    {
        return view('livewire.app.auth.register-form')->layout('layouts.auth', ['title' => 'Register to access our features']);
    }
}
