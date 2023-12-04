@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y category_view">
    <!-- Role cards -->
    <div class="row g-4">
        <div class="col-xl-8 col-lg-8 col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class=" d-flex align-items-center flex-column">
                            <img class="img-fluid rounded my-4" src="{{asset('uploads/category/'.$category->image)}}" height="110" width="110" alt="User avatar">
                            <div class="user-info text-center">
                            <h5 class="mb-2">{{$category->name}}</h5>
                            
                            </div>
                        </div>
                    </div>

                    <h5 class="pb-2 border-bottom mb-4">Details</h5>
                    <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                        <span class="fw-bold me-2">Category Name:</span>
                        <span>{{$category->name}}</span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">Category Description:</span>
                        <span> {{$category->description}}</span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">Status:</span>
                        @if($category->status==1)
                        <span class="badge bg-label-success">Active</span>
                        @else
                        <span class="badge bg-label-danger">InActive</span>
                        @endif
                        </li>

                    </ul>
                  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Role cards -->

</div>

<!-- Edit User Modal -->

<!--/ Edit User Modal -->
<!-- / Content -->
@endsection
