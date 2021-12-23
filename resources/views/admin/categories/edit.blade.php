@extends('admin.home')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{route ('categories.update',$category->id)}}" method="post" enctype="multipart/form-data" >
                @csrf

                @method('PUT')
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Add New Category</div>
                    <div class="tools">
                        <a href="{{route ('categories.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Category Name</label>
                            <div class="input-group col">
                                <input type="text" class="form-control" name="category_name" value="{{$category->name}}" required>
                            </div>
                        </div>





                         <div class="form-group row">
                            <label class="col-md-3 col-form-label">Parent Category Name</label>
                            <div class="input-group col">
                            <select class="form-control" name="parent_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @if($cat->id == $category->parent_id) Selected @endif>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="eventRegInput2">Category Icon</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div>
                                        <input type="file" accept=".jpg,.png,.jpeg" name="category_icon" onchange="readURL(this);" >&nbsp;&nbsp;&nbsp;
                                        <input type="text" accept=".jpg,.png,.jpeg" name="old_image" value="{{$category->category_icon}}" onchange="readURL(this);"hidden >
                                        <img id="image" >
                                    </div>
                                </div>
                            </div>
                        </div>




                        {{-- <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="form-radio col-md-9" >
                                <label class="mr-3">
                                    <input type="radio" name="status" value="1" @if($category->status ==1) checked @endif>
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> Show
                                </label>
                                <label class="mr-3">
                                    <input type="radio" name="status" value="0" @if($category->status ==2) checked @endif>
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> Hide
                                </label>
                            </div>
                        </div> --}}
                    </li>
                </ul>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">
                        <i class="ti-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
