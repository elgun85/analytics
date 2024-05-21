<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register" class="row g-3 needs-validation" novalidate>

        <div class="col-12">
            <label for="name" class="form-label"> Name</label>
            <input type="text"  wire:model="name"   class="form-control"id="name" name="name" required autofocus autocomplete="name">
            <span>@error('name') <p class="text-danger">{{$message}} @enderror</span>
        </div>

        <div class="col-12">
            <label for="Email" class="form-label"> Email</label>
            <input type="email" wire:model="email"  name="email" class="form-control" id="Email" required autocomplete="username">
            <span>@error('email') <p class="text-danger">{{$message}} @enderror</span>
        </div>


        <div class="col-12">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" wire:model="password"  name="password" class="form-control" id="yourPassword"  required autocomplete="new-password" >
            <span>@error('password') <p class="text-danger">{{$message}} @enderror</span>
        </div>


        <div class="col-12">
            <label for="yourPassword" class="form-label">Confirm Password</label>
            <input type="password" wire:model="password_confirmation" name="password" class="form-control" id="password_confirmation" required>
            <span>@error('password_confirmation') <p class="text-danger">{{$message}} @enderror</span>

        </div>


        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Create Account</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Already have an account? <a href="{{ route('login') }}" wire:navigate>Log in</a></p>
        </div>
    </form>

</div>
