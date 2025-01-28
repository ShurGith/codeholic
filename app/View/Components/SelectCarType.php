<?php
    
    namespace App\View\Components;
    
    use App\Models\CarType;
    use Closure;
    use Illuminate\Contracts\View\View;
    use Illuminate\Support\Collection;
    use Illuminate\View\Component;
    
    class SelectCarType extends Component
    {
        public Collection $types;
        
        public function __construct()
        {
            $this->types = CarType::orderBy('name')->get();
        }
        
        /**
         * Get the view / contents that represent the component.
         */
        public function render(): View|Closure|string
        {
            return view('components.select-car-type');
        }
    }
