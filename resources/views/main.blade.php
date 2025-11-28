<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <meta name="viewport" content= "user-scalable=no, width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Cutting Tool Management || {{$title}}</title>
        <link rel="apple-touch-icon" href="">
        <link rel="shortcut icon" type="image/x-icon" href="">
        <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/bootstrap/bootstrap-icons.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/select2/select2.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/config.css')}}" rel="stylesheet">
        <script src="{{asset('assets/js/moment.min.js')}}"></script>
        <script src="{{asset('assets/js/id.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-3.7.1.min.js')}} "></script>
        <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/select2/select2.min.js')}}"></script>
        <script src="{{asset('assets/sweetalert2/sweetalert2.all.min.js')}}"></script>

        @include('Template.head')

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </head>
    <body>

        <div class="wrapper">
            {{-- Header dan Sidebar  --}}
            @include('Template.sidebar')
            <div class="content">
                {{-- Include Header --}}
                @include('Template.header')
                {{-- Content yang akan di tampilkan --}}
                @yield('content')
            </div>
        </div>

        <script>
            $(document).ready(function() {
                moment.locale('id');
                var currentTime = moment().format('ddd, D MMM YYYY HH:mm'); 
                $('#date_show').text(currentTime);
            });
        </script>

    </body>
</html>