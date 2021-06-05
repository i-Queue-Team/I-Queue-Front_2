<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--css tarjetas hoover-->
    <link rel="stylesheet" href="./css/aboutUsCards.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Sobre nosotros</title>

</head>
<style>
    body {

        min-height: 100vh;
        flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }
    @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic);

    body {
        font-family: 'Source Sans Pro', sans-serif;
        line-height: 1.5;
        color: #323232;
        font-size: 15px;
        font-weight: 400;
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
        -moz-font-smoothing: antialiased;
    }

    .heading-title {
        margin-bottom: 100px;
    }
    .text-center {
        text-align: center;
    }
    .heading-title h3 {
        margin-bottom: 0;
        letter-spacing: 2px;
        font-weight: normal;
    }
    .p-top-30 {
        padding-top: 30px;
    }
    .half-txt {
        width: 60%;
        margin: 0 auto;
        display: inline-block;
        line-height: 25px;
        color: #7e7e7e;
    }
    .text-uppercase {
        text-transform: uppercase;
    }

    .team-member, .team-member .team-img {
        position: relative;
    }
    .team-member {
        overflow: hidden;
    }
    .team-member, .team-member .team-img {
        position: relative;
    }

    .team-hover {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        margin: 0;
        border: 20px solid rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.90);
        opacity: 0;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }
    .team-member:hover .team-hover .desk {
        top: 35%;
    }
    .team-member:hover .team-hover, .team-member:hover .team-hover .desk, .team-member:hover .team-hover .s-link {
        opacity: 1;
    }
    .team-hover .desk {
        position: absolute;
        top: 0%;
        width: 100%;
        opacity: 0;
        -webkit-transform: translateY(-55%);
        -ms-transform: translateY(-55%);
        transform: translateY(-55%);
        -webkit-transition: all 0.3s 0.2s;
        transition: all 0.3s 0.2s;
        padding: 0 20px;
    }
    .desk, .desk h4, .team-hover .s-link a {
        text-align: center;
        color: #222;
    }
    .team-member:hover .team-hover .s-link {
        bottom: 10%;
    }
    .team-member:hover .team-hover, .team-member:hover .team-hover .desk, .team-member:hover .team-hover .s-link {
        opacity: 1;
    }
    .team-hover .s-link {
        position: absolute;
        bottom: 0;
        width: 100%;
        opacity: 0;
        text-align: center;
        -webkit-transform: translateY(45%);
        -ms-transform: translateY(45%);
        transform: translateY(45%);
        -webkit-transition: all 0.3s 0.2s;
        transition: all 0.3s 0.2s;
        font-size: 35px;
    }
    .desk, .desk h4, .team-hover .s-link a {
        text-align: center;
        color: #222;
    }
    .team-member .s-link a {
        margin: 0 10px;
        color: #333;
        font-size: 16px;
    }
    .team-title {
        position: static;
        padding: 20px 0;
        display: inline-block;
        letter-spacing: 2px;
        width: 100%;
    }
    .team-title h5 {
        margin-bottom: 0px;
        font-size: 12pt;
        display: block;
        text-transform: uppercase;
        color: #000000;
        font-weight: 1000;
    }
    .team-title span {
        font-size: 12px;
        text-transform: uppercase;
        color: #0ac284;
        letter-spacing: 1px;
    }


</style>

