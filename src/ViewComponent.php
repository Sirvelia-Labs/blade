<?php

namespace Lexdubyna\Blade;

use Illuminate\Support\Facades\Facade;
use Illuminate\View\Component;
use Illuminate\View\View;

class ViewComponent extends Component
{
    private function view(string $name): View
    {
        return Facade::getFacadeApplication()->get('view')->make(
            $name,
            $this->extractPublicProperties()
        );
    }

    public function render(): View
    {
        return $this->view($this->template);
    }
}
