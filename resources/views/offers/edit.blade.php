@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add Offer</h4>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            
            <form class="forms-sample" action="{{ route('offers.update', $offer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="row">
                <div class="form-group col-6 d-flex align-items-center">
                  <label class="col-sm-3 col-form-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="title" value="{{ $offer->title }}" placeholder="Title">
                  </div>
                </div>

                <div class="form-group col-6 d-flex align-items-center">
                  <label class="col-sm-3 col-form-label">Code</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="code" value="{{ $offer->code }}" placeholder="Code">
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="form-group col-6 d-flex align-items-center">
                  <label class="col-sm-3 col-form-label">Description</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="description" value="{{ $offer->description }}" placeholder="Description">
                  </div>
                </div>
                <div class="form-group col-6 d-flex align-items-center">
                  <label class="col-sm-3 col-form-label">Type</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="offer_category_id">
                      <option value="" selected disabled>Select Offer Category</option>
                      @foreach ($offerCategories as $offerCategory)
                        <option value="{{ $offerCategory->id }}" {{ $offer->offerCategory->id == $offerCategory->id? 'selected': '' }}>{{ $offerCategory->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group col-6 d-flex align-items-center">
                  <label class="col-sm-3 col-form-label">Offer Value</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" name="offer_value" value="{{ $offer->offer_value }}" placeholder="Offer Value">
                  </div>
                </div>
                
              </div>

              <hr>

              <fieldset>
                <h6>Offer Condiction Details:</h6>

                <div class="row d-flex">
                  <div class="form-group col-6 d-flex align-items-center">
                    <label class="col-sm-3 col-form-label">Type</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="offer_type_id">
                        <option value="" selected disabled>Select Offer Type</option>
                        @foreach ($offerTypes as $offerType)
                          <option value="{{ $offerType->id }}" {{ $offer->offerType->id == $offerType->id? 'selected': '' }}>{{ $offerType->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-6 d-flex align-items-center">
                    <label class="col-sm-3 col-form-label">Condition Type</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="condition_type">
                        <option value="" selected disabled>Select Offer Condition Type</option>
                        @foreach (config('constants.offer_condition_types') as $key => $value)
                          <option value="{{ $value }}" {{ $offer->condition_type == $value? 'selected': '' }}>{{ $value }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-6 d-flex align-items-center">
                    <label class="col-sm-3 col-form-label">Condition</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="condition">
                        <option value="" selected disabled>Select Condition</option>
                        @foreach (config('constants.offer_conditions') as $key => $value)
                          <option value="{{ $value }}" {{ $offer->condition == $value? 'selected': '' }}>{{ $value }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-6 d-flex align-items-center">
                    <label class="col-sm-3 col-form-label">Condition Value</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="condition_value" value="{{ $offer->condition_value }}" placeholder="Condition Value">
                    </div>
                  </div>
                </div>
                <hr>
              </fieldset>
              
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