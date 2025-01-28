<?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Contracts\Validation\ValidationRule;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rules\Password;
    
    class SignupUserRequest extends FormRequest
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
         * @return array<string, ValidationRule|array<mixed>|string>
         */
        public function rules(): array
        {
            return [
              'name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'email', 'unique:users,email'],
              'phone' => ['required', 'string', 'max:255', 'unique:users,phone'],
              'password' => [
                'required', 'string', 'confirmed',
                Password::min(8)
                  ->max(24)
                  ->numbers()
                  ->mixedCase()
                  ->symbols()
                  ->uncompromised()
              ]
            ];
        }
    }
