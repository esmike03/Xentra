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

        <section class="pt-24 text-xs">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Order List</h2>

                <div x-data="{ search: '', statusFilter: '', openCustomer: null }" class="bg-white shadow-lg rounded-lg p-4">
                    <!-- Search & Filter Controls -->
                    <div class="flex justify-between items-center mb-4">
                        <input type="text" x-model="search" placeholder="Search by customer or product..." class="border p-2 rounded-lg w-1/3 focus:ring focus:ring-green-300">
                        <select x-model="statusFilter" class="border p-2 rounded-lg">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="space-y-4">
                        @foreach ($orders as $user_id => $userOrders)
                            <div class="border rounded-lg overflow-hidden">
                                <button @click="openCustomer === {{ $user_id }} ? openCustomer = null : openCustomer = {{ $user_id }}" class="w-full bg-gray-200 px-4 py-2 text-left font-semibold flex justify-between items-center">
                                    <span>{{ $userOrders->first()->user->firstname }} {{ $userOrders->first()->user->lastname }}</span>
                                    <span x-show="openCustomer === {{ $user_id }}">&#9650;</span>
                                    <span x-show="openCustomer !== {{ $user_id }}">&#9660;</span>
                                </button>
                                <div x-show="openCustomer === {{ $user_id }}" x-collapse class="p-4 space-y-4">
                                    @foreach ($userOrders as $order)
                                        <div class=" shadow rounded-lg flex justify-between bg-white p-1 px-2" x-show="
                                            ('{{ strtolower($order->user->firstname . ' ' . $order->user->lastname) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($order->product->name) }}'.includes(search.toLowerCase())) &&
                                            (statusFilter === '' || statusFilter === '{{ strtolower($order->status) }}')">
                                            <h3 class="font-semibold text-gray-900">{{ $order->product->name }}</h3>
                                            <p class="text-gray-700">Quantity: {{ $order->quantity }}</p>
                                            <p class="text-gray-700">Status: <span class="px-2 rounded-lg text-white text-sm font-semibold {{ $order->status == 'pending' ? 'bg-yellow-500' : 'bg-green-500' }}">
                                                {{ ucfirst($order->status) }}
                                            </span></p>
                                            <button onclick="updateStatus({{ $order->id }})" class=" px-4  bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition duration-200">
                                                Mark as Completed
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </section>
    </main>

    <script>
        function updateStatus(orderId) {
            Swal.fire({
                title: "Mark as Completed?",
                text: "Are you sure you want to mark this order as completed?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, mark it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/orders/${orderId}/complete`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire("Updated!", "Order marked as completed.", "success")
                                    .then(() => window.location.reload());
                            } else {
                                Swal.fire("Error!", data.message, "error");
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire("Oops!", "Something went wrong.", "error");
                        });
                }
            });
        }

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
