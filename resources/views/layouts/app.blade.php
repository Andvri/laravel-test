<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/buefy/lib/buefy.min.css">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">    
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <section class="hero is-dark">
            <div class="hero-head">
                    <nav class="navbar">
                      <div class="container">
                        <div id="navbarMenuHeroA" class="navbar-menu">
                          <div class="navbar-end">
                            <a class="navbar-item" href="/">
                                Home
                            </a>
                            <a class="navbar-item" href="/empleados">
                              Todos los Empleados
                            </a>
                            <span class="navbar-item">
                              <a class="button is-primary is-inverted" href="https://github.com/Andvri/laravel-test" target="_blank">
                                <span class="icon">
                                  <i class="fab fa-github"></i>
                                </span>
                                <span>Repositorio</span>
                              </a>
                            </span>
                          </div>
                        </div>
                      </div>
                    </nav>
                  </div>
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    <form method="POST" action="{{url('results')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <upload></upload>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">Subir Hoja de Calculo</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="file" >
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </div>
                    </form>
                </h1>
            </div>
        </div>
    </section>
    
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
