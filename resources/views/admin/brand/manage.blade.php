@extends('admin.master')
@section('admin')
<script src="{{asset('backend')}}/assets/js/jquery.min.js"></script>
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Manage Brand</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage All Brand</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card">
                        <div class="card-body">
                                <table class="table table-striped table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>#sl</th>
                                        <th>Brand Slug</th>
                                        <th>Brand Name</th>
                                        <th>Brand Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $key => $brand)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $brand->brand_name }}</td>
                                                <td>{{ $brand->brand_slug }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/brand/'.$brand->brand_image) }}" alt="" style="width: 70px; height: 70px;">
                                                </td>
                                                <td>{{ $brand->brand_status }}</td>
                                                <td>
                                                    <a class="btn btn-info btn-sm" href="{{ route('brand.edit', $brand->id) }}"><i class="fas fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-sm" id="delete" href="{{ route('brand.delete', $brand->id) }}"><i class="fas fa-trash"></i></a>                                        
                                                </td>
                                            </tr>
                                        @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#sl</th>
                                        <th>Brand Slug</th>
                                        <th>Brand Name</th>
                                        <th>Brand Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
