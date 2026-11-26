
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Perpustakaan')</title>
</head>
<body>

    <header>
        <h1>Sistem Manajemen Perpustakaan</h1>

        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('books.index') }}">Books</a>
            <a href="{{ route('categories.index') }}">Categories</a>
            <a href="{{ route('members.index') }}">Members</a>
            <a href="{{ route('borrowing.index') }}">Peminjaman</a>
            @can('manage-users')
                <a href="{{ route('users.index') }}">Kelola Pengguna</a>
            @endcan
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Sistem Manajemen Perpustakaan - Valenly Yabes Pakpahan</p>
    </footer>

</body>
</html>
