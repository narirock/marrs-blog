<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @yield('seo')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    @stack('css')
</head>

<body>
    <div class="container">
        <div class="flex-center position-ref full-height">
            <section class="section dashboard-section">
                <div class="section-header">
                    @yield('title')
                </div>
                @yield('content')
            </section>
        </div>
    </div>

    @stack('modals')
    @stack('scripts')
</body>

</html>
