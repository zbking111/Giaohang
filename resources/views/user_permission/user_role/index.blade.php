@extends('Backend.Layouts.default')
@section ('title', '')
@section('content')
	<div class="content-wrapper">
		<div id="page-content">
		    <div class="card-body">
		    	<div class="col-sm-6">
			        <div class="card">
			            <div class="card-heading">
			            </div>
			            @php
							$roles = \App\Models\Role::all();
			            @endphp
			            <div class="card-body">
			            	<form action="{{ route('user-permission.store', $user->id) }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
			            		@csrf
			            		@method ('POST')
    			            	<p class="text-main text-bold mar-no">{{ trans('backend.user_role.premission') }}</p>
    			            	<select multiple="multiple" class="form-control selected-2" name="roles[]">
    		            	        @foreach ($roles as $key => $role)
    		            	        	@if ($role->name != config('roleper.superadmin'))
	    									<option @foreach ($user->roles as $user_role) 
		    										@if($role->id == $user_role->id)
		    											{{ 'selected' }} 
		    											@break 
		    										@endif 
												@endforeach
												value="{{ $role->id }}">
	    										{{ $role->display_name }}
	    									</option>
	    								@elseif (Auth::check() && Auth::user()->hasRole(config('roleper.superadmin'))
    		            	        		&& $role->name == config('roleper.superadmin'))
	    									<option @foreach ($user->roles as $user_role) 
		    										@if($role->id == $user_role->id)
		    											{{ 'selected' }} 
		    											@break 
		    										@endif 
												@endforeach
												value="{{ $role->id }}">
	    										{{ $role->display_name }}
	    									</option>
    		            	        	@endif 	
    		            	        @endforeach
    			            	</select>
    			            	<br>
    			            	@if ($errors->has('roles'))
	                            	<p class="text-left text-danger">{{ $errors->first('roles') }}</p>
	                            @endif
    			            	<br>
    			            	<div class="row">
    			            		<div class="col-sm-12">
    			            			<button type="submit" class="btn btn-primary btn-block">{{ trans('backend.actions.submit') }}</button>
    			            		</div>
    			            	</div>
			            	</form>
			            </div>
			           
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

