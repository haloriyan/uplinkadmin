@extends('layouts.admin')

@section('title', "Withdrawal")

@section('content')
<section class="section dashboard">
    <div class="row">
    	<div class="col-lg-12">
        	<div class="row">
          		<div class="col-12">
            		<div class="card recent-sales overflow-auto">
              			<div class="filter">
                			<a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                			<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  				<li class="dropdown-header text-start">
                    				<h6>Filter</h6>
                  				</li>
								<li><a class="dropdown-item" href="#">Today</a></li>
								<li><a class="dropdown-item" href="#">This Month</a></li>
								<li><a class="dropdown-item" href="#">This Year</a></li>
							</ul>
						</div>

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
									<tr>
										<th scope="row"><input type="checkbox" name="check" id="check" /></th>
										<td>
											<img
												src="https://media-exp1.licdn.com/dms/image/C4D03AQES3lFEdrZfOw/profile-displayphoto-shrink_100_100/0/1626272694982?e=1647475200&v=beta&t=GnYBffjmKjfP2tOtmoYWZ874m-4FkxVgQUH1aI2MKzI"
												alt="Profile"
												class="rounded-circle"
												style="width: 25px; height: auto; margin-right: 10px"
												/>
											<span>Maskurnia shidi</span>
										</td>
										<td><a href="#" class="text-primary">maskurshidi12@gmail.com</a></td>
										<td>Pay Monthly</td>
										<td>RP. 630.000</td>
										<td><span class="badge bg-danger">Rejected</span></td>
										<td>
											<div class="d-flex justify-content-evenly">
												<a>
													<i class="bi bi-eye" style="font-size: 18px; color: #01b9c2"></i>
												</a>
												<a>
													<i class="bi bi-trash" style="font-size: 18px; color: #e23647"></i>
												</a>
											</div>
										</td>
									</tr>
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