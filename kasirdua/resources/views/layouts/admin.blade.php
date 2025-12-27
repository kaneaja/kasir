<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>Dashboard</title>

    <x-style/>
</head>

<body class="bg-soft-blue" data-theme="light">
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container-fluid">
            <a href="." class="navbar-brand logo">
                <img src="assets/images/logo.png" alt=""> KasirOnlen
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto gap-2">
                    <li class="nav-item">
                        <a href="{{url('admin')}}" class="nav-link px-4 {{ Request::is('admin') ? 'active' : ''}}">
                            <i class="bx bxs-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/menu')}}" class="nav-link px-4 {{ Request::is('admin/menu') ? 'active' :''}}">
                            <i class="bx bx-food-menu"></i> Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/pendapatan')}}" class="nav-link px-4">
                            <i class="bx bx-money"></i> Pendapatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/kasir')}}" class="nav-link px-4 {{ Request::is('admin/kasir') ? 'active' :''}}">
                            <i class="bx bx-user-pin"></i> Kasir
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item d-flex align-items-center me-3">
                        <button class="dark-mode-toggle" id="darkModeToggle" type="button" aria-label="Toggle dark mode">
                            <i class="bx bx-moon" id="darkModeIcon"></i>
                        </button>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{Auth:: user()->name}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item" href="#">Setting</a></li>
                            <li>
                                <a class="dropdown-item" href="{{url('/')}}">
                                    <i class="bx bx-shopping-bag"></i> Kasir
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{route(name: 'logout')}}" method="post">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container-fluid py-5 px-1 px-lg-5">
       @yield('content')
    </section>

    <footer class="pt-5 pb-4">
        <div class="container">
            <p class="mb-0 text-center text-secondary fs-7">
                Copyright &copy; PT Onlenkan Teknologi Indonesia 2024. Seluruh hak cipta dilindungi.
            </p>
        </div>
    </footer>

    <x-script />
    <script>
        // Dark Mode Toggle
        (function() {
            try {
                const darkModeToggle = document.getElementById('darkModeToggle');
                const darkModeIcon = document.getElementById('darkModeIcon');
                const body = document.body;
                
                // Skip if elements not found
                if (!darkModeToggle || !darkModeIcon || !body) return;
                
                // Check for saved theme preference or default to light mode
                const currentTheme = localStorage.getItem('theme') || 'light';
                
                // Apply the theme
                body.setAttribute('data-theme', currentTheme);
                updateIcon(currentTheme);
                
                // Toggle dark mode
                darkModeToggle.addEventListener('click', function() {
                    try {
                        const currentTheme = body.getAttribute('data-theme');
                        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                        
                        body.setAttribute('data-theme', newTheme);
                        localStorage.setItem('theme', newTheme);
                        updateIcon(newTheme);
                    } catch (e) {
                        console.error('Error toggling dark mode:', e);
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
                if (document.body) {
                    document.body.setAttribute('data-theme', 'light');
                }
            }
        })();
    </script>
</body>

</html>
