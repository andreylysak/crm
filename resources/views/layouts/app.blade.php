<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{asset('libs/jquery.dataTables.css')}}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container container-header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    CRM
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('admin/contacts') }}">Contacts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('admin/leads') }}">Leads</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('admin/account-crm') }}">Acount Amo CRM</a>
                            </li>
                        </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="main-section group">
                @auth
                <div class="section-sidebar">
                    <div class="list-group">
                        <a href="{{ url('admin') }}" class="list-group-item list-group-item-action @if(Request::url() === url('admin'))) active @endif">Dashboard</a>
                        <a href="{{ url('admin/contacts') }}" class="list-group-item list-group-item-action @if(strpos(Request::url(), url('admin/contacts')) !== false) active @endif">Contacts</a>
                        <a href="{{ url('admin/leads') }}" class="list-group-item list-group-item-action @if(strpos(Request::url(), url('admin/leads')) !== false) active @endif">Leads</a>
                        <a href="{{ url('admin/account-crm') }}" class="list-group-item list-group-item-action @if(strpos(Request::url(), url('admin/account-crm')) !== false) active @endif">Account Amo CRM</a>
                        <a href="{{ url('admin/users') }}" class="list-group-item list-group-item-action @if(strpos(Request::url(), url('admin/users')) !== false) active @endif">Users</a>
                    </div>
                </div>
                @endauth
                <div class="section-content">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('libs/jquery.dataTables.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#contactsTable').DataTable();
            $('#leadsTable').DataTable();
            $('#usersTable').DataTable();
        } );
    </script>
</body>
</html>
