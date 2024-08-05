<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <style>
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .nav-links.show {
                display: flex;
                flex-direction: column;
            }
        }
    </style>
</head>

<body class="bg-[#cde8e5] min-h-screen flex flex-col">
    <nav class="bg-teal-500 p-4 flex justify-between items-center">
        <div class="flex flex-col items-center justify-center space-x-4">
            <img src="https://assets.mockflow.com/app/wireframepro/company/Ccd57c0a2cd05465e8b4c56685008aa29/projects/M0Ns6YQ8Dqb/images/M004840aba390e426a5c84e1e14b6d2741717178823723"
                alt="Logo" class="h-14 w-14">
            <div class="hidden md:block text-white font-semibold">
                <div class="text-lg">de-KLPCM</div>
            </div>
        </div>

        <button id="menuToggle" class="md:hidden text-white focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <ul id="navLinks" class="nav-links hidden md:flex space-x-6 text-white">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:underline {{ Request::is('dashboard') ? 'font-bold' : '' }} ">Dashboard</a></li>
            <li><a href="{{ route('user.index') }}"
                    class="hover:underline {{ Request::is('user') ? 'font-bold' : '' }}">Data User</a></li>
            <li><a href="{{ route('rekam-medis.index') }}"
                    class="hover:underline {{ Request::is('rekam-medis') ? 'font-bold' : '' }}">Distribusi Rekam
                    medis</a></li>
            <li><a href="{{ route('distribusi.index') }}"
                    class="hover:underline {{ Request::is('rekam-medis') ? 'font-bold' : '' }}">Data Distribusi Rekam
                    medis</a></li>
            <li><a href="{{ route('klpcm.index') }}"
                    class="hover:underline {{ Request::is('klpcm') ? 'font-bold' : '' }}">Data KLPCM</a></li>
            <li class="relative">
                <details class="group">
                    <summary class="hover:underline cursor-pointer">Laporan</summary>
                    <ul class="absolute left-0 mt-2 w-40 bg-white text-black shadow-lg rounded-lg">
                        <li class="p-2 hover:bg-gray-100"><a href="#">Laporan 1</a></li>
                        <li class="p-2 hover:bg-gray-100"><a href="#">Laporan 2</a></li>
                    </ul>
                </details>
            </li>
        </ul>

        <div class="hidden md:flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <img src="https://assets.mockflow.com/app/wireframepro/company/Ccd57c0a2cd05465e8b4c56685008aa29/projects/M0Ns6YQ8Dqb/images/M80755d6d821f5e730adf32dc1ce288641712225764995"
                    alt="Profile Picture" class="h-10 w-10 rounded-full">
                <div class="text-white">
                    <div class="text-sm font-bold">{{ auth()->user()->name }}</div>
                    <div class="text-xs">Role : {{ auth()->user()->role }}</div>
                </div>
            </div>
            <form action="{{ route('logout', ['id' => 1]) }}" method="post">
                @csrf
                <button
                    class="bg-[#4d869c] text-white px-4 py-2 rounded-sm border-black shadow hover:text-white flex items-center space-x-2 focus:ring-2 focus:ring-black">
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="flex-grow p-8">
        @yield('content')
    </div>

    <script>
        document.getElementById('menuToggle').addEventListener('click', function() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('show');
        });
    </script>

</body>

</html>
