@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            @foreach($categories as $category)
            <div class="col-md-12">
                <h2 class="text-primary">{{ $category->name }}</h2>
                <div class="jumbotron">
                    <div class="row">
                        @foreach($category->food as $food)
                        <div class="col-md-3">
                            <img width="200" height="155" src="images/{{ $food->image }}" alt="">
                            <p class="text-center">
                                {{ $food->name }}
                                $<span>{{ $food->price }}</span>
                            </p>
                            <p class="text-center">
                                <a class="btn btn-block btn-outline-success" href="{{ route('food.detail', [$food->id]) }}">More</a>
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

