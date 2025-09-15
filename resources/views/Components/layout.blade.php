<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
</head>
<body>
    <nav>
        <x-nav-link></x-nav-link>
        <a href="/about">About</a>
        <a href="/contact">Contact</a>
    </nav>

   {{ $slot }}
   
</body>
</html>