@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit Menu Subcategory</h4>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            
            <form class="forms-sample" action="{{ route('menu-subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Category</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="menu_category_id">
                      <option value="">Select Category</option>
                      @foreach ($categories as $item)
                          <option value="{{ $item->id }}" {{ $item->id == $subcategory->menu_category_id? 'selected': '' }}>{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $subcategory->name }}">
                </div>
              </div>
              
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">Create</button>
                <button class="btn btn-light">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    
</div>

@endsection