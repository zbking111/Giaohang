@extends('Backend.Layouts.default')
@section ('title', '')
@section('content')
	<div class="content-wrapper">
		<div id="page-content">
		    <div class="card-body">
		        <div class="card">
					@if (!isset($role))
						<form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
							@method ('POST')
					@else
						<form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
							@method ('PUT')
					@endif
						@csrf
						<div class="card-body col-sm-offset-2">
							<div class="row">
								<div class="col-sm-10">
									<div class="form-group">
										<label class="control-label">{{ trans('backend.user_role.name') }}</label>
										<input type="text" name="name" class="form-control"
										value="{{ old('name') ? old('name') : @$role->name }}">
										@if ($errors->has('name'))
											<p class="text-left text-danger">{{ $errors->first('name') }}</p>
										@endif
									</div>
								</div>
								<div class="col-sm-10">
									<div class="form-group">
										<label class="control-label">{{ trans('backend.user_role.display_name') }}</label>
										<input type="text" name="display_name" class="form-control"
										value="{{ old('display_name') ? old('display_name') : @$role->display_name }}">
										@if ($errors->has('display_name'))
											<p class="text-left text-danger">{{ $errors->first('display_name') }}</p>
										@endif
									</div>
								</div>

								<div class="col-sm-10">
									<div class="form-group">
										<label class="control-label">{{ trans('backend.user_role.desciption') }}</label>
										<input type="text" name="description" class="form-control"
										 value="{{ old('description') ? old('description') : @$role->description }}">
										@if ($errors->has('description'))
											<p class="text-left text-danger">{{ $errors->first('description') }}</p>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-10">
									<button type="submit" class="btn btn-primary btn-block">{{ trans('backend.user_role.submit') }}</button>
								</div>
							</div>
						</div>
					</form>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section ('myJs')
	
@endsection

@section ('myCss')
	
@endsection

