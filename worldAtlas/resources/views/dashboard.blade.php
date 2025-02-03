<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to the Dashboard</h1>
        </header>
        <nav>
            <ul>
                <li><a href="{{ route('welcome') }}">Home</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </nav>
        <main>
            <h2>Dashboard Content</h2>
            <p>This is where your dashboard content will go.</p>
        </main>
        <footer>
            <p>&copy; {{ date('Y') }} Your Company</p>
        </footer>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>