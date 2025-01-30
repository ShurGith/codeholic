<?php
    
    namespace App\Policies;
    
    use App\Models\Car;
    use App\Models\User;
    use Illuminate\Auth\Access\Response;
    
    class CarPolicy
    {
        public function create(User $user): bool
        {
            return !!$user->isAdmin();
        }
        
        public function update(User $user, Car $car): Response
        {
            return $user->id === $car->user_id ? Response::allow()
              : Response::denyWithStatus(403, "No permitido");
        }
        
        public function delete(User $user, Car $car): Response
        {
            return $user->id === $car->user_id ? Response::allow()
              : Response::denyWithStatus(403, "No permitido");
        }
        
    }
