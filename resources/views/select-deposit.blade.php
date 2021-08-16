@extends('layouts.sidebar')

@section('content')
<div class="row">
    @if($deposits)
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Deposits Pending Approval
                </div>                
                <ul class="list-group">
                    @forelse($deposits as $deposit)
                        <li class="list-group-item"><span>Amount : {{$deposit->amount}}</span> <span>Method : {{$deposit->bank->name}}</span> <span class="label label-pill label-success">Pending</span></li>
                    @empty
                    @endforelse
                </ul>                
            </div>
        </div>
    </div>  
    @endif
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Choose Deposit Method</h4>
                </div>
                <form method="GET" action="/deposit-view"> 
                    @csrf               
                    <div class="col-12 flex-column justify-content-center align-items-center">
                        <div class="form-group">
                            <select class="form-control" name="bank" id="bank">
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="card-footer">
                        <button type="submit" class="btn mb-1 btn-primary">Continue<span class="btn-icon-right"><i class="fa fa-shopping-cart"></i></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tex-center">
        <img src="{{ asset('app_assets/images/processors.png')}}" alt="">
    </div>
</div>
@endsection
