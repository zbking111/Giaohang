@extends('Backend.Layouts.default')
@section ('title', 'User')
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
	<div class="content-wrapper" ng-controller="userCtrl">
		<div id="page-content">
			<div class="card-body">
				<div class="card">
					<div class="card-heading">
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6 float-left">
								<a href="{{ route('users.create') }}" id="demo-btn-addrow" class="btn btn-info">
									<i class="fa fa-plus-circle"></i> {!! trans('backend.actions.create') !!}
								</a>
							</div>
							<div class="col-sm-6 float-right">
								<div class="form-group col-sm-6 float-right">
									
									<input id="demo-input-search2" type="text" placeholder="{!! trans('backend.actions.search') !!}" name="key" class="form-control col-sm-
									8" autocomplete="off" ng-change="actions.getAboutTeam()" ng-model="filter.freetext">
									<!-- <form action="{{route('user.search') }}" method="POST">
										{{ csrf_field() }}
										<button class="icon"><i class="fa fa-search"></i></button>
									<input type="text" name="search" placeholder="Search..">

									</form> -->
								</div>

							</div>
						</div>
						<div class="row">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
									<tr>
										<th class="text-center">#</th>
										<th>{!! trans('backend.user.name') !!}</th>
									<!-- 	<th>{!! trans('backend.user.email') !!}</th> -->
										<th>{!! trans('backend.user.phone') !!}</th>
										<th>{!! trans('Phạm vi hoạt động') !!}</th>
										<th>Ảnh đại diện</th>
										<th>{!! trans('backend.actions.actions') !!}</th>
									</tr>
									</thead>
									<tbody>
									<tr ng-repeat="(key, user) in data.page.data">
										<td class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
										<td>@{{ user.name }}</td>
									<!-- 	<td>@{{ user.email }}</td> -->
										<td>@{{ user.phone }}</td>
										<td>@{{ user.address }}</td>
										<td class="text-center">
		                                	<span>
		                                		<img class="img-sm rounded-circle" ng-src="{{ url('') }}/@{{  user.avatar }}" />
			                                </span>
										</td>
										<td style="width: 100px">
											<a class="btn btn-outline-primary btn-sm" href="{{ url('admin/users') }}/@{{ user.id }}/edit" title="{!! __('backend.actions.edit') !!}">
												<i class="fa-lg ti-pencil-alt"></i>
											</a>
											<a class="btn btn-outline-primary btn-sm" href="{{ url('admin/users/user-permission') }}/@{{ user.id }}" title="{!! __('backend.user.permission') !!}">
												<i class="fa-lg ti-user"></i>
											</a>
											<button class="btn btn-outline-danger btn-sm" ng-click="actions.delete(user.id)" title="{!! __('backend.actions.delete') !!}">
												<i class="fa-lg ti-trash"></i>
											</button>
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
	<script src="{{ url('angularJs/uses/factory/services/userService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/userCtrl.js') }}"></script>
	@if (Session::has('status'))
		<script>
            $.toast({
                heading: '{{ trans("backend.user.user") }}',
                text: '{{ Session::get("users") }}',
                showHideTransition: 'fade',
                position: 'top-right',
                icon: 'success'
            })
		</script>
	@endif
@endpush

@push ('myCss')
@endpush

