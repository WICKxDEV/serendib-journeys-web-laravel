<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4 flex justify-center items-center space-x-8">
        <a href="{{ route('customer.dashboard') }}" class="text-lg font-semibold text-blue-600 hover:text-blue-800 transition">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-lg font-semibold text-red-500 hover:text-red-700 transition">Logout</button>
        </form>
    </nav>
    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
