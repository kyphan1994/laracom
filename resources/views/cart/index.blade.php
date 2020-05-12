@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-12">

        <h1>Cart</h1>

        @if (session()->has('success'))
            <div class="alert alert-success">
            {{session()->get('success')}}
            </div>
        @endif

        @if (Cart::count() > 0)
            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Description</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach (Cart::content() as $item)
                        <tr>
                            <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                            <td>{{$item->model->name}}</td>
                            <td>{{$item->model->description}}</td>
                            <td><input class="form-control" type="text" value="1" /></td>
                            <td class="text-right">{{$item->model->price}}</td>
                            <td class="text-right">
                                <form action="/cart/saveForLater/{{$item->rowId}}" method="POST">
                                    {{csrf_field()}}
                                    <button class="btn btn-primary"> Save for later </button>
                                </form> 
                                <form action="/cart/{{$item->rowId}}" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-danger"> Delete </button>
                                </form> 
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right">{{Cart::subtotal()}}VND</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Tax</td>
                            <td class="text-right">{{Cart::tax()}}VND</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong>{{Cart::total()}}VND</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="/" class="btn btn-block btn-light">Continue Shopping</a>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <a href="/checkout" class="btn btn-lg btn-block btn-success text-uppercase">Checkout</a>
                    </div>
                </div>
            </div>

            @else
            
            <h1>No Item in Cart</h1>

            @endif



            <h1>Save For Later</h1>

            @if (Cart::instance('saveForLater')->count() >0)
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"> </th>
                                <th scope="col">Product</th>
                                <th scope="col">Description</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-right">Price</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach (Cart::instance('saveForLater')->content() as $item)
                            <tr>
                                <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                                <td>{{$item->model->name}}</td>
                                <td>{{$item->model->description}}</td>
                                <td><input class="form-control" type="text" value="1" /></td>
                                <td class="text-right">{{$item->model->price}}</td>
                                <td class="text-right">
                                    <form action="/saveForLater/moveToCart/{{$item->rowId}}" method="POST">
                                        {{csrf_field()}}
                                        <button class="btn btn-primary"> Move to Cart </button>
                                    </form> 
                                    <br>
                                    <form action="/saveForLater/{{$item->rowId}}" method="POST">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-danger"> Delete </button>
                                    </form> 
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                @else
                
                <h1>You have no items Save For Later!</h1>

                @endif

    </div>
</div>
        
@endsection