<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <style>
        .hero-bg {
            background: url('https://via.placeholder.com/1200x400') no-repeat center center/cover;
        }

        .navbar {
            background: linear-gradient(90deg, #4a90e2, #50e3c2);
        }

        @keyframes pop {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            80% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .tick {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #4CAF50;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pop 0.5s ease-out forwards;
        }

        .tick svg {
            stroke: white;
            width: 50px;
            height: 50px;
        }

        .carousel-item {
            transition: transform 0.5s ease-in-out;
        }

        .carousel-container {
            overflow: hidden;
            position: relative;
        }
    </style>

</head>

<body class="font-sans">
    <nav class="flex items-center justify-between p-4 shadow-sm fixed top-0 left-0 w-full z-50 bg-white">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2 py-2">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="rounded-full w-10 h-10 object-cover">
            <span class="font-bold text-xl text-gray-800">Nilkamal</span>
        </a>


        <!-- Search Bar -->
        <div class="flex items-center border border-gray-300 bg-gray-100 rounded-full px-4 py-2 w-80  transition">
            <input type="text" id="searchInput" placeholder="Search For Beds"
                class="bg-transparent border-none outline-none flex-1 text-sm text-gray-700 placeholder-gray-500" />

            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z" />
            </svg>
        </div>

        <script>
            const searchInput = document.getElementById('searchInput');
            const placeholders = ["Search For Beds", "Search For Sofas", "Search For Chairs", "Search For Tables",
                "Search For Wardrobes"
            ];
            let index = 0;

            function changePlaceholder() {
                searchInput.setAttribute('placeholder', placeholders[index]);
                index = (index + 1) % placeholders.length;
            }
            setInterval(changePlaceholder, 2000);
        </script>

        <!-- Icons & Actions -->
        <div class="flex items-center space-x-4">
            <a href="#" class="flex items-center text-blue-600 font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.38 0-2.5 1.12-2.5 2.5S10.62 13 12 13s2.5-1.12 2.5-2.5S13.38 8 12 8z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19.5 12c0 3.59-2.91 6.5-6.5 6.5S6.5 15.59 6.5 12 9.41 5.5 13 5.5 19.5 8.41 19.5 12z" />
                </svg>
                Best Deal
            </a>

            <a href="#" title="Location">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 9s-7-4.686-7-9a7 7 0 1114 0c0 4.314-7 9-7 9z" />
                </svg>
            </a>

            <a href="{{ route('wishlist.index') }}" title="Wishlist" class="relative inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 5.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>

                @if ($wishlistCount > 0)
                    <span
                        class="absolute -top-1 -right-1 p-1 bg-blue-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        {{ $wishlistCount }}
                    </span>
                @endif
            </a>


            <a href="{{ route('cart.index') }}" class="relative" title="Cart">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5M7 13h10m0 0l1.4 5M6 18a1 1 0 100 2 1 1 0 000-2zm12 0a1 1 0 100 2 1 1 0 000-2z" />
                </svg>
                <span
                    class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                    {{ $cartCount }}
                </span>
            </a>

            <!-- Auth Section -->
            <div class="relative space-x-4 z-50">
                @auth
                    <div class="inline-block relative group">
                        <button class="font-medium text-gray-700 focus:outline-none">
                            Hello, {{ Auth::user()->name }}
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-300 z-50">
                            @if (Auth::user()->is_admin == 1)
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Admin
                                    Dashboard</a>
                            @endif
                            {{-- My Orders --}}
                            <a href="{{route('myorder')}}" class="block px-4 py-2 hover:bg-gray-100">My Orders</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Sign Up</a>
                @endauth
            </div>

        </div>
    </nav>


    <br>
    <br>
    <br>
    <nav class="bg-gray-100 p-4 flex items-center shadow-sm mt-3 relative z-20">
        <div class="inline-flex space-x-4">
            @foreach ($categories as $cat)
                <div class="relative group">
                    <a href="{{ route('category-products', $cat->id) }}"
                        class="border border-black px-4 py-2 rounded-full text-gray-700 hover:text-black hover:bg-gray-200 transition duration-300">
                        {{ $cat->cat_name }}
                    </a>

                    <!-- Dropdown -->
                    <div
                        class="absolute left-0 top-full mt-2 w-72 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300 ease-in-out z-50">

                        @forelse ($cat->products as $product)
                            <a href="#"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-black transition duration-200">
                                {{ $product->product_name }}
                            </a>
                            <hr>
                        @empty
                            <span class="block px-4 py-2 text-gray-400">No Products</span>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </nav>








    @section('content')
    @show

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 p-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-7xl mx-auto">
            <div>
                <h3 class="font-bold text-white mb-4">Furniture</h3>
                <ul class="space-y-2">
                    <li>Home Furniture</li>
                    <li>Office Furniture</li>
                    <li>Mattress</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-white mb-4">About Us</h3>
                <ul class="space-y-2">
                    <li>About Nilkamal</li>
                    <li>Social Impact</li>
                    <li>Contact Us</li>
                    <li>Blogs</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-white mb-4">Help</h3>
                <ul class="space-y-2">
                    <li>Shipping & Delivery</li>
                    <li>Terms & Conditions</li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-white mb-4">Support</h3>
                <p>📞 1800 1219 115</p>
                <p>✉️ furniture.enquiry@nilkamal.com</p>
                <p>🏠 Mumbai, India</p>
            </div>
        </div>
    </footer>

</body>

</html>
