@extends('admin.home')
@section('content')
<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase">
                    <i class="ti-view-list"></i> Offer List
                </div>
                <div class="tools">
                    <a href="{{ route('offers.create') }}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Add New Offer
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dt-addrows">
                        <thead class="thead-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Offer Name</th>
                                <th>Offer Type</th>
                                <th>Offer Amount</th>
                                <th>Offer Start Date</th>
                                <th>Offer End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($offers as $key => $row)
                            <tr id="tr-{{$row->id}}">
                                <td>{{$key+1}}</td>
                                <td>{{$row->offer_name}}</td>
                                <td>

                                    @if($row->offer_type == "1")
                                        Fixed
                                    @else
                                        Percent
                                    @endif
                                </td>
                                <td>

                                    @if($row->offer_type == "1")
                                         {{$row->offer_amount}}TK
                                    @else
                                         {{$row->offer_amount}}%
                                    @endif
                                </td>
                                <td>{{$row->offer_start_date}}</td>
                                <td>{{$row->offer_end_date}}</td>

                                <td>
                                    @if($row->status == '1')
                                        <span class='badge badge-success'>Active</span>
                                    @else
                                        <span class='badge badge-warning'>Inactive</span>
                                    @endif

                                </td>

                                <td>
                                    <a href="{{ route('offers.edit', ['offer'=>$row->id]) }}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>

                                    <form action="{{ route('offers.destroy', ['offer'=> $row->id]) }}" method="POST" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/offers','{{$row->id}}')" ><i class="ti-trash"></i></button>
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

