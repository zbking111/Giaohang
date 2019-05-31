@extends('Backend.Layouts.default')
@section ('title','Tạo tài khoản mới')
@section('content')
	<div class="content-wrapper">
		<div id="page-content">
		    <div class="card-body">
		        <div class="card">
		            <div class="card">
			            <div class="card-heading">
			            </div>
			            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
			            	@csrf
			            	@method ('POST')
			                <div class="card-body col-sm-offset-2">
			                    <div class="row">
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{!! trans('backend.user.name') !!}</label>
			                                <input type="text" name="name" class="form-control">
			                                @if ($errors->has('name'))
				                            	<p class="text-left text-danger">{{ $errors->first('name') }}</p>
				                            @endif
			                            </div>
			                        </div> 
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{!! trans('backend.user.phone') !!}</label>
			                                <input type="text" name="phone" class="form-control">
			                                @if ($errors->has('phone'))
				                            	<p class="text-left text-danger">{{ $errors->first('phone') }}</p>
				                            @endif
			                            </div>
			                        </div>
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{!! trans('backend.user.email') !!}</label>
			                                <input type="text" name="email" class="form-control">
			                                @if ($errors->has('email'))
				                            	<p class="text-left text-danger">{{ $errors->first('email') }}</p>
				                            @endif
			                            </div>
			                        </div>
									<div class="col-sm-10">
										<div class="form-group">
											<label class="control-label">Phạm vi hoạt động</label>
											<input type="text" name="address" class="form-control">
											@if ($errors->has('address'))
												<p class="text-left text-danger">{{ $errors->first('address') }}</p>
											@endif
										</div>
									</div>
									@php
										$roles = \App\Models\Role::all();
									@endphp
									@permission('permission.add_role')
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{!! trans('backend.user.role') !!}</label>
											<select multiple="multiple" class="form-control selected-2" data-live-search="true" name="roles[]">
												@foreach ($roles as $key => $role)
													@if ($role->name != config('roleper.superadmin'))
														<option
																@if (isset($user))
																	@foreach ($user->roles as $user_role)
																		@if($role->id == $user_role->id)
																			{{ 'selected' }}
																			@break
																		@endif
																	@endforeach
																@endif
																value="{{ $role->id }}">
															{{ $role->display_name }}
														</option>
													@elseif (Auth::check() && Auth::user()->hasRole(config('roleper.superadmin'))
                                                        && $role->name == config('roleper.superadmin'))
														<option @if (isset($user))
																	@foreach ($user->roles as $user_role)
																		@if($role->id == $user_role->id)
																			{{ 'selected' }}
																			@break
																		@endif
																	@endforeach
																@endif
																value="{{ $role->id }}">
															{{ $role->display_name }}
														</option>
													@endif
												@endforeach
											</select>
											@if ($errors->has('roles'))
												<p class="text-left text-danger">{{ $errors->first('roles') }}</p>
											@endif
			                            </div>

			                        </div>
									@endpermission
			                    </div>

			                    <div class="row">
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                               	<div>
			                               		<span class="btn btn-primary btn-file">{!! trans('backend.user.chosse_avatar') !!} 
			                               			<input class="myRenderImage" type="file" name="avatar">
			                               		</span>
			                               		<div style="margin-top: 15px;">
			                               			<img id="blah" alt="true" src="{{ url('Nifty/img/profile-photos/1.png') }}" style="width: 140px; height: 150px;">
				                               	</div>
			                               </div>
			                            </div>
			                        </div>
			                        <div class="col-sm-10"  style="margin-bottom: 15px;">
			                            <div class="form-group has-feedback">
				                            <label class="col-lg-3 control-label" style="padding-top: 10px;">{!! trans('backend.status.status') !!}</label>
				                            <div class="col-lg-7">
				                                <div class="radio">
				                                    <input id="demo-radio-7" class="magic-radio" type="radio" name="status" value="AVAILABLE" data-bv-field="member" checked>
				                                    <label for="demo-radio-7">{!! trans('backend.status.available') !!} </label>
				
				                                    <input id="demo-radio-8" class="magic-radio" type="radio" name="status" value="DISABLE" data-bv-field="member">
				                                    <label for="demo-radio-8">{!! trans('backend.status.disable') !!} </label>
				                                </div>
				                        </div>
			                        </div>
			                    </div>
			                    <div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary btn-block save-form">
											<i class="ti-save"></i></button>
									</div>
			                    </div>
			                </div>
					   	</form>
			        </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@push ('myJs')
	<script src="{{ url('backend/js/publishs/') }}/select2.js"></script>
	<script>
        $(document).ready(function() {
            $('.selected-2').select2();
        });
	</script>
@endpush

@push ('myCss')

@endpush