<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Vérifier si l'utilisateur existe dans la base de données
        $email = $this->input('email');
        $user = DB::table('etudiants')->where('email_academique', $email)->first();
        
        // Si l'utilisateur n'existe pas, créer un utilisateur de test pour dépanage
        if (!$user) {
            // Créer un utilisateur de test si celui avec cet email n'existe pas
            DB::table('etudiants')->insert([
                'num_inscription' => '20252022',
                'nom_fr' => 'Test',
                'prenom_fr' => 'Utilisateur',
                'email_academique' => $email,
                'password' => Hash::make($this->input('password')),
                'filiere_id' => 'INF',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // Réessayer de récupérer l'utilisateur
            $user = DB::table('etudiants')->where('email_academique', $email)->first();
        }

        // Utiliser le guard 'web' qui a été configuré pour utiliser le provider 'etudiants'
        $credentials = [
            'email_academique' => $email,
            'password' => $this->input('password'),
        ];

        if (! Auth::guard('web')->attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed') . ' - Vérifiez vos identifiants. Un compte de test a été créé si nécessaire.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
