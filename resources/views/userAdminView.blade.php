<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #map {
            width: 100%;
            height: 400px;
            box-shadow: 5px 5px 5px #888;
        }

    </style>
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

    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <title>Iqueue-ADMIN-PANEL</title>
</head>

<body class="container">

    <!--menu-->
    <!--nav extendido-->
    <nav class="nav-extended">
        <div class="nav-wrapper" style="margin-left: 8px;">
            <a href="{{ url('/dashboard') }}" class="brand-logo"><span class=".center-align">I-queue
                    Admin-Panel</span></a>
            <ul class="right hide-on-med-and-down">
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">{{ Auth::user()->name }}<i
                            class="material-icons right">account_box</i></a></li>
            </ul>
        </div>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab col s3 "><a class="active" href="#test1">Datos</a></li>
                <li class="tab col s3"><a href="#test2">Tu Cola</a></li>
                <li class="tab col s3 "><a href="#test3">Configuracion</a></li>
            </ul>
        </div>
    </nav>
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">

        <li><a href="#!">Configuracion</a></li>
        <li class="divider"></li>
        <li><a href="{{ url('/logout') }}">Cerrar Sesión</a></li>
    </ul>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="#!">Configuracion</a></li>
        <li><a href="{{ url('/logout') }}"> Cerrar Sesión </a></li>
    </ul>
    <main class="center-align">
        <!--fin menu-->
        <div id="test1" class="col s12">
            <!--tab datos-->
            <h2>Datos</h2>
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
        <div id="test2" class="col s12">
            <!--tab datos-->
            <h2>Nombre Cola</h2>
        </div>
        <div id="test3" class="col s12">
            <!--tab datos-->
            <h2>Configuracion</h2>
        </div>


        <!--fin login-->
        <br>
    </main>

    @include('footerlayout')
</body>


<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"
    integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.tabs').tabs();
        $(".dropdown-trigger").dropdown({  constrainWidth: false });;
    });


    const image = new Image();
    image.src = './images/logo.svg';
    const plugin = {
        id: 'custom_canvas_background_image',
        beforeDraw: (chart) => {
            if (image.complete) {
                const ctx = chart.ctx;
                const {
                    top,
                    left,
                    width,
                    height
                } = chart.chartArea;
                const x = left + width / 2 - image.width / 2;
                const y = top + height / 2 - image.height / 2;
                ctx.drawImage(image, x, y);
            } else {
                image.onload = () => chart.draw();
            }
        }
    };
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',

        plugins: [plugin],
        data: {
            labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
            datasets: [{
                label: 'Personas en el local',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132,  0.5)',
                    'rgba(54, 162, 235,  0.5)',
                    'rgba(255, 206, 86,  0.5)',
                    'rgba(75, 192, 192,  0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64,  0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            aspectRatio: 2,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0,
                }
            },
            responsive: true,
            cutoutPercentage: 90,
            legend: {
                display: false,
            },
            title: {
                display: false,
            },
        }

    });

</script>

</html>
