<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>Halaman Depan</title>

    
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
                <ul class="navbar-nav me-auto gap-2">
                    <li class="nav-item">
                        <a href="." class="nav-link px-4 {{ Request::is('/') ? 'active' : ''}}">Kasir</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('kasir.order-list')}}" class="nav-link px-4 {{ Request::is('order-list') ? 'active' : ''}}">Order List</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
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
                            <li>
                                <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                                    {{Auth:: user()->roles}}
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="#">Setting</a></li>
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

    @yield('content')

    <footer class="pt-5 pb-4">
        <div class="container">
            <p class="mb-0 text-center text-secondary fs-7">
                Copyright &copy; PT Onlenkan Teknologi Indonesia 2024. Seluruh hak cipta dilindungi.
            </p>
        </div>
    </footer>

    {{-- <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
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

        // Checkout modal focus handler (only if element exists)
        const checkoutModal = document.getElementById('checkoutModal');
        if (checkoutModal) {
            checkoutModal.addEventListener('shown.bs.modal', function () {
                const nameInput = document.getElementById('name');
                if (nameInput) {
                    nameInput.focus();
                }
            });
        }


        function formatNumber(input) {
            // Menghapus karakter non-digit dari nilai input
            let cleanedValue = input.value.replace(/\D/g, '');

            // Memisahkan nilai menjadi bagian ribuan dengan menggunakan regular expression
            cleanedValue = cleanedValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Memperbarui nilai input dengan format yang diinginkan
            input.value = cleanedValue;
            document.getElementById('nominal').value = cleanedValue.replace(/,/g, '');
        }
    </script>
</body>

</html>
