@extends('layouts.sidebar')

@section('content')
<div class="row">
    @if(session()->has('message'))
        <div class="alert alert-success text-center">
            {{ session()->get('message') }}
        </div>
    @endif
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif    
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Send Your Deposit First</h4>
                </div>
                <form method="POST" action="/deposit" enctype="multipart/form-data"> 
                {{ csrf_field() }}           
                    <div class="col-12 flex-column justify-content-center align-items-center">
                        <div class="media-body">
                            <ul class="list-group">
                                <li class="list-group-item"><i class="icon-arrow-right-circle"></i> Login to your wallet (Luno, Trust, Blockchain, Coinbase,Skrill, or any of your choice)</li>
                                <li class="list-group-item"><i class="icon-arrow-right-circle"></i> Copy our account/address below. Copy it as it is please do not edit</li>
                                <li class="list-group-item"><i class="icon-arrow-right-circle"></i> Send the amount you want to invest</li>
                                <li class="list-group-item"><i class="icon-arrow-right-circle"></i> Take a screenshot and attach it on next step</li>
                            </ul>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item" aria-current="page">Address / Account:  {{$bank->account_number}}</li>
                                </ol>
                            </n av>                           
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="plan">Choose Plan</label>
                                <select class="form-control" name="plan" id="plan">
                                    @foreach($plans as $plan)
                                        <option value="{{$plan->id}}">{{$plan->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount (Must be in $ and do not put symbol)</label>
                                <input type="text" class="form-control input-rounded" name="amount" placeholder="Enter Amount" required>
                            </div>
                            <input type="hidden" name='payment_method' value="{{$bank->id}}">
                            <div class="form-group">
                                <input type="file" name="pop" required class="form-control-file">
                            </div>
                        </div>
                    </div> 
                    <div class="card-footer">
                        <button type="submit" class="btn mb-1 btn-success">Submit <span class="btn-icon-right"><i class="fa fa-check"></i></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
