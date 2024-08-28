@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex justify-content-between">
              <h4>Orders</h4>
              {{-- <a href="{{ route('users.create') }}" class="btn btn-success">Add New</a> --}}

              <div class="col-8">
                <form class="form-inline d-flex justify-content-between" action="{{ route('orders.index') }}" method="GET">

                  <div class="col-3">
                    <select class="form-control" name="status">
                      <option value="" selected disabled>Status</option>
                      <option value="2" {{ request()->status == 2? 'selected': '' }}>New</option>
                      <option value="3" {{ request()->status == 3? 'selected': '' }}>Preparing</option>
                      <option value="4" {{ request()->status == 4? 'selected': '' }}>Prepared</option>
                      <option value="5" {{ request()->status == 5? 'selected': '' }}>Picked Up</option>
                      <option value="6" {{ request()->status == 6? 'selected': '' }}>Delivered</option>
                    </select>
                  </div>

                  <div class="col-3">
                    <select class="form-control" name="type">
                      <option value="" selected disabled>Type</option>
                      <option value="delivery" {{ request()->type == 'delivery'? 'selected': '' }}>Delivery</option>
                      <option value="pickup" {{ request()->type == 'pickup'? 'selected': '' }}>Pick Up</option>
                      <option value="dine_in" {{ request()->type == 'dine_in'? 'selected': '' }}>Dine In</option>
                      <option value="in_car" {{ request()->type == 'in_car'? 'selected': '' }}>In Car</option>
                    </select>
                  </div>

                  <div class="col-4 text-center">
                    <input type="submit" class="btn btn-primary" value="Filter">
                    <a href="{{ route('orders.index') }}" class="btn btn-primary">Reset</a>
                  </div>
                  
                </form>
              </div>
              
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Customer Name</th>
                    <th>Menu Items</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order) 
                    <tr>
                        <td>{{ $order->user->name ?? '--' }}</td>
                        <td>
                          @foreach ($order->menuItems as $item)
                              {{ $item->menuItem->name }} ({{ $item->price->base->name }}),
                          @endforeach
                        </td>
                        <td>{{ $order->total_amount }} INR</td>
                        <td>{{ $order->order_type }}</td>
                        <td>{!! $order->status_badge ?? '--' !!}</td>
                        <td>
                          <div class="dropdown" style="position: inherit">
                            <button type="button" class="btn btn-primary" id="dropdownMenuIconButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton3" style="">
                              <h6 class="dropdown-header">Status</h6>
                              <li class="dropdown-item" data-status="3" data-id="{{ $order->id }}">Preparing</li>
                              <li class="dropdown-item" data-status="4" data-id="{{ $order->id }}">Prepared</li>
                              <li class="dropdown-item" data-status="5" data-id="{{ $order->id }}">Picked Up</li>
                              <div class="dropdown-divider"></div>
                              <li class="dropdown-item" data-status="6" data-id="{{ $order->id }}">Delivered</li>
                            </div>
                          </div>
                          
                            {{-- <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary"><i class="mdi mdi-dots-vertical"></i></a> --}}
                            {{-- <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger delete-btn"><i class="mdi mdi-trash-can"></i></a> --}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="d-flex justify-content-end mr-4">
            {{ $orders->links() }}
          </div>
        </div>
      </div>

      {{-- <x-modal title="Order" body="test" id="ordered-items-modal" /> --}}
</div>

@endsection

@push('script')
    <script>
      $('.dropdown-item').click(function() {
        let status = $(this).data('status');
        let orderId = $(this).data('id');
        let url = `{{ route('orders.update', ${orderId}) }}`;

        let data = {
          _token: "{{ csrf_token() }}",
          status: status,
        }

        $.ajax({
          url,
          method: "PATCH",
          data,
          success: function(response) {
            if(response.status)
              location.reload()
          }
        })
      })
    </script>
@endpush