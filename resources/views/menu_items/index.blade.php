@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title col-12 d-flex justify-content-between">
              <div class="col-2">
                <h4>Menu Items</h4>
              </div>
              <div class="col-8">
                <form class="form-inline d-flex justify-content-between" action="{{ route('menu-items.index') }}" method="GET">

                  <div class="col-3">
                    <select class="form-control" name="menu_category_id">
                      <option value="" selected disabled>Category</option>
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request()->menu_category_id == $category->id? 'selected': '' }}>{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-3">
                    <select class="form-control" name="is_veg">
                      <option value="" selected disabled>Veg/Non-Veg</option>
                      <option value="1" {{ request()->is_veg == '1'? 'selected': '' }}>Veg</option>
                      <option value="0" {{ request()->is_veg == '0'? 'selected': '' }}>Non-Veg</option>
                    </select>
                  </div>

                  <div class="col-4 text-center">
                    <input type="submit" class="btn btn-primary" value="Filter">
                    <a href="{{ route('menu-items.index') }}" class="btn btn-primary">Reset</a>
                  </div>
                  
                </form>
              </div>

              <div class="col-2 text-right">
                <a href="{{ route('menu-items.create') }}" class="btn btn-primary">Add New</a>  
              </div>
              
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