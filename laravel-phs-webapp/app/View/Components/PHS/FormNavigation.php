<?php

namespace App\View\Components\PHS;

use Illuminate\View\Component;

class FormNavigation extends Component
{
    public $previousRoute;
    public $nextRoute;
    public $previousText;
    public $nextText;

    public function __construct(
        $previousRoute = null,
        $nextRoute = null,
        $previousText = 'Previous Section',
        $nextText = 'Next Section'
    ) {
        $this->previousRoute = $previousRoute;
        $this->nextRoute = $nextRoute;
        $this->previousText = $previousText;
        $this->nextText = $nextText;
    }

    public function render()
    {
        return view('phs.components.form-navigation');
    }
} 