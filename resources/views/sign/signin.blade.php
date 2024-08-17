<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LARAPIX</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('mycss/style.css') }}">
</head>
<style>
    .inputGroup {
        margin: 1em 0 1em 0;
        max-width: 100%;
        position: relative;
    }

    .inputGroup input {
        font-size: 90%;
        padding: 0.8em;
        outline: none;
        border: 2px solid #DEE2E6;
        background-color: transparent;
        border-radius: 8px;
        width: 100%;
    }

    .inputGroup label {
        font-size: 90%;
        position: absolute;
        left: 0;
        padding: 0.8em;
        margin-left: 0.5em;
        pointer-events: none;
        transition: all 0.3s ease;
        color: rgb(100, 100, 100);
    }

    .inputGroup :is(input:focus, input:valid, input:invalid)~label {
        transform: translateY(-50%) scale(.9);
        margin: 0em;
        margin-left: 1.3em;
        padding: 0.4em;
        background-color: #fff;
    }

    .inputGroup :is(input:focus, input:valid) {
        border-color: #FFCA2C;
    }
</style>


<!-- Custom styles for this template -->
<link href="{{ asset('login/login.css') }}" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center ">
    <div class="row">
        <div class="col">
            <main class="form-signin m-auto border border-2 rounded rounded-2 p-4 bg-white text-center">
                <form action="{{ route('aksisignin') }}" method="post">
                    @csrf
                    <h1 class="h3 mb-3 fw-semibold text-dark">Lara<span class="text-warning ">pix</span></h1>

                    <div class="inputGroup">
                        <input type="text" required="" autocomplete="off" name="email">
                        <label for="name">Username / Email</label>
                    </div>
                    <div class="inputGroup">
                        <input type="password" required="" autocomplete="off" name="password">
                        <label for="name">Password</label>
                    </div>

                    <button class="text-dark fw-semibold btn btn-warning w-100" type="submit">Masuk</button>
                    <hr class="border-secondary border-1 border">
                    <p class="mt-2 mb-2 text-dark" style="font-size: 14px">Tidak punya akun? <a
                            class="text-decoration-none" href="{{ route('signup') }}">Buat Akun</a></p>
                </form>
            </main>
        </div>
    </div>
    @include('sweetalert::alert')
</body>

</html>
