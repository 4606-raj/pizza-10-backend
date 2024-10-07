@extends('layouts.main')

@section('content')
    
@php
  $statuses = [1 => 'Recieved', 2 => 'Confirmed', 3 => 'Preparing', 4 => 'Prepared', 5 => 'Picked Up', 6 => 'Delivered'];
@endphp

<div class="content-wrapper pb-0 row">
    <div class="col-lg-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex justify-content-between">
            <h4>Order Details</h4>

            @if (isset($statuses[$order->status - 1]))
              <button class="btn btn-warning status-btn" data-status="{{ $order->status - 1 }}" data-id="{{ $order->id }}">{{ $statuses[$order->status - 1] }}</button>
            @endif
            @if (isset($statuses[$order->status + 1]))
              <button class="btn btn-success status-btn" data-status="{{ $order->status + 1}}" data-id="{{ $order->id }}">{{ $statuses[$order->status + 1] }}</button>
            @endif
            
            {{-- <div class="dropdown" style="position: inherit">
              <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-pencil"></i>
                Change Status
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
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Menu Items</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($order->menuItems as $item)
                    <tr>
                      <td>{{ $item->menuItem->name }}</td>
                      <td>{{ $item->menuItem->description }}</td>
                    </tr>
                @endforeach
              </tbody>
              <tfoot style="bottom: 0 !important;position: absolute;">
                <td>Total Amount: <b>{{ $order->total_amount }} INR</b></td>
                <td>Order Type: <b>{{ $order->order_type }}</b></td>
                <td>Status: {!! $order->status_badge ?? '--' !!}</td>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex justify-content-between">
            <h4>Customer Details</h4>
            
          </div>
          <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                  <th>Customer Name</th>
                  <td>{{ $order->user->name ?? '--' }}</td>
                </tr>
                <tr>  
                  <th>Phone Number</th>
                  <td>{{ $order->user->phone_number ?? '--' }}</td>
                </tr>

                <tr>  
                  <th>Customer Address</th>
                  <td style="line-height: normal;">
                    <address>
                      {{ $order->address->house_no ?? '--' }},
                      {{ $order->address->steet_landmark ?? '--' }},
                      {{ $order->address->sector_village ?? '--' }},<br>
                      {{ $order->address->city ?? '--' }},
                      {{ $order->address->state ?? '--' }},<br>
                      {{ $order->address->details ?? '--' }}
                    </address>
                  </td>
                </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

@push('script')
    <script>
      $('.status-btn').click(function() {
        let status = $(this).data('status');
        let orderId = $(this).data('id');
        let url = `{{ route('orders.update', ':id') }}`.replace(':id', orderId);

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