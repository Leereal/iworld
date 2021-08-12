@extends('layouts.sidebar')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="stat-widget-one">
                            <div class="stat-content">
                                <div class="stat-text">Investments / Deposits</div>
                                <div class="stat-digit gradient-3-text"><i class="fa fa-usd"></i>0</div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar gradient-3" style="width: 100%;" role="progressbar"><span class="sr-only">100% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="stat-widget-one">
                            <div class="stat-content">
                                <div class="stat-text">Withdrawals</div>
                                <div class="stat-digit gradient-4-text"><i class="fa fa-usd"></i>0</div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar gradient-4" style="width: 100%;" role="progressbar"><span class="sr-only">100% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="stat-widget-one">
                            <div class="stat-content">
                                <div class="stat-text">Referral Bonus</div>
                                <div class="stat-digit gradient-4-text"><i class="fa fa-usd"></i> 0</div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar gradient-4" style="width: 100%;" role="progressbar"><span class="sr-only">100% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="card col-sm-12">
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

