<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" id="sidebar-wrapper" style="background-color:#373635!important">
            <h3 class="text-center">Admin Panel</h3>
            <ul class="list-unstyled">
                <li class="mb-2">
                    <a href="{{ route('home') }}" class="text-white text-decoration-none">Dashboard</a>
                </li>
                @if( !empty(Auth::user()) && !empty(Auth::user()->role) && Auth::user()->role == 'Admin')
                <li class="mb-2">
                    <a href="{{ route('admin.faculity.index') }}" class="text-white text-decoration-none">Faculties</a>
                </li>
                @endif
                @if(!empty(Auth::user()) && !empty(Auth::user()->role) && (Auth::user()->role == 'Admin' || Auth::user()->role == 'AcademicHead'))
                <li class="mb-2">
                    <a href="{{ route('admin.course.create') }}" class="text-white text-decoration-none">Courses</a>
                </li>
                @endif

                <li class="mb-2">
                    <a href="{{ route('admin.semester.create') }}" class="text-white text-decoration-none">Semesters</a>
                </li>
             
                <li class="mb-2">
                    <a href="{{ route('admin.syllabus.create') }}" class="text-white text-decoration-none">Syllabus</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.module.create') }}" class="text-white text-decoration-none">Modules</a>
                </li>
                @if(!empty(Auth::user()) && !empty(Auth::user()->role) &&( Auth::user()->role == 'Admin' || Auth::user()->role == 'Teacher'))
                <li class="mb-2">
                    <a href="{{ route('admin.teacher.create') }}" class="text-white text-decoration-none">Teachers</a>
                </li>
                @endif
                @if(!empty(Auth::user()) && !empty(Auth::user()->role) &&( Auth::user()->role == 'Admin' || Auth::user()->role == 'Student'))
                <li class="mb-2">
                    <a href="{{ route('admin.student.create') }}" class="text-white text-decoration-none">Student</a>
                </li>
                @endif
            </ul>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="menu-toggle" style="background-color: #00c0ef;border: 1px solid #00c0ef">Toggle Menu</button>
                    <ul class="navbar-nav ms-auto" style="float:right; margin-right:50px">
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
            </nav>

            <div class="container-fluid mt-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- Custom Scripts -->
    <script>
        // Toggle Sidebar
        const toggleButton = document.getElementById('menu-toggle');
        const wrapper = document.getElementById('wrapper');
        toggleButton.addEventListener('click', () => {
            wrapper.classList.toggle('toggled');
        });
    </script>
</body>
</html>
