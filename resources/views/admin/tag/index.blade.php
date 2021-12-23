
@extends('admin.home')
@section('content')


<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase">
                    <i class="ti-view-list"></i> Tag List
                </div>
                <div class="tools">
                    <a href="{{ route('tags.create') }}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Add New Tag
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dt-addrows">
                        <thead class="thead-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Tag Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($tag as $key=> $value)
                            <tr id="tr-{{ $value->id }}">
                                <td>{{$key+1}}</td>
                                <td>{{ $value->tag_name}}</td>
                                <td>
                                    <a href="{{ route('tags.edit', ['tag'=> $value->id]) }}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>
                                    <form action="{{ route('tags.destroy', ['tag'=> $value->id]) }}" method="POST" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/tags','{{$value->id}}')" ><i class="ti-trash"></i></button>
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
