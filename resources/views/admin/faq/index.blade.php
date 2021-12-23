
@extends('admin.home')
@section('content')


<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase">
                    <i class="ti-view-list"></i> FAQ List
                </div>
                <div class="tools">
                    <a href="{{ route('faqs.create') }}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Add New FAQ
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dt-addrows">
                        <thead class="thead-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($faqs as $key=> $value)
                            <tr id="tr-{{$value->id}}">
                                <td>{{$key+1}}</td>
                                <td>{{ $value->faq_question}}</td>
                                <td>{{Str::limit($value->faq_answer, 30)}}</td>
                                <td>
                                    <a href="{{ route('faqs.edit', ['faq'=> $value->id]) }}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>
                                    <form action="{{ route('faqs.destroy', ['faq'=> $value->id]) }}" method="POST" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/faqs','{{$value->id}}')" ><i class="ti-trash"></i></button>

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
