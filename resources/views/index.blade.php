@extends('layouts.main')

@section('content')  
      
  <div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
      <h3 class="mb-0">Hi, Welcome Admin! <span class="ps-0 h6 ps-sm-2 text-muted d-inline-block">to the Boxed Dashboard</span>
      </h3>

      
    </div>

    <div class="row">

      <div class="col-xl-3 col-md-3 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
        <div class="card bg-primary">
          <div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
              <div class="color-card">
                <p class="mb-0 color-card-head">Total Reservations</p>
                <h2 class="text-white">{{ $data['reservations'] }}</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-xl-3 col-md-3 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
        <div class="card bg-warning">
          <div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
              <div class="color-card">
                <p class="mb-0 color-card-head">Total Storage Boxes</p>
                <h2 class="text-white">{{ $data['storage_boxes'] }}</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-3 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
        <div class="card bg-info">
          <div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
              <div class="color-card">
                <p class="mb-0 color-card-head">Total Package Wrappers</p>
                <h2 class="text-white">{{ $data['package_wrappers'] }}</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
    
@endsection