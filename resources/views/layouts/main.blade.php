<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pizza 10</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css" ') }}/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-light-layout/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/jquery.tagsinput.min.js') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css" /> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
      .mr-4 {
        margin-right: 1.5rem;
      }
      .ml-4 {
        margin-left: 1.5rem;
      }
      .main-panel {
        min-height: 100vh;
      }
      .text-right {
        text-align: right !important;
      }
      .dropdown-item {
        cursor: pointer;
      }
      .select2-selection__choice__display {
        font-size: medium;
      }
      .select2-selection__choice__remove {
        width: 15px;
        height: 15px;
      }
    </style>
    
    @stack('style')
    
    @livewireStyles
  </head>
  <body>

    <div class="container-scroller">

      @include('includes.sidebar')

      <div class="container-fluid page-body-wrapper">

        @include('includes.header')

        <div class="main-panel">

          @yield('content')

          @include('includes.footer')
      </div>
      
    </div>
    
  </div>


<!-- plugins:js -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/vendors/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('assets/vendors/flot/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('assets/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
<script src="{{ asset('assets/vendors/flot/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('assets/vendors/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/proBanner.js') }}"></script>
<script src="{{ asset('assets/jquery.tagsinput.min.js') }}"></script>
<!-- End custom js for this page -->

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- @livewireScripts --}}

</body>
</html>

@stack('script')

<script>
  $('.delete-btn').on('click', function(event) {
    event.preventDefault();
    var url = $(this).attr('href');
    var confirmMessage = 'Are you sure you want to delete this?';
    if (confirm(confirmMessage)) {

      $.ajax({
        method: 'DELETE',
        url: url,
        data: {
          _token: "{{ csrf_token() }}"
        },
        success: function(data) {
          
        },
        error: function(xhr, status, error) {
          console.log('Error deleting storage box:', error);
        }
    });
      
      window.location.reload();
    }
  });

  $('.remove-btn').on('click', function(event) {
    event.preventDefault();
    var url = $(this).attr('href');
    var confirmMessage = 'Are you sure you want to delete this?';
    if (confirm(confirmMessage)) {

      $.ajax({
        method: 'GET',
        url: url,
        data: {
          _token: "{{ csrf_token() }}"
        },
        success: function(data) {
          
        },
        error: function(xhr, status, error) {
          console.log('Error deleting storage box:', error);
        }
    });
      
      window.location.reload();
    }
  });
  
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>