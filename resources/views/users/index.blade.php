@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex justify-content-between">
              <h4>Users</h4>
              <a href="{{ route('users.create') }}" class="btn btn-success">Add New</a>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Location</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($users as $user) 
                    <tr>
                        <td>{{ $user->first_name ?? '--' }}</td>
                        <td>{{ $user->last_name ?? '--' }}</td>
                        <td>{{ $user->email ?? '--' }}</td>
                        <td>{{ $user->phone_number ?? '--' }}</td>
                        <td>{{ $user->role ?? '--' }}</td>
                        <td>{{ $user->location ?? '--' }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                            <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger delete-btn"><i class="mdi mdi-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="d-flex justify-content-end mr-4">
            {{ $users->links() }}
          </div>
        </div>
      </div>
</div>

@endsection