@extends('layouts.nav')

@section('content')
<div class="container">
    <h1>User List</h1>
    <div class="item-table">
        <table class="table" >
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Role</th>
                    {{-- @if ($role =='Admin')
                        <th>Action</th>
                    @endif --}}
                </tr>
            </thead>
            <tbody id="result">
                @foreach ($user as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        {{-- <td>{{$user->role}}</td> --}}

                        <td>
                            <select name="role" id="{{$user->id}}" class="form-control" onclick="changeRole(this)">
                                <option value="No Role" {{$user->role == null ? 'selected' : '' }}>No Role</option>
                                <option value="Manager" {{$user->role == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="Operator" {{$user->role == 'Operator' ? 'selected' : '' }}>Operator</option>
                                <option value="Quality Control" {{$user->role == 'Quality Control' ? 'selected' : '' }} >Quality Control</option>
                            </select>
                        </td>
                        {{-- <td>{{$user->status}}</td> --}}
                        {{-- @if ($role =='Admin')
                            <td><a href="/meeting/{{$product->id}}/edit"><button class="btn btn-primary">Edit Order</button></a></td>
                        @endif --}}
                    </tr>
                @endforeach
            </tbody>


        </table>
    </div>
</div>

<script>
    function changeRole(item){
        var data = item.value;
        var id = item.id;

        // console.log(data);

        $.ajax({
            type : "GET",
            url : "/change-role",
            data : {
                'data' : data,
                'id' : id,
            },
            success: function(response){
                console.log('success');
            }
        })
    }
</script>
@endsection
