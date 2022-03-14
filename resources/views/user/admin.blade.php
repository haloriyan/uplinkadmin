@extends('layouts.admin')

@section('title', "Super Administrator")

@section('head.dependencies')
<style>
    .FAB {
        width: 60px;
        height: 60px;
        position: fixed;
        bottom: 50px;right: 2.5%;
        background-color: #02a9f1;
        color: #fff;
        border-radius: 900px;
        font-size: 22px;
        align-items: center;
        display: flex;
        justify-content: center;
    }
</style>
@endsection

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
        <div class="col-md-12 bg-white p-4 bordered rounded">
            @if ($message != '')
                <div class="bg-hijau-transparan rounded p-3 mb-4">
                    {{ $message }}
                </div>
            @endif
            <table class="table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <span class="btn btn-sm btn-success" onclick="edit('{{ $admin }}')">
                                    <i class="bx bx-edit"></i>
                                </span>
                                <a href="{{ route('user.admin.delete', $admin->id) }}" onclick="return confirm('Are you sure to delete this admin?')">
                                    <span class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="bg"></div>
<div class="popupWrapper" id="addAdmin">
    <div class="popup">
        <div class="wrap">
            <h3>Add New Administrator
                <i class="bx bx-x ke-kanan pointer" onclick="hilangPopup('#addAdmin')"></i>
            </h3>
            <form action="{{ route('user.admin.store') }}" method="POST" class="wrap">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="mt-2" for="name">Name :</label>
                    <input type="text" class="form-control mt-2" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label class="mt-2" for="name">Email :</label>
                    <input type="email" class="form-control mt-2" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label class="mt-2" for="name">Password :</label>
                    <input type="password" class="form-control mt-2" name="password" id="password" required>
                </div>
                <button class="btn w-100 biru rounded mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="editAdmin">
    <div class="popup">
        <div class="wrap">
            <h3>Edit Administrator
                <i class="bx bx-x ke-kanan pointer" onclick="hilangPopup('#editAdmin')"></i>
            </h3>
            <form action="{{ route('user.admin.update') }}" method="POST" class="wrap">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label class="mt-2" for="name">Name :</label>
                    <input type="text" class="form-control mt-2" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label class="mt-2" for="name">Email :</label>
                    <input type="email" class="form-control mt-2" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label class="mt-2" for="name">Change Password :</label>
                    <input type="password" class="form-control mt-2" name="password" id="password">
                    <label class="teks-kecil text-muted">Keep it blank if not changing password</label>
                </div>
                <button class="btn w-100 biru rounded mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>

<button class="FAB biru" onclick="munculPopup('#addAdmin')">
    <i class="bx bx-plus"></i>
</button>
@endsection

@section('javascript')
<script>
    const edit = data => {
        data = JSON.parse(data);
        munculPopup('#editAdmin');
        select("#editAdmin #id").value = data.id;
        select("#editAdmin #name").value = data.name;
        select("#editAdmin #email").value = data.email;
    }
</script>
@endsection