@extends('layouts.guest')

@section('content')
    
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
      <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left p-5">
            <div class="brand-logo">
              <img src="../../../assets/images/logo.png">
            </div>
            <h4>Hello! let's get started</h4>
            <h6 class="font-weight-light">Sign in to continue.</h6>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            
            <form class="pt-3" action="{{ route('login') }}" method="POST">
              @csrf
              <div class="form-group">
                <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password">
              </div>
              <div class="mt-3 d-grid gap-2">
                <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</a>
              </div>
              <div class="my-2 d-flex justify-content-between align-items-center">
                {{-- <div class="form-check">
                  <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                </div> --}}
                <a href="#" class="auth-link text-black">Forgot password?</a>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
@endsection

@push('style')
  <style>
    .brand-logo {
      /* background: black; */
      padding: 5%;
      text-align: center;
    }
  </style>
@endpush