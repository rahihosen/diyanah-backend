
@extends('admin.home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{route('products.store')}}" method="post" enctype="multipart/form-data" >
            @csrf


                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-plus"></i> Add New Product</div>
                    <div class="tools">
                        <a href="{{route('products.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Name</label>
                            <div class="input-group col">
                                <input class="form-control" id="productname" name="product_name" placeholder="i.e iPhone">
                            </div>
                            <span id="productname_result"></span>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Slug</label>
                            <div class="input-group col">
                                <input class="form-control" name="product_slug" placeholder="i.e ip">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Code</label>
                            <div class="input-group col">
                                <input class="form-control" name="product_code" placeholder="i.e iPhone#001">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Quantity</label>
                            <div class="input-group col">
                                <input class="form-control" name="product_quantity" placeholder="i.e 50">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Price</label>
                            <div class="input-group col">
                                <input class="form-control" name="product_price" placeholder=" 10000"  >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Select Category</label>
                            <div class="col">
                                <select class="form-control" name="category_id">
                                    <option>Select Category</option>
                                    @foreach($categories as $row)
                                        <option value="{{$row->id}}">
                                            {{$row->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Select Unit</label>
                            <div class="col">
                                <select class="form-control" name="unit_id">
                                    <option>Select Unit</option>
                                    @foreach ($units as $value)
                                        <option value="{{$value->id}}">
                                            {{$value->unit_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Tag</label>
                            <div class="form-radio col-md-9" >
                                @foreach($tags as $row)
                                    <label class="mr-3">
                                        <input type="checkbox" name="tag_id[]" value="{{$row->id}}">
                                        <span class="checkmark"><i class="fa fa-check"></i></span>
                                        {{$row->tag_name}}
                                    </label>
                                @endforeach

                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Description</label>
                            <div class="input-group col">
                                <textarea class="form-control" id="editor" name="product_description" placeholder=" Write description here"></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="eventRegInput2">Product Image</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div>
                                        <input type="file" name="product_image" onchange="readURL(this);" accept=".png, .jpg, .jpeg">&nbsp;&nbsp;&nbsp;
                                        <img id="image" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="form-radio col-md-9" >
                                <label class="mr-3">
                                    <input type="radio" required name="status" value="1">
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> Show
                                </label>
                                <label class="mr-3">
                                    <input type="radio" required name="status" value="0">
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> Hide
                                </label>
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

