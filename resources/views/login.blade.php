<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <meta name="viewport" content= "user-scalable=no, width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Cutting Tool || Login</title>
        <link rel="apple-touch-icon" href="">
        <link rel="shortcut icon" type="image/x-icon" href="">
        <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/bootstrap/bootstrap-icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/login.css')}}" rel="stylesheet">
        <script src="{{asset('assets/js/moment.min.js')}}"></script>
        <script src="{{asset('assets/js/id.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-3.7.1.min.js')}} "></script>
        <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </head>
    <body>
        <main>
            <div class="card-logo">
                <div class="body-logo">
                    <img class="logo-login" src="{{asset('assets/icon/logo-login.svg')}}" alt="">
                </div>
            </div>
            <div class="card-form">
                <img class="ahm-login" src="{{asset('assets/icon/ahm-login.svg')}}" alt="">
                <p class="text-1">Welcome to</p>
                <p class="text-2">Cutting Tool Management</p>

                <p class="text-3">please enter your</p>
                <p class="text-3">NRP and password in the fields below</p>

                <form action="{{route('login_post')}}" method="POST" class="form-login">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
                        <input type="text" class="form-control" name="nrp" placeholder="NRP" aria-label="NRP" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-4">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" placeholder="PASSWORD" aria-label="PASSWORD" aria-describedby="basic-addon1" id="password" name="password">
                        <span class="input-group-text show-hide-pass togglePassword" id="basic-addon1"><i class="bi bi-eye-fill" id="icon-show"></i><i class="bi bi-eye-slash-fill" id="icon-hide" style="display: none"></i></span>
                    </div>

                    <button type="submit" class="btn btn-login">Login</button>
                </form>

                <p class="text-4">We Digitize Things</p>
                <p class="text-copyright"> © {{date('Y')}}</p>
            </div>
        </main>

        <script>
            $(document).ready(function() {
                $('.togglePassword').click(function() {
                    var passwordInput = $('#password');
                    var passwordFieldType = passwordInput.attr('type');

                    if (passwordFieldType === 'password') {
                        passwordInput.attr('type', 'text');
                        $('#icon-hide').show();
                        $('#icon-show').hide();
                    } else {
                        passwordInput.attr('type', 'password');
                        $('#icon-show').show();
                        $('#icon-hide').hide();
                    }
                });
            });
        </script>
    </body>
</html>
