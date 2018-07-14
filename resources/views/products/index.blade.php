@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <products-dashboard></products-dashboard>
        <!-- <div class="col-md-8">
            <ul>
                @foreach ($products as $product)
                    <li>{{ $product->title }}</li>
                @endforeach
            </ul>
        </div> -->
    </div>
</div>
@endsection
