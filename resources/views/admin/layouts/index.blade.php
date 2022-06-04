@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    @if($items->count() == 0)
                        <div class="card-body">
                            There is nothing here yet
                            <a href="{{route($create_route)}}" class="btn btn-primary">Create</a>
                        </div>
                    @else
                        <a href="{{route($create_route)}}" class="btn btn-primary">Create</a>
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            @foreach($headers as $head)
                            <th scope="col">{{$head}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                @foreach($item->getAttributes() as $attr)
                                    <th scope="row">{{$attr}}</th>
                                @endforeach
                                <th scope="row"><a href="{{route($update_route, $item)}}" class="btn btn-info">Update</tr>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
