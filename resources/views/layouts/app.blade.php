<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Netflixify</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500;700&display=swap" rel="stylesheet">

    <!--font awesome-->

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/easy-autocomplete.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/easy-autocomplete.themes.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">


    <style>
        .fw-900 {
            font-weight: 900;
        }

        .easy-autocomplete {
            width: 80% !important;
        }

        .easy-autocomplete input {
            color: white !important;
        }

        .eac-icon-left .eac-item img {
            max-height: 80px !important;
        }
    </style>
</head>
<body>

@yield('content')

<!--footer-->

@yield('footer')

<!--end footer-->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/fontawesome.min.js')}}"></script>
<script src="{{asset('js/popover.js')}}"></script>
<script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/main.min.js')}}"></script>
<script src="{{asset('js/playerjs.js')}}"></script>
<script src="{{asset('plugins/jquery.easy-autocomplete.min.js')}}"></script>
<script src="{{asset('js/custom/movie.js')}}"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        }

    });


    var options = {
        url: function (search) {
            return "/movies?search=" + search;
        },
        getValue: "name",
        template: {
            type: 'iconLeft',
            fields: {
                iconSrc: "poster_path"
            }
        },
        list: {
            onChooseEvent: function () {
                var movie = $('.form-control[type="search"]').getSelectedItemData();
                var url = window.location.origin + '/movies/' + movie.id;
                window.location.replace(url);
            }
        }
    };
    $('.form-control[type="search"]').easyAutocomplete(options);


    $(document).ready(function () {
        $("#banner .movies").owlCarousel({
            loop: true,
            nav: false,
            items: 1,
            dots: false,
            autoplay: true,


        });

        $(".listing .movies").owlCarousel({
            loop: true,
            nav: false,
            dots: false,
            autoplay: true,
            stagePadding: 50,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                900: {
                    items: 4
                },
                1000: {
                    items: 4
                },
            }

        })
        ;
    });

</script>
@stack('scripts')
</body>
</html>
