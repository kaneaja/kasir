<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
     @include('components.style')
</head>
<body data-theme="light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item d-flex align-items-center me-3">
                            <button class="dark-mode-toggle" id="darkModeToggle" type="button" aria-label="Toggle dark mode">
                                <i class="bx bx-moon" id="darkModeIcon"></i>
                            </button>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
            @yield('content')
        </main>
    </div>

    @include('components.script')
    <script>
        // Dark Mode Toggle
        (function() {
            try {
                const darkModeToggle = document.getElementById('darkModeToggle');
                const darkModeIcon = document.getElementById('darkModeIcon');
                const body = document.body;
                
                // Skip if elements not found - graceful degradation
                if (!darkModeToggle || !darkModeIcon || !body) return;
                
                // Check for saved theme preference or default to light mode
                let currentTheme = 'light';
                try {
                    currentTheme = localStorage.getItem('theme') || 'light';
                } catch (e) {
                    // If localStorage fails, use light mode
                    currentTheme = 'light';
                }
                
                // Apply the theme
                body.setAttribute('data-theme', currentTheme);
                updateIcon(currentTheme);
                
                // Toggle dark mode
                darkModeToggle.addEventListener('click', function() {
                    try {
                        const currentTheme = body.getAttribute('data-theme');
                        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                        
                        body.setAttribute('data-theme', newTheme);
                        try {
                            localStorage.setItem('theme', newTheme);
                        } catch (e) {
                            // If localStorage fails, continue without saving
                            console.warn('Could not save theme preference:', e);
                        }
                        updateIcon(newTheme);
                    } catch (e) {
                        console.error('Error toggling dark mode:', e);
                        // Fallback to light mode on error
                        if (body) {
                            body.setAttribute('data-theme', 'light');
                        }
                    }
                });
                
                function updateIcon(theme) {
                    try {
                        if (theme === 'dark') {
                            darkModeIcon.classList.remove('bx-moon');
                            darkModeIcon.classList.add('bx-sun');
                        } else {
                            darkModeIcon.classList.remove('bx-sun');
                            darkModeIcon.classList.add('bx-moon');
                        }
                    } catch (e) {
                        console.error('Error updating icon:', e);
                    }
                }
            } catch (e) {
                console.error('Error initializing dark mode:', e);
                // Fallback: ensure light mode if error occurs
                try {
                    if (document.body) {
                        document.body.setAttribute('data-theme', 'light');
                    }
                } catch (fallbackError) {
                    // If even fallback fails, continue silently
                }
            }
        })();
    </script>
</body>
</html>
