
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
                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Add New Roles
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dt-addrows">
                        <thead class="thead-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Roles Name</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($roles as $key=> $value)
                            <tr id="tr-{{ $value->id }}">
                                <td>{{$key+1}}</td>
                                <td>{{ $value->name}}</td>
                                <td>
                                    @foreach($value->permissions as $permission)
                                        <span style="font-size: 10px; margin: 2px" class="btn btn-sm btn-outline-warning font-weight-bold text-dark">{{$permission->name}}</span>
                                    @endforeach</td>
                                <td>
                                    <a href="{{route('roles.edit', $value->id)}}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>
                                    <form style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/roles','{{$value->id}}')" ><i class="ti-trash"></i></button>
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
