@extends('admin.home')
@section('content')

<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase">
                    <i class="ti-view-list"></i> Product List
                </div>
                <div class="tools">
                    <a href="{{ route('products.create')}}" class="btn btn-sm btn-primary">
                        <i class="ti-plus"></i> Add New Product
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dt-addrows">
                        <thead class="thead-light">
                            <tr>
                                <th width="2%">#SL</th>
                                <th width="10%">Product Name</th>
                                <th>Product Code</th>
                                <th>Price</th>
                                <th>quantity</th>
                                <th>Product Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $key=> $row)
                            <tr id="tr-{{ $row->id }}">
                                <td>{{$key+1}}</td>
                                <td>{{$row->product_name}}</td>
                                <td>{{$row->product_code}}</td>
                                <td ><span style="font-size: 25px">৳ </span>{{$row->product_price}}</td>
                                <td >{{$row->product_quantity}}</td>
                                <td><img src="{{ asset('product/'.$row->product_image)}}" style="width:100px!important;height:65px!important;" alt="image"></td>

                                <td>@if($row->status ==1) Show @else Hide @endif</td>


                                <td>
                                    <a  class="btn  mb-1 btn-success" href="{{asset('product/show_product_details/'.$row->product_id)}}"><i class="ti-eye"></i></a>

                                    <a href="{{ route('products.edit', ['product'=> $row->id]) }}" class="btn btn-xs btn-info"><i class="ti-pencil-alt"></i></a>
                                    {{-- <a href="{{ route('products.destroy', ['product'=> $row->id]) }}" class="btn btn-xs btn-danger remove"><i class="ti-trash"></i></a> --}}
                                   <form action="{{ route('products.destroy', ['product'=> $row->id]) }}" method="POST" style="display: inline-block;">
                                       @method('DELETE')
                                       @csrf
                                       <button type="button" class="btn btn-xs btn-danger remove" onclick="deleteButton('admin/products','{{$row->id}}')" ><i class="ti-trash"></i></button>
                                 </form>

                                     <a href="{{url('product/update_quantity/'.$row->id."/increase")}}" class="  type-error btn btn-icon btn-info btn-sm mr-1 mb-1">
                                  <i class="fa fa-angle-up"></i>
                                 </i>
                                  </a>
                                  <a href="{{url('product/update_quantity/'.$row->id."/decrease")}}" class="  type-error btn btn-icon btn-info btn-sm mr-1 mb-1">
                                  <i class="fa fa-angle-down"></i>
                                 </i>
                                  </a>
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


