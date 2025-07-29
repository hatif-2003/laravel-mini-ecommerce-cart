<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}| Admin Panel</title>
    @vite('resources/css/app.css')
</head>

<body>
    <nav class="bg-white shadow p-4 flex items-center justify-between fixed w-full z-40">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="rounded-full w-10 h-10">
            <span class="font-bold text-xl text-blue-800">Admin Panel</span>
        </div>
        <div class="flex items-center space-x-4">

            <div class="flex items-center space-x-2">
                <form method="POST" action="{{ route('logout') }}" class="">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <br>
    @section('content')
    @show


    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
