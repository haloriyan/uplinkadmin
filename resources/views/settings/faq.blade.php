@extends('layouts.admin')

@section('title', "FAQ")

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
                        <th>Question</th>
                        <th>Answer</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faqs as $faq)
                        <tr>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td>
                                <span class="btn btn-sm btn-success" onclick="edit('{{ $faq }}')">
                                    <i class="bx bx-edit"></i>
                                </span>
                                <a href="{{ route('faq.delete', $faq->id) }}" onclick="return confirm('Are you sure to delete this item?')">
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

<button class="FAB biru" onclick="munculPopup('#addFaq')">
    <i class="bx bx-plus"></i>
</button>

<div class="bg"></div>
<div class="popupWrapper" id="addFaq">
    <div class="popup">
        <div class="wrap">
            <h3>Add New Item
                <i class="bx bx-x pointer ke-kanan" onclick="hilangPopup('#addFaq')"></i>
            </h3>
            <form action="{{ route('faq.store') }}" method="POST" class="wrap">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="question">Question :</label>
                    <input type="text" class="form-control mt-2" name="question" id="question" required>
                </div>
                <div class="form-group">
                    <label for="question" class="mt-2">Answer :</label>
                    <textarea name="answer" id="answer" class="form-control mt-2" style="height: 100px;"></textarea>
                </div>
                <button class="btn w-100 biru rounded mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="editFaq">
    <div class="popup">
        <div class="wrap">
            <h3>Edit Item
                <i class="bx bx-x pointer ke-kanan" onclick="hilangPopup('#editFaq')"></i>
            </h3>
            <form action="{{ route('faq.update') }}" method="POST" class="wrap">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="question">Question :</label>
                    <input type="text" class="form-control mt-2" name="question" id="question" required>
                </div>
                <div class="form-group">
                    <label for="question" class="mt-2">Answer :</label>
                    <textarea name="answer" id="answer" class="form-control mt-2" style="height: 100px;"></textarea>
                </div>
                <button class="btn w-100 biru rounded mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const edit = data => {
        data = JSON.parse(data);
        munculPopup("#editFaq");
        select("#editFaq #id").value = data.id;
        select("#editFaq #question").value = data.question;
        select("#editFaq #answer").value = data.answer;
    }
</script>
@endsection