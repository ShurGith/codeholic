<?php
    
    namespace App\View\Components;
    
    use App\Models\Maker;
    use Closure;
    use Illuminate\Contracts\View\View;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\View\Component;
    
    class
    SelectMaker extends Component
    {
        public Collection $makers;
        
        public function __construct()
        {
            
            /*    $this->makers = Cache::get('makers');
                if ($this->makers === null) {
                    $this->makers = Maker::orderBy('name')->get();
                    Cache::set('makers', $this->makers);
                }*/
            $this->makers = Cache::rememberForever('makers', function () {
                return Maker::orderBy('name')->get();
            });
        }
        
        /**
         * Get the view / contents that represent the component.
         */
        public function render(): View|Closure|string
        {
            return view('components.select-maker');
        }
    }
