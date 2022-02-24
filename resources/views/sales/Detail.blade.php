@extends('layouts.admin')

@section('title', "Sales Detail")

@php
function binders($product, $type, $toShow) {
    $glosarium = [
        'digital_product' => [
            'name' => 'name',
            'price' => 'price',
        ],
        'support' => [
            'name' => 'stuff',
            'price' => 'price_unit',
        ],
    ];
    return $product->{$glosarium[$type][$toShow]};
}
@endphp

@section('content')
<div class="bagi lebar-40 mt-4">
    <div class="wrap mt-0">
        <div class="bg-putih rounded bayangan-5 smallPadding">
            <div class="wrap">
                <h3>Summary</h3>
                <div class="tinggi-20"></div>
                <div class="bagi bagi-2">
                    <b>Seller</b>
                    <div>{{ $sale->user->name }}</div>
                </div>
                <div class="bagi bagi-2">
                    <b>Buyer</b>
                    <div>{{ $sale->visitor->name }}</div>
                </div>
                <div class="tinggi-20"></div>
                <div class="bagi bagi-2">
                    <b>Total</b>
                    <div>@currencyEncode($sale->grand_total)</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bagi lebar-60 mt-4">
    <div class="wrap mt-0">
        <div class="bg-putih rounded bayangan-5 smallPadding">
            <div class="wrap">
                <h3>Order Item(s)</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale->details as $item)
                            @php
                                $productType = $item->product_type;
                                $productTypePrefix = $item->product_type."_item";
                                $product = $item->{$productTypePrefix};
                            @endphp
                            <tr>
                                <td>{{ binders($product, $productType, 'name') }}</td>
                                <td>{{ $item->quantity }} x</td>
                                <td>@currencyEncode($item->total_price)</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 