@extends('frontend_layout')
@section('title','PRODUCT-DETAIL')
@section('content')
<!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('frontend.home')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="#" class="stext-109 cl8 hov-cl1 trans-04">
                {{$infoProduct->categories_name}}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{$infoProduct->name}}
            </span>
        </div>
    </div>
<!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                @foreach ($list_images as $list_img)
                                    <div class="item-slick3" data-thumb="{{URL::to('/')}}/upload/images/product/{{$list_img}}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{URL::to('/')}}/upload/images/product/{{$list_img}}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{URL::to('/')}}/upload/images/product/{{$list_img}}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                             

                               
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                           
                           {{$infoProduct->name}}
                        </h4>

                        <span class="mtext-106 cl2">
                           {{$infoProduct->price}}
                        </span>

                        <p class="stext-102 cl3 p-t-23">
                           {{$infoProduct->summery}}
                        </p>
                        
                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Size
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2 js-size-product" name="time">
                                            <option>Choose an option</option>
                                            @foreach ($sizeProduct as $size)
                                                <option value="{{$size->id}}">{{$size->name_letter}}</option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Color
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2 js-color-product" name="time" >
                                            <option>Choose an option</option>
                                            @foreach ($colorProduct as $color)
                                                <option value="{{$color->id}}">{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-w p-b-10 ml-4 px-3">
                                Số Lượng Sẵn Có 
                                <div class="quantity" style="margin-left:10px; padding: 0px 20px; border: 2px solid #e8e8e8;  border-radius: 5px;">
                                    {{$infoProduct->quantity}}
                                </div> 
                            </div>
                            
                            

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product js-num-product" type="number" name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                       
                                    </div>
                                    <form action="{{route('frontend.cart.add')}}" method="post">
                                        @csrf
                                        <button type="submit" name="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail add-cart">
                                            Add to cart
                                        </button>
                                    </form>
                                    
                                </div>
                                
                            </div>	
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!!$infoProduct->description!!}
                                </p>
                            </div>
                        </div>


                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        <div class="flex-w flex-t p-b-68">
                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                <img src="images/avatar-01.jpg" alt="AVATAR">
                                            </div>

                                            <div class="size-207">
                                                <div class="flex-w flex-sb-m p-b-17">
                                                    <span class="mtext-107 cl2 p-r-20">
                                                        Ariana Grande
                                                    </span>

                                                    <span class="fs-18 cl11">
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star-half"></i>
                                                    </span>
                                                </div>

                                                <p class="stext-102 cl6">
                                                    Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <!-- Add review -->
                                        <form class="w-full">
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Add a review
                                            </h5>

                                            <p class="stext-102 cl6">
                                                Your email address will not be published. Required fields are marked *
                                            </p>

                                            <div class="flex-w flex-m p-t-50 p-b-23">
                                                <span class="stext-102 cl3 m-r-16">
                                                    Your Rating
                                                </span>

                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <input class="dis-none" type="number" name="rating">
                                                </span>
                                            </div>

                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review">Your review</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                                </div>

                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="name">Name</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
                                                </div>

                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="email">Email</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
                                                </div>
                                            </div>

                                            <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                NameProduct::{{$infoProduct->name}}
            </span>

            <span class="stext-107 cl6 p-lr-25">
                Categories: {{$infoProduct->categories_name}}
            </span>
        </div>
    </section>
	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Related Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
                    @foreach ($reletedProduct as $item)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{URL::to('/')}}/upload/images/product/{{$item->image}}" alt="IMG-PRODUCT">
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{route('frontend.product.detail',['slug'=>$item->slug,'id'=>$item->id])}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{$item->name}}
                                        </a>

                                        <span class="stext-105 cl3">
                                            {{'$'.$item->price}}
                                        </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                            <img class="icon-heart1 dis-block trans-04" src="{{asset('frontend/images/icons/icon-heart-01.png')}}" alt="ICON">
                                            <img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{asset('frontend/images/icons/icon-heart-02.png')}}" alt="ICON">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
			</div>
		</div>
	</section>
