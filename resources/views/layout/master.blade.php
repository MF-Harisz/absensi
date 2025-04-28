
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Absensi</title>

    <link href="{{ asset( 'asset/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">
    <link href="{{ asset('asset/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @stack('css')

</head>

<body id="page-top">

    <div id="wrapper">

        @include('layout.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layout.header')
                <div class="container-fluid">

                    @yield('contents')
                    @yield('makul')
                    @yield('admin')
                    @yield('dosen')
                    @yield('user')
                    @yield('kelas')
                    @yield('jadwal')
                    @yield('absensi')
                    @yield('dataAbsensi')


                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Website Absensi 2024</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset( 'asset/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset( 'asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset( 'asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{ asset('asset/js/sb-admin-2.min.js')}}"></script>
    <script src="{{ asset( 'asset/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('asset/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('asset/js/demo/chart-pie-demo.js')}}"></script>
    @stack('scripts')
</body>

</html>