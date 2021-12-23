
@extends('admin.home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{ route('roles.update', $role->id)}}" method="post"  enctype="multipart/form-data" >
            @csrf
            @method('put')
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Edit Roles</div>
                    <div class="tools">
                        <a href="{{route ('roles.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Roles Name</label>
                            <div class="input-group col">
                                <input class="form-control" id="permission_name" value="{{$role->name}}" name="name" placeholder="product.create"  required>
                            </div>
                            <span id="category_name_result"></span>
                        </div>


                         

                      
                    </li>
                </ul>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label"><span style="color: red;">*</span> Permissions</label>
                    <div class="col">
                        @foreach ($permission as $item)
                        {{-- <input class="" type="checkbox" id="vehicle1" name="permission" value="Bike">
                        <label class="col-form-label" for="vehicle1">{{$item->name}}</label><br> --}}


                        <input class="border-checkbox" type="checkbox" name="permission[]" id="{{$item->name}}" value="{{$item->name}}"
                                                    {{!empty($role) && in_array($item->id, $role->permissions->pluck('id')->toArray()) ? "checked" : null}}/>
                                                <label class="border-checkbox-label" for="{{$item->name}}">{{$item->name}}</label><br/>
                        @endforeach
                        
                        
                    </div>
                </div>

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

