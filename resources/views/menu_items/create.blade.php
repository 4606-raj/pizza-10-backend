@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add Menu Item</h4>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            
            <form class="forms-sample" action="{{ route('menu-items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="name" placeholder="Enter menu item name">
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
                  <textarea class="form-control" name="description" placeholder="Enter menu item description"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Menu Category</label>
                <div class="col-sm-9">
                  <select class="form-control categories" name="menu_category_id">
                    <option value="">Select Category</option>
                    @foreach ($menuCategories as $menuCategory)
                      <option value="{{ $menuCategory->id }}" {{ request()->menu_category_id && request()->menu_category_id == $menuCategory->id? 'selected': '' }}>{{ $menuCategory->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Menu Subcategory</label>
                <div class="col-sm-9">
                  <select class="form-control subcategories" name="menu_subcategory_id">
                    <option value="">Select Category</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Is Veg</label>
                <div class="col-sm-9">
                  <select class="form-control" name="is_veg">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-3 col-form-label">Prices (INR)</label>
                
                @foreach ($bases as $base)
                  <div class="form-group row col-2">
                    <div class="col-sm-12">
                      <input type="number" class="form-control" name="prices[{{ $base->id }}]" placeholder="{{ $base->name }}">
                    </div>
                  </div>
                @endforeach
                
              </div>

              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    

    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add Menu Item To Category</h4>

          <form class="forms-sample" action="{{ route('menu-items.category-attach') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Menu Category</label>
              <div class="col-sm-9">
                <select class="form-control categories" name="menu_category_id">
                  <option value="">Select Category</option>
                  @foreach ($menuCategories as $menuCategory)
                    <option value="{{ $menuCategory->id }}" {{ request()->menu_category_id && request()->menu_category_id == $menuCategory->id? 'selected': '' }}>{{ $menuCategory->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Menu Subcategory</label>
              <div class="col-sm-9">
                <select class="form-control subcategories" name="menu_subcategory_id">
                  <option value="">Select Category</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Menu Category</label>
              <div class="col-sm-9">
                <select class="form-control select2" name="menu_item_ids[]" multiple>
                  <option value="">Select Menu Items</option>
                  @foreach ($menuItems as $menuItem)
                    <option value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                  @endforeach
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

@push('script')
    <script>
      $('.categories').change(function() {
        let id = $(this).val();
        let subcategories = @json($menuSubcategories);

        let subcategoryId = @json(request()->menu_subcategory_id);
        
        
        let options = '<option value="">Select Category</option>';
        
        subcategories.forEach((value, index) => {
          if(value.menu_category_id == id) {
            options += `<option value=${value.id} ${subcategoryId == value.id? 'selected': ''}>${value.name}</option>`;
          }
        })

        $('.subcategories').html(options);

      })

      $('.categories').trigger('change');
    </script>
@endpush