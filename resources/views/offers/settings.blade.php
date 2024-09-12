@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Apply Offer On Menu Items</h4>
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
      
            <form class="forms-sample" action="{{ route('offers.settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="offer_id" value="{{ $offer->id }}">
              <div class="row">
                <div class="form-group col-4 d-flex align-items-center m-0">
                  <label class="col-sm-3 col-form-label">Menu Item</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="menu_item[0][id]">
                      <option value="" selected disabled>Select Menu Items</option>
                      @foreach ($menuItems ?? [] as $menuItem)
                        <option value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group col-4 d-flex align-items-center m-0">
                  <label class="col-sm-3 col-form-label">Base</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="menu_item[0][base_ids][]" multiple>
                      <option value="" disabled>Select Menu Bases</option>
                      @foreach ($bases ?? [] as $base)
                        <option value="{{ $base->id }}">{{ $base->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group col-4 d-flex align-items-center m-0">
                    <button type="button" class="btn btn-primary add-more-btn">+ Add More</button>
                </div>
                <div class="new-fields">
                </div>
      
              </div>
      
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">Create</button>
                <a href="{{ route('offers.index') }}" class="btn btn-light">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Apply Offer On All Menu Items Of Base</h4>
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
      
            <form class="forms-sample" action="{{ route('offers.settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="offer_id" value="{{ $offer->id }}">
              <div class="form-group col-12 d-flex align-items-center">
                <label class="col-sm-3 col-form-label">Base</label>
                <div class="col-sm-9">
                  <select class="form-control select2" name="base_ids[]" multiple>
                    <option value="" disabled>Select Bases</option>
                    @foreach ($bases ?? [] as $base)
                      <option value="{{ $base->id }}">{{ $base->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
      
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">Create</button>
                <a href="{{ route('offers.index') }}" class="btn btn-light">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="card-title">List Of Offer's Menu Items</h4>
              <a href="{{ route('offers.settings.remove-all-menu-items', $offer->id) }}" class="btn btn-danger remove-btn" style="margin-bottom: 0.75rem">Delete All</a>
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
                    <th>Base</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>

                  @if (!$offerMenuItems->count())
                      <tr>
                        <td colspan="7" class="text-center"><h4>No Data Found</h4></td>
                      </tr>
                  @endif
                  @foreach ($offerMenuItems as $menuItem)

                    @php
                        $base = $bases->filter(function($base) use ($menuItem) {return $base['id'] == $menuItem->pivot->base_id; })->first()
                    @endphp
                  
                    <tr>
                        <td>{{ $menuItem->name }}</td>
                        <td>
                          <img src="{{ $menuItem->image }}" alt="Menu Item Image" class="img-thumbnail">
                        </td>
                        <td>{{ $menuItem->description }}</td>
                        <td>{{ $menuItem->category->name ?? '--' }}</td>
                        <td>{{ $menuItem->is_veg ? 'Yes' : 'No' }}</td>
                        <td>{{ $base->name }}</td>
                        <td>
                            <a href="{{ route('offers.settings.remove-menu-items', [$offer->id, $menuItem->id, $base->id]) }}" class="btn btn-danger remove-btn"><i class="mdi mdi-trash-can"></i></a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="d-flex justify-content-end mr-4">
            {{ $offerMenuItems->links() }}
          </div>
          
        </div>
      </div>
      
    </div>
    
</div>

@endsection

@push('script')
    <script>

      var index = 1;
      
      $('.add-more-btn').click(function() {
        let html = `<div class="row">
                <div class="form-group col-4 d-flex align-items-center">
                  <label class="col-sm-3 col-form-label">Menu Item</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="menu_item[${index}][id]">
                      <option value="" selected disabled>Select Menu Items</option>
                      @foreach ($menuItems ?? [] as $menuItem)
                        <option value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group col-4 d-flex align-items-center">
                  <label class="col-sm-3 col-form-label">Base</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="menu_item[${index}][base_ids][]" multiple>
                      <option value="" disabled>Select Menu Items</option>
                      @foreach ($bases ?? [] as $base)
                        <option value="{{ $base->id }}">{{ $base->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group col-4 d-flex align-items-center">
                    <button type="button" class="btn btn-danger remove-btn">Remove</button>
                </div>
              </div>`;
                
                $('.new-fields').append(html);
                
        $('.select2').select2();
      })

      $('body').on('click', '.remove-btn', function() {
        $(this).closest('.row').remove();
      })
      
    </script>
@endpush