@extends('layouts.sidebar')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-rose card-header-icon">
          <h4 class="card-title">Bonus Total : <span class="text-success">${{$total}}</span></h4>
            <form action="/bonus-payall" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="user" value="{{$user}}">                        
                <button type="submit" class="btn btn-success btn-sm btn-round" onclick="confirm('Are you sure you want to pay this?')"><i class="icon-plus"></i>PAY</button>
            </form>
            <form action="/bonus-invest" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="user" value="{{$user}}">                        
                <button type="submit" class="btn btn-info btn-sm btn-round" onclick="confirm('Are you sure you want to invest this?')"><i class="icon-plus"></i>INVEST</button>
            </form>           
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="">
                  <th>DATE</th>
                  <th>USERNAME</th>
                  <th>AMOUNT</th>
                  <th>INVESTMENT</th>
                  <th>DOWNLINER</th>
                  <th>STATUS</th>
                </thead>
                <tbody>  
                  @foreach($bonuses as $bonus) 
                    <tr>
                        <td>{{$bonus->created_at}}</td>
                        <td>{{$bonus->user->username}}</td> 
                        <td>${{$bonus->amount}}</td>
                        <td>${{$bonus->investment->amount ?? ''}}</td>
                        <td>{{$bonus->investment->user->username ?? ''}}</td>
                        <td>    
                            @if($bonus->status == 1) 
                                <form action="/bonus-pay" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="bonus" value="{{$bonus->id}}">                        
                                    <button type="submit" class="btn btn-success btn-sm btn-round" onclick="confirm('Are you sure you want to pay this?')"><i class="icon-plus"></i>PAY</button>
                                </form>
                            @else
                             <span class="badge badge-secondary">Paid</span>
                            @endif 
                        </td>
                    </tr>
                  @endforeach  
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
