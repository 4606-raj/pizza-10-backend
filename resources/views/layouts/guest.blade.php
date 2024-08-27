<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Boxed Campup Storage</title>
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
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <style>
      .mr-4 {
        margin-right: 1.5rem;
      }
      .ml-4 {
        margin-left: 1.5rem;
      }
    </style>
    
    @stack('style')
    
  </head>
  <body>

    @yield('content')


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
</script>