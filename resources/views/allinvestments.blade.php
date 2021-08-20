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
                  <th>BALANCE</th>
                  <th>PROFIT</th>
                  <th>PLAN</th>                  
                  <th>BANK</th>
                  <th>DUE DATE</th>
                  <th>ACTION</th>
                  {{-- <th>STATUS</th> --}}
                </thead>
                <tbody> 
                  @foreach($investments as $investment) 
                  <form action="/reinvest" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="investment" value="{{$investment->id}}">
                        <tr>
                            <td>{{$investment->created_at}}</td> 
                            <td>{{$investment->user->username}}</td>
                            <td>${{$investment->amount}}</td>
                            <td>${{$investment->balance}}</td>
                            <td>${{$investment->profit}}</td>
                            <td>{{$investment->plan->name}}</td>                    
                            <td>{{$investment->bank->name}}</td>
                            <td>{{$investment->due_date}}</td>
                            <td>
                                @if($investment->status == 101 && $investment->due_date < (date('Y-m-d H:i:s')))
                                    <button type="submit" class="btn btn-success btn-sm btn-round" onclick="confirm('Are you sure you want to mature this?')"><i class="icon-plus"></i> MATURE?</button>

                                @elseif($investment->status == 1)
                                <button type="submit" class="btn btn-info btn-sm btn-round" onclick="confirm('Are you sure you want to reinvest?')"><i class="icon-plus"></i> REINVEST</button>
                                
                                @else
                                    <button disabled class="btn btn-primary btn-sm btn-round"><i class="icon-check"></i> RUNNING...</button>
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
