<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="a-sidebar">
            <i class="icon-sidebar-logo"></i>
            <p class="mb-0">Cutting Tools Management</p>
        </a>
    </div>

    <a href="{{route('home')}}" class="@if (Route::currentRouteName()=='home') active @endif">
        <div class="card-sidebar">
            <i class="i-dashboard"></i>
            <p>Dashboard</p>
        </div>
    </a>

    @php
        $array_route    = ['mplant','mline','mmodel','mpart','mholder','mtool','mmaterial','maccessories','mbat','mtolerance','mmakertool','mmakermachine','mmachineregrind','mmarkingprogram','munit'];
    @endphp
    <a href="{{route('mplant')}}" class="@if (in_array(Route::currentRouteName() , $array_route)) active @endif">
        <div class="card-sidebar">
            <i class="i-masterdata"></i>
            <p>Master Data</p>
        </div>
    </a>

    @php
        $array_route    = ['rholder','rtool','raccessories','rmachine'];
    @endphp
    <a href="{{route('rholder')}}" class="@if (in_array(Route::currentRouteName() , $array_route)) active @endif">
        <div class="card-sidebar">
            <i class="i-registration"></i>
            <p>Registration</p>
        </div>
    </a>

    <a href="{{route('createmachine')}}" class="@if (Route::currentRouteName() == 'createmachine') active @endif">
        <div class="card-sidebar">
            <i class="i-createmachine"></i>
            <p>Create Machine</p>
        </div>
    </a>

    @php
        $array_route    = ['incoming','imarkingholder','imarkingtool','iinspectionrecord','igoodstockholder','igoodstocktool','igoodstocaccessories','iassy','imeasure','iassystock','tgate','tabnormality','tassytortuline','rtoolanalyze','rdetailtoolanalyze','rregrind','tfirstpokayokestep1','tfirstpokayokestep2','tfirstpokayokestep3','tfirstpokayokestep4'];
    @endphp
    <a href="{{route('incoming')}}" class="@if (in_array(Route::currentRouteName() , $array_route)) active @endif">
        <div class="card-sidebar">
            <i class="i-incoming"></i>
            <p>Incoming</p>
        </div>
    </a>

    @php
        $array_route    = ['pokayokestep1','pokayokestep2','pokayokestep3','pokayokestep4','pokayokestep5'];
    @endphp
    <a href="{{route('pokayokestep1')}}" class="@if (in_array(Route::currentRouteName() , $array_route)) active @endif">
        <div class="card-sidebar">
            <i class="i-pokayoke"></i>
            <p>Pokayoke</p>
        </div>
    </a>

    <a href="{{route('users')}}" class="@if (Route::currentRouteName() == 'users') active @endif">
        <div class="card-sidebar">
            <i class="i-configure"></i>
            <p>Configuration</p>
        </div>
    </a>

    <a href="{{route('report')}}" class="@if (Route::currentRouteName() == 'report') active @endif">
        <div class="card-sidebar">
            <i class="i-report"></i>
            <p>Report</p>
        </div>
    </a>
</nav>