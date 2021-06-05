<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Registro IQueue</title>
</head>
<style>
    body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }

</style>

<body class="container">
    <!--menu-->
    <!--nav extendido-->
    @include('navLayout')
    <!--fin menu-->
    <h2 class="center-align">Registra tu cuenta</h2>
    <main>
        <section class="container">

            <div style="border-radius: 1rem; background-color: antiquewhite; padding: 10px; ">
                <article class="col s6 offset-s3">
                    <form name="form" method="POST" action="{{ url('/register') }}">
                        @csrf
                        <div class="input-field">
                            <i class="material-icons prefix">person_pin</i>
                            <label for="usuario">Usuario</label>
                            <input type="text" name="name" value="{{old('name')}}" required>
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">email</i>
                            <label for="email">email</label>
                            <input type="email" name="email" value="{{old('email')}}" required class="validate">
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">password</i>
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" required minlength="4">
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">password</i>
                            <label for="password2" style="font-size: 0.8em;">Repetir contraseña</label>
                            <input type="password" name="password2" required minlength="4">
                        </div>

                        <div class="center-align">
                            <label>
                                <input type="checkbox" id="terminos" onclick="sendBtn()" />

                                <span>He leído y acepto los
                                    <a href="#Condiciones" style="font-size:10pt">términos y condiciones</a>
                                    <span style="font-size:12pt">y la
                                        <a href="#Condiciones" style="font-size:10pt">política de privacidad</a>
                                        .</span>
                            </label>
                        </div>
                        <p class="center-align">

                            <button class="waves-effect waves-light btn" type="submit" id="enviarregistro"
                                disabled="disabled"><i class="material-icons right">send</i>registrar</button>
                        </p>
                        <br>
                        <p class="center-align">¿Ya tienes cuenta? <a href="{{ url('/login') }}">entra aquí</a>.</p>
                        <br>

                    </form>
                </article>
            </div>
        </section>
        <!--fin login-->
        <br>
    </main>

    @include('footerlayout')

</body>

<script id="envio">
    function sendBtn() {
        var terminos = document.getElementById("terminos")
        var sendBtn = document.getElementById("enviarregistro")
        if (sendBtn.disabled == 1) {
            sendBtn.disabled = 0;
        } else {
            sendBtn.disabled = 1;
        }
    }

</script>


<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
