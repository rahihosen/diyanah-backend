
@extends('admin.home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{route ('brands.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Add New Brand</div>
                    <div class="tools">
                        <a href="{{route ('brands.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Brand Name</label>
                            <div class="input-group col">
                                <input class="form-control" name="brand_title" placeholder="i.e Convenient & Quick" required>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="eventRegInput2">Brand Image</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div>
                                        <input type="file" accept=".jpg,.png,.jpeg" name="brand_image" onchange="readURL(this);" >&nbsp;&nbsp;&nbsp;
                                        <img id="image" >
                                    </div>
                                </div>
                            </div>
                        </div>


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
