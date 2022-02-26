@extends('layouts.admin')

@section('title', "Customers")

@section('searchBar')
<div class="search-bar">
    <form class="search-form d-flex align-items-center">
        <input type="text" name="search" placeholder="Search customer by name" title="Search customer by name" value="{{ $request->search }}" />
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
</div>
@endsection

@section('content')

<section class="section dashboard">
    <div class="row">
        <div class="col-xl-4 col-md-8">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Most Loyal</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{ $mostValuableCustomer == null ? 0 : $mostValuableCustomer->name }}</h6>
                            <span class="text-muted teks-kecil">{{ $mostValuableCustomer->orders_count }}x Transactions</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-8">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Recent</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{ $recentCustomer->count() }}</h6>
                            <span class="text-muted teks-kecil">just registered this month</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-8">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{ $countCustomer }}</h6>
                            <span class="text-muted teks-kecil">customers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="tinggi-40"></div>

@if ($request->search != "")
    <h3>Looking for customer where match with "{{ $request->search }}",
        <a href="{{ route('user.customer') }}">
            <div class="teks-kecil bagi mt-1">remove search</div>
        </a>
    </h3>
@endif

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
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

<div class="rata-tengah mt-5">
    {{ $customers->links('pagination::bootstrap-4') }}
</div>
@endsection