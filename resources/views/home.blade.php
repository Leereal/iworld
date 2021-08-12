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
                                <div class="stat-digit gradient-3-text"><i class="fa fa-usd"></i>$0</div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar gradient-3" style="width: 50%;" role="progressbar"><span class="sr-only">100% Complete</span>
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
                                <div class="stat-digit gradient-4-text"><i class="fa fa-usd"></i>$0</div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar gradient-4" style="width: 40%;" role="progressbar"><span class="sr-only">100% Complete</span>
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
                                <div class="stat-digit gradient-4-text"><i class="fa fa-usd"></i> $0</div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar gradient-4" style="width: 15%;" role="progressbar"><span class="sr-only">100% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

@endsection

