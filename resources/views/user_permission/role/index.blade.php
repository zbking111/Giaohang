@extends('Backend.Layouts.default')
@section ('title', 'Vai trò')
@section('content')
	<div class="content-wrapper">
		<div id="page-content">
		    <div class="card-body">
		        <div class="card">
		            <div class="card-body">
						<h4 class="card-title">
							<i class="fa fa-home"></i>
							{{ __('backend.role.label') }} >
							{{ __('backend.actions.list') }}
						</h4>
						<div class="row">
							<div class="col-sm-6 float-left">
								<a href="{{ route('roles.create') }}" id="demo-btn-addrow" class="btn btn-info">
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
		                	@php
		                		$roles = App\Models\Role::paginate(30);
		                	@endphp
		                    <table class="table table-bordered table-striped">
		                        <thead>
		                            <tr>
		                                <th class="text-center">#</th>
		                                <th>{{ trans('backend.role.code') }}</th>
		                                <th>{{ trans('backend.role.display_name') }}</th>
		                                <th>{{ trans('backend.role.desciption') }}</th>
		                                <th>{{ trans('backend.actions.actions') }}</th>
		                            </tr>
		                        </thead>
		                        <tbody>
	                            	@foreach ($roles as $key => $role) 
	                            	<tr>
		                                <td class="text-center"> {{ $key + 1 }} </td>
		                                <td>{{ $role->name }}</td>
		                                <td>{{ $role->display_name }}</td>
		                                <td>{{ $role->description }}</td>
		                                <td class="text-center" style="width: 150px;">
			                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
			                                	<a class="btn btn-sm btn-info btn-icon" title="update"  href="{{ route('roles.edit', $role->id) }}">
			                                		<i class="fa fa-edit icon-lg"></i>
			                                	</a>
			                                	@if ( Auth::check() && ($role->name != config('roleper.superadmin')) || 
			                                	(Auth::user()->hasRole(config('roleper.superadmin')) && $role->name == config('roleper.superadmin'))  )
			                                	<a class="btn btn-sm btn-warning" title="permission" 
			                                	href="{{ route('roles-permission.index', $role->id) }}"><i class="fa fa-key"></i></a>
			                                	@endif
			                                    @csrf
			                                    @method('DELETE')
			                                    <button type="submit" title="delete"  class="btn btn-sm btn-danger"><i class="fa fa-trash icon-lg"></i></button>
			                                </form>
			                            </td>
		                            </tr>
		                            @endforeach
		                        </tbody>
		                    </table>
		                    	{{ $roles->links() }}
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section ('myJs')
	@if (Session::has('role'))
	<script>
		$.toast({
		    heading: '{{ trans("backend.user_role.lable") }}',
		    text: '{{ Session::get("user_role") }}',
		    showHideTransition: 'fade',
		    position: 'top-right',
		    icon: 'success'
		})
	</script>
	@endif
@endsection

@section ('myCss')
	
@endsection

