<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Dashboard - FUTURiSE</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Halo, {{ auth()->user()->name }}.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Keluar</button>
    </form>
</body>
</html>