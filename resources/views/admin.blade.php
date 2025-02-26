<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('IMAGES/logowestpoint.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Admin - Xentra Medica Corp.</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="font-mono flex bg-gray-100">

    <!-- Sidebar -->
    <aside
        class="fixed mt-20 left-0 top-0 w-64 h-screen bg-white shadow-lg p-4 transition-transform transform -translate-x-full sm:translate-x-0">
        <div class="flex items-center justify-between mb-6">


        </div>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="/admin" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                </li>
                {{-- <li>
                    <a href="/admin/orders" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-shopping-cart mr-2"></i>Orders
                    </a>
                </li>
                <li>
                    <a href="/admin/users" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-user mr-2"></i>Users
                    </a>
                </li> --}}
                <li>
                    <a href="/admin/messages" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-envelope mr-2"></i>Messages
                    </a>
                </li>
                <li>
                    <a href="/manage/content" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-newspaper mr-2"></i>Manage Content
                    </a>
                </li>
                <li>
                    <button id="settingsToggle"
                        class="w-full text-left block py-2 px-4 rounded hover:bg-green-100 text-gray-700 flex justify-between items-center">
                        <span><i class="fas fa-cogs mr-2"></i>Settings</span>
                        <i class="fas fa-chevron-down transition-transform duration-300"></i>
                    </button>
                    <ul id="settingsSublist" class="ml-6 mt-1 hidden space-y-2">
                        <li><a href="/addproducts" class="block py-2 px-4 rounded hover:bg-green-200 text-gray-700">Add
                                Products</a></li>
                        <li><a href="/modifyproducts"
                                class="block py-2 px-4 rounded hover:bg-green-200 text-gray-700">Modify Products</a>
                        </li>
                        <li><a href="/moresettings"
                                class="block py-2 px-4 rounded hover:bg-green-200 text-gray-700">More Settings</a></li>
                        <li><a href="/admin/changepassword"
                                class="block py-2 px-4 rounded hover:bg-green-200 text-gray-700">Change Password</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="logout-btn" class="block py-2 px-4 rounded hover:bg-red-100 text-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </li>
                <form id="logout-form" action="/auth/admin-logout" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>

        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-0 sm:ml-64 p-4 transition-all">
        <header
            class="fixed border-b-4 border-orange-500 top-0 left-0 right-0 mb-2 px-4 shadow bg-white z-50 backdrop-filter backdrop-blur-xl bg-opacity-30">
            <div
                class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex">
                    <button id="mobileMenuToggle" class="sm:hidden text-gray-600 text-xl">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="flex items-center text-2xl font-black" href="/admin">
                        <img src="{{ asset('IMAGES/xentra1.png') }}" class="w-36 my-0" alt="BISU Logo" />
                    </a>
                </div>


            </div>
        </header>

        <section class="pt-24">
            <h1 class="text-2xl font-semibold">Dashboard</h1>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
                <div
                    class="bg-white h-fit w-full shadow-md rounded-lg p-4 flex items-start gap-4 border border-gray-200">
                    <div class="text-orange-500 text-3xl my-auto mx-4">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="/admin/orders">
                        <div>
                            <h3 class="text-lg text-gray-800 font-semibold">{{ $customerCount }}</h3>
                            <p class="text-gray-600 text-sm ">Orders</p>
                        </div>
                    </a>

                </div>
                <div
                    class="bg-white h-fit w-full shadow-md rounded-lg p-4 flex items-start gap-4 border border-gray-200">
                    <a href="/admin/users">

                    </a>
                    <div class="text-orange-500 text-3xl my-auto mx-4">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="/admin/users">
                        <div>
                            <h3 class="text-lg text-gray-800 font-semibold">{{ $userCount }}</h3>
                            <p class="text-gray-600 text-sm ">Users</p>
                        </div>
                    </a>

                </div>
                <div
                    class="bg-white h-fit w-full shadow-md rounded-lg p-4 flex items-start gap-4 border border-gray-200">
                    <a href="/admin/users">

                    </a>
                    <div class="text-orange-500 text-3xl my-auto mx-4">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <a href="/admin/messages">
                        <div>
                            <h3 class="text-lg text-gray-800 font-semibold">{{ $messageCount }}</h3>
                            <p class="text-gray-600 text-sm ">Messages</p>
                        </div>
                    </a>

                </div>
                <div
                    class="bg-white h-fit w-full shadow-md rounded-lg p-4 flex items-start gap-4 border border-gray-200">
                    <div class="text-orange-500 text-3xl my-auto mx-4">
                        <h1 class="text-4xl">8</h1>
                    </div>
                    <div>
                        <h3 class="text-lg text-gray-600">Content Title</h3>
                        <p class="text-gray-800 text-sm font-semibold">Description</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.getElementById('logout-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action

            Swal.fire({
                title: "Are you sure?",
                text: "You will be logged out.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, Logout!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit(); // Submit the logout form
                }
            });
        });

        // Sidebar Toggle for Mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('aside').classList.toggle('-translate-x-full');
        });

        document.getElementById('mobileMenuToggle')?.addEventListener('click', function() {
            document.querySelector('aside').classList.toggle('-translate-x-full');
        });
        document.getElementById('settingsToggle').addEventListener('click', function() {
            let sublist = document.getElementById('settingsSublist');
            let icon = this.querySelector('i:last-child');

            sublist.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    </script>

</body>

</html>
