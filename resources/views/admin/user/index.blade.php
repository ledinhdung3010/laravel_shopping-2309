@extends('admin_layout')
@section('title','ListUsers')
@section('breadcrumb-item-1','Users')
@section('breadcrumb-item-2','Lists')
@push('javascript')

<script>
    $(function(){
        $('#txtKeyword').bind('enterKey',function(){
            let keyword=$('#txtKeyword').val().trim();
            keyword=encodeURI(keyword);
            window.location.href="{{route('admin.user')}}"+"?s="+keyword;
            
        })
        $('#txtKeyword').keyup(function(e){
            if(e.keyCode==13){
                $(this).trigger('enterKey')
            }
        })

        $('#btnSearch').click(function(){
            let keyword=$('#txtKeyword').val().trim();
            keyword=encodeURI(keyword);
            window.location.href="{{route('admin.user')}}"+"?s="+keyword;
            
        })

    })

</script>
@endpush
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h5 class="text-center">User</h5>
       
        <a href="{{route('admin.user.add')}}" class="btn btn-primary my-3">ADD USER</a>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="txtKeyword" placeholder="LastName" value="{{$keyword}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th colspan="3" width="5%">Action</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($admins as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->first_name}}</td>
                        <td>{{$item->last_name}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->gender==1 ? 'Nam' : ($item->gender==2 ? 'Nu': 'Khac')}}</td>
                        <td>{{$item->address}}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">view</a>
                        </td>
                        <td>
                            <a href="{{route('admin.user.edit',['id'=>$item->id])}}" class="btn btn-info btn-sm">edit</a>
                        </td>
                        <form action="{{route('admin.user.delete',['id'=>$item->id])}}" method="post">
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
      
    </div>
</div>
@endsection