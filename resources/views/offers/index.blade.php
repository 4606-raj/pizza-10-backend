@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex justify-content-between">
              <h4>Offers</h4>
              <a href="{{ route('offers.create') }}" class="btn btn-success">Add New</a>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Offer</th>
                    <th>Type</th>
                    <th>Condition Type</th>
                    <th>Condition</th>
                    <th>Condition Value</th>
                    <th>Code</th>
                    <th>Upto</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($offers as $value) 
                    <tr>
                      <td>{{ $value->title ?? '--' }}</td>
                      <td>{{ $value->offer_value ?? '--' }}</td>
                      <td>{{ $value->offerType->name ?? '--' }}</td>
                      <td>{{ $value->condition_type ?? '--' }}</td>
                      <td>{{ $value->condition ?? '--' }}</td>
                      <td>{{ $value->condition_value ?? '--' }}</td>
                      <td>{{ $value->code ?? '--' }}</td>
                      <td>{{ $value->upto ?? '--' }}</td>
                      <td><img src="{{ $value->image }}" alt="" class="img-thumbnail"></td>
                        <td>
                            <a href="{{ route('offers.edit', $value->id) }}" class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                            <a href="{{ route('offers.settings.create', $value->id) }}" class="btn btn-primary"><i class="mdi mdi-settings"></i></a>
                            {{-- <a href="{{ route('offers.destroy', $value->id) }}" class="btn btn-danger delete-btn"><i class="mdi mdi-trash-can"></i></a> --}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="d-flex justify-content-end mr-4">
            {{ $offers->links() }}
          </div>
        </div>
      </div>
</div>

@endsection