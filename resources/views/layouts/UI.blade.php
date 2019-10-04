<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>window.Laravel= { csrfToken:'{{ csrf_token() }}'}</script> 
  <link rel="icon" href="greymore.ico">
  
  <title>Greydesk EAM | Admin Dashboard</title>

  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

 </head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse"> <?php //layout-footer-fixed ?>
<div class="wrapper" id="app">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/home" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">{{\Auth::user()->emp_id}}</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
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
          <a href="#" class="dropdown-item dropdown-footer">{{\Auth::user()->emp_id}}</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
      <li class="nav-item">
          <a class="nav-link"  href="{{ route('adminlogout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"><i
              class="fas fa-lock" aria-hidden="true">
              </i><span>&nbsp;Logout</span>
              </a>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <form id="logout-form" action="{{ route('adminlogout') }}" method="POST" style="display: none;">
    @csrf
   </form>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link navbar-white">
      <img src="img/greymorelogo.png" alt="Greymore Logo" class="brand-image img-circle"
           style="opacity: 1">
      <span class="brand-text font-weight-light"><img src="img/greydesk.png" alt="Greydesk Logo" class=""
        style="opacity: 1">ERP</span>
    </a>

    <!-- Sidebar -->
    @can('isThor')
    @include( 'layouts.sidebar.thor' )
    @endcan
    @can('isHRAdmin')
    @include( 'layouts.sidebar.hr_admin' )
    @endcan
    @can('isAssetAdmin')
    @include( 'layouts.sidebar.asset_admin' )
    @endcan
    @can('isPurchaseManager')
    @include( 'layouts.sidebar.purchase_manager' )
    @endcan
    @can('isStoreManager')
    @include( 'layouts.sidebar.store_manager' )
    @endcan
    @can('isStoreKeeper')
    @include( 'layouts.sidebar.store_keeper' )
    @endcan
    @can('isEmployee')
    @include( 'layouts.sidebar.employee' )
    @endcan

    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <vue-progress-bar>

  </vue-progress-bar>
  <router-view>

  </router-view>
 
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
      <img src="img/greymorelogo.png" alt="Greymore Logo" class="brand-image img-circle"
      style="opacity: 1">
 <span><img src="img/greydesk.png" alt="Greydesk Logo" class=""
   style="opacity: 1"></span>
        <strong>&nbsp|&nbsp &copy; 2018-2019 <a href="http://www.greymore.tech">Greymore Tech Pvt. Ltd.</a></strong> 
        All rights reserved.
    <div class="float-right d-none d-sm-inline">
            Vestibulum. Accommodare. Vincere.
            </div>
  </footer>
</div>
<!-- ./wrapper -->
@auth
<script>
    window.user = @json(auth()->user()) 
</script>
@endauth
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/js/app.js"></script>
</body>
</html>
