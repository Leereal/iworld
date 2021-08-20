@extends('layouts.sidebar')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Choose Deposit Method</h4>
                </div>
                <div>
                @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
  @endif
  @if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
    <div class="row">
        <div class="col-12">
            <h1>Reinvest All</h1>
            <form action="/reinvest-all" method="POST">
            {{ csrf_field() }}
                <button type="submit" onclick="confirm('Do you want to reinvest?')" class="btn btn-primary btn-lg btn-block">Reinvest All</button>
            </form>            
        </div>  
        <div class="col-12">
            <h1>Mature Investments</h1>
            <form action="/mature-all" method="POST">
            {{ csrf_field() }}
                <button type="submit" onclick="confirm('Do you want to mature all?')" class="btn btn-primary btn-lg btn-block">Mature All</button>
            </form>            
        </div>            
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
