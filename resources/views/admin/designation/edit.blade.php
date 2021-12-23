@extends('admin.home')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{route ('designations.update',$designation->id)}}" method="post" enctype="multipart/form-data" >
                @csrf

                @method('PUT')
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Add New Designation</div>
                    <div class="tools">
                        <a href="{{route ('designations.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Designaion Title</label>
                            <div class="input-group col">
                                <input type="text" class="form-control" name="designation_title" value="{{$designation->designation_title}}" required>
                            </div>
                        </div>





                         <div class="form-group row">
                            <label class="col-md-3 col-form-label">Parent Designation</label>
                            <div class="input-group col">
                            <select class="form-control" name="parent_id">
                                <option value="">Select Parent Designation</option>
                                @foreach($designations as $row)
                                <option value="{{ $row->id }}" @if($row->id == $designation->parent_id) Selected @endif>{{ $row->designation_title }}</option>
                                @endforeach
                            </select>
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
