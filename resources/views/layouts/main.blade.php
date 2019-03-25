<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,
    maximum-scale=1.0, minimum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fontawesome Icons -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <div class="container flex flex-col sm:flex-row items-center mx-auto mt-1">
        <div class="w-1/4"><h1><a href="{{ route('home') }}" class="text-black no-underline">{{ config('app.name', 'Laravel') }}</a></h1></div>
        <div class="w-3/4 flex justify-center mt-3 sm:justify-end sm:mt-0">
            @guest
                <div class="mr-6">
                    <a class="text-sm text-grey-darkest no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                </div>
                @if (Route::has('register'))
                    <div>
                        <a class="text-sm text-grey-darkest no-underline hover:underline" href="{{ route('register') }}">{{ __('Become a member') }}</a>
                    </div>
                @endif
            @else
                @if (Auth::user()->admin == true)
                <div class="flex justify-center items-center mr-6">
                    <a class="text-sm text-grey-darkest no-underline hover:underline" href="{{ route('adminDashboard') }}">
                        Admin Dashboard
                    </a>
                </div>
                @endif
                <div class="mr-6">
                    <a href="{{ route('newStory') }}" class="block bg-white text-sm text-grey-darkest py-2 px-4 border border-grey-darkest rounded no-underline">New Story</a>
                </div>
                <div class="py-2">
                    <a class="text-sm text-grey-darkest no-underline hover:underline" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>
    </div> <!-- end header -->

    @if (Route::current()->action['prefix'] != '/admin')
        @include('includes.navigation')
    @endif

    @yield('content')

    <!-- Custom JS -->
    <script src="{{ asset('js/general.js') }}" defer></script>

</body>
</html>
