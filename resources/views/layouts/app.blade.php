<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description"
          content="BLUEWAVE STATIONERY - Sistem Manajemen Toko Alat Tulis">

    <meta name="author" content="BLUEWAVE STATIONERY">

    <title>@yield('title', 'Dashboard') - BLUEWAVE STATIONERY</title>

    <!-- Font Awesome -->
    <link
        href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"
        rel="stylesheet"
        type="text/css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900"
        rel="stylesheet">

    <!-- SB Admin 2 CSS -->
    <link
        href="{{ asset('css/sb-admin-2.min.css') }}"
        rel="stylesheet">

    <!-- BLUEWAVE PASTEL THEME -->
    <link
        href="{{ asset('css/bluewave.css') }}"
        rel="stylesheet">

    @stack('styles')

    <!-- Favicon -->
    <link
        rel="icon"
        type="image/png"
        href="https://cdn-icons-png.flaticon.com/512/5005/5005813.png">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper"
             class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                        <h1 class="h3 mb-0 text-gray-800">

                            @yield('page_heading', 'Dashboard')

                        </h1>

                        <div>
                            @yield('action-button')
                        </div>

                    </div>

                    <!-- SUCCESS MESSAGE -->
                    @if (session('success'))

                        <div class="alert alert-success alert-dismissible fade show"
                             role="alert">

                            <i class="fas fa-check-circle mr-2"></i>

                            {{ session('success') }}

                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                    @endif

                    <!-- ERROR MESSAGE -->
                    @if (session('error'))

                        <div class="alert alert-danger alert-dismissible fade show"
                             role="alert">

                            <i class="fas fa-exclamation-circle mr-2"></i>

                            {{ session('error') }}

                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                    @endif

                    <!-- VALIDATION ERRORS -->
                    @if ($errors->any())

                        <div class="alert alert-danger alert-dismissible fade show"
                             role="alert">

                            <strong>
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Periksa kembali data yang dimasukkan.
                            </strong>

                            <ul class="mb-0 mt-2">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                    @endif

                    <!-- PAGE CONTENT -->
                    @yield('content')

                </div>

            </div>

            <!-- Footer -->
            @include('layouts.footer')

        </div>

    </div>

    <!-- Scroll to Top -->
    <a class="scroll-to-top rounded" href="#page-top">

        <i class="fas fa-angle-up"></i>

    </a>

    <!-- Logout Modal -->
    <div class="modal fade"
         id="logoutModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="logoutModalLabel"
         aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title"
                        id="logoutModalLabel">

                        <i class="fas fa-sign-out-alt mr-2 text-primary"></i>

                        Konfirmasi Logout

                    </h5>

                    <button
                        class="close"
                        type="button"
                        data-dismiss="modal"
                        aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    Apakah Anda yakin ingin keluar dari
                    sistem BLUEWAVE STATIONERY?

                </div>

                <div class="modal-footer">

                    <button
                        class="btn btn-secondary"
                        type="button"
                        data-dismiss="modal">

                        Batal

                    </button>

                    <!-- Logout Form -->
                    <form
                        method="POST"
                        action="{{ route('logout') }}">

                        @csrf

                        <button
                            class="btn btn-primary"
                            type="submit">

                            <i class="fas fa-sign-out-alt mr-1"></i>

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core Plugin JavaScript -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- SB Admin 2 JavaScript -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Chart.js -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Dashboard Charts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>

    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

    @stack('scripts')

</body>
</html>
