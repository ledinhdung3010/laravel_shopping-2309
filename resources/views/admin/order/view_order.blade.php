@extends('admin_layout')
@section('title','ListOrder')
@section('breadcrumb-item-1','Order')
@section('breadcrumb-item-2','Detail')
@section('content')
<form class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head" style="width:400px">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Color</th>
                                <th class="column-6" style="width: 10%;">Size</th>
                                <th class="column-7" style="width: 10%;">SubTotal</th>
                            </tr>
                            @php
                                $count=0;
                            @endphp
                            @foreach ($products as $item)
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img width="40%" src="{{URL::to('/')}}/upload/images/product/{{$item->image}}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2"><a href="{{route('frontend.product.detail',['slug'=>$item->slug,'id'=>$item->id])}}">{{$item->name}}</a></td>
                                <td class="column-3">{{'$'.$item->price}}</td>
                                <td class="column-4">
                                    {{$item->qtyprice}}
                                </td>
                                <td class="column-5">{{$item->color_name}}</td>
                                <td class="column-6">{{$item->size_name}}</td>
                                <td class="column-7">{{'$'.($item->qtyprice*$item->price)}}</td>
                            </tr>
                            @php
                                $count+=$item->qtyprice*$item->price;
                            @endphp
                            @endforeach
                            
                        </table>
                        <div class="bg-primary text-center">
                            <h3>TOTAL: ${{$count}}</h3>
                           
                        </div>
                        
                    </div>

                   
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
