@extends('layouts.admin')

@section('title', "Contact Message")

@php
    use Carbon\Carbon;
    $showConnector = false;
@endphp

@section('head.dependencies')
<style>
	.listMessage {
        background-color: #fff;
        border-radius: 6px;
        border: 1px solid #ddd;
        padding: 25px;
    }
    .listMessage .item { 
        border-bottom: 1px solid #ddd;
        padding: 15px 0px;
        position: relative;
    }
    .listMessage .item.active {
        border: 1px solid #ddd;
        border-radius: 6px;
        margin: 10px 0px;
        padding: 15px 25px;
    }
    .listMessage .item .connector {
        position: absolute;
        right: -40px;top: -1px;bottom: -1px;
        z-index: 3;
        background-color: #fff;
        width: 50px;
        border: 1px solid #ddd;
        border-left: none;
        border-right: none;
    }
    .listMessage a { color: #444; }
    .listMessage .item h4 {
        font-size: 20px;
        margin: 0px;
        margin-bottom: 6px;
        font-weight: bold;
    }
    .listMessage .item p { font-size: 14px;margin: 0px;color: #777; }
    .empty {
        flex-direction: column;
    }
    .empty .icon {
        font-size: 50px;
        margin-top: 50px;
    }
    .body {
        min-height: 500px;
    }
    .body pre {
        font-family: Arial;
        margin-top: 20px;
    }
</style>
@endsection
    
@section('content')
<section class="section dashboard">
    <div class="row">
    	<div class="col-lg-12">
        	<div class="row">
          		<div class="col-4 listMessage">
                    <form action="#">
                        <div class="teks-kecil">Search message sender :</div>
                        <input type="text" name="sender" class="box" placeholder="hit enter to search" value="{{ $request->sender }}">
                    </form>
                    @foreach ($messages as $item)
                        <a href="{{ route('admin.message', $item->id) }}">
                            <div class="item {{ $message != null && $item->id == $message->id ? 'active' : '' }}">
                                <h4>{{ $item->name }}
                                    <div class="ke-kanan teks-kecil teks-transparan">{{ Carbon::parse($item->created_at)->diffForHumans(null, true) }}</div>
                                </h4>
                                <p>{{ substr($item->message, 0, 25) }}</p>
                                @if ($message != null && $item->id == $message->id)
                                    @php
                                        $showConnector = true;
                                    @endphp
                                    <div class="connector"></div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                    @if ($showConnector == false && $message != null)
                        <div class="item {{ $message != null && $item->id == $message->id ? 'active' : '' }}">
                            <h4>{{ $message->name }}
                                <div class="ke-kanan teks-kecil teks-transparan">{{ Carbon::parse($message->created_at)->diffForHumans(null, true) }}</div>
                            </h4>
                            <p>{{ substr($message->message, 0, 25) }}</p>
                            <div class="connector"></div>
                        </div>
                    @endif
                    <div class="mt-3">
                        {{ $messages->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                <div class="col-8">
                    @if ($message != null)
                        <div class="bg-putih rounded bordered smallPadding body">
                            <div class="wrap">
                                <h3>{{ $message->name }}</h3>
                                <div class="teks-kecil teks-transparan">
                                    {{ $message->email }} -
                                    {{ $message->phone }}
                                </div>
                                <pre>{{ $message->message }}</pre>
                                <div class="teks-kecil teks-transparan border-top pt-2 mt-5">
                                    {{ Carbon::parse($message->created_at)->diffForHumans(null, true) }} ago<br />
                                    {{ Carbon::parse($message->created_at)->isoFormat('DD MMMM YYYY H:m') }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="rata-tengah empty">
                            <div class="icon teks-transparan bx bx-message-dots"></div>
                            <div class="teks-transparan mt-3">
                                See messages from customers
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection