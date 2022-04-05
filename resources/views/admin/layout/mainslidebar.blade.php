<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="https://www.facebook.com/toandnt/" class="brand-link">
      <img src="admin_lib/dist/img/Logo-Thuy_Loi.png" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">58TH2 - ĐNT</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="admin_lib/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('users') }}" class="d-block">hello: <b>{{ Auth::user()->name }}</b></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route('index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>QL tài khoản</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('menus') }}" class="nav-link">
                        <i class="fas fa-list"></i>
                        <p>QL menu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contents') }}" class="nav-link">
                        <i class="fas fa-clipboard-list"></i>
                        <p>QL Nội Dung</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('news') }}" class="nav-link">
                        <i class="fas fa-clipboard-list"></i>
                        <p>QL tin tức</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs"></i>
                        <p>Web setting</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>