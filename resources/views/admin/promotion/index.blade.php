
@extends('admin.home')
@section('content')


<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase">
                    <i class="ti-view-list"></i> Promotion List
                </div>
                <div class="tools">
                    <a href="{{ route('promotions.create') }}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Add New Promotion
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dt-addrows">
                        <thead class="thead-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Category Name</th>
                                <th>Promotion Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($promotion as $key=> $row)
                            <tr id="tr-{{$row->id}}">
                                <td>{{$key+1}}</td>
                                <td>
                                    @if($row->category)
                                        {{ $row->category->category_name}}</td>
                                    @endif
                                <td><img src="{{ asset( 'promotion/'.$row->promotion_image)}}" height="50px;" width="50px;" alt="image"></td>
                                <td>
                                    @if($row->status ==1) Show @else Hide @endif
                                </td>
                                <td>
                                    <a href="{{ route('promotions.edit', ['promotion'=>$row->id]) }}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>

                                    <form action="{{ route('promotions.destroy', ['promotion'=> $row->id]) }}" method="POST" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/promotions','{{$row->id}}')" ><i class="ti-trash"></i></button>
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
