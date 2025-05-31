<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
</head>

<body>
    <div class="wrapper">
        @include('admin.sidebar')

        <div class="main">
            @include('admin.header')

            <main class="content">
                @yield('content')
            </main>

            @include('admin.footer')
        </div>
    </div>
</body>

</html>
