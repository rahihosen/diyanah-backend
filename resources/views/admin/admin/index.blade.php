
@extends('admin.home')
@section('content')


<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase">
                    <i class="ti-view-list"></i> Admin List
                </div>
                <div class="tools">
                    <a href="{{ route('admin-user.create') }}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Add New Admin
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dt-addrows">
                        <thead class="thead-light">
                            <tr>
                                <th>SL NO</th>
                                <th>User Name</th>
                                <th>Roles</th>
                                <th>image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($userList as $key=> $value)
                            <tr id="tr-{{ $value->id }}">
                                <td>{{$key+1}}</td>
                                <td>{{ $value->name}}</td>
                                <td>
                                    {{-- @if(!empty($value->getRoleNames()))
                                        @foreach($value->getRoleNames() as $v)
                                            <label class="">{{ $v }}</label>
                                        @endforeach
                                        @else
                                        <label class="">not found roles</label>
                                    @endif  --}}

                                     @if($value->role_id == "1")
                                        Admin
                                        @else
                                        Editor
                                    @endif 
                            
                                </td>
                                <td><img src="{{ asset( 'admin/'.$value->profile_photo_path)}}" height="50px;" width="50px;" alt="image"></td>
                                <td>
                                    <a href="{{route('admin-user.edit', $value->id)}}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>
                                    <form  style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/admin-user','{{$value->id}}')" >
                                            <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>



                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
