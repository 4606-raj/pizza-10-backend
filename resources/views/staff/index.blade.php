@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex justify-content-between">
              <h4>Staff</h4>
              <a href="{{ route('staff.create') }}" class="btn btn-success">Add New</a>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    {{-- <th>Phone Number</th> --}}
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($staff as $value) 
                    <tr>
                        <td>{{ $value->name ?? '--' }}</td>
                        <td>{{ $value->email ?? '--' }}</td>
                        {{-- <td>{{ $value->phone_number ?? '--' }}</td> --}}
                        <td>{!! $value->role_badge ?? '--' !!}</td>
                        <td>
                            <a href="{{ route('staff.edit', $value->id) }}" class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                            <a href="{{ route('staff.destroy', $value->id) }}" class="btn btn-danger delete-btn"><i class="mdi mdi-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="d-flex justify-content-end mr-4">
            {{ $staff->links() }}
          </div>
        </div>
      </div>
</div>

@endsection