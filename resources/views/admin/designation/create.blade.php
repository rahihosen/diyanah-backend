
@extends('admin.home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{route ('designations.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
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
                            <label class="col-md-3 col-form-label">Designation Title</label>
                            <div class="input-group col">
                                <input class="form-control" id="designation_title" name="designation_title" placeholder="i.e Marketing Manager" required>
                            </div>
                            <span id="category_name_result"></span>
                        </div>


                         <div class="form-group row">
                            <label class="col-md-3 col-form-label">Parent Designation</label>
                            <div class="col">
                                <select class="form-control" name="parent_id">
                                    <option value="" selected>Select Parent Designation</option>
                                    @foreach($designations as $value)
                                        <option value="{{ $value->id }}">{{ $value->designation_title }}</option>
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
