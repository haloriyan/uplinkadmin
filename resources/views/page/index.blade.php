@extends('layouts.admin')

@section('title', "Pages")

@section('head.dependencies')
<style>
    .item {
        border-bottom: 1px solid #ddd;
        padding: 15px 0px;
    }
    .item .title {
        font-size: 22px;
        font-family: PoppinsBold;
    }
    .item .slug {
        font-size: 14px;
        color: #555;
    }
    .item span {
        padding: 10px 20px;
        border-radius: 6px;
        margin-left: 10px;
    }
</style>
@endsection
    
@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        @foreach ($pages as $page)
            <div class="item">
                <div class="bagi lebar-80">
                    <h4 class="title">{{ $page->title }}</h4>
                    <div class="slug">/{{ $page->slug }}</div>
                </div>
                <div class="bagi rata-kanan lebar-20 pt-2">
                    <a href="{{ route('page.edit', $page->id) }}">
                        <span class="bg-hijau-transparan">
                            <i class="bx bx-edit"></i>
                        </span>
                    </a>
                    <span class="pointer bg-merah-transparan" onclick="del('{{ $page->id }}', this)">
                        <i class="bx bx-trash"></i>
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('javascript')
<script>
    const del = (id, btn) => {
        btn.innerHTML = `<i class="bx bx-loader-circle"></i>`;
        post("{{ env('REMOTE_URL') }}/api/page/delete", {
            id: id
        })
        .then(res => {
            if (res.status == 200) {
                window.location.reload();
            }
        });
    }
</script>
@endsection