<nav class="nav-extended">
    <div class="nav-wrapper" style="margin-left: 8px;">
        <a href="{{ url('/') }}" class="brand-logo"><img src="./images/cabeceraIcon.png"  style="margin-top: 5px"  alt=""></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ url('/login') }}"><i class="material-icons left">account_circle</i>Login</a></li>
        </ul>
    </div>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <div class="nav-content">
        <ul class="tabs tabs-transparent">
            <li class="tab {{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Inicio</a></li>
            <li class="tab {{ Request::is('contactoempresas') ? 'active' : '' }}"><a
                    href="{{ url('/contactoempresas') }}">Empresas</a></li>
            <li class="tab {{ Request::is('sobrenosotros') ? 'active' : '' }}"><a
                    href="{{ url('/sobrenosotros') }}">Sobre nosotros</a></li>
        </ul>
    </div>
</nav>
<ul class="sidenav" id="mobile-demo">
    <li><a href="{{ url('/login') }}"><i class="material-icons text-red">person</i>Login</a></li>
    <li><a href="{{ url('/register') }}"><i class="material-icons text-red">person_add</i>Registro</a></li>

</ul>
