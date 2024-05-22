<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section>

    <form wire:submit="updatePassword" >


        <div class="row mb-3">
            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="current_password" name="current_password" type="password" class="form-control" id="currentPassword" autocomplete="current-password">
            </div>
            <span>@error('current_password') <p class="text-danger">{{$message}} @enderror</span>
        </div>

        <div class="row mb-3">
            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="password" name="password" type="password" class="form-control" id="newPassword" autocomplete="new-password">
            </div>
            <span>@error('password') <p class="text-danger">{{$message}} @enderror</span>

        </div>


        <div class="row mb-3">
            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="password_confirmation" name="password_confirmation" type="password" class="form-control" id="renewPassword" autocomplete="new-password">
            </div>
            <span>@error('password_confirmation') <p class="text-danger">{{$message}} @enderror</span>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Change Password</button>
        </div>

    </form>

</section>
