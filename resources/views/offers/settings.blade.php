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