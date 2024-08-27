@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex justify-content-between">
              <h4>Orders</h4>
              {{-- <a href="{{ route('users.create') }}" class="btn btn-success">Add New</a> --}}
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
                              {{ $item->menuItem->name }},
                          @endforeach
                        </td>
                        <td>{{ $order->total_amount }} INR</td>
                        <td>{{ $order->order_type }}</td>
                        <td>{!! $order->status_badge ?? '--' !!}</td>
                        <td>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary"><i class="mdi mdi-dots-vertical"></i></a>
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