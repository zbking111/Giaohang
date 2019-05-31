@extends('Backend.Layouts.default')
@section ('title', 'Khách hàng')
@section ('page_header')
	<style> 
input[type=text] {
	  width: 130px;
	  box-sizing: border-box;
	  border: 2px solid black;
	  border-radius: 4px;
	  font-size: 16px;
	  background-color: white;
	  background-image: url('searchicon.png');
	  background-position: 10px 10px; 
	  background-repeat: no-repeat;
	  padding: 12px 20px 12px 40px;
	  -webkit-transition: width 0.4s ease-in-out;
	  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 100%;
}
</style>
@endsection
@section('content')
	<div class="content-wrapper" ng-controller="customerCtrl">
		<div id="page-content">
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">
							<i class="fa fa-home"></i>
							Khách hàng > Danh sách
						</h4>
						<div class="row">
							<div class="col-sm-6 float-left">

							</div>
							<div class="col-sm-6 float-right">
								<div class="form-group col-sm-6 float-right">
									<input id="demo-input-search2" type="text" placeholder="{!! trans('backend.actions.search') !!}" class="form-control col-sm-
									8" autocomplete="off" ng-change="actions.list()" ng-model="filter.freetext">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
									<tr>
										<th class="text-center">#</th>
										<th>Mã</th>
										<th>Tên</th>
										<th>SĐT</th>
										<th>Địa chỉ</th>
										<th>ATM</th>
										<th>Khách VIP</th>
										<th>Status</th>
									</tr>
									</thead>
									<tbody>
									<tr ng-repeat="(key, item) in data.page.data">
										<td class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
										<td>@{{ item.code }}</td>
										<td>@{{ item.name }}</td>
										<td>@{{ item.phone }}</td>
										<td>@{{ item.address }}</td>
										<td>@{{ item.atm }}</td>
										<td>
											<label class="badge badge-warning" ng-if="(item.is_vip == 1)">Có</label>
											<label class="badge badge-info"  ng-if="(item.is_vip == 0)">Không</label>
										</td>
										<td>
											<input ng-click="actions.changeStatus(item.id)" class="is-sw-checked" type="checkbox"
												   ng-checked="(item.status == 'AVAILABLE')">
										</td>
									</tr>
									</tbody>
								</table>
								<div class="text-center mt-3 float-right">
									<div paging
										 page="data.page.current_page"
										 show-first-last="true"
										 page-size="data.page.per_page"
										 total="data.page.total"
										 paging-action="actions.changePage(page)">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push ('myJs')
	<script src="{{ url('angularJs/uses/factory/services/customerService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/customerCtrl.js') }}"></script>
	@if (Session::has('status'))
		<script>
			console.log('{{ Session::get("messages") }}', 123);
            $.toast({
                heading: 'Tin tức',
                text: '{{ Session::get("messages") }}',
                showHideTransition: 'fade',
                position: 'top-right',
                icon: '{{ Session::get("status") }}'
            })
		</script>
	@endif
@endpush

@push ('myCss')
@endpush

