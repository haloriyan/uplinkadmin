@extends('layouts.admin')

@section('title', "Profile")

@section('breadcrumb')
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="wrap">
    @if ($message != "")
        <div class="bg-hijau p-4 rounded mb-4">
            {{ $message }}
        </div>
    @endif
    @if ($errors->count() != 0)
        @foreach ($errors->all() as $err)
            <div class="bg-merah p-4 rounded mb-4">
                {{ $err }}
            </div>
        @endforeach
    @endif
    <div class="bg-putih rounded bayangan-5 smallPadding">
        <div class="wrap">
            <h4>Personal Information</h4>
            <form action="{{ route('profile.update') }}" method="POST" class="wrap">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="info">
                <div class="mt-2">Name :</div>
                <input type="text" class="box" name="name" required value="{{ $myData->name }}">
                <div class="mt-2">Email :</div>
                <input type="email" class="box" name="email" required value="{{ $myData->email }}">
    
                <button class="lebar-100 mt-4 biru rounded">Save Changes</button>
            </form>
        </div>
    </div>
    <div class="tinggi-50"></div>
    <div class="bg-putih rounded bayangan-5 smallPadding">
        <div class="wrap">
            <h4>Change Password</h4>
            <form action="{{ route('profile.update') }}" method="POST" class="wrap">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="password">
                <div class="mt-2">Old Password :</div>
                <input type="password" class="box" name="oldPassword" required>
                <div class="mt-2">New Password :</div>
                <input type="password" class="box" name="newPassword" required>
                <div class="mt-2">Re-type Password :</div>
                <input type="password" class="box" name="rePassword" required>
    
                <button class="lebar-100 mt-4 biru rounded">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection