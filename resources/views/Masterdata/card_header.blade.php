<div class="dropdown">
    @php
        $array_route    = ['mplant','mline','mmodel','mpart'];
    @endphp
    <a class="dropdown-toggle @if (in_array(Route::currentRouteName() , $array_route)) active @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Production Data
    </a>

    <ul class="dropdown-menu">
        <li class="@if (Route::currentRouteName()=='mplant') active @endif">
            <a class="dropdown-item" href="{{route('mplant')}}"><span>Plant Type</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='mline') active @endif">
            <a class="dropdown-item" href="{{route('mline')}}"><span>Line Type</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='mmodel') active @endif">
            <a class="dropdown-item" href="{{route('mmodel')}}"><span>Model Type</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='mpart') active @endif">
            <a class="dropdown-item" href="{{route('mpart')}}"><span>Part Type</span><i class="bi bi-house-fill"></i></a>
        </li>
    </ul>
</div>

<div class="dropdown">
    @php
        $array_route    = ['mholder','mtool','mmaterial','maccessories'];
    @endphp
    <a class="dropdown-toggle @if (in_array(Route::currentRouteName() , $array_route)) active @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Cutting Tool
    </a>

    <ul class="dropdown-menu">
        <li class="@if (Route::currentRouteName()=='mholder') active @endif">
            <a class="dropdown-item" href="{{route('mholder')}}"><span>Holder Type</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='mtool') active @endif">
            <a class="dropdown-item" href="{{route('mtool')}}"><span>Tool Type</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='mmaterial') active @endif">
            <a class="dropdown-item" href="{{route('mmaterial')}}"><span>Material Type</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='maccessories') active @endif">
            <a class="dropdown-item" href="{{route('maccessories')}}"><span>Accessories Type</span><i class="bi bi-house-fill"></i></a>
        </li>
    </ul>
</div>

<div class="dropdown">
    <a class="dropdown-toggle @if (Route::currentRouteName()=='mbat') active @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        BAT
    </a>

    <ul class="dropdown-menu">
        <li class="@if (Route::currentRouteName()=='mbat') active @endif">
            <a class="dropdown-item" href="{{route('mbat')}}"><span>BAT Category</span><i class="bi bi-house-fill"></i></a>
        </li>
    </ul>
</div>

<div class="dropdown">
    @php
        $array_route    = ['mtolerance','mmakertool','mmakermachine','mmachineregrind','mmarkingprogram','munit'];
    @endphp
    <a class="dropdown-toggle @if (in_array(Route::currentRouteName() , $array_route)) active @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        General
    </a>

    <ul class="dropdown-menu">
        <li class="@if (Route::currentRouteName()=='mtolerance') active @endif">
            <a class="dropdown-item" href="{{route('mtolerance')}}"><span>Tolerance Type</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='mmakertool') active @endif">
            <a class="dropdown-item" href="{{route('mmakertool')}}"><span>Maker Tool</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='mmakermachine') active @endif">
            <a class="dropdown-item" href="{{route('mmakermachine')}}"><span>Maker Machine</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='mmachineregrind') active @endif">
            <a class="dropdown-item" href="{{route('mmachineregrind')}}"><span>Machine Regrind</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='mmarkingprogram') active @endif">
            <a class="dropdown-item" href="{{route('mmarkingprogram')}}"><span>Marking Program</span><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="@if (Route::currentRouteName()=='munit') active @endif">
            <a class="dropdown-item" href="{{route('munit')}}"><span>Unit</span><i class="bi bi-house-fill"></i></a>
        </li>
    </ul>
</div>