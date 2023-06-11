@php
    /** @var string $reactComponentToRender */
    /** @var ?iterable $componentData */
    $page = [ 'component' => $reactComponentToRender, 'url' => url()->current()];
@endphp

<div class="react-from-blade-{{$reactComponentToRender}}"></div>
