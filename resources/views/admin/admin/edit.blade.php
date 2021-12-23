
@extends('admin.home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{route('admin-user.update',$admins->id)}}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('PUT')

                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Edit Admin</div>
                    <div class="tools">
                        <a href="{{route('admin-user.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Admin Name</label>
                            <div class="input-group col">
                                <input class="form-control" id="name" value="{{ $admins->name }}" name="name" placeholder="Admin Name">
                            </div>
                            <span id="productname_result"></span>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Email</label>
                            <div class="input-group col">
                                <input class="form-control" name="email" value="{{$admins->email}}" placeholder="Demo@email.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Admin Role</label>
                            <div class="col">
                                <select class="form-control" name="role_id">
                                    <option value="{{$roles->id}}">{{$roles->name}}</option>
                                    @foreach($role as $row)
                                        <option value="{{$row->id}}">
                                            {{$row->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="eventRegInput2">Admin Image</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div>
                                        <input type="file" name="profile_photo_path" onchange="readURL(this);" accept=".png, .jpg, .jpeg">&nbsp;&nbsp;&nbsp;
                                        <img  id="image" >
                                        <input type="hidden" name="old_one" value="{{ $admins->profile_photo_path }}">
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

