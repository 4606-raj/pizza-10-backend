@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex justify-content-between">
              <h4>Menu Items</h4>
              <a href="{{ route('menu-items.create') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Menu Category</th>
                    <th>Is Veg</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($menuItems as $menu_item) 
                    <tr>
                        <td>{{ $menu_item->name }}</td>
                        <td>
                          <img src="{{ $menu_item->image }}" alt="Menu Item Image" class="img-thumbnail">
                        </td>
                        <td>{{ $menu_item->description }}</td>
                        <td>{{ $menu_item->category->name ?? '--' }}</td>
                        <td>{{ $menu_item->is_veg ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('menu-items.show', $menu_item->id) }}" class="btn btn-success"><i class="mdi mdi-eye"></i></a>
                            <a href="{{ route('menu-items.edit', $menu_item->id) }}" class="btn btn-warning"><i class="mdi mdi-pencil"></i></a>
                            <a href="{{ route('menu-items.destroy', $menu_item->id) }}" class="btn btn-danger delete-btn"><i class="mdi mdi-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="d-flex justify-content-end mr-4">
            {{ $menuItems->links() }}
          </div>
        </div>
      </div>
</div>

@endsection

@push('style')
    <style>
      .img-thumbnail {
        width: 50px !important;
        height: 50px !important;
      }
    </style>
@endpush