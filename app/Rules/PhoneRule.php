<?php
    
    namespace App\Rules;
    
    use Closure;
    use Illuminate\Contracts\Validation\ValidationRule;
    
    class PhoneRule implements ValidationRule
    {
        public function validate(string $attribute, mixed $value, Closure $fail): void
        {
            $chars = 6;
            if (strlen($value) < $chars) {
                $fail("El {$attribute} mínimo {$chars} caracteres en app/Rules/PhoneRules.php");
            }
        }
    }
