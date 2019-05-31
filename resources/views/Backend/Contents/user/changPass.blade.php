@extends('Backend.Layouts.default')
@section ('title', 'Thay đổi mật khẩu')
@section('content')
	<div class="content-wrapper">
		<div id="page-content">
		    <div class="card-body">
		        <div class="card">
		            <div class="card">
			            <div class="card-heading">
			               
			            </div>
			            <form action="{{ route('users.changePassword') }}" method="POST" enctype="multipart/form-data">
			            	@csrf
			            	@method ('POST')
			                <div class="card-body col-sm-offset-2">
			                    <div class="row">
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{!! trans('backend.user.password') !!} </label>
			                                <input type="password" name="password" class="form-control">
			                                @if ($errors->has('password'))
				                            	<p class="text-left text-danger">{{ $errors->first('password') }}</p>
				                            @endif
			                            </div>
			                        </div> 
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{!! trans('backend.user.confirm_password') !!} </label>
			                                <input type="password" name="confirm" class="form-control">
			                                @if ($errors->has('confirm'))
				                            	<p class="text-left text-danger">{{ $errors->first('confirm') }}</p>
				                            @endif
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

@section ('myJs')
	@if (Session::has('users') && Session::get('users') == 'success')
	<script>
		$.toast({
		    heading: 'Thành công',
		    showHideTransition: 'fade',
		    position: 'top-right',
		    icon: 'success'
		})
	</script>
	@endif
@endsection

@section ('myCss')
	
@endsection

