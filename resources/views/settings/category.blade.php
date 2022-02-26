@extends('layouts.admin')

@section('title', "Categories")

@section('head.dependencies')
<style>
    #renderCategories .del {
        background-color: #fff;
        color: #e74c3c;
        margin-left: 5px;
        position: relative;
        top: -2px;
        display: none;
        width: 20px;
        line-height: 20px;
        text-align: center;
        font-size: 12px;
    }
    #renderCategories .item:hover .del {
        display: inline-block;
    }
    .box.special {
        width: 200px;
        border-radius: 900px;
        margin: 0px;
    }
    button.special {
        border-radius: 900px;
    }
</style>
@endsection

@section('content')
<div class="rata-tengah">
    <div class="tinggi-40"></div>
    <div class="bagi lebar-70 bg-putih rounded bayangan-5 smallPadding rata-kiri">
        <div class="wrap">
            {{ csrf_field() }}
            <div id="loading">loading...</div>
            <span id="renderCategories"></span>
            <form action="#" class="bagi" id="formAdd">
                <input type="text" class="box special" id="category" name="category" placeholder="hit enter to save category">
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
            configs: ['CATEGORIES']
        })
        .then(configs => {
            for (let cfg in configs) {
                state[cfg] = configs[cfg];
            }
            state['CATEGORIES'] = state['CATEGORIES'].split(',');
            console.log(state);
            render();
        })
    }
    init();

    const render = () => {
        select("#loading").classList.add('d-none');
        select("#renderCategories").classList.remove('d-none');
        select("#renderCategories").innerHTML = "";
        state.CATEGORIES.map(category => {
            let content = `${category} <div onclick="removeCat('${category}')" class='del rounded-max pointer'><span class='bx bx-trash'></span></div>`;
            if (category == 'Other') {
                content = category;
            }
            createElement({
                el: 'div',
                attributes: [
                    ['class', 'bagi bg-biru rounded-max mr-1 mb-3 item'],
                    ['style', 'padding: 10px 20px'],
                ],
                html: content,
                createTo: '#renderCategories'
            })
        });
    }

    const removeCat = category => {
        removeArray(category, state.CATEGORIES);
        render();
        saveData();
    }

    const saveData = () => {
        let categories = state.CATEGORIES.join(',');
        post("{{ env('BASE_URL') }}/api/settings/set", {
            configs: {
                CATEGORIES: categories
            }
        })
        .then(res => {
            console.log(res);
        })
    }

    select("#formAdd").onsubmit = e => {
        let inp = select("#formAdd #category");
        let total = state.CATEGORIES.length;
        let category = inp.value;
        state.CATEGORIES.splice((total - 1), 0, category);
        inp.value = '';
        render();
        saveData();
        
        return false;
        e.preventDefault();
    }
</script>
@endsection