@extends('layouts.nav')

@section('content')
<div class="title">
    <h1>Manager Dashboard</h1>
</div>


<div class="row justify-content-end">
    <div class="col-3 my-4">
        <input type="text" class="form-control" id="search" placeholder="Search..." onkeyup="search()" name="search">
    </div>
</div>

<div class="item-table">
    <table class="table" >
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Quantity</th>
                <th>Order Code</th>
                <th>Tracking</th>
                {{-- @if ($role =='Admin')
                    <th>Action</th>
                @endif --}}
            </tr>
        </thead>
        <tbody id="result">
            @foreach ($product as $product)
                <tr>
                    <td><a href="#" id = "{{$product->id}}" onclick="modalShow(this); return false;">{{$product->product_name}}</a></td>
                    <td>{{$product->cust_name}}</td>
                    <td>{{$product->qty}}</td>
                    <td>{{$product->code}}</td>
                    <td>{{$product->status}}</td>
                    {{-- @if ($role =='Admin')
                        <td><a href="/meeting/{{$product->id}}/edit"><button class="btn btn-primary">Edit Order</button></a></td>
                    @endif --}}
                </tr>
            @endforeach
        </tbody>


    </table>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="/stock/edit" method="POST">
                        @csrf
                        <div id="modal-content">

                        </div>

                    </form>
                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<script>
    function modalShow(item){

        $('#modal-content').empty();
        var id = item.id;

        $.ajax({
            type : "GET",
            url : "/product-edit",
            data : {'id' : id},
            success:function(response){
                data = JSON.parse(response);

                product = data.product;

                console.log(product);
                $('#modal-content').append(`

                    <input type="text" value = "${product.id}" class="form-control" name="id" readonly hidden>
                    <div class="row">
                        <div class="col m-3">
                            <label for="">Product Name</label>
                            <input type="text" value = "${product.product_name}" class="form-control" name="product_name" readonly>
                        </div>
                        <div class="col m-3">
                            <label for="">Quantity</label>
                            <input type="text" value = "${product.qty}"  class="form-control col" name="qty" readonly>


                        </div>

                    </div>

                    <div class="row">
                        <div class="col m-3">
                            <label for="">Customer Name</label>
                            <input type="text" value = "${product.cust_name}"  class="form-control" name="cust_name" readonly>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col m-3">
                            <label for="">Product Status</label>
                            <select name="status" class="form-control">
                                <option value="Milling">Milling</option>
                                <option value="Drilling">Drilling</option>
                                <option value="Tapping">Tapping</option>
                                <option value="Grinding">Grinding</option>
                            </select>


                            <input type="submit" class="btn btn-primary my-3" value="Update Product" style="float: right">

                        </div>
                    </div>

                `);

                $('#exampleModal').modal('show');
            }

        })
    }

    function search(){
        $('#result').empty();
        var data = document.getElementById('search').value;
        $.ajax({
            type : "GET",
            url: "/search",
            data : {'char': data},
            success:function(response){
                data = JSON.parse(response);
                var product = data.product;

                console.log(product);

                if (product.length < 1) {
                    $('#result').append(`
                        <div>
                            <h1>No Data</h1>
                        </div>
                    `);
                } else {
                    product.forEach(element => {
                        $('#result').append(`
                            <tr>
                                <td><a href="#" id = "${element.id}" onclick="modalShow(this); return false;"">${element.product_name}</a></td>
                                <td>${element.cust_name}</td>
                                <td>${element.qty}</td>
                                <td>${element.code}</td>
                                <td>${element.status}</td>
                            </tr>
                        `);
                    });
                }
            }
        })
    }
</script>
@endsection

