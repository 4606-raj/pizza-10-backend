<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center pb-5 pt-2">
      <a class="sidebar-brand brand-logo" href="/"><img src="../../../assets/images/logo.png"
          alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini ps-4 pt-3" href="/"><img
          src="../../../assets/images/logo.png" alt="logo" /></a>
    </div>
    <br><hr>
    <ul class="nav" style="height: 100vh;">
      <li class="nav-item mt-4">
        <a class="nav-link" href="/">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>


      @if (Auth::guard('staff')->user()->role == 1)
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.index') }}">
            <i class="mdi mdi-account-outline menu-icon"></i>
            <span class="menu-title">Customers</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('staff.index') }}">
            <i class="mdi mdi-account-supervisor menu-icon"></i>
            <span class="menu-title">Staff</span>
          </a>
        </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}">
          <i class="mdi mdi-progress-check menu-icon"></i>
          <span class="menu-title">Orders</span>
        </a>
      </li>
      @if (Auth::guard('staff')->user()->role == 1)

      <li class="nav-item">
        <a class="nav-link" href="{{ route('menu-categories.index') }}">
          <i class="mdi mdi-plus-circle-multiple-outline menu-icon"></i>
          <span class="menu-title">Menu Categories</span>
        </a>
      </li>
      
        <li class="nav-item">
          <a class="nav-link" href="{{ route('menu-items.index') }}">
            <i class="mdi mdi-pizza menu-icon"></i>
            <span class="menu-title">Menu Items</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('offers.index') }}">
            <i class="mdi mdi-tag-outline menu-icon"></i>
            <span class="menu-title">Offers</span>
          </a>
        </li>

      @endif
        <li class="nav-item logout-btn mt-4" style="bottom: 5%; position: absolute;">
          <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="btn btn-lg btn-primary" href="{{ route('logout') }}">
                <i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Logout</span>
              </button>
          </form>
        </li>
      
    </ul>
  </nav>
  <!-- partial -->