<body class="container">
    <!--menu-->
    <!--nav extendido-->
    @include('navLayout')
    <!--fin menu-->
    <!-- Our team Section -->
    <main>
        <section id="team" class="team content-section">
            <div class="">
                <div class="row text-center">
                    <div class="col s12">

                    </div><!-- /.col l12 -->
                    <div class="row" style="min-width: 261px; max-width:100%">
                        <div class="heading-title text-center">
                            <h2 class="center-align"><b>Nuestro equipo</b></h2>
                        </div>

                        <!--Zamora-->
                        <div class="col s12 m6 l4">
                            <div class="team-member">
                                <div class="team-img">
                                    <img src="./images/ios.png" class="responsive-img" alt="team member" style="display:block;margin:auto;">
                                </div>
                                <div class="team-hover">
                                    <div class="desk">
                                        <div class="card-panel teal lighten-3" style="display:block;margin:auto; heigth:100%;">
                                            <img src='./images/zamora.PNG' class="responsive-img" style="border-radius:140px;border:4px solid #666;margin-top:60px"/>
                                            <p>He desarrollado la aplicación móvil para terminales iOS.</p>

                                        </div>
                                    </div>
                                    <div class="s-link">
                                        <a href="#"><img src="./images/linkedin.png" alt=""></a>
                                        <a href="#"><img src="./images/correoelectronico.png" alt=""></a>
                                        <a href="#"><img src="./images/github.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-title">
                                <h5>Jose Ángel Zamora</h5>
                                <span>Desarrollador iOS</span>
                            </div>
                        </div>
                        <!--Zamora-->
                          <!--Pepelu-->
                          <div class="col s12 m6 l4 offset-l2">
                            <div class="team-member">
                                <div class="team-img">
                                    <img src="./images/android.png"  class="responsive-img" alt="team member" style="display:block;margin:auto;">
                                </div>
                                <div class="team-hover">
                                    <div class="desk">
                                        <div class="card-panel green lighten-3" style="display:block;margin:auto;">

                                            <div class="content">
                                                <img src='./images/pepelu.PNG' class="responsive-img" style="border-radius:140px;border:4px solid #666;margin-top:60px" />
                                                <p>He desarrollado la aplicación para terminales Android.</p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="s-link">
                                        <a href="#"><img src="./images/linkedin.png" alt=""></a>
                                        <a href="#"><img src="./images/correoelectronico.png" alt=""></a>
                                        <a href="#"><img src="./images/github.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-title">
                                <h5>Jose Luis Berrio</h5>
                                <span>Desarrollador Android</span>
                            </div>
                        </div>
                       <br><br><br>
                        <!--Pepelu-->
                        <!--Felix-->
                        <div class="col s12 m6 l4 ">
                            <div class="team-member">
                                <div class="team-img">
                                    <img src="./images/backend.png" class="responsive-img" alt="team member">
                                </div>
                                <div class="team-hover">
                                    <div class="desk">
                                        <div class="card-panel deep-purple lighten-5">
                                            <img src='./images/felix.png' class="responsive-img" style="border-radius:140px;border:4px solid #666;margin-top:70px" />
                                            <p>He desarrollado el backend utilizando el framework Laravel</p>
                                        </div>
                                    </div>
                                    <div class="s-link">
                                        <a href="#"><img src="./images/linkedin.png" alt=""></a>
                                        <a href="#"><img src="./images/correoelectronico.png" alt=""></a>
                                        <a href="#"><img src="./images/github.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-title">
                                <h5>Felix Corujo</h5>
                                <span>Desarrollador Backend</span>
                            </div>
                        </div>
                        <!--Felix-->
                        <div class="col s12 m6 l4">
                            <div class="team-member">
                                <div class="team-img">
                                    <img src="./images/front.png" class="responsive-img" alt="team member">
                                </div>
                                <div class="team-hover">
                                    <div class="desk">
                                        <div class="card-panel  blue lighten-3">
                                            <img src='./images/dani.png' class="responsive-img" style="border-radius:140px;border:4px solid #666;margin-top:70px" />
                                            <p>He diseñado las interfaces y desarrollado el frontend de la app </p>
                                        </div>
                                    </div>
                                    <div class="s-link" >
                                        <a href="#"><img src="./images/linkedin.png" alt=""></a>
                                        <a href="#"><img src="./images/correoelectronico.png" alt=""></a>
                                        <a href="#"><img src="./images/github.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-title">
                                <h5>Dani Merino</h5>
                                <span>Desarrollador Frontend</span>
                            </div>
                        </div>
                        <div class="col s12 m6 l4">
                            <div class="team-member">
                                <div class="team-img">
                                    <img src="./images/backend.png" class="responsive-img" alt="team member">
                                </div>
                                <div class="team-hover">
                                    <div class="desk">
                                        <div class="card-panel deep-purple lighten-5">
                                            <img src='./images/vicente.jpg' class="responsive-img" style="border-radius:140px;border:4px solid #666;margin-top:70px" />
                                            <p>He desarrollado el backend utilizando el framework Laravel.</p>
                                        </div>
                                    </div>
                                    <div class="s-link">
                                        <a href="#"><img src="./images/linkedin.png" alt=""></a>
                                        <a href="#"><img src="./images/correoelectronico.png" alt=""></a>
                                        <a href="#"><img src="./images/github.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-title">
                                <h5>Vicente Maroto</h5>
                                <span>Desarrollador Backend</span>
                            </div>
                        </div>



                            </div>
                    </div><!-- /.container -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.our-team -->
    </main>


    @include('footerlayout')
    <!--fin footer-->

    <!--fin contenedor-->
</body>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