@endsection
@push('javascript')
    <script>
        $(function(){
            $('.btn-num-product-up').click(function(){
                var quantity=$('.quantity').text().trim();
                var number_product=$('.num-product').val();
                if(parseInt(number_product)>parseInt(quantity)){
                    $('.num-product').val(quantity);
                }
            })
            $('.btn-num-product-down').click(function(){
                var number_product=$('.num-product').val();
                if(parseInt(number_product)==0){
                    $('.num-product').val('1');
                }
            })
            $('.num-product').on('input', function() {
                var number_product=$('.num-product').val();
                var quantity=$('.quantity').text().trim();
                if(parseInt(number_product)==0){
                    $('.num-product').val('');
                }
                if(parseInt(number_product)>parseInt(quantity)){
                    $('.num-product').val(quantity);
                }
            })
            $('.num-product').change(function(){
                var number_product=$('.num-product').val();
                if((number_product)==''){
                    $('.num-product').val('1');
                }
            })
            

            $('.js-addcart-detail').click(function(event){
                event.preventDefault();
               
               
                // Người dùng đã đăng nhập, thực hiện hành động Add to Cart ở đây
                console.log('User is logged in. Perform Add to Cart action.');
                let idPd="{{$infoProduct->id}}";
               let qty=$('.js-num-product').val().trim();
               let idColor=$('.js-color-product').val().trim();
               let idSize=$('.js-size-product').val().trim();
               if($.isNumeric(idColor) && $.isNumeric(idSize)&& $.isNumeric(qty)){
                    $.ajax({
                        url:"{{route('frontend.cart.add')}}",
                        type:"Post",
                        data:{"id":idPd,'idColor':idColor,'idSize':idSize,'qty':qty},
                        beforeSend:function(){
                            $('.js-addcart-detail').text('Processing...');
                        },
                        success:function(result){
                            $('.js-addcart-detail').text('Add to cart');
                            if(result.cod==200){
                                $('.check_out').show();
                                swal('Message', result.mess, "success");
                                $('.js-show-cart').attr('data-notify',result.count);
                               
                                // Lấy thông tin về sản phẩm vừa thêm vào giỏ hàng
                                var updatedCartItem = result.lastCart;
                                var cartItemSelector = '.header-cart-item-info[data-product-id="' +  updatedCartItem.id + updatedCartItem.options.size +updatedCartItem.options.color + '"]';
                                var existingCartItem = $(cartItemSelector);
                                console.log(existingCartItem.length)
                                if (existingCartItem.length > 0) {
                                   
                                    console.log(updatedCartItem.price+'         '+updatedCartItem.qty);
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                                    var newQuantity = updatedCartItem.qty;
                                    existingCartItem.text(updatedCartItem.price + ' X ' + newQuantity);
                                } else {
                               
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào danh sách
                                    let cartItemHtml = '<li class="header-cart-item flex-w flex-t m-b-12" data-id="'+updatedCartItem.rowId+'">' +
                                        '<div class="header-cart-item-img">' +
                                        '<img src="{{URL::to('/')}}/upload/images/product/' + updatedCartItem.options.image + '" alt="IMG">' +
                                        '</div>' +
                                        '<div class="header-cart-item-txt p-t-8">' +
                                        '<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">' +
                                        updatedCartItem.name +
                                        '</a>' +
                                        '<span class="header-cart-item-info" data-product-id="' + updatedCartItem.id + updatedCartItem.options.size +updatedCartItem.options.color + '">' +
                                        updatedCartItem.price + ' X ' + updatedCartItem.qty +
                                        '</span>' +
                                        '</div>' +
                                        '</li>';
                                    $('.header-cart-wrapitem').append(cartItemHtml);
                                }
                                $('.header-cart-total').text(" Total: "+result.total)

                            }else{
                                swal('Message', result.error, "error");
                            }
                        }
                    })
               }else{
                swal('Message', "Choose color and size and quantity", "error");
               }
            
               
               
            });
            
        })
    </script>
    
@endpush