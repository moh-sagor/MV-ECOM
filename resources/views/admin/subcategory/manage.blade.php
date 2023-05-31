@extends('admin.master')
@section('admin')
<script src="{{asset('backend')}}/assets/js/jquery.min.js"></script>
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Manage SubCategory</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage All SubCategory</li>
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
                                        <th>Category Name</th>
                                        <th>SubCategory Name</th>
                                        <th>SubCategory Slug</th>
                                        <th>SubCategory Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($subcategories)>0)
                                    @foreach ($subcategories as $key => $subcategory)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $subcategory->cat->category_name }}</td>
                                
                                <td>{{ $subcategory->subcategory_name }}</td>
                                
                                <td>{{ $subcategory->subcategory_slug }}</td>
                                <td>
                                    <img src="{{ asset('uploads/subcategory/'.$subcategory->subcategory_image) }}" alt="" style="width: 70px; height: 70px;">
                                </td>
                                <td>{{ $subcategory->brand_status }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('subcategory.edit', $subcategory->id) }}"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" id="delete" href="{{ route('subcategory.delete', $subcategory->id) }}"><i class="fas fa-trash"></i></a>                                        
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center text-warning">
                                Data Not Found 
                            </td>
                        </tr>
                        @endif

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#sl</th>
                                        <th>Category Name</th>
                                        <th>SubCategory Name</th>
                                        <th>SubCategory Slug</th>
                                        <th>SubCategory Image</th>
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
