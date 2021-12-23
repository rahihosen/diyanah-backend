@extends('admin.home')
@section('content')
<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase">
                    <i class="ti-view-list"></i> Set Offer List
                </div>
                <div class="tools">
                    <a href="{{ route('SetOffers.create') }}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Set New Offer
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dt-addrows">
                        <thead class="thead-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Product Name</th>
                                <th>Offer Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($offer_details as $key => $row)
                            <tr id="tr-{{$row->id}}">
                                <td>{{$key+1}}</td>
                                <td>
                                    @if($row->product)
                                        {{ $row->product->product_name}}</td>
                                    @endif
                                </td>
                                <td>
                                    @if($row->offer)
                                        {{$row->offer->offer_name}}
                                    @endif
                                </td>


                                <td>
                                    <a href="{{ route('SetOffers.edit', $row->id) }}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>

                                    <form action="{{ route('SetOffers.destroy',$row->id) }}" method="POST" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/SetOffers','{{$row->id}}')" ><i class="ti-trash"></i></button>
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

