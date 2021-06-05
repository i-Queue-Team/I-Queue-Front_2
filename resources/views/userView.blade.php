<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        #map {
            width: 100%;
            height: 400px;
            box-shadow: 5px 5px 5px #888;
        }

        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <title>User view 1</title>
</head>

<body class="container">


    <!--menu-->
    <!--nav extendido-->
    <nav class="nav-extended">
        <div class="nav-wrapper" style="margin-left: 8px;">
            <a href="{{ url('/dashboard') }}" class="brand-logo"><span class=".center-align">I-queue
                    User-Panel</span></a>
            <ul class="right hide-on-med-and-down">

                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">{{ Auth::user()->name }}<i
                            class="material-icons right">account_box</i></a></li>
            </ul>
        </div>

        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab col s3 "><a class="active" href="#test1">Mapa</a></li>
                <li class="tab col s3"><a href="#test2">Cola</a></li>
                <li class="tab col s3 "><a href="#test3">Comercios</a></li>
            </ul>
        </div>
    </nav>
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content"  >

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
        <div id="test1" class="col s12 queue-animate-bottom">
            <!--tab datos-->
            <h2 class="center-align" id="tituloSeccion">Mapa I-Queue</h2>

            <section class="container">
                <div id="map"></div>
            </section>

        </div>
        <div id="test2" class="col s12 queue-animate-bottom">
            <!--tab datos-->
            <h2>Nombre Cola</h2>
        </div>
        <div id="test3" class="col s12 queue-animate-bottom">
            <!--tab datos-->
            <h2>Configuracion</h2>
        </div>
    </main>


    <!--fin menu-->

    @include('footerlayout')





</body>




<script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>

<script>
    //map configuracion
    var map = L.map('map').
    setView([38.089923966368815, -3.615282093540719],
        15);

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

        maxZoom: 18
    }).addTo(map);

    map.doubleClickZoom.disable();

    L.control.scale().addTo(map);

    //marker con click de popup
    L.marker([38.09620852240139, -3.6383423859866477]).addTo(map)
        .bindPopup('Mercadona')
        .openPopup();

    //marker con click de popup
    L.marker([39.09620852240239, -3.6383423859866477]).addTo(map)
        .bindPopup('Alcampo')
        .openPopup().closePopup();


    //evento click del mapa
    //  map.on('click', function() {
    // alert("has hecho click en el mapa");
    // });

</script>

<!--boton para el street view-->
<script>
    L.StreetView = L.Control.extend({
        options: {
            google: true,
        },

        providers: [
            ['google', '<i class="material-icons" style="padding:2px">accessibility</i>',
                'Google Street View', false,
                'https://www.google.com/maps?layer=c&cbll={lat},{lon}'
            ],
        ],

        onAdd: function(map) {
            this._container = L.DomUtil.create('div', 'leaflet-bar');
            this._buttons = [];

            for (var i = 0; i < this.providers.length; i++)
                this._addProvider(this.providers[i]);

            map.on('moveend', function() {
                if (!this._fixed)
                    this._update(map.getCenter());
            }, this);
            this._update(map.getCenter());
            return this._container;
        },

        /*
          fixCoord: function(latlon) {
            this._update(latlon);
            this._fixed = true;
          },
          */



        _addProvider: function(provider) {
            if (!this.options[provider[0]])
                return;
            if (provider[0] == 'mapillary' && !this.options.mapillaryId)
                return;
            var button = L.DomUtil.create('a');
            button.innerHTML = provider[1];
            button.title = provider[2];
            button._bounds = provider[3];
            button._template = provider[4];
            button.href = '#';
            button.target = 'streetview';
            button.style.padding = '0 8px';
            button.style.width = 'auto';

            // Some buttons require complex logic
            if (provider[0] == 'mapillary') {
                button._needUrl = false;
                L.DomEvent.on(button, 'click', function(e) {
                    if (button._href) {
                        this._ajaxRequest(
                            button._href.replace(/{id}/, this.options.mapillaryId),
                            function(data) {
                                if (data && data.features && data.features[0].properties) {
                                    var photoKey = data.features[0].properties.key,
                                        url = 'https://www.mapillary.com/map/im/{key}'.replace(
                                            /{key}/, photoKey);
                                    window.open(url, button.target);
                                }
                            }
                        );
                    }
                    return L.DomEvent.preventDefault(e);
                }, this);
            } else if (provider[0] == 'openstreetcam') {
                button._needUrl = false;
                L.DomEvent.on(button, 'click', function(e) {
                    if (button._href) {
                        this._ajaxRequest(
                            'http://openstreetcam.org/nearby-tracks',
                            function(data) {
                                if (data && data.osv && data.osv.sequences) {
                                    var seq = data.osv.sequences[0],
                                        url = 'https://www.openstreetcam.org/details/' + seq
                                        .sequence_id + '/' + seq.sequence_index;
                                    window.open(url, button.target);
                                }
                            },
                            button._href
                        );
                    }
                    return L.DomEvent.preventDefault(e);
                }, this);
            } else
                button._needUrl = true;

            // Overriding some of the leaflet styles
            button.style.display = 'inline-block';
            button.style.border = 'none';
            button.style.borderRadius = '0 0 0 0';
            this._buttons.push(button);
        },

        _update: function(center) {
            if (!center)
                return;
            var last;
            for (var i = 0; i < this._buttons.length; i++) {
                var b = this._buttons[i],
                    show = !b._bounds || b._bounds.contains(center),
                    vis = this._container.contains(b);

                if (show && !vis) {
                    ref = last ? last.nextSibling : this._container.firstChild;
                    this._container.insertBefore(b, ref);
                } else if (!show && vis) {
                    this._container.removeChild(b);
                    return;
                }
                last = b;

                var tmpl = b._template;
                tmpl = tmpl
                    .replace(/{lon}/g, L.Util.formatNum(center.lng, 6))
                    .replace(/{lat}/g, L.Util.formatNum(center.lat, 6));
                if (b._needUrl)
                    b.href = tmpl;
                else
                    b._href = tmpl;
            }
        },

        _ajaxRequest: function(url, callback, post_data) {
            if (window.XMLHttpRequest === undefined)
                return;
            var req = new XMLHttpRequest();
            req.open(post_data ? 'POST' : "GET", url);
            if (post_data)
                req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            req.onreadystatechange = function() {
                if (req.readyState === 4 && req.status == 200) {
                    var data = (JSON.parse(req.responseText));
                    callback(data);
                }
            };
            req.send(post_data);
        }
    });

    L.streetView = function(options) {
        return new L.StreetView(options);
    }

    L.streetView().addTo(map);

</script>


<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
    $(document).ready(function() {
        $('.tabs').tabs();

        $(".dropdown-trigger").dropdown({  constrainWidth: false });
    });

</script>

</html>
