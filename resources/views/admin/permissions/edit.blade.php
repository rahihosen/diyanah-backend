
@extends('admin.home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{ route('permissions.update', $permission->id)}}" method="post"  enctype="multipart/form-data" >
            @csrf
            @method('put')
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Edit Roles</div>
                    <div class="tools">
                        <a href="{{route ('permissions.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Permission Name</label>
                            <div class="input-group col">
                                <input class="form-control" id="permission_name" value="{{$permission->name}}" name="name" placeholder="product.create"  required>
                            </div>
                            <span id="category_name_result"></span>
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

