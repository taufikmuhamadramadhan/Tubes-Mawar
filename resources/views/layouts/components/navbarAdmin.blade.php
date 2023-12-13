<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('adminWarnet.dashboard') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
            <a class="btn btn-default btn-flat float-right" href="{{ route('logoutAdmin') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">

                <form id="logout-form" action="{{ route('logoutAdmin') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
            </a>
            {{-- <a href="#" class="btn btn-default btn-flat float-right">Sign out</a> --}}

        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->