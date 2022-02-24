@extends('layouts.admin')

@section('title', "Recent Sales")
    
@section('content')
<table>
    <thead>
        <tr>
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