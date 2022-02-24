@extends('layouts.auth')

@section('title', "Login")
    
@section('content')
<h2>Log in to your account</h2>
<div class="teks-kecil teks-transparan">Enter your username & password to login</div>

<form action="{{ route('admin.login') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="r" value="{{ $request->r }}">
    @if ($message != "")
        <div class="bg-hijau-transparan rounded p-2 mt-2">
            {{ $message }}
        </div>
    @endif
    @if ($errors->count() != 0)
        @foreach ($errors->all() as $err)
            <div class="bg-merah-transparan rounded p-2 mt-2">
                {{ $err }}
            </div>
        @endforeach
    @endif
    <div class="mt-2">Email :</div>
    <input type="email" class="box" name="email" required>
    <div class="mt-2">Password :</div>
    <input type="password" class="box" name="password" required>

    <button class="lebar-100 mt-3 biru">Login</button>
</form>
@endsection