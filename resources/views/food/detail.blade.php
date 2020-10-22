@extends('layouts.app')
@section('content')
   <div class="row justify-content-center">
       <div class="col-md-3 offset-1">
           <img width="200" height="155" src="../images/{{ $food->image }}" alt="">
       </div>
       <div class="col-md-8">
           <p class="text-center">
               {{ $food->name }}
               $<span>{{ $food->price }}</span>
           </p>
           <p class="text-center">
               {{ $food->description }}
           </p>
       </div>
   </div>
@endsection
