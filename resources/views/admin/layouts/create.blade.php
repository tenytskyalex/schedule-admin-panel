@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form action="{{route($store_route)}}" method="post">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @csrf
                        @foreach($fields as $field)
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <label for="last-name">{{ucfirst($field)}}</label>
                                    <input type="text" name="{{$field}}" class="form-control" value="" placeholder="Input {{$field}}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                            @foreach($relations as $name => $values)
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="last-name">{{ucfirst($name)}}</label>
                                            <select class="form-select" name="{{$name}}">
                                                @foreach($values as $value)
                                                    <option value="{{$value->id}}">{{$value->getNameForForm()}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                    <button class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
