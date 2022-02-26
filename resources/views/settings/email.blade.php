@extends('layouts.admin')

@section('title', "Email")
    
@section('content')
<div class="rata-tengah">
    <div class="tinggi-40"></div>
    <div class="bagi lebar-70 bg-putih rounded bayangan-5 smallPadding rata-kiri">
        <div class="wrap">
            {{ csrf_field() }}
            <div id="loading">loading...</div>
            <form id="form" class="d-none">
                <div class="bagi lebar-50">
                    <div class="mt-2">Host :</div>
                    <input type="text" class="box" id="MAIL_HOST" required>
                </div>
                <div class="bagi lebar-25">
                    <div class="mt-2">Port :</div>
                    <input type="number" class="box" id="MAIL_PORT" required>
                </div>
                <div class="bagi lebar-25">
                    <div class="mt-2">Encryption :</div>
                    <input type="text" class="box" id="MAIL_ENCRYPTION" required>
                </div>
                <div class="mt-3">Username :</div>
                <input type="text" class="box" id="MAIL_USERNAME" required>
                <div class="mt-3">Password :</div>
                <input type="text" class="box" id="MAIL_PASSWORD" required>

                <div class="bg-hijau-transparan rounded mt-4 p-3 d-none" id="notif">
                    Email setting has been saved
                </div>

                <button class="lebar-100 biru mt-4 rounded">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/base.js') }}"></script>
<script>
    let state = {};
    const init = () => {
        let req = post(`{{ env('BASE_URL') }}/api/settings/get`, {
            csrfToken: select("input[name='_token']").value,
            configs: ['MAIL_HOST','MAIL_PORT','MAIL_USERNAME','MAIL_PASSWORD','MAIL_ENCRYPTION']
        })
        .then(configs => {
            for (let cfg in configs) {
                state[cfg] = configs[cfg];
            }
            renderForm();
        })
    }
    init();

    const typing = (key, value) => {
        state[key] = value;
    }
    selectAll("input").forEach(inp => {
        inp.addEventListener('input', e => {
            let target = e.target;
            let key = target.getAttribute('id');
            state[key] = target.value;
        });
    });

    const renderForm = () => {
        select("#loading").classList.add('d-none');
        select("#form").classList.remove('d-none');
        select("#form #MAIL_HOST").value = state.MAIL_HOST;
        select("#form #MAIL_PORT").value = state.MAIL_PORT;
        select("#form #MAIL_ENCRYPTION").value = state.MAIL_ENCRYPTION;
        select("#form #MAIL_USERNAME").value = state.MAIL_USERNAME;
        select("#form #MAIL_PASSWORD").value = state.MAIL_PASSWORD;
    }

    select("#form").onsubmit = e => {
        let req = post(`{{ env('BASE_URL') }}/api/settings/set`, {
            configs: state
        })
        .then(res => {
            select("#notif").classList.remove('d-none');
            setTimeout(() => {
                select("#notif").classList.add('d-none');
            }, 2200);
        })
        return false;
        e.preventDefault();
    }
</script>
@endsection