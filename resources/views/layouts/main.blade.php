<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LARAPIX</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mycss/style.css') }}">

    {{-- jquery --}}
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>

</head>

<body>
    <div class="container-fluid bg-light w-100 h-100" style="min-height: 100vh">
        <div class="col-2 border-end border-2 bg-light h-100 position-fixed bg-light pe-3" style="min-height: 100vh;">
            @include('partials.sidebar')
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10 bg-light h-100 pb-5" style="min-height: 100vh">
                <div class="container min-vh-100">
                    {{-- content --}}
                    @yield('container')
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')


    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('myjs/js.js') }}"></script>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>


</body>

</html>
