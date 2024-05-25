<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{route('dashboard')}}" target="_blank">
        <!-- <img src="../assets/images/logo.jpg" class="navbar-brand-img" style="width: 50px; height:70px" alt="main_logo"> -->
        <!-- <span class="ms-1 font-weight-bold fw-bold">BAMS</span> -->
        <h3 class="fw-bolder text-center">BAMS</h3>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'index') ? 'active' : ''; ?>" href="{{route('dashboard')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        @if(auth()->user()->userType == 'super-admin')
        <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'components') ? 'active' : ''; ?>" href="{{route('components')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-sitemap text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Components</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'admins') ? 'active' : ''; ?>" href="{{route('admins')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Admins</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'employees') ? 'active' : ''; ?>" href="{{route('employees')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Employees</span>
          </a>
        </li>
        @endif
        {{-- <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'clients') ? 'active' : ''; ?>" href="{{route('clients')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Clients</span>
          </a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'products') ? 'active' : ''; ?>" href="{{route('products')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Products</span>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'services') ? 'active' : ''; ?>" href="services">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-briefcase text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Services</span>
          </a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'orders') ? 'active' : ''; ?>" href="{{route('orders')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-shopping-cart text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Orders</span>
          </a>
        </li>
        @if(auth()->user()->userType == 'super-admin')
        <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'accounting') ? 'active' : ''; ?>" href="{{route('accounting')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-credit-card text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Accounting</span>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'expenses') ? 'active' : ''; ?>" href="{{route('expenses')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Expenses</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'wages') ? 'active' : ''; ?>" href="{{route('wages')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-piggy-bank text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Wages</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'history') ? 'active' : ''; ?>" href="{{route('histories')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-table text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">History</span>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link <?php echo ($page == 'analytics') ? 'active' : ''; ?>" href="{{route('analytics')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-credit-card text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Analytics</span>
          </a>
        </li> --}}

      </ul>
    </div>
</aside>