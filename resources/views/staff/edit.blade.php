@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Update Staff Data</h4>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            
            <form class="forms-sample" action="{{ route('staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="name" value="{{ $staff->name }}" placeholder="Name">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" name="email" value="{{ $staff->email }}" placeholder="Email">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="new-password">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Confirm Password</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                  <select class="form-control" name="role">
                    <option value="2" {{ $staff->role == 2? 'selected': '' }}>Kitchen Staff</option>
                    <option value="3" {{ $staff->role == 3? 'selected': '' }}>Delivery Staff</option>
                  </select>
                </div>
              </div>
              
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">Update</button>
                <button class="btn btn-light">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    
</div>

@endsection