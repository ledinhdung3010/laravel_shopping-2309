@extends('admin_layout')
@section('title','AddPRoduct')
@section('breadcrumb-item-1','Products')
@section('breadcrumb-item-2','Add')
@push('stylesheets')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
<style>
    .mult-select-tag .wrapper{
        padding-left: 0 !important;
    }
    .ck-editor__editable{
        min-height: 500px !important;
    }
</style>
@endpush
@push('javascript')

<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script>
 new MultiSelectTag('color_id', {
    rounded: true,    // default true
    shadow: false,      // default false
    placeholder: 'Search',  // default Search...
    tagColor: {
        textColor: '#327b2c',
        borderColor: '#92e681',
        bgColor: '#eaffe6',
    },
    onChange: function(values) {
        console.log(values)
    }
})
new MultiSelectTag('size_id', {
    rounded: true,    // default true
    shadow: false,      // default false
    placeholder: 'Search',  // default Search...
    tagColor: {
        textColor: '#327b2c',
        borderColor: '#92e681',
        bgColor: '#eaffe6',
    },
    onChange: function(values) {
        console.log(values)
    }
})
new MultiSelectTag('tag_id', {
    rounded: true,    // default true
    shadow: false,      // default false
    placeholder: 'Search',  // default Search...
    tagColor: {
        textColor: '#327b2c',
        borderColor: '#92e681',
        bgColor: '#eaffe6',
    },
    onChange: function(values) {
        console.log(values)
    }
})
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

</script>
<script>
    $(document).ready(function(){
        $('#sale_price').prop('disabled',true);
        $('input[name="in_sale"]').change(function(){
                if($(this).is(':checked')){
                    $('#sale_price').prop('disabled', false);
                } else {
                    $('#sale_price').prop('disabled', true);
                }
            });
    })
</script>

@endpush
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h5 class="text-center">Add Product</h5>
        <a href="{{route('admin.product')}}" class="btn btn-primary my-3">Back to list products</a>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('error_sale--price'))
            <div class="alert alert-danger">
                <p>{{Session::get('error_sale--price')}}</p>
            </div>
        @endif
        
        @if(Session::has('error_upload_img'))
            <div class="alert alert-danger">
                <p>{{Session::get('error_upload_img')}}</p>
            </div>
        @endif
        @if(Session::has('error_insert--product'))
            <div class="alert alert-danger">
                <p>{{Session::get('error_insert--product')}}</p>
            </div>
        @endif

        <form action="{{route('admin.product.create')}}" class="border p-3" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>
                    <div class="mb-3">
                        <label for="">Category</label>
                        <select name="category_id" id="" class="form-control">
                            <option value="">-- Chose --</option>
                            @foreach ($categorys as $item)
                            <option value="{{$item->id}}" {{old('category_id')==$item->id ? 'selected' :''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Summary</label>
                        <textarea name="summary" id="" class="form-control"  rows="5">
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Price</label>
                        <input type="text" name="price" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="">Is Sale</label>
                        <input type="checkbox" name="in_sale"  id="">
                    </div>
                    <div class="mb-3">
                        <label for="">Sale-Price</label>
                        <input type="text" name="sale_price" class="form-control" id="sale_price">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="">Quantity</label>
                        <input type="text" name="quantity" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="">Image gally</label>
                        <input type="file" name="list_image[]" class="form-control" id=""  multiple>
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="">-- Chose --</option>
                            <option value="1"  {{old('status')=="1" ? 'selected': ''}}>Active</option>
                            <option value="2" {{old('status')=="2" ? 'selected': ''}}>In Active</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Color</label>
                        <select name="color_id[]" id="color_id" class="form-control" multiple>
                            @foreach ($colors as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Size</label>
                        <select name="size_id[]" id="size_id" class="form-control" multiple>
                            @foreach ($sizes as $item)
                            <option value="{{$item->id}}">{{$item->name_letter}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="mb-3">
                        <label for="">Tag</label>
                        <select name="tag_id[]" id="tag_id" class="form-control" multiple>
                     
                            @foreach ($tags as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    
                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" id="editor"  class="form-control" rows="10">
                        </textarea>
                    </div>
                    <button  type="submit" class="btn btn-primary btn-lg">Submit</button>
                </div>
            </div>
            
            
        </form>
    </div>
</div>
@endsection