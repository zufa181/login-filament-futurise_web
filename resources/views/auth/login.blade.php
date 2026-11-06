<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - FUTURiSE</title>
</head>
<body>
    <h1>Masuk ke FUTURiSE</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
            @error('email') <p>{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password">Kata sandi</label>
            <input id="password" name="password" type="password" required>
        </div>

        <label><input type="checkbox" name="remember"> Ingat saya</label>

        <button type="submit">Masuk</button>
    </form>
</body>
</html>