
@extends('admin.home')
@section('content')


<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase">
                    <i class="ti-view-list"></i> Feature List
                </div>
                <div class="tools">
                    <a href="{{ route('features.create') }}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Add New Feature
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dt-addrows">
                        <thead class="thead-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Feature Title</th>
                                <th>Feature Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($feature as $key=> $row)
                            <tr id="tr-{{$row->id}}">
                                <td>{{$key+1}}</td>
                                <td>{{$row->feature_title}}</td>
                                <td>{{Str::limit($row->feature_description, 30)}}</td>
                                <td><img src="{{ asset( 'feature/'.$row->feature_image)}}" height="50px;" width="50px;" alt="image"></td>

                                <td>
                                    <a href="{{ route('features.edit', ['feature'=>$row->id]) }}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>

                                    <form action="{{ route('features.destroy', ['feature'=> $row->id]) }}" method="POST" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/features','{{$row->id}}')" ><i class="ti-trash"></i></button>
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
