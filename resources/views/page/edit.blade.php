@extends('layouts.admin')
@section('title', "Editing " . $page->title)
    
@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        <form action="{{ env('REMOTE_URL') }}/api/page/store" method="POST" id="form">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id" value="{{ $page->id }}">
            <div class="mt-2">Title :</div>
            <input type="text" class="box" id="title" name="title" value="{{ $page->title }}" required>
            <div class="mt-2 mb-2">Content :</div>
            <textarea name="body" id="body" required>{{ $page->body }}</textarea>
            <button class="mt-3 biru lebar-100 rounded">Update</button>
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
        let id = select("#id").value;
        let title = select("#title").value;
        let body = CKEDITOR.instances['body'].getData();
        
        post("{{ env('REMOTE_URL') }}/api/page/update", {
            id: id,
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