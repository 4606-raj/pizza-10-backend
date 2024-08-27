@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add Storage Box</h4>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            
            <form class="forms-sample" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="first_name" placeholder="First Name">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" name="email" placeholder="email">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="phone_number" placeholder="Phone Number">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Location</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="location" placeholder="Location">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                  <select class="form-control" name="role">
                    <option value="2">Student</option>
                    <option value="3">Parent</option>
                  </select>
                </div>
              </div>

              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    
</div>

@endsection
