<?php
    
    namespace App\View\Components;
    
    use App\Models\Modelo;
    use Closure;
    use Illuminate\Contracts\View\View;
    use Illuminate\Support\Collection;
    use Illuminate\View\Component;
    
    class SelectModel extends Component
    {
        public Collection $models;
        
        public function __construct()
        {
            
            $this->models = Modelo::class::orderBy('name')->get();
        }
        
        /**
         * Get the view / contents that represent the component.
         */
        public function render(): View|Closure|string
        {
            return view('components.select-model');
        }
    }
