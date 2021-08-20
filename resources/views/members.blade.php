@extends('layouts.sidebar')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-rose card-header-icon">
          <h4 class="card-title">Members</h4>          
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="">
                  <th>ID</th>
                  <th>DATE JOINED</th>
                  <th>USERNAME</th>                  
                  <th>CELLPHONE</th>
                  <th>REFERRER</th> 
                  {{-- <th>STATUS</th> --}}
                </thead>
                <tbody> 
                  @foreach($members as $member)                  
                        <tr>
                          <td>{{$member->id}}</td> 
                            <td>{{$member->created_at}}</td> 
                            <td>{{$member->username}}</td>
                            <td>{{$member->cellphone}}</td>
                            <td>{{$member->referrer->username}}</td> 
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
