@extends('layouts.main')

@section('content')
    
<div class="content-wrapper pb-0 row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex justify-content-between">
            <h4>Menu Item Details</h4>
            <a href="{{ route('menu-items.edit', $menuItem->id) }}" class="btn btn-primary">Edit</a>
          </div>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
              </thead>
              <tbody>
                <tr>
                  <th>Name:</th>
                  <td>{{ $menuItem->name }}</td>
                </tr>
                <tr>
                  <th>Image:</th>
                  <td><img src="{{ asset('storage/' . $menuItem->image) }}" alt="Menu Item Image" width="100"></td>
                </tr>
                <tr>
                  <th>Description:</th>
                  <td>{{ $menuItem->description }}</td>
                </tr>
                <tr>
                  <th>Menu Category:</th>
                  <td>{{ $menuItem->category->name ?? '--' }}</td>
                </tr>
                <tr>
                  <th>Is Veg:</th>
                  <td>{{ $menuItem->is_veg ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                  <th colspan="2" class="text-center">Prices (INR):</th>
                  @foreach ($menuItem->prices as $price)
                    <tr>
                      <th>{{ $price->base->name }}</th>
                      <td>{{ $price->price }}</td>
                    </tr>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection