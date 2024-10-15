@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex justify-content-between">
              <h4>Menu Subcategories</h4>
              <a href="{{ route('menu-subcategories.create', $categoryId) }}" class="btn btn-success">Add New</a>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($data as $value) 
                    <tr>
                        <td>{{ $value->name ?? '--' }}</td>
                        <td>
                            <a href="{{ route('menu-items.create', ['menu_category_id' => $categoryId, 'menu_subcategory_id' => $value->id]) }}" class="btn btn-info"><i class="mdi mdi-plus"></i></a>
                            <a href="{{ route('menu-subcategories.edit', $value->id) }}" class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                            <a href="{{ route('menu-subcategories.destroy', $value->id) }}" class="btn btn-danger delete-btn"><i class="mdi mdi-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="d-flex justify-content-end mr-4">
            {{ $data->links() }}
          </div>
        </div>
      </div>
</div>

@endsection