<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center pb-5 pt-2">
      <a class="sidebar-brand brand-logo" href="/"><img src="../../../assets/images/logo.png"
          alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini ps-4 pt-3" href="/"><img
          src="../../../assets/images/logo.png" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item mt-4">
        <a class="nav-link" href="/">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>


      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="mdi mdi-account-outline menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}">
          <i class="mdi mdi-progress-check menu-icon"></i>
          <span class="menu-title">Orders</span>
        </a>
      </li>
      
      <li class="nav-item logout-btn mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="nav-link" href="{{ route('logout') }}">
              <i class="mdi mdi-logout menu-icon"></i>
              <span class="menu-title">Logout</span>
            </button>
        </form>
      
    </ul>
  </nav>
  <!-- partial -->