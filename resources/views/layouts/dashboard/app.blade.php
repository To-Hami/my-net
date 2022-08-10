<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description"
          content="Netflifify for watch movies">

    <title>Netflixify</title>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{csrf_token()}}">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" href="{{asset('assets/dashboard_files/css/main.css')}}">
    <script src="{{asset('assets/dashboard_files/js/jquery-3.3.1.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/dashboard_files/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard_files/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard_files/plugins/noty/noty.css')}}">
    <script src="{{asset('assets/dashboard_files/css/custom.css')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/dashboard_files/plugins/select2/select2.min.css')}}">
    <script src="{{asset('assets/dashboard_files/plugins/noty/noty.min.js')}}"></script>


    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('styles')
</head>
<body class="app sidebar-mini">

@include('layouts.dashboard.__header')

@include('layouts.dashboard.__aside')

<main class="app-content">

    @include('dashboard.partials._session')

    @yield('content')
</main>
<!-- Essential javascripts for application to work-->
<script src="{{asset('assets/dashboard_files/js/popper.min.js')}}"></script>
<script src="{{asset('assets/dashboard_files/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/dashboard_files/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/dashboard_files/js/custom/movie.js')}}"></script>
<script src="{{asset('assets/dashboard_files/js/main.js')}}"></script>

<script>


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        }

    });

    $(document).ready(function () {

        $(".delete").on('click', function (e) {
            var that = $(this);
            e.preventDefault();
            var n = new Noty({
                'text': 'Confirm deleting record',
                killer: true,
                buttons: [
                    Noty.button('yes', 'btn btn-success mx-1', function () {
                        that.closest('form').submit()
                    }),
                    Noty.button('no', 'btn btn-danger', function () {
                        n.close()
                    }),
                ]
            });
            n.show();

        });
        //select 2
        $('.select2').select2({
            width: '100%',

        });

        //image
        $(".image").on('change', function () {
            if (this.files && this.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

        });


        //poster
        $(".poster").on('change', function () {
            if (this.files && this.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('.poster-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

        });


        //sidebar

        $(".app-menu__item").on('click', function () {
            $(this).addClass('active');
        });


    });
    @stack('scripts')
</script>
</body>
</html>
