
@extends('admin.home')
@section('content')


<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase">
                    <i class="ti-view-list"></i> Category List
                </div>
                <div class="tools">
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Add New Category
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
                                <th>Parent Category</th>
                                <th>Category Icon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($categories as $category)
                            <tr id="tr-{{ $category->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name}}</td>
                                <td>
                                    @if ($category->parent)
                                        {{ $category->parent->name}}
                                    @endif
                                </td>
                                <td><img src="{{ asset( 'category-icon/'.$category->category_icon)}}" height="50px;" width="50px;" alt="image"></td>
                                <td>
                                    @if($category->status ==1) Show @else Hide @endif
                                </td>
                                <td>
                                    <a href="{{ route('categories.edit', ['category'=> $category->id]) }}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>
                                    <form action="{{ route('categories.destroy', ['category'=> $category->id]) }}" method="POST" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/categories','{{$category->id}}')" ><i class="ti-trash"></i></button>
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
