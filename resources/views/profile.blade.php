@extends('layouts.sidebar')

@section('content')
<div class="row">
    <div class="col-lg-4 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center mb-4">
                    <img class="mr-3" src="{{ asset('app_assets/images/user/form-user.png')}}" width="80" height="80" alt="">
                    <div class="media-body">
                        <h3 class="mb-0">{{Auth::user()->username}}</h3>
                    </div>
                </div>
                <h4>About Me</h4>
                <p class="text-muted">I joined Pipsotrade {{Auth::user()->created_at}}</p>
                <ul class="card-profile__info">
                    <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>{{Auth::user()->cellphone}}</span></li>
                    <li><strong class="text-dark mr-4">Email</strong> <span>{{Auth::user()->email}}</span></li>
                </ul>
            </div>
        </div>  
    </div>
    <div class="col-lg-8 col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend"><span class="input-group-text">Referral Link</span>
                    </div>
                    <input type="text" id="reflink" value="{{Request::root().'/register/'.Auth::user()->username}}"  class="form-control">
                    <div class="input-group-append"><span class="input-group-text" onclick="copyLink()"><a href="">Copy</a></span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script>
        function copyLink() {
        /* Get the text field */
        var copyText = document.querySelector("#reflink");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        alert("Copied the Link: " + copyText.value);
        };
    </script>
</div>
@endsection
