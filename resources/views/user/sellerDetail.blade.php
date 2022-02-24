@extends('layouts.admin')

@section('title', "Seller Detail")

@php
    $profilePicture = $seller->icon == "default" || $seller->icon == "default-icon.png" ? 
        asset('images/default-icon.png')
    :
        env('BASE_URL')."/storage/user_icon/".$seller->icon;
@endphp

@section('head.dependencies')
<style>
    .profilePicture {
        width: 200px;
        height: 200px;
        border-radius: 900px;
        margin-bottom: 25px;
    }
</style>
@endsection

@section('content')
<div class="tinggi-20"></div>
<div class="bagi lebar-60 rata-tengah">
    <img src="{{ $profilePicture }}" class="profilePicture">
    <h3>{{ $seller->name }}</h3>
    <div class="teks-kecil mb-3">{{ "@".$seller->username }}</div>
    <p>{{ $seller->bio }}</p>
</div>
<div class="bagi lebar-40 bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap super">
        <h5>Customers : {{ $countCustomer }}</h5>
        <div class="tinggi-20"></div>
        <h5>Transactions : {{ $countTransaction }}</h5>
        <div class="tinggi-20"></div>
        <h5>Revenue : @currencyEncode($countRevenue)</h5>

        <div class="teks-kecil mt-4">*accumulated by all the time</div>
    </div>
</div>

<div class="tinggi-50"></div>
<h3 class="rata-tengah" style="font-weight: 800">Last five...</h3>
<div class="bagi bagi-2">
    <div class="wrap">
        <div class="bg-putih rounded bayangan-5 smallPadding">
            <div class="wrap">
                <b>Transaction</b>
                <table>
                    <thead>
                        <tr>
                            <th><i class="bx bx-notepad"></i></th>
                            <th><i class="bx bx-user"></i></th>
                            <th><i class="bx bx-wallet"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lastTransaction as $item)
                            <tr>
                                <td>#{{ $item->invoice_number }}</td>
                                <td>{{ $item->visitor->name }}</td>
                                <td>
                                    @currencyEncode($item->grand_total)
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="bagi bagi-2">
    <div class="wrap">
        <div class="bg-putih rounded bayangan-5 smallPadding">
            <div class="wrap">
                <b>Customer</b>
                <table>
                    <thead>
                        <tr>
                            <th><i class="bx bx-user"></i></th>
                            <th><i class="bx bx-envelope"></i></th>
                            <th><i class="bx bx-phone"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="rata-tengah mt-5">
    <a href="{{ route('user.seller') }}">
        <button class="lebar-40 border-biru rounded-more">
            back
        </button>
    </a>
    <a href="https://uplink.id/{{ $seller->username }}" target="_blank">
        <button class="bg-biru rounded-more lebar-40 ml-2">
            Visit Profile
        </button>
    </a>
</div>

<div class="tinggi-40"></div>
@endsection