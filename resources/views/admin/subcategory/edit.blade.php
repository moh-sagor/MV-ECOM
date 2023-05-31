@extends('admin.master')
@section('admin')
<script src="{{asset('backend')}}/assets/js/jquery.min.js"></script>
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">SubCategory</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update SubCategory</li>
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
                            <form class="form" action="{{ route('subcategory.update', ['id' => $subcategory->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Category Name</h6>
                                    </div>
                                    <div class="col-sm-9 msg text-secondary">
                                        <select name="category_id" id="" class="form-control">
                                            <option value="">----Select Category----</option>
                                            
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    
                                </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">SubCategory Name</h6>
                                </div>
                                <div class="col-sm-9 msg text-secondary">
                                    <input type="text" name="subcategory_name" id="subcategory_name" class="form-control" value="{{$subcategory->subcategory_name}}"  />
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">SubCategory Logo</h6>
                                </div>
                                <div class="col-sm-9 msg text-secondary">
                                    <input type="file" name="subcategory_image" class="form-control subcategory_image" />
                                    <img id="imagepre" class="mt-2" src="{{ !empty(asset('uploads/subcategory/'.$subcategory->subcategory_image)) ? asset('uploads/subcategory/'.$subcategory->subcategory_image) : asset('uploads/empty.png')  }}" alt="" height="120" width="120" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Update SubCategory" />
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- image preview  --}}
<script>
    'use strict'
    jQuery(document).ready(function(){
        jQuery('.subcategory_image').change(function(e){
            var filereader = new FileReader();
            filereader.onload = function(e) {
                jQuery('#imagepre').attr('src', e.target.result);
            }
            filereader.readAsDataURL(e.target.files['0']);
        })
    })
</script>

{{-- Validation  --}}

<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.form').validate({
        rules: {
            subcategory_name: {
                required: true,
            },
            category_id: {
                required: true,
            },
        },
        messages: {
            subcategory_name: {
                required: "Please enter subcategory name",
        },
        subcategory_image: {
                required: "Please select subcategory image",
        },
        category_id: {
                required: "Please select category ID",
        },
            
    },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.msg').append(error);
        },
        highlight:function(element,errorClass,validClass){
            jQuery('.is-invalid').removeClass('is-invalid');
            jQuery(element).addClass('is-invalid');
        },
        unhighlight:function(element,errorClass,validClass){
            jQuery('.is-invalid').removeClass('is-invalid');
            jQuery(element).addClass('is-valid');
        }
    });
});

</script>


@endsection
