<!-- resources/views/layouts/app.blade.php -->
<html>
    <head>
        @vite('resources/css/app.css')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LoanAHorse</title>
    </head>
    <body>
        <!-- Include the header partial -->
        @include('partials.header')

        <div class="content">
            <!-- The content of each individual page will be injected here -->
            @yield('content')
        </div>

        <!-- Include the footer partial -->
        @include('partials.footer')
    </body>
</html>
