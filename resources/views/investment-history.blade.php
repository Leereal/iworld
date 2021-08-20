@extends('layouts.sidebar')

@section('content')
<div class="row">
<div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-rose card-header-icon">
          <h4 class="card-title">My Investments</h4>          
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="">
                  <th>DATE</th>
                  <th>AMOUNT</th>
                  <th>PROFIT</th>
                  <th>BALANCE</th>
                  <th>PLAN</th>
                  <th>DUE</th>
                  <th>METHOD</th>
                  <th colspan="2" class="text-center">ACTION</th>
                  {{-- <th>STATUS</th> --}}
                </thead>
                <tbody> 
                  @foreach($investments as $investment) 
                  <tr>
                    <td>{{$investment->created_at}}</td> 
                    <td>${{$investment->amount}}</td>
                    <td>${{$investment->profit}}</td>
                    <td>${{$investment->balance}}</td>
                    <td>{{$investment->plan->name}}</td>
                    <td>{{$investment->due_date}}</td>
                    <td>{{$investment->bank->name}}</td>
                    <td>
                      @if($investment->status == 1)
                          <a href="withdraw/{{$investment->id}}"><button type="button" class="btn btn-success btn-sm btn-round"><i class="icon-plus"></i> Withdraw</button></a>                      
                      @else
                          <button disabled class="btn btn-primary btn-sm btn-round"><i class="icon-check"></i> Running..</button>
                      @endif 
                    </td>
                    <td>
                      <form action="/reinvest-user" method="POST">             
                        {{ csrf_field() }}
                        <input type="hidden" name="investment" value="{{$investment->id}}">
                      @if($investment->status == 1)
                          <button type="submit" onclick="confirm('Do you want to reinvest? If NO please click back button')" class="btn btn-success btn-sm btn-round"><i class="icon-plus"></i> Reinvest</button>                   
                      @endif 
                      </form>  
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
