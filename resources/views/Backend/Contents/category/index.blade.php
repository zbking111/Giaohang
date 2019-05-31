@extends('Backend.Layouts.default')
@section ('title', 'Địa điểm')
@section('content')
	<div class="content-wrapper" id="content-container" ng-controller="categoryCtrl">
		<div id="page-content">
		    <div class="card-body">
		        <div class="card">
		            <div class="card-body">
						<h4 class="card-title">
							<i class="fa fa-home"></i>
							Loại nhà > Danh sách
						</h4>
						<div class="row">
							<div class="col-sm-6 float-left">
								<a href="{{ route('categories.create') }}" id="demo-btn-addrow" class="btn btn-info">
									<i class="fa fa-plus-circle"></i> {!! trans('backend.actions.create') !!}
								</a>
							</div>
							<div class="col-sm-6 float-right">
								<div class="form-group col-sm-6 float-right">
									<input id="demo-input-search2" type="text" placeholder="{!! trans('backend.actions.search') !!}" class="form-control col-sm-
									8" autocomplete="off" ng-change="" ng-model="filter.freetext">
								</div>
							</div>
						</div>
		                <div class="table-responsive">
		                    <table id="category-table" class="table table-bordered table-striped">
		                        <thead>
		                            <tr>
		                            	<th class="text-center">
                            		        <input type="checkbox" ng-model="checker.btnCheckAll"
                            		        ng-click="actions.checkAll(data.categories)">
		                            	</th>
		                                <th class="text-center">#</th>
		                                <th class="sorting"
		                                ng-class="scope.filter.orderBy =='name' && filter.reverse ? 'sorting-desc' : 'sorting-asc' "
		                                ng-click="actions.orderBy('name')">{!! trans('backend.category.name') !!}</th>
		                                <th class="sorting"
		                                ng-class="scope.filter.orderBy =='status' && filter.reverse ? 'sorting-desc' : 'sorting-asc' "
		                                ng-click="actions.orderBy('status')">{!! trans('backend.status.status') !!}</th>
		                                <th>{!! trans('backend.category.action') !!}</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <tr ng-repeat="(key, category) in data.categories">
		                            	<td style="width: 50px" class="text-center">
                            		        <input type="checkbox" ng-model="checker.checkedAll[category.id]">
		                            	</td>
		                                <td style="width: 50px"  class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
		                                <td> @{{ actions.findParent(data.categories, category.depth) }} </td>
		                                <td>
		                                	<div class="badge badge-danger" ng-if="(category.status == '{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}')">
											{!! trans('backend.status.disable') !!}</div>

		                                	<div class="badge badge-success" ng-if="(category.status == '{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}')">
		                                	{!! trans('backend.status.available') !!}</div>
		                                </td>
		                                <td style="width: 100px">
		                                	<a href="{{ url('admin/categories') }}/@{{ category.id }}/edit" class="btn btn-outline-primary btn-sm" >
		                                		<i class="fa-lg ti-pencil-alt"></i>
		                                	</a>
		                                	<button class="btn btn-outline-danger btn-sm" ng-click="actions.delete(category.id)">
		                                		<i class="fa-lg ti-trash"></i>
		                                	</button>
		                                </td>
		                            </tr>
		                        </tbody>
		                    </table>
		                    <div class="text-center">
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
@endsection

@push ('myJs')
	<script src="{{ url('angularJs/uses/factory/services/categoryService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/categoryCtrl.js') }}"></script>

	@if (Session::has('status'))
		<script>
            $.toast({
                heading: 'Loại',
                text: '{{ Session::get('messages') }}',
                showHideTransition: 'fade',
                position: 'top-right',
                icon: '{{ Session::get('status') }}'
            })
		</script>
	@endif
@endpush
@push ('myCss')
@endpush

