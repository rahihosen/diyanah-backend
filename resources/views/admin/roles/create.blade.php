
@extends('admin.home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{route ('roles.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Add New Roles</div>
                    <div class="tools">
                        <a href="{{route ('roles.store')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>
                            <div class="input-group col">
                                <input class="form-control" id="roles_name" name="name" placeholder="Ex.. admin"  required>
                            </div>
                            <span id="category_name_result"></span>
                        </div>


                         <div class="form-group row">
                            <label class="col-md-3 col-form-label">Permissions</label>
                            <div class="col">
                                @foreach ($permission as $item)
                       <input class="border-checkbox" type="checkbox" name="permission[]" id="{{$item->name}}" value="{{$item->name}}"
                            {{!empty($role) && in_array($item->id, $role->permissions->pluck('id')->toArray()) ? "checked" : null}}/>
                            <label class="border-checkbox-label" for="{{$item->name}}">{{$item->name}}</label><br/>
                                @endforeach
                                
                                
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

