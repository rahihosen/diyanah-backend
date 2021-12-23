
@extends('admin.home')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">
            <form class="validate1" action="{{ route('offers.update', $offer->id)}}" method="post" enctype="multipart/form-data" novalidate>
                @csrf

                @method('PUT')
                <div class="card-header uppercase">
                    <div class="caption"><i class="ti-pencil-alt"></i> Edit Offer</div>
                    <div class="tools">
                        <a href="{{route ('offers.index')}}" class="btn btn-warning">
                            <i class="ti-share"></i>
                        </a>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Offer Name</label>
                            <div class="input-group col">
                                <input type="text" class="form-control" name="offer_name" value="{{$offer->offer_name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Offer Type</label>
                            <div class="form-radio col-md-9" >
                                <label class="mr-3">
                                    <input type="radio" name="offer_type" value="1" @if($offer->offer_type =="1") echo checked @endif >
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> Fixed
                                </label>
                                <label class="mr-3">
                                    <input type="radio" name="offer_type" value="0" @if($offer->offer_type =="0") echo checked @endif>
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> Percent
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Offer Amount</label>
                            <div class="input-group col">
                                <input class="form-control" name="offer_amount" value="{{$offer->offer_amount}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Offer Start Date</label>
                            <div class="input-group col">
                                <input type="date" class="form-control" name="offer_start_date" value="{{$offer->offer_start_date}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Offer End Date</label>
                            <div class="input-group col">
                                <input type="date" class="form-control" name="offer_end_date" value="{{$offer->offer_end_date}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="form-radio col-md-9" >
                                <label class="mr-3">
                                    <input type="radio" name="status" value="1" @if($offer->status == 1) echo checked @endif>
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> Active
                                </label>
                                <label class="mr-3">
                                    <input type="radio" name="status" value="0" @if($offer->status == 0) echo checked @endif>
                                    <span class="radiomark">
                                        <i class="fa fa-circle"></i>
                                    </span> In-active
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
