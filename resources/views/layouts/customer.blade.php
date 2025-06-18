<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4">
        <a href="{{ route('customer.dashboard') }}" class="mr-4">Dashboard</a>
        <a href="{{ route('customer.bookings.index') }}" class="mr-4">My Bookings</a>
        <a href="{{ route('customer.profile.edit') }}" class="mr-4">Profile</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-red-500">Logout</button>
        </form>
    </nav>
    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
