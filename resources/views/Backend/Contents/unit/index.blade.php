@extends('Backend.Layouts.default')
@section ('title', 'Giá vận đơn')
@section('content')
	<div class="content-wrapper" ng-controller="unitCtrl">
		<div id="page-content">
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">
							<i class="fa fa-home"></i>
							Giá vận đơn> Danh sách
						</h4>
						@if (Auth::user()->is_customer == 0)
						<div class="row">
							<div class="col-sm-6 float-left">
								<a href="{{ route('units.create') }}" id="demo-btn-addrow" class="btn btn-info">
									<i class="fa fa-plus-circle"></i> {!! trans('backend.actions.create') !!}
								</a>
								<br>
								<br>
							</div>
							
							<!-- <div class="col-sm-6 float-right">
								<div class="form-group col-sm-6 float-right">
									<input id="demo-input-search2" type="text" placeholder="{!! trans('backend.actions.search') !!}" class="form-control col-sm-
									8" autocomplete="off" ng-change="" ng-model="filter.freetext">
								</div>
							</div> -->
						</div>
						@endif
						<div>
								<p class="text-danger">
                                            (*) Dưới 5km: đồng giá 25k <br>
                                            Trên 5km: mỗi km sau 5km đầu sẽ tính thêm Giá tiền
                                        </p>

							</div>
						<div class="row">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
									<tr>
										<th class="text-center">#</th>
										<th>Giá tiền/km</th>
										<th>Ngày thêm</th>
										<th>Người thêm</th>
										@if (Auth::user()->is_customer == 0)
										<th>Status</th>
										
										<th>Thao tác</th>
										@endif
									</tr>
									</thead>
									<tbody>
									<tr ng-repeat="(key, item) in data.page.data">
										<td class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
										<td>@{{ item.price }}</td>
										<td>@{{ item.created_at }}</td>
										<td>@{{ item.created_by.name }}</td>
										@if (Auth::user()->is_customer == 0)
										<td>
											<input ng-click="actions.changeStatus(item.status)" class="is-sw-checked" type="checkbox"
												   ng-checked="(item.status == '{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}')">
										</td>
										
										<td style="width: 100px">
											<a class="btn btn-outline-primary btn-sm" href="{{ url('admin/units') }}/@{{ item.id }}/edit" title="{!! __('backend.actions.edit') !!}">
												<i class="fa-lg ti-pencil-alt"></i>
											</a>
											<button class="btn btn-outline-danger btn-sm" ng-click="actions.delete(item.id)" title="{!! __('backend.actions.delete') !!}">
												<i class="fa-lg ti-trash"></i>
											</button>
										</td>
										@endif
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
	<script src="{{ url('angularJs/uses/factory/services/unitService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/unitCtrl.js') }}"></script>
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

