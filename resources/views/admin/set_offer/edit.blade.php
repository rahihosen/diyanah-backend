
@extends('admin.home')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <form class="validate1" action="{{ route('SetOffers.update', $offer_details->id) }}" method="POST" enctype="multipart/form-data" >
                    @csrf

                    @method('PUT')
                    <div class="card-header uppercase">
                        <div class="caption"><i class="ti-plus"></i> Set New Offer</div>
                        <div class="tools">
                            <a href="{{route ('SetOffers.index')}}" class="btn btn-warning">
                                <i class="ti-share"></i>
                            </a>
                        </div>
                    </div>



                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Product</label>
                                <div class="col">
                                    <select class="form-control" name="product_id">
                                        <option value="" selected>Select Product</option>
                                        @foreach($products as $row)
                                            <option value="{{$row->id}}" {{ ($row->id == $offer_details->product_id) ? "selected" : "" }}>
                                                {{$row->product_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Offer</label>
                                <div class="col">
                                    <select class="form-control" name="offer_id">
                                        <option value="" selected>Select Offer</option>
                                        @foreach($offers as $row)
                                            <option value="{{$row->id}}" {{ ($row->id == $offer_details->offer_id) ? "selected" : "" }}>
                                                {{$row->offer_name}}
                                            </option>

                                        @endforeach
                                    </select>
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

