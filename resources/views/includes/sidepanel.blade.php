<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ config('app.APP_URL') }}/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ config('app.APP_URL') }}/assets/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ config('app.APP_URL') }}/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ config('app.APP_URL') }}/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ config('app.APP_URL') }}/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">
                        @if (session('activePage') != null)
                            {{ session('activePage') }}
                        @endif
                    </a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                {{-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li> --}}

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ config('app.APP_URL') }}/assets/dist/img/user1-128x128.jpg"
                                    alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ config('app.APP_URL') }}/assets/dist/img/user8-128x128.jpg"
                                    alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ config('app.APP_URL') }}/assets/dist/img/user3-128x128.jpg"
                                    alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout" role="button">
                        <i class="fas fa-power-off"></i>
                    </a>
                </li>
                {{-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li> --}}
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ config('app.APP_URL') }}/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ config('app.APP_URL') }}/assets/dist/img/user2-160x160.jpg"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            @if (session('user_name'))
                                {{ session('user_name') }}
                            @endif
                        </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                        <li class="nav-item @if (session('activePage') != null && str_contains(session('activePage'), 'category')) ) menu-open @endif">
                            <a href="#" class="nav-link @if (session('activePage') != null && str_contains(session('activePage'), 'category')) ) active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Category
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ config('app.APP_URL') }}/category"
                                        class='nav-link @if (session('activePage') != null &&
                                            (session('activePage') == 'category' || str_contains(session('activePage'), 'category-edit'))) active @endif '>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ config('app.APP_URL') }}/category-add"
                                        class='nav-link @if (session('activePage') != null && session('activePage') == 'category-add') active @endif '>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Category</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @if (session('activePage') != null &&
                            (session('activePage') == 'product' ||
                                session('activePage') == 'product-edit' ||
                                session('activePage') == 'product-add')) menu-open @endif">
                            <a href="#" class="nav-link @if (session('activePage') != null &&
                                (session('activePage') == 'product' ||
                                    session('activePage') == 'product-edit' ||
                                    session('activePage') == 'product-add')) active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Product
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ config('app.APP_URL') }}/product"
                                        class='nav-link @if (session('activePage') != null &&
                                            (session('activePage') == 'product' || str_contains(session('activePage'), 'product-edit'))) active @endif '>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Product</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ config('app.APP_URL') }}/product-add"
                                        class='nav-link @if (session('activePage') != null && session('activePage') == 'product-add') active @endif '>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Product</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @if (session('activePage') != null && str_contains(session('activePage'), 'product-section')) ) menu-open @endif">
                            <a href="#" class="nav-link @if (session('activePage') != null && str_contains(session('activePage'), 'product-section')) ) active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Product Section
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ config('app.APP_URL') }}/product-section-view"
                                        class='nav-link @if (session('activePage') != null && session('activePage') == 'product-section-view') active @endif '>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Product Section</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ config('app.APP_URL') }}/product-section-add"
                                        class='nav-link @if (session('activePage') != null && session('activePage') == 'product-section-add') active @endif '>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Product in product section</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item @if (session('activePage') != null && str_contains(session('activePage'), 'delivery-person')) ) menu-open @endif">
                            <a href="#" class="nav-link @if (session('activePage') != null && str_contains(session('activePage'), 'delivery-person')) ) active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Delivery Person Section
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ config('app.APP_URL') }}/product-section-view"
                                        class='nav-link @if (session('activePage') != null && session('activePage') == 'product-section-view') active @endif '>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Delivery Person</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ config('app.APP_URL') }}/product-section-add"
                                        class='nav-link @if (session('activePage') != null && session('activePage') == 'product-section-add') active @endif '>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Delivery Person</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item @if (session('activePage') != null && str_contains(session('activePage'), 'order-section')) ) menu-open @endif">
                            <a href="#" class="nav-link @if (session('activePage') != null && str_contains(session('activePage'), 'order-section')) ) active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Order Section
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ config('app.APP_URL') }}/product-section-view"
                                        class='nav-link @if (session('activePage') != null && session('activePage') == 'product-section-view') active @endif '>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Orders</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ config('app.APP_URL') }}/product-section-add"
                                        class='nav-link @if (session('activePage') != null && session('activePage') == 'product-section-add') active @endif '>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Delivery Person</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    View Order

                                </p>
                            </a>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')


        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        {{-- <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
      </footer> --}}
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ config('app.APP_URL') }}/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ config('app.APP_URL') }}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ config('app.APP_URL') }}/assets/dist/js/adminlte.min.js"></script>

    {{-- datatables --}}
    <script src="{{ config('app.APP_URL') }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ config('app.APP_URL') }}/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });
            $(".table-multi").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        const imageDelete = async (domain, documentid) => {
            let url = `${domain}/delete-document/${documentid}`
            let res = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                },
            })
            let body = res.body;
            if (body.response == true) {
                location.reload();
            }
        }
    </script>
</body>

</html>
