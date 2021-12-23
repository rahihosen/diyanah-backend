
@extends('admin.home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{route ('faqs.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Add New FAQ</div>
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
                                <input class="form-control" name="faq_question" placeholder="i.e Why Choose us?" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Answer</label>
                            <div class="input-group col">
                                <textarea  class="form-control" id="editor" name="faq_answer" placeholder="i.e Write your answer here" required></textarea>
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
