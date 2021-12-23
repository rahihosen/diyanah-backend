@extends('admin.home')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{ route('promotions.update', $promotion->id)}}" method="post" enctype="multipart/form-data" >
                @csrf

                @method('PUT')
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Add New Promotion</div>
                    <div class="tools">
                        <a href="{{route ('promotions.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">

                         <div class="form-group row">
                            <label class="col-md-3 col-form-label">Category Name</label>
                            <div class="input-group col">
                            <select class="form-control" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @if($cat->id == $promotion->category_id) Selected @endif>{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="eventRegInput2">Promotion Image</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <img src="/promotion/{{$promotion->promotion_image}}" style="height: 80px; width:100px;"><br>
                                    <div>
                                        <input type="hidden" name="old_one" value="{{ $promotion->promotion_image }}">
                                        <input type="file" accept=".jpg,.png,.jpeg" name="promotion_image" onchange="readURL(this);" >&nbsp;&nbsp;&nbsp;
                                        <img id="image" >
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="form-radio col-md-9" >
                                <label class="mr-3">
                                    <input type="radio" name="status" value="1" @if($promotion->status ==1) checked @endif>
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> Show
                                </label>
                                <label class="mr-3">
                                    <input type="radio" name="status" value="0" @if($promotion->status ==0) checked @endif>
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> Hide
                                </label>
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
