<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        
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
                

                <div class="header-cart-buttons flex-w w-full check_out" style="display: none">
                    
                    <div class="header-cart-total w-full p-tb-40">
                        Total: {{$data['total']}}
                    </div>
                    <a href="{{route('frontend.order.checkout')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10 btn-block">
                        Check Out
                    </a>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@push('javascript')

    <script>
        var a=$('.header-cart-item').length;
        if(a<=0){
            $('.check_out').hide();
        }else{
            $('.check_out').show();
        }
        $('.header-cart-wrapitem').on('click', '.header-cart-item-img', function() {
                        var id = $(this).closest(".header-cart-item").data("id");
                        $.ajax({
                                url:"{{route('frontend.cart.delete')}}",
                                type:"Post",
                                data:{"id":id},
                                success:function(result){
                                    $(".header-cart-item[data-id='"+id+"']").remove();
                                    var a=$('.header-cart-item').length;
                                    if(a<=0){
                                        $('.check_out').hide();
                                    }
                                    $('.js-show-cart').attr('data-notify',result.count);
                                    $('.header-cart-total').text(" Total: "+result.total);
                                }
                            })
                        
                    })
       
    </script>
@endpush