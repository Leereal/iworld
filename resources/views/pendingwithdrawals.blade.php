@extends('layouts.sidebar')

@section('content')
<div class="row">
<div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-rose card-header-icon">
          <h4 class="card-title">My Pending Withdrawals</h4>          
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="">
                  <th>DATE</th>
                  <th>AMOUNT</th>
                  <th>PAYMENT METHOD</th>
                  <th>ACCOUNT</th>
                  <th>STATUS</th>
                </thead>
                <tbody> 
                  @foreach($withdrawals as $withdrawal) 
                  <tr>
                    <td>{{$withdrawal->created_at}}</td> 
                    <td>${{$withdrawal->amount}}</td>
                    <td>{{$withdrawal->bank->name}}</td>
                    <td>{{$withdrawal->account}}</td>
                    <td>
                      <button disabled class="btn btn-primary btn-sm btn-round"><i class="icon-check"></i> Pending..</button>
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
