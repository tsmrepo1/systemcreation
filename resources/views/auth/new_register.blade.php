<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>New user</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">

    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    {{-- Page Level Styles --}}
    @yield('styles')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/css/adminlte.min.css')}}">
    <!-- Tree View -->
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-treeview.min.css')}}">

    <!-- Load calender -->
    <link rel="stylesheet" href="{{asset('admin/plugins/fullcalendar/main.css')}}">

    {{-- Page level Css --}}
    @yield('css')

     {{-- Custom Css --}}
  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('images/logo-icon.png')}}" alt="New User" height="60" width="60">
        </div>

        <section class="bg-dark py-2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        {{-- <div class="logoCont"> <img src="{{ asset('admin/img/logo-horizontal.png')}}" alt="logo"> </div> --}}
                        <h1> Register a new user </h1>

                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="content-wrapper normal_wrap">
            <section class="content">
                <div class="defaultFormWrap">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                                <h4 class="text-center">New Registration</h4>
                                            <hr/>
                                        </div>
                                    </div>
                                    <form action="{{ route('register.store') }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <x-Forms.Input type="text" label="First Name" id="first_name" name="first_name" />
                                            </div>
                                            <div class="col-sm-6">
                                                <x-Forms.Input type="text" label="Last Name" id="last_name" name="last_name" />
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <x-Forms.Input type="email" label="Email" id="email" name="email" placeholder="Email" required />
                                            </div>

                                            <div class="col-sm-6">
                                                <x-Forms.Input type="text" label="Referral Code" id="referral_code" name="referral_code" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <label for="address">Address</label>
                                                <textarea name="address" class="form-control" id="address" rows="3"></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="profession">Profession and work information</label>
                                                <textarea name="profession" class="form-control" id="profession" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="students_potential">How do you know potential students?</label>
                                                <textarea name="students_potential" class="form-control" id="students_potential" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                        <button value="submit" class="btn pill_btn btn_baseColor mt-2 btn_reg px-5" type="submit" onclick="this.form.submit(); this.disabled=true; this.innerText='Hold on...';"> Save </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- //container-fluid --}}
            </section>
        </div>
    </div>

    @if(Session::has('success'))
        <div class="toast" data-type="success" data-title="Thank You!" > {{ Session::get('success') }}</div>
    @endif

    <!-- jQuery -->
    <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/inputmask/inputmask.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- jQuery UI -->
    <script src="{{asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- AdminLTE -->
    <script src="{{asset('admin/js/adminlte.js')}}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

    <!-- summernote -->
    <script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

    <!-- Moment JS -->
    <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>

    <!-- Calender Js -->
    <script src="{{asset('admin/plugins/fullcalendar/main.js')}}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('admin/js/demo.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('admin/js/pages/dashboard3.js')}}"></script>
    <!-- Tree View -->
    <script src="{{asset('admin/js/bootstrap-treeview.min.js')}}"></script>
    {{-- @include('backend.admin.common.message-alert') --}}
    <script>
        $('[data-mask]').inputmask();
    </script>
</body>
</html>
