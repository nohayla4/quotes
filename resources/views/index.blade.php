@extends('layouts.app')
@section('content')

    <div class="container border p-5 m-5 mx-auto text-center">
        <h1 class="text-gray pb-5">{{$breeds}}</h1>
       
        <div class="d-flex justify-content-center">

            @if (Auth::check()) 
            <form action="{{ url('/add', ['qt' => $breeds]) }}" method="POST">
                @csrf
                
                <button type="submit" class="btn btn-primary">Add to favorite</button>
                
            </form>
            
            @else
            
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <button type="submit" class="btn btn-primary">Add to favorite</button>
                    
                </form>
            
            @endif


            <a href="{{ route('home') }}" class="btn btn-primary ms-4">Refresh</a>
            
        </div>

        @if ($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                <li class="list-group-item text-danger pt-5">{{$error}}</li>
                @endforeach
            </ul>
        @endif

        <div class="container">
            @if(session()->has('status'))
                <h3 class="text-secondary fs-2 pt-5">
                    {{session()->get('status')}}
                </h3>
            @endif
        </div>


        <ul class="list-group   pt-5">
            @foreach ($quotes as $quote)
            <div class="d-flex justify-content-between pb-4">
                <li class="list-group-item p-1  w-100">{{$quote->content}}</li>

                <form method="POST" action="{{ route('quotes.destroy', ['quote' => $quote->id]) }}">
                    @csrf
                    @method('DELETE')
                                
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>                
            </div>
            @endforeach
        </ul>

    </div>


@endsection