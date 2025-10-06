<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'mail' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name' => $input['username'],
            'username' => $input['username'],
            'age' => $input['age'],
            'email' => $input['mail'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
