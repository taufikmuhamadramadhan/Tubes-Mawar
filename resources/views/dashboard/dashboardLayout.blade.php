<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/css/style.css">
    <link rel="stylesheet" href="welcome/css/styles.css">
    <link rel="shortcut icon" href="{{ asset('admin') }}/images/favicon.png" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Mawar</h2>
            </div class>
                <ul>
                    <li><a href="dataWarnet">Warnet</a></li>
                </ul>
                <ul>
                    <li><a href="cv">Billing</a></li>
                </ul>

            <div class="right-menu">
                @auth
                    <ul>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                                Selamat Datang
                                <!-- <img class="images" src="{{ asset('admin') }}/images/faces/OIP.jpg" alt="profile" /> -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="">
                                    <i class="mdi mdi-account text-primary"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-settings text-primary"></i>
                                    Settings
                                </a>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="mdi mdi-logout text-danger"></i>
                                    Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                @else
                    <ul>
                        <li>
                            <a class="dropdown-item" href="/login">
                                <i class="mdi mdi-login text-primary"></i>
                                login
                            </a>
                        </li>
                    </ul>
                @endauth 
            </div>

        </div>
        @yield('konten2')
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="{{ asset('admin') }}/vendors/base/vendor.bundle.base.js"></script>
    <script src="{{ asset('admin') }}/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ asset('admin') }}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ asset('admin') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('admin') }}/js/off-canvas.js"></script>
    <script src="{{ asset('admin') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('admin') }}/js/template.js"></script>
    <script src="{{ asset('admin') }}/js/dashboard.js"></script>
    <script src="{{ asset('admin') }}/js/data-table.js"></script>
    <script src="{{ asset('admin') }}/js/jquery.dataTables.js"></script>
    <script src="{{ asset('admin') }}/js/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('admin') }}/js/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>
