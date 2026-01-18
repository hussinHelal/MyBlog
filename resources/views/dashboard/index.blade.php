@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12 ">
            <h1 class="d-block border-bottom border-black">Blog DashBoard</h1>
        </div>
        <br>
        <div class="col d-flex m-3">
            <div class="row">
            <div class="card m-1" style="width:18rem; border-radius: 22px;">
               <i class="fas fa-newspaper m-2 card-top"></i>
              <div class="card-body">
                <h5 class="card-title"> <i class="fas fa-newspaper me-2"></i> Posts </h5>
                <h6 class="card-subtitle mb-2 text-muted ">Posts count</h6>
                <p class="card-text"> {{ $postCount ?? 0 }} </p>
              </div>
            </div>

            <div class="card m-1" style="width:18rem; border-radius: 22px;">
             <i class="fas fa-clipboard m-2 card-top"></i>
              <div class="card-body">
                <h5 class="card-title"> <i class="fas fa-clipboard me-2"></i> Notes</h5>
                <h6 class="card-subtitle mb-2 text-muted ">Notes Count</h6>
                <p class="card-text"> {{ $noteCount ?? 0 }} </p>
              </div>
            </div>

            <div class="card m-1" style="width:18rem; border-radius: 22px;">
             <i class="fas fa-comments m-2 card-top"></i>
              <div class="card-body">
                <h5 class="card-title"> <i class="fas fa-comments me-2"></i> Comments</h5>
                <h6 class="card-subtitle mb-2 text-muted ">Comments Count</h6>
                <p class="card-text">{{ $commentCount ?? 0 }}</p>
              </div>
            </div>

            <div class="card m-1" style="width:18rem; border-radius: 22px;">
             <i class="fas fa-comments m-2 card-top"></i>
              <div class="card-body">
                <h5 class="card-title"> <i class="fas fa-comments me-2"></i> Users</h5>
                <h6 class="card-subtitle mb-2 text-muted ">Users Count</h6>
                <p class="card-text">{{ $userCount ?? 0 }}</p>
              </div>
            </div>
     </div>
    </div>
  </div>
</div>
@endsection


