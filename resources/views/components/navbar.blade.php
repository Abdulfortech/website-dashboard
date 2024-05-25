<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <!-- <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="index">Home</a></li>
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
        </ol> -->
        <h6 class="font-weight-bolder text-white mb-0">{{$page}}</h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
         <div class="ms-md-auto pe-md-3 d-flex align-items-center">
         {{--<div class="input-group">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="Type here...">
          </div> --}}
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item pe-2 mx-2 d-flex align-items-center">
            <a href="{{route('orders.showProductAdd')}}" class="nav-link text-white font-weight-bold px-0" aria-expanded="false">
              <span class="d-sm-inline badge bg-white text-primary d-none" id="caption-title">
                <i class="fa fa-shopping-cart me-sm-1" style="font-size: 15px;"></i> Product</span>
            </a>
          </li>
          <li class="nav-item pe-2 mx-2 d-flex align-items-center">
            <a href="{{route('orders.showServiceAdd')}}" class="nav-link text-white font-weight-bold px-0" aria-expanded="false">
              <span class="d-sm-inline badge bg-white text-primary d-none" id="caption-title">
                <i class="fa fa-shopping-cart me-sm-1" style="font-size: 15px;"></i> Service</span>
            </a>
          </li>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
              </div>
            </a>
          </li>
          <li class="nav-item dropdown px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user-circle me-sm-1" style="font-size: 20px;"></i>
              <span class="d-sm-inline d-none" id="caption-title">{{auth()->user()->firstName ." ". auth()->user()->lastName}}</span>
            </a>
            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
              {{-- <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="profile">
                  <div class="d-flex py-1">
                    <div class="my-auto me-3">
                        <i class="fa fa-user" style="font-size: 15px;"></i>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h3 class="text-sm font-weight-normal mb-0">
                        <span class="font-weight-bold">Profile</span>
                      </h3>
                    </div>
                  </div>
                </a>
              </li>
              <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="settings">
                  <div class="d-flex py-1">
                    <div class="my-auto me-3">
                        <i class="fa fa-gears" style="font-size: 15px;"></i>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h3 class="text-sm font-weight-normal mb-0">
                        <span class="font-weight-bold">Settings</span>
                      </h3>
                    </div>
                  </div>
                </a>
              </li>
              <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="tables">
                  <div class="d-flex py-1">
                    <div class="my-auto me-3">
                        <i class="fa fa-table" style="font-size: 15px;"></i>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h3 class="text-sm font-weight-normal mb-0">
                        <span class="font-weight-bold">User Logs</span>
                      </h3>
                    </div>
                  </div>
                </a>
              </li> --}}
              <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="{{route('logout')}}">
                  <div class="d-flex py-1">
                    <div class="my-auto me-3">
                        <i class="fa fa-sign-out" style="font-size: 15px;"></i>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h3 class="text-sm font-weight-normal mb-0">
                        <span class="font-weight-bold">Sign Out</span>
                      </h3>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </div>
  </nav>