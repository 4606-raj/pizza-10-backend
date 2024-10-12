@extends('layouts.main')

@section('content')
    
@php
  $statuses = [1 => 'Recieved', 2 => 'Confirmed', 3 => 'Preparing', 4 => 'Prepared', 5 => 'Picked Up', 6 => 'Delivered'];
@endphp

{{-- @push('style')
  <style>
    .order-time-edit {
      cursor: pointer;
    }
  </style>
@endpush --}}

<div class="content-wrapper pb-0">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex justify-content-between">
              <h4>Orders</h4>
              {{-- <a href="{{ route('users.create') }}" class="btn btn-success">Add New</a> --}}

              <div class="col-6">
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
              <div class="col-4">
                <div class="col-12 text-right">
                  <a href="{{ route('orders.create') }}" class="btn btn-success">Create</a>
                </div>
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
                        <td class="{{ ($order->menuItems->count() > 1)? 'd-flex align-items-center': '' }}">
                          @if ($order->menuItems->count() > 1)

                          {{ $order->menuItems->first()->menuItem->name }} ({{ $order->menuItems->first()->price->base->name }})
                           + &nbsp;
                          <div class="dropdown" style="position: inherit">
                            <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="mdi mdi-eye"></i> Show
                            </button>
                            <div class="dropdown-menu" style="">
                              @foreach ($order->menuItems as $item)
                                <span class="p-4">{{ $item->menuItem->name }} ({{ $item->price->base->name }}),</span>
                                <div class="dropdown-divider"></div>
                              @endforeach
                            </div>
                          </div>
                          @else
                              {{ $order->menuItems->first()->menuItem->name ?? '--' }} ({{ $order->menuItems->first()->price->base->name ?? '--' }})
                          @endif
                        </td>
                        <td>{{ $order->total_amount }} INR</td>
                        <td>{{ $order->order_type }}</td>
                        <td>{!! $order->status_badge ?? '--' !!}</td>
                        <td>

                          <div class="d-flex">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary mr-4"><i class="mdi mdi-eye"></i></a>
                            
                            @if ($order->status == 1) 

                              {{-- <div class="col-sm-4 mr-4 d-flex order-time-text justify-content-center align-items-center">
                                <span>30 Mins</span>
                                <i class="ml-4 mdi mdi-pencil order-time-edit"></i>
                              </div>
                               --}}
                              <div class="col-sm-4 mr-4 order-time-box d-flex">
                                <input type="number" class="form-control order-time-hours" value="0" name="order_time" placeholder="Hours">
                                <input type="number" class="form-control order-time-minutes" value="30" name="order_time" placeholder="Minutes">
                              </div>
                            @endif
                            
                            @if (isset($statuses[$order->status - 1]))
                              <button class="btn btn-warning status-btn mr-4" data-status="{{ $order->status - 1 }}" data-id="{{ $order->id }}">{{ $statuses[$order->status - 1] }}</button>
                            @endif
                            @if (isset($statuses[$order->status + 1]))
                              <button class="btn btn-success status-btn" data-status="{{ $order->status + 1}}" data-id="{{ $order->id }}">{{ $statuses[$order->status + 1] }}</button>
                            @endif

                            
                            {{-- <div class="dropdown" style="position: inherit">
                              <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                              </button>
                              <div class="dropdown-menu" style="">
                                <h6 class="dropdown-header">Status</h6>
                                <li class="dropdown-item" data-status="3" data-id="{{ $order->id }}">Preparing</li>
                                <li class="dropdown-item" data-status="4" data-id="{{ $order->id }}">Prepared</li>
                                <li class="dropdown-item" data-status="5" data-id="{{ $order->id }}">Picked Up</li>
                                <div class="dropdown-divider"></div>
                                <li class="dropdown-item" data-status="6" data-id="{{ $order->id }}">Delivered</li>
                              </div>
                            </div> --}}
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
      $('.status-btn').click(function() {
        let status = $(this).data('status');
        let orderId = $(this).data('id');
        let url = `{{ route('orders.update', ':id') }}`.replace(':id', orderId);

        let orderHours = $('.order-time-hours').val();
        let orderMinutes = $('.order-time-minutes').val();
        
        order_time = null;
        
        if(orderHours !== undefined && orderMinutes !== undefined) {
          order_time = +(orderHours * 60) + +orderMinutes;
        }

        let data = {
          _token: "{{ csrf_token() }}",
          status: status,
          order_time: order_time,
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

      // $('.order-time-edit').click(function() {
      //   $('.order-time-text').hide();
      //   $('.order-time-box').show();
      // })
      
    </script>
@endpush