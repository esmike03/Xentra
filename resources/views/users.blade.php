<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('IMAGES/logowestpoint.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Admin - Westpoint Pharma Inc.</title>
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
                <li>
                    <a href="/admin/orders" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-shopping-cart mr-2"></i>Orders
                    </a>
                </li>
                <li>
                    <a href="/admin/users" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-user mr-2"></i>Users
                    </a>
                </li>
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
            class="fixed border-b-4 border-green-500 top-0 left-0 right-0 mb-2 px-4 shadow bg-white z-50 backdrop-filter backdrop-blur-xl bg-opacity-30">
            <div
                class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex">
                    <button id="mobileMenuToggle" class="sm:hidden text-gray-600 text-xl">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="flex items-center text-2xl font-black" href="/admin">
                        <img src="{{ asset('IMAGES/wespointv2nb.png') }}" class="w-36 my-0" alt="BISU Logo" />
                    </a>
                </div>


            </div>
        </header>

        <section class="pt-24">

            <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-lg" x-data="{ search: '' }">
                <h1 class="text-3xl font-semibold text-gray-900 mb-6">User List</h1>

                <!-- Search Bar -->
                <div class="relative mb-6 flex items-center">
                    <input type="text" x-model="search" placeholder="Search by name or email..."
                        class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <svg class="absolute left-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 3a7.5 7.5 0 006.15 12.15z" />
                    </svg>
                    <button @click="search = ''" class="absolute right-3 text-gray-500 hover:text-red-500 transition"
                        x-show="search !== ''">
                        ✕
                    </button>
                </div>

                <!-- User Table -->
                <div x-data="{ showModal: false, selectedUser: {} }">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-blue-50 transition"
                                    x-show="search === '' ||
                                        '{{ strtolower($user->firstname) }}'.includes(search.toLowerCase()) ||
                                        '{{ strtolower($user->lastname) }}'.includes(search.toLowerCase()) ||
                                        '{{ strtolower($user->email) }}'.includes(search.toLowerCase())">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $user->id }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $user->firstname }} {{ $user->lastname }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $user->phone }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $user->email }}</td>
                                    <td class="px-4 py-3 flex space-x-2">
                                        <button
                                            @click="selectedUser = {
                                            id: '{{ $user->id }}',
                                            name: '{{ $user->firstname }} {{ $user->lastname }}',
                                            phone: '{{ $user->phone }}',
                                            email: '{{ $user->email }}',
                                            profile_picture: '{{ asset('storage/' . $user->profile_picture) }}',
                                            address: `{{ optional($user->address)->house_number ?? '' }}
                                                      {{ optional($user->address)->street ?? '' }},
                                                      {{ optional($user->address)->barangay ?? '' }},
                                                      {{ optional($user->address)->city ?? '' }},
                                                      {{ optional($user->address)->province ?? '' }},
                                                      {{ optional($user->address)->postal_code ?? '' }},
                                                      {{ optional($user->address)->country ?? '' }}`
                                        }; showModal = true;">
                                            <i class="fa fa-eye text-blue-500 cursor-pointer"></i>
                                        </button>



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- ✅ Modal for User Details -->
                    <div x-show="showModal"
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                            <div class="flex justify-center">
                                <img :src="selectedUser.profile_picture && selectedUser.profile_picture !== 'null'
                                            ? selectedUser.profile_picture
                                            : 'https://media.istockphoto.com/id/2151669184/vector/vector-flat-illustration-in-grayscale-avatar-user-profile-person-icon-gender-neutral.jpg?s=612x612&w=0&k=20&c=UEa7oHoOL30ynvmJzSCIPrwwopJdfqzBs0q69ezQoM8='"
                                     class="h-24 w-24 rounded-full border"
                                     alt="User Profile Picture">
                            </div>

                            <h2 class="text-xl font-semibold text-center mt-3" x-text="selectedUser.name"></h2>
                            <p class="text-gray-600 text-center" x-text="selectedUser.email"></p>
                            <p class="text-gray-600 text-center" x-text="selectedUser.phone"></p>
                            <hr class="my-3">
                            <p class="text-gray-800"><strong>Address:</strong></p>
                            <p class="text-gray-600" x-text="selectedUser.address"></p>
                            <div class="text-center mt-4">
                                <button @click="showModal = false"
                                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Empty Message -->
                @if ($users->isEmpty())
                    <p class="text-gray-500 mt-6 text-center">No users found.</p>
                @endif
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
