@extends('layouts.admin')

@section('title', "Settings")

@php
    $categories = [];
    foreach ($settings as $key => $set) {
        if ($set->name == 'categories') {
            $categories = explode(",", $set->value);
        }
    }
@endphp

@section('content')
<div class="tinggi-15"></div>
<div class="bagi bagi-2">
    <div class="wrap">
        <div class="bg-putih rounded bayangan-5 smallPadding">
            <div class="wrap">
                <h3>Categories</h3>
                <input type="hidden" name="categories" id="categories" value="{{ json_encode($categories) }}">
                <div id="renderCategories"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/base.js') }}"></script>
<script>
    let categories = JSON.parse(select("#categories").value);
    categories.forEach(category => {
        createElement({
            el: 'div',
            attributes: [
                ['class', 'border-bottom lh-40']
            ],
            html: `${category}`,
            createTo: '#renderCategories'
        });
    })
</script>
@endsection