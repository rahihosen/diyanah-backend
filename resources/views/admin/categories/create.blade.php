
@extends('admin.home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{route ('categories.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
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
                                <input class="form-control" id="category_name" name="name" placeholder="i.e iPhone"  required>
                            </div>
                            <span id="category_name_result"></span>
                        </div>


                         <div class="form-group row">
                            <label class="col-md-3 col-form-label">Parent Category</label>
                            <div class="col">
                                <select class="form-control" name="parent_id">
                                    <option value="" selected>Select Parent Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <img id="image" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="form-radio col-md-9" >
                                <label class="mr-3">
                                    <input type="radio" required name="status" value="1">
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> Show
                                </label>
                                <label class="mr-3">
                                    <input type="radio" required name="status" value="0">
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

