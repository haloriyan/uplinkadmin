@extends('layouts.admin')

@section('title', "Dashboard")

@section('breadcrumb')
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Home</li>
    </ol>
</nav>
@endsection

@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="col-xl-4 col-md-8">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Revenue</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-wallet"></i>
                            </div>
                            <div class="ps-3">
                            <h6>@currencyEncode($revenueThisMonth)</h6>
                            <span class="text-muted teks-kecil">this month</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-8">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Seller</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{ $sellerThisMonth }}</h6>
                            <span class="text-muted teks-kecil">registered this month</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-8">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Customer</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{ $customerThisMonth }}</h6>
                            <span class="text-muted teks-kecil">registered this month</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="tinggi-40"></div>

<div class="bagi lebar-100">
    <div class="wrapss mt-0">
        <div class="bg-putih rounded bayangan-5 smallPadding">
            <div class="wrap">
                <h3>Seller Growth</h3>
                <div class="text-muted">last 6 months</div>
                <input type="hidden" id="sellerGrowthData" value="{{ json_encode($sellerGrowth) }}">
                <div id="sellerGrowth"></div>
            </div>
        </div>
    </div>
</div>
<div class="bagi lebar-100">
    <div class="wrapss mt-0">
        <div class="bg-putih rounded bayangan-5 smallPadding">
            <div class="wrap">
                <h3>Revenue Growth</h3>
                <div class="text-muted">last 6 months</div>
                <input type="hidden" id="revenueGrowthData" value="{{ json_encode($revenueGrowth) }}">
                <div id="revenueGrowth"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const select = dom => document.querySelector(dom);
    let sellerGrowthData = JSON.parse(select("input#sellerGrowthData").value);
    let revenueGrowthData = JSON.parse(select("input#revenueGrowthData").value);
    let sellerGrowth = {
        series: [],
        labels: []
    }
    let revenueGrowth = {
        series: [],
        labels: []
    }
    
    for (let key in sellerGrowthData) {
        sellerGrowth.labels.push(key);
        sellerGrowth.series.push(sellerGrowthData[key]);
    }
    for (let key in revenueGrowthData) {
        revenueGrowth.labels.push(key);
        revenueGrowth.series.push(revenueGrowthData[key]);
    }
    
    let sellerGrowthChart = new ApexCharts(select("#sellerGrowth"), {
        chart: {type: 'line'},
        series: [{data: sellerGrowth.series}],
        labels: sellerGrowth.labels,
    });
    sellerGrowthChart.render();

    let revenueGrowthChart = new ApexCharts(select("#revenueGrowth"), {
        chart: {type: 'line'},
        series: [{data: revenueGrowth.series}],
        labels: revenueGrowth.labels,
    });
    revenueGrowthChart.render();
</script>
@endsection