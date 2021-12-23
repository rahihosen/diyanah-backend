@extends('admin.home')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{ route('slides.update', $slide->id)}}" method="post" enctype="multipart/form-data" >
                @csrf

                @method('PUT')
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Edit Slide</div>
                    <div class="tools">
                        <a href="{{route ('slides.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">



                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="eventRegInput2">Slide Image</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <img src="/slide/{{$slide->slide_image}}" style="height: 80px; width:100px;"><br>
                                    <div>
                                        <input type="hidden" name="old_one" value="{{ $slide->slide_image }}">
                                        <input type="file" accept=".jpg,.png,.jpeg" name="slide_image" onchange="readURL(this);" >&nbsp;&nbsp;&nbsp;
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
