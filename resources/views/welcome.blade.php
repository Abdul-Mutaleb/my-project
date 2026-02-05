
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TravelPlatform - Discover the World</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')

</head>

<body>
    <!-- ================= HERO SECTION ================= -->

    @include('user.header')
    @include('user.mobile_header')

    <main>
        <!-- ================= OUR SERVICES ================= -->
        @include('user.our_services')

        <!-- ================= TRENDING TOUR PACKAGES ================= -->

        @include('user.products')
        <!-- ================= LATEST FLIGHT DEALS ================= -->
        @include('user.lates_products')

        <!-- ================= TRUST FEATURES ================= -->
        @include('user.suport')

    </main>


    <!-- ================= FOOTER ================= -->
    @include('user.footer')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>