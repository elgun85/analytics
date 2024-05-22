<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="row g-3 needs-validation" novalidate>


        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" wire:model="form.email" name="email" class="form-control" id="email" required autofocus autocomplete="username">
                <span>@error('form.email') <p class="text-danger">{{$message}} @enderror</span>
            </div>
        </div>


        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <input type="password" wire:model="form.password"  name="password" class="form-control" id="password" required autocomplete="current-password">
            <span>@error('form.password') <p class="text-danger">{{$message}} @enderror</span>
        </div>

        <div class="col-12">
            <div class="form-check">
                <input wire:model="form.remember"  class="form-check-input" type="checkbox" name="remember" value="true" id="remember">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
        </div>

        <div for="remember" class="col-12">
            <button class="btn btn-primary w-100" type="submit">Login</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Don't have account? <a href="{{route('registers')}}">Create an account</a></p>
        </div>
    </form>




{{--        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

        </div>--}}

</div>
