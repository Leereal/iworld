@extends('layouts.sidebar')

@section('content')
<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-rose card-header-icon">
          <h4 class="card-title">All Deposits</h4>          
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="">
                  <th>DATE</th>
                  <th>USERNAME</th>                  
                  <th>AMOUNT</th>
                  <th>REFERRAL</th>
                  <th>INVESTMENT</th>                  
                  <th>ACTION</th>
                  {{-- <th>STATUS</th> --}}
                </thead>
                <tbody> 
                  @foreach($bonuses as $bonus) 
                  <form action="/bonus-pay" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="bonus" value="{{$bonus->id}}">
                        <tr>
                            <td>{{$bonus->created_at}}</td> 
                            <td><a href="user-bonus/{{$bonus->user->id}}">{{$bonus->user->username}}</td>
                            <td>${{$bonus->amount}}</td>
                            <td>{{$bonus->investment->user->username ?? ''}}</td>
                            <td>${{$bonus->investment->amount ?? ''}}</td>                                                       
                            <td>    
                              @if($bonus->status == 1)                         
                                    <button type="submit" class="btn btn-success btn-sm btn-round" onclick="confirm('Are you sure you want to mature this?')"><i class="icon-plus"></i> PAY?</button>
                                    @else
                                    <button disabled class="btn btn-primary btn-sm btn-round"><i class="icon-check"></i> Paid</button>
                                @endif 

                            </td>
                            {{-- <td>{{$investment->status}}</td>               --}}
                        </tr>
                  </form>
                  @endforeach   
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
