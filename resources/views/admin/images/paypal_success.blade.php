@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container">
    @include('errors')
      <!-- @if(isset($images)) -->
        <div class="alert alert-success">
            You have successfully purchased the items below:
        </div>
        <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Art Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($images as $img)
                    <tr>
                        <th scope="row">2</th>
                        <td> {{  $img['image']['name'] }} </td>       
                        <td> {{  $img['qty'] }} </td>       
                        <td> $ {{  $img['price'] }} </td> 
                    </tr>      
                @endforeach 
            </tbody>
        </table>
        </div>
        <!-- @endif -->
    </div>
@endsection