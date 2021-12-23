
@extends('admin.home')
@section('content')


<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase">
                    <i class="ti-view-list"></i> Brand List
                </div>
                <div class="tools">
                    <a href="{{ route('brands.create') }}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Add New Brand
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dt-addrows">
                        <thead class="thead-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Brand Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($brand as $key=> $row)
                            <tr id="tr-{{ $row->id }}">
                                <td>{{$key+1}}</td>
                                <td>{{$row->brand_title}}</td>
                                <td><img src="{{ asset( 'brand/'.$row->brand_image)}}" height="50px;" width="50px;" alt="image"></td>

                                <td>
                                    <a href="{{ route('brands.edit', ['brand'=>$row->id]) }}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>

                                    {{-- <a href="{{ route('brands.destroy', ['brand'=> $row->id]) }}" data-token="{!! csrf_token() !!}" data-id="{!! $row->id !!}" class="deleteBtn">
                                    <i class="btn btn-xs btn-danger ti-trash"></i> 
                                    </a> --}}

                                    <form action="{{ route('brands.destroy', ['brand'=> $row->id]) }}" method="POST" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/brands','{{$row->id}}')" ><i class="ti-trash"></i></button>
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
