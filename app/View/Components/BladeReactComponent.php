<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class BladeReactComponent extends Component
{
    public string $reactComponentToRender;

    public iterable $componentData;

    public function __construct()
    {
        $this->reactComponentToRender = $this->getReactComponentName();
        $this->componentData = $this->getComponentData();
    }

    final public function render(): View|Closure|string
    {
        return view('components.blade-react-component');
    }

    protected function getReactComponentName(): string
    {
       return class_basename($this);
    }

    protected function getComponentData(): iterable
    {
        return [];
    }
}
