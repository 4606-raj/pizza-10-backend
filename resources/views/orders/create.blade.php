@extends('layouts.main')

@section('content')
    
<div class="content-wrapper row pb-0">

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add Order</h4>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            
            <form class="forms-sample" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="menu-items">
                    {{-- <div class="row">
                        <div class="col-sm-9"> --}}
                        <livewire:inputs.menu-item />
                        {{-- </div> --}}
                        {{-- <div class="col-sm-3">
                            <button type="button" class="btn btn-success addMore">Add More</button>
                        </div>
                    </div> --}}
                </div>
              
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">Create</button>
                <button class="btn btn-light">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Order Details</h4>

            <div>
                <livewire:show-value />
            </div>
            
          </div>
        </div>
      </div>
    
</div>

@endsection

@push('script')
    <script>
        $('.addMore').click(function() {
            let data = `<div class="row new-menu-item">
                            <div class="col-sm-9">
                                <livewire:inputs.menu-item />
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-danger remove">Remove</button>
                            </div>
                        </div>`;

            $('.menu-items').append(data)
        })

        $('body').on('click', '.remove', function() {
            $(this).closest('.new-menu-item').remove()
        })
    </script>
@endpush