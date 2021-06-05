<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Login IQueue</title>
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


    <main>
        <!--fin menu-->
        <h2 class="center-align">Inicio de sesión</h2>


        <section class="container">
            <div style="border-radius: 1rem; background-color: antiquewhite; padding: 10px; ">
                <article class="col s6 offset-s3">
                    <form method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="input-field">
                            <i class="material-icons prefix">person_pin</i>
                            <label for="email">Email</label>
                            <input type="text" name="email" required>
                            @if ($errors)
                                <span class="error">
                                    <span class="helper-text" data-error="wrong"
                                        data-success="right">{{ $errors->first('email') }}</span>
                                </span>
                            @endif
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">password</i>
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" required>
                        </div>
                        <p class="center-align">
                            <button class="waves-effect waves-light btn" type="submit"><i
                                    class="material-icons right">send</i>entrar</button>
                        </p>
                    </form>
                    <br>
                    <div class="center-align">
                        <!-- Modal Trigger -->
                        <a class="modal-trigger" href="#modal1">¿Olvidaste tu contraseña?</a>
                        <!-- Modal Structure -->
                        <div id="modal1" class="modal" style="min-width: 250px">
                            <div class="modal-content">
                                <h4>Recordar contraseña</h4>
                                <p>Introduce tu dirección de correo electronico</p>
                                <form action="#ContraseñaRecordada">
                                    <div class="input-field">
                                        <i class="material-icons prefix">contact_mail</i>
                                        <label for="email">email</label>
                                        <input type="email" name="email" required class="validate">
                                    </div>
                                    <div class="input-field">
                                        <i class="material-icons prefix">contact_mail</i>
                                        <label for="email2">repetir email</label>
                                        <input type="email" name="email2" required class="validate">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <div class="center-align">
                                    <a href="#!" class="modal-close waves-effect waves-light btn red">Cancelar</a>
                                    <button class="waves-effect waves-light btn " type="submit">Recordar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="center-align">¿No tienes cuenta? <a href="{{ url('/registro') }}">regístrate aquí</a>.
                    </p>
                    <br>
                    </form>
                </article>
            </div>
        </section>
    </main>
    <!--fin login-->
    <br>
    @include('footerlayout')

</body>


<script>
    //modal

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });

</script>


<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</html>
