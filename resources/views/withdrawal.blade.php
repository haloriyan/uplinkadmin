@extends('layouts.admin')

@section('title', "Withdrawal")

@section('content')
<section class="section dashboard">
    <div class="row">
    	<div class="col-lg-12">
        	<div class="row">
          		<div class="col-12">
            		<div class="card recent-sales overflow-auto">
						<div class="card-body p-3">
							<table class="table table-borderless datatable">
								<thead>
									<tr>
										<th scope="col">
											<input type="checkbox" name="check" id="check" />
										</th>
										<th scope="col">User</th>
										<th scope="col">Bank</th>
										<th scope="col">Amount</th>
										<th scope="col">Verification</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($datas as $item)
										<tr>
											<th scope="row"><input type="checkbox" name="check" id="check" /></th>
											<td>
												<img
													src="{{ env('BASE_URL') }}/storage/user_icon/{{ $item->user->icon }}"
													alt="Profile"
													class="rounded-circle"
													style="width: 25px; height: auto; margin-right: 10px"
												/>
												<span>{{ $item->user->name }}</span>
											</td>
											<td>
												{{ strtoupper($item->bank->bank_name) }}
												<div class="teks-kecil teks-transparan">{{ $item->bank->account_number }}</div>
											</td>
											<td>@currencyEncode($item->amount)</td>
											<td>
												<span class="badge {{ $item->status == 'paid' ? 'bg-success' : 'bg-warning' }}">{{ ucwords($item->status) }}</span>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- End Recent Sales -->
			</div>
		</div>
    </div>
</section>
@endsection