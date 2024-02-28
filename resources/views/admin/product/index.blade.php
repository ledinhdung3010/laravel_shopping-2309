@extends('admin_layout')
@section('title','ListProduct')
@section('breadcrumb-item-1','Products')
@section('breadcrumb-item-2','Lists')
@push('javascript')

<script>
    $(function(){
        $('#txtKeyword').bind('enterKey',function(){
            let keyword=$('#txtKeyword').val().trim();
            keyword=encodeURI(keyword);
            window.location.href="{{route('admin.product')}}"+"?s="+keyword;
            
        })
        $('#txtKeyword').keyup(function(e){
            if(e.keyCode==13){
                $(this).trigger('enterKey')
            }
        })

        $('#btnSearch').click(function(){
            let keyword=$('#txtKeyword').val().trim();
            keyword=encodeURI(keyword);
            window.location.href="{{route('admin.product')}}"+"?s="+keyword;
            
        })

    })

</script>
@endpush
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h5 class="text-center">Product</h5>
       
        <a href="{{route('admin.product.add')}}" class="btn btn-primary my-3">ADD PRODUCT</a>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="txtKeyword" placeholder="ProductName" value="{{$keyword}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="input-group-text" id="btnSearch">Search</button>
            </div>
          </div>
        @if(Session::has('insert_success'))
            <div class="alert alert-success">
                <p>{{Session::get('insert_success')}}</p>
            </div>
        @endif
        @if(Session::has('delete_success'))
            <div class="alert alert-success">
                <p>{{Session::get('delete_success')}}</p>
            </div>
        @endif
        @if(Session::has('update_success'))
            <div class="alert alert-success">
                <p>{{Session::get('update_success')}}</p>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>image</th>
                    <th>Price</th>
                    <th>is_sale</th>
                    <th>sale_price</th>
                    <th>Quantity</th>
                    <th colspan="3" width="5%">Action</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td><img src="{{URL::to('/')}}/upload/images/product/{{$product->image}}" width="100px" height="100px" alt=""></td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->in_sale == 1 ?'yes' : 'no'}}</td>
                        <td>{{$product->sale_price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">view</a>
                        </td>
                        <td>
                            <a href="{{route('admin.product.edit',['id'=>$product->id])}}" class="btn btn-info btn-sm">edit</a>
                        </td>
                        <form action="{{route('admin.product.delete',['id'=>$product->id])}}" method="post">
                            @method('delete')
                            @csrf
                            <td>
                            <button type="submit" class="btn btn-info btn-sm">delete</button>
                            </td>

                        </form>
                       

                    </tr>
                    
                @endforeach

            </tbody>

        </table>
        {{ $products->appends(request()->input())->links() }}
    </div>
</div>
@endsection