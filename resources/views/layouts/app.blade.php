<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Perpustakaan')</title>

    @vite('resources/css/app.css')
</head>
<body>

    <header class="topbar">
        <div class="brand">
            <h2>Sistem Informasi Perpustakaan</h2>
        </div>

        <nav class="navigation">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active' : '' }}">Books</a>
            <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a>
            <a href="{{ route('members.index') }}" class="{{ request()->routeIs('members.*') ? 'active' : '' }}">Members</a>
            <a href="{{ route('borrowing.index') }}" class="{{ request()->routeIs('borrowing.*', 'borrowings.*') ? 'active' : '' }}">Peminjaman</a>

            @can('manage-users')
                <a href="{{ route('users.index') }}"class="{{ request()->routeIs('users.*') ? 'active' : '' }}">Kelola Pengguna</a>
            @endcan
        </nav>

        <div class="user-menu">
            <span>{{ auth()->user()->name }}</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="main-footer">
        &copy; {{ date('Y') }} Sistem Informasi Perpustakaan Sederhana - Valenly Yabes Pakpahan
    </footer>

</body>
</html>
