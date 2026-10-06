<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * $type: success | error | info
     */
    public function __construct(
        public string $type = 'info',
        public ?string $message = null,
    ) {
    }

    public function classes(): string
    {
        return match ($this->type) {
            'success' => 'bg-green-50 text-green-800 border-green-200',
            'error' => 'bg-red-50 text-red-800 border-red-200',
            default => 'bg-blue-50 text-blue-800 border-blue-200',
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
