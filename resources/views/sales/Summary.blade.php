@extends('layouts.admin')

@section('title', "Recent Sales")

@section('searchBar')
<div class="search-bar">
    <form class="search-form d-flex align-items-center">
        <input type="text" name="invoice" placeholder="Search with invoice number" title="Search with invoice number" value="{{ $request->search }}" />
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
</div>
@endsection
    
@section('content')
@if ($request->invoice != "")
    <div class="tinggi-40"></div>
    <h5>Displaying transactions with invoice number <b>{{ $request->invoice }}</b>,
        <a href="{{ route('sales') }}">
            <div class="teks-kecil bagi mt-1">remove search</div>
        </a>
    </h5>
@endif

<table>
    <thead>
        <tr>
            <th><i class="bi bi-menu-button-wide"></i></th>
            <th>Seller</th>
            <th>Buyer</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $item)
            @php
                $user = $item->user;
                $visitor = $item->visitor;
                $visitorName = $visitor->name != null ? $visitor->name : "Belum ada nama";
            @endphp
            <tr>
                <td>#{{ $item->invoice_number }}</td>
                <td>
                    <div class="bagi lebar-20">
                        <img 
                            src="{{ env('BASE_URL') }}/storage/user_icon/{{ $user->icon }}" 
                            alt="User Icon" title="{{ $user->name }}"
                            style="width: 50px;height: 50px;border-radius: 600px;margin-right: 15px"
                        />
                    </div>
                    <div class="bagi lebar-80">
                        {{ $user->name }}
                        <div class="teks-kecil teks-transparan">{{ "@".$user->username }}</div>
                    </div>
                </td>
                <td>
                    {{ $visitorName }}
                </td>
                <td>
                    @currencyEncode($item->grand_total)
                    <div class="teks-kecil teks-transparan">{{ $item->details->count() }} item</div>
                </td>
                <td>
                    <a href="{{ route('sales.detail', $item->id) }}">
                        <i class="bi bi-eye" style="font-size: 18px; color: #01b9c2"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="rata-tengah mt-5">
    {{ $orders->links('pagination::bootstrap-4') }}
</div>
@endsection