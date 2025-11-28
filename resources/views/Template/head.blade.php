@if (Route::currentRouteName()=='home')
    <link href="{{asset('assets/css/dashboard/list.css')}}" rel="stylesheet">
    <script src="{{ asset('assets/highcharts/highcharts.js')}}"></script>
@endif

@if (Route::currentRouteName()=='changetool')
    <link href="{{asset('assets/css/changetool.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/html5-qrcode.min.js')}}"></script>
@endif

@if (Route::currentRouteName()=='mplant')
    <link href="{{asset('assets/css/masterdata/mplant.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mline')
    <link href="{{asset('assets/css/masterdata/mline.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mmodel')
    <link href="{{asset('assets/css/masterdata/mmodel.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mpart')
    <link href="{{asset('assets/css/masterdata/mpart.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mholder')
    <link href="{{asset('assets/css/masterdata/mholder.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mtool')
    <link href="{{asset('assets/css/masterdata/mtool.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mmaterial')
    <link href="{{asset('assets/css/masterdata/mmaterial.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='maccessories')
    <link href="{{asset('assets/css/masterdata/maccessories.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mbat')
    <link href="{{asset('assets/css/masterdata/mbat.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mtolerance')
    <link href="{{asset('assets/css/masterdata/mtolerance.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mmakertool')
    <link href="{{asset('assets/css/masterdata/mmakertool.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mmakermachine')
    <link href="{{asset('assets/css/masterdata/mmakermachine.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mmachineregrind')
    <link href="{{asset('assets/css/masterdata/mmachineregrind.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='mmarkingprogram')
    <link href="{{asset('assets/css/masterdata/mmarkingprogram.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='munit')
    <link href="{{asset('assets/css/masterdata/munit.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='rholder')
    <link href="{{asset('assets/css/registrasi/rholder.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='rtool')
    <link href="{{asset('assets/css/registrasi/rtool.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='raccessories')
    <link href="{{asset('assets/css/registrasi/raccessories.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='rmachine')
    <link href="{{asset('assets/css/registrasi/rmachine.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.floatThead.js')}}"></script>
@endif

@if (Route::currentRouteName()=='createmachine')
    <link href="{{asset('assets/css/machine/create.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='incoming')
    <link href="{{asset('assets/css/incoming/incoming.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='imarkingholder')
    <link href="{{asset('assets/css/incoming/imarkingholder.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='imarkingtool')
    <link href="{{asset('assets/css/incoming/imarkingtool.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='iinspectionrecord')
    <link href="{{asset('assets/css/incoming/iinspectionrecord.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='igoodstockholder')
    <link href="{{asset('assets/css/incoming/igoodstockholder.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='igoodstocktool')
    <link href="{{asset('assets/css/incoming/igoodstocktool.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='igoodstocaccessories')
    <link href="{{asset('assets/css/incoming/igoodstocaccessories.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='iassy')
    <link href="{{asset('assets/css/incoming/iassy.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='imeasure')
    <link href="{{asset('assets/css/incoming/imeasure.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='iassystock')
    <link href="{{asset('assets/css/incoming/iassystock.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='tgate')
    <link href="{{asset('assets/css/incoming/tgate.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.floatThead.js')}}"></script>
@endif

@if (Route::currentRouteName()=='tabnormality')
    <link href="{{asset('assets/css/incoming/tabnormality.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='tassytortuline')
    <link href="{{asset('assets/css/incoming/tassytortuline.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='rtoolanalyze')
    <link href="{{asset('assets/css/incoming/rtoolanalyze.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='rdetailtoolanalyze')
    <link href="{{asset('assets/css/incoming/rdetailtoolanalyze.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='rregrind')
    <link href="{{asset('assets/css/incoming/rregrind.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='pokayokestep1')
    <link href="{{asset('assets/css/pokayoke/pokayokestep1.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/html5-qrcode.min.js')}}"></script>
@endif

@if (Route::currentRouteName()=='pokayokestep2')
    <link href="{{asset('assets/css/pokayoke/pokayokestep2.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.floatThead.js')}}"></script>
    <script src="{{asset('assets/js/html5-qrcode.min.js')}}"></script>
@endif

@if (Route::currentRouteName()=='pokayokestep3')
    <link href="{{asset('assets/css/pokayoke/pokayokestep3.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.floatThead.js')}}"></script>
    <script src="{{asset('assets/js/html5-qrcode.min.js')}}"></script>
@endif

@if (Route::currentRouteName()=='pokayokestep4')
    <link href="{{asset('assets/css/pokayoke/pokayokestep4.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.floatThead.js')}}"></script>
    <script src="{{asset('assets/js/html5-qrcode.min.js')}}"></script>
@endif

@if (Route::currentRouteName()=='pokayokestep5')
    <link href="{{asset('assets/css/pokayoke/pokayokestep5.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.floatThead.js')}}"></script>
@endif

@if (Route::currentRouteName()=='users')
    <link href="{{asset('assets/css/configuration/users.css')}}" rel="stylesheet">
@endif

@if (Route::currentRouteName()=='tfirstpokayokestep1')
    <link href="{{asset('assets/css/incoming/firstpokayokestep1.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.floatThead.js')}}"></script>
    <script src="{{asset('assets/js/html5-qrcode.min.js')}}"></script>
@endif

@if (Route::currentRouteName()=='tfirstpokayokestep2')
    <link href="{{asset('assets/css/incoming/firstpokayokestep2.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.floatThead.js')}}"></script>
    <script src="{{asset('assets/js/html5-qrcode.min.js')}}"></script>
@endif

@if (Route::currentRouteName()=='tfirstpokayokestep3')
    <link href="{{asset('assets/css/incoming/firstpokayokestep3.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.floatThead.js')}}"></script>
    <script src="{{asset('assets/js/html5-qrcode.min.js')}}"></script>
@endif

@if (Route::currentRouteName()=='tfirstpokayokestep4')
    <link href="{{asset('assets/css/incoming/firstpokayokestep4.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.floatThead.js')}}"></script>
    <script src="{{asset('assets/js/html5-qrcode.min.js')}}"></script>
@endif

