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
            
            <form class="forms-sample" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Name">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="email">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="phone_number" value="{{ $user->phone_number }}" placeholder="Phone Number">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Gender</label>
                <div class="col-sm-9">
                  <select class="form-control" name="gender">
                    <option value="male" {{ $user->gender == 'male'? 'selected': '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female'? 'selected': '' }}>Female</option>
                    <option value="other" {{ $user->gender == 'other'? 'selected': '' }}>Other</option>
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
