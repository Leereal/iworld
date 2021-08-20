@extends('layouts.sidebar')

@section('content')
<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-rose card-header-icon">
          <h4 class="card-title">My Bonus</h4>          
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="">
                  <th>DATE</th>
                  <th>AMOUNT</th>
                  <th>INVESTMENT</th>
                  <th>DOWNLINER</th>
                  {{-- <th>STATUS</th>           --}}
                </thead>
                <tbody>  
                  @forelse($bonuses as $bonus) 
                  <tr>
                    <td>{{$bonus->created_at}}</td> 
                    <td>${{$bonus->amount}}</td>
                    <td>${{$bonus->investment->amount ?? ''}}</td>
                    <td>{{$bonus->investment->user->username ?? ''}}</td>
                    {{-- <td>{{$bonus->status}}</td>              --}}
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
