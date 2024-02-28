@extends('admin_layout')
@section('title','AddColor')
@section('breadcrumb-item-1','Colors')
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

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h5 class="text-center">Add Color</h5>
        <a href="{{route('admin.user')}}" class="btn btn-primary my-3">Back to list users</a>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.user.create')}}" class="border p-3" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="">UserName <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" value="{{old('username')}}">
                    </div>
                    <div class="mb-3">
                        <label for="">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" value="">
                    </div>
                    <div class="mb-3">
                        <label for="">Email <span class="text-danger">*</span></label>
                        <input type="Email" class="form-control" name="email" value="">
                    </div>
                    <div class="mb-3">
                        <label for="">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="">
                    </div>
                    <div class="mb-3">
                        <label for="">Gender <span class="text-danger">*</span></label>
                        <select name="gender" id="" class="form-control">
                            <option value="">-- Chose --</option>
                            <option value="1"  {{old('status')=="1" ? 'selected': ''}}>Nam</option>
                            <option value="2" {{old('status')=="2" ? 'selected': ''}}>Nu</option>
                            <option value="3" {{old('status')=="2" ? 'selected': ''}}>Khac</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address" value="">
                    </div>

                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="">Status <span class="text-danger">*</span></label>
                        <select name="status" id="" class="form-control">
                            <option value="">-- Chose --</option>
                            <option value="1"  {{old('status')=="1" ? 'selected': ''}}>Active</option>
                            <option value="2" {{old('status')=="2" ? 'selected': ''}}>In Active</option>
                        </select>
                    </div> 
                    <div class="mb-3">
                        <label for="">Birthday</label>
                        <input type="date" class="form-control" name="birthday" value="">
                    </div>
                    <div class="mb-3">
                        <label for="">FirstName <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="first_name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="">LastName <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="last_name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="">Avatar</label>
                        <input type="file" class="form-control" name="avatar">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12">
                
                    <button  type="submit" class="btn btn-primary btn-lg">Submit</button>
                </div>
            </div>
            
            
        </form>
    </div>
</div>
@endsection