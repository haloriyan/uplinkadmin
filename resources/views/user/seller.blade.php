@extends('layouts.admin')

@section('title', "Seller (Partner)")

@section('content')
<div class="bagi lebar-60">
    <input type="hidden" id="datas" value="{{ json_encode($sumCategories) }}">
    <div id="myChart" class="lebar-100"></div>
</div>
<div class="bagi lebar-40">
    <div class="wrap">
        <h5>Total Seller : {{ $userCategories->count() }}</h5>
        <div class="tinggi-10"></div>
        <h5>Most Valuable Seller : {{ $mostValuableSeller->name }}</h5>
        <div class="tinggi-10"></div>
        <h5>Latest Registered : {{ $recentSeller->name }}</h5>
    </div>
</div>

<div class="tinggi-50"></div>

<div class="bagi lebar-30">
    <div>Search by Category :</div>
    <select name="category" class="box" onchange="setCategory(this.value)">
        <option value="">SHOW ALL</option>
        @foreach ($sumCategories as $item)
            <option {{ $item['name'] == $request->category ? "selected='selected'" : "" }} value="{{ $item['name'] }}">{{ strtoupper($item['name']) }}</option>
        @endforeach
    </select>
</div>
<div class="bagi lebar-30"></div>
<form class="bagi lebar-40 mb-4 rata-kanan">
    <div>Search by name</div>
    <input type="text" class="box bagi lebar-95 mt-2" name="search" placeholder="Search by name" value="{{ $request->search }}">
    @if ($request->search != "")
        <a href="{{ route('user.seller') }}">
            <box-icon color="#e74c3c" name="x-circle" type="solid" class="bagi" style="margin-left: -35px;margin-top: 20px;"></box-icon>
        </a>
    @endif
</form>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            @php
                $categories = explode(",", $user->categories);
                $profilePicture = $user->icon == "default" || $user->icon == "default-icon.png" ? asset('images/default-icon.png') : env('BASE_URL')."/storage/user_icon/".$user->icon;
            @endphp
            <tr>
                <td>
                    <div class="bagi mr-2">
                        <img 
                            src="{{ $profilePicture }}"
                            style="width: 65px;height: 65px;border-radius: 900px;"
                        />
                    </div>
                    <div class="bagi">
                        <a href="https://uplink.id/{{ $user->username }}" class="teks-tebal teks-hitam" target="_blank">
                            {{ $user->name }}
                        </a>
                        <br />
                        @if ($user->categories != null)
                            @foreach ($categories as $category)
                                <div onclick="setCategory('{{ $category }}')" class="bagi bg-biru pointer rounded teks-kecil mt-1 mr-05 p-1 pl-2 pr-2">{{ strtoupper($category) }}</div>
                            @endforeach
                        @endif
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('user.seller.detail', $user->id) }}">
                        <i class="bi bi-eye" style="font-size: 18px; color: #01b9c2"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="rata-tengah mt-5">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
@endsection

@section('javascript')
<script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
<script>
    const select = dom => document.querySelector(dom);
    let cvs = select('#myChart');

    let chartData = JSON.parse(select("input#datas").value);
    let chart = {
        series: [],
        labels: []
    }
    chartData.map(data => {
        chart['series'].push(data.count);
        chart['labels'].push(data.name.toUpperCase());
    })

    let myChart = new ApexCharts(cvs, {
        chart: {
            type: 'donut'
        },
        series: chart.series,
        labels: chart.labels
    })
    myChart.render();

    const setCategory = category => {
        let url = new URL(document.URL);
        url.searchParams.set('category', category);
        window.location = url.toString();
    }
</script>
@endsection