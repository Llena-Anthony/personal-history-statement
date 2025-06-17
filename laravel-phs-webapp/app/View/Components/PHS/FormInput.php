<?php

namespace App\View\Components\PHS;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $label;
    public $name;
    public $type;
    public $value;
    public $required;
    public $help;
    public $error;

    public function __construct(
        $label,
        $name,
        $type = 'text',
        $value = '',
        $required = false,
        $help = null,
        $error = null
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->required = $required;
        $this->help = $help;
        $this->error = $error;
    }

    public function render()
    {
        return view('phs.components.form-input');
    }
} 