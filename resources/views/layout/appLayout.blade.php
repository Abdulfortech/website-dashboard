
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}"> -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  {{-- <link href="{{ asset('assets/vendors/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" /> --}}
  <link href="{{ asset('assets/vendors/font-awesome-6/css/all.min.css') }}" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Include Select2 Bootstrap 5 theme CSS -->
  <link href="{{ asset('assets/vendors/select2-bootstrap-5-theme/docs/assets/css/docs.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <!-- DataTables  -->
  <link href="{{ asset('assets/vendors/DataTables/datatables.min.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
</head>

<body class="g-sidenav-show  bg-gray-100">
  
    @yield('contents')


  <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/DataTables/datatables.min.js') }}"></script>
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
  <!-- Toastr js -->
   <script src="{{ asset('assets/js/toastr.js') }}"></script>
  @if (session()->has('message'))
   <script>
            toastr.info("{{ session('message') }}");        
    </script>
    @endif
    <!-- Include jQuery (required for Select2) -->
    
    {{-- <script src="{{ asset('assets/vendors/select2-bootstrap-5-theme/docs/assets/js/docs.js') }}"></script> --}}
    <script src="{{ asset('assets/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Scripts -->

    <script>
      function closeModal(modal) {
        $('#' + modal).modal("hide");    
      }
      
    $('#datatable').DataTable();
    </script>    
 @stack('script')
</body>

</html>