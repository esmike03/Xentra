<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-green-50">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md text-center border border-green-200">
        <h1 class="text-2xl font-bold text-green-700 mb-4">Logged Out Successfully</h1>
        <p class="text-green-600">You have been logged out. Would you like to log in again or return home?</p>

        <div class="mt-6 flex flex-col gap-3">
            <a href="{{ route('login') }}" class="px-6 py-3 text-white bg-green-600 rounded-lg hover:bg-green-700 transition">Login Again</a>
            <a href="/" class="px-6 py-3 text-green-600 border border-green-600 rounded-lg hover:bg-green-600 hover:text-white transition">Go Back Home</a>
        </div>
    </div>
</body>
</html>
