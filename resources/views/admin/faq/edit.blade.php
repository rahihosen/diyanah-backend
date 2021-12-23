@extends('admin.home')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{route ('faqs.update',$faq->id)}}" method="post" enctype="multipart/form-data" >
                @csrf

                @method('PUT')
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Edit FAQ</div>
                    <div class="tools">
                        <a href="{{route ('faqs.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Question</label>
                            <div class="input-group col">
                                <input type="text" class="form-control" name="faq_question" value="{{$faq->faq_question}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Answer</label>
                            <div class="input-group col">
                                <textarea type="text" class="form-control" id="editor" name="faq_answer" required>{{$faq->faq_answer}}</textarea>
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
