@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit Menu Item</h4>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            
            <form class="forms-sample" action="{{ route('menu-items.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="name" value="{{ $menuItem->name }}" placeholder="Enter menu item name">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" name="image">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                  <textarea class="form-control" name="description" placeholder="Enter menu item description">{{ $menuItem->description }}</textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Menu Category</label>
                <div class="col-sm-9">
                  <select class="form-control categories" name="menu_category_id">
                    @foreach ($menuCategories as $menuCategory)
                      <option value="{{ $menuCategory->id }}" {{ $menuItem->category->id == $menuCategory->id? 'selected': '' }}>{{ $menuCategory->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Menu Subcategory</label>
                <div class="col-sm-9">
                  <select class="form-control subcategories" name="menu_subcategory_id">
                    @if ($menuItem->subcategory)
                      <option value="{{ $menuItem->subcategory->id }}" selected>{{ $menuItem->subcategory->name }}</option>
                    @endif
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Is Veg</label>
                <div class="col-sm-9">
                  <select class="form-control" name="is_veg">
                    <option value="1" {{ $menuItem->is_veg == 1? 'selected': '' }}>Yes</option>
                    <option value="0" {{ $menuItem->is_veg == 0? 'selected': '' }}>No</option>
                  </select>
                </div>
              </div>

              {{-- {{ dd($menuItem->prices->where('base_id', 1)) }} --}}
              
              <div class="row">
                <label class="col-sm-3 col-form-label">Prices (INR)</label>
                
                @foreach ($bases as $base)
                  <div class="form-group row col-2">
                    <div class="col-sm-12">
                      <input type="number" class="form-control" name="prices[{{ $base->id }}]" value="{{ $menuItem->prices->where('base_id', $base->id)->first()->price }}" placeholder="{{ $base->name }}">
                    </div>
                  </div>
                @endforeach
                
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

@push('script')
    <script>
      $('.categories').change(function() {
        let id = $(this).val();
        let subcategories = @json($menuSubcategories);
        let subcategorId = @json($menuItem->subcategory->id ?? 0);

        let options = '<option value="">Select Category</option>';
        
        subcategories.forEach((value, index) => {
          if(value.menu_category_id == id) {
            options += `<option value=${value.id} ${subcategorId == value.id? 'selected': ''}>${value.name}</option>`;
          }
        })

        $('.subcategories').html(options);

      })

      $('.categories').trigger('change');
    </script>
@endpush