@extends('frontend_layout')
@section('title','CHECKOUT')
@section('content')
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{route('frontend.home')}}" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="#" class="stext-109 cl8 hov-cl1 trans-04">
            Product
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
           Checkout
        </span>
    </div>
</div>

<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h5>Customer information</h5>
                <form action="{{route('frontend.order.payment')}}" class="border p-3" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="">Full name</label>
                        <input type="text" name="full_name" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="text" name="email" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Address</label>
                        <input type="text" name="address" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Not</label>
                        <input type="text" name="nots" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <p class="text-success">Thanh toan tien khi nhan san pham</p>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Payment</button>
                </form>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="header-cart-content flex-w js-pscroll">
                    <ul class="header-cart-wrapitem w-full">
                        @foreach ($data['cart'] as $item)
                            <li class="header-cart-item flex-w flex-t m-b-12" data-id="{{$item->rowId}}">
                                <div class="header-cart-item-img">
                                    <img src="{{URL::to('/')}}/upload/images/product/{{$item->options->image}}" alt="IMG">
                                </div>
        
                                <div class="header-cart-item-txt p-t-8">
                                    <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                        {{$item->name}}
                                    </a>
        
                                    <span class="header-cart-item-info"  data-product-id="{{$item->id.''.$item->options->size.''.$item->options->color}}">
                                        {{$item->price.'          X           '.$item->qty}} 
                                    </span>
                                </div>
                            </li>
                        @endforeach
                        
                    </ul>
                    
                    <div class="w-full">
                        <div class="header-cart-total w-full p-tb-40">
                            Total: {{$data['total']}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</section>
@endsection