@extends('layouts.admin')
@section('title', "Add New Page")
    
@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        <form action="{{ env('REMOTE_URL') }}/api/page/store" method="POST" id="form">
            {{ csrf_field() }}
            <div class="mt-2">Title :</div>
            <input type="text" class="box" id="title" name="title" required>
            <div class="mt-2 mb-2">Content :</div>
            <textarea name="body" id="body" required></textarea>
            <button class="mt-3 biru lebar-100 rounded">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.editorConfig = config => {
        config.height = 400;
    }
    CKEDITOR.replace('body');

    select("#form").onsubmit = function (e) {
        let title = select("#title").value;
        let body = select("#body").value;
        
        post("{{ env('REMOTE_URL') }}/api/page/store", {
            title: title,
            body: body,
        })
        .then(res => {
            if (res.status == 200) {
                window.location = "{{ route('page') }}";
            }
        })
        e.preventDefault();
        return false;
    }
</script>
@endsection