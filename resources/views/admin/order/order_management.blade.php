@extends('admin_layout')
@section('title','ListOrder')
@section('breadcrumb-item-1','Order')
@section('breadcrumb-item-2','Lists')
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h5 class="text-center">Order</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full_name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Order_Date</th>
                    <th colspan="3" width="25%">Action</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($orders as $item)
                    <tr data-id="{{$item->id}}">
                        <td>{{$item->id}}</td>
                        <td>{{$item->full_name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->order_date}}</td>
                        <td>
                            <a href="{{route('admin.view',['id'=>$item->extrs_code])}}" class="btn btn-primary btn-sm">View</a>
                        </td>
                        <td>
                            <a href="{{route('admin.order.accept',['extrs_code'=>$item->extrs_code,'id'=>$item->id])}}" class="btn btn-primary btn-sm">Accept</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              No Accept
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="{{route('admin.order.no_accept',['extrs_code'=>$item->extrs_code])}}" method="post">
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ly do ban khong chap nhan don hang</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <input type="text" name="content" id="" class="form form-control">
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                          </div>
                                        </div>
                                      </div>
                                </form>
                             
                            </div>
                            
                        </td>
                    </tr>
                    
                @endforeach

            </tbody>

        </table>
        {{$orders->links()}}
    </div>
@endsection
@push('stylesheets')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
@endpush
@push('javascript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
@endpush