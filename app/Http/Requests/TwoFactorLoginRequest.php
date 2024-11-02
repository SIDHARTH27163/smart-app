<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TwoFactorLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all users for 2FA, since they're already authenticated.
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|size:6', // Assuming the 2FA code is a 6-digit string
        ];
    }

    /**
     * Determine if the request has a challenged user for 2FA.
     */
    public function hasChallengedUser(): bool
    {
        return session('two_factor_auth') === true; // Check session flag
    }

    /**
     * Get the user that is being challenged for 2FA.
     */
    public function challengedUser()
    {
        // Fetch the user from the session or auth
        return $this->user();
    }

    /**
     * Check if the provided code is valid.
     */
    public function hasValidCode(): bool
    {
        // Assuming you have a method in your User model to validate the 2FA code
        return $this->challengedUser()->validateTwoFactorCode($this->input('code'));
    }

    /**
     * Optionally, you could handle recovery codes as well.
     */
    public function validRecoveryCode()
    {
        // Implement recovery code validation logic if you have that functionality.
    }
}
