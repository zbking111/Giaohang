@extends('Backend.Layouts.default')
@section ('title', '')
@section('content')
	@php
		$per_gr = \App\Models\PermissionGroup::with('permissions')->get();
	@endphp
	<div class="content-wrapper">
		<div id="page-content">
			<div class="card">
				<div class="card-body">
					<div class="form-check">
						<label class="form-check-label">
						<input id="checkAll" type="checkbox" class="form-check-input"> {{ __('backend.roles.check_all') }} </label>
					</div>
				</div>
			</div>
			<form action="{{ route('roles-permission.store', @$role->id) }}" method="POST">
				@csrf
				@foreach (@$per_gr as $key => $gr)
					<div class="card mt-2">
						<div class="card-header" role="tab" id="headingOne">
							<h6 class="mb-0">
								<div class="form-check">
									<label class="form-check-label text-primary text-bold">
										<input type="checkbox" class="form-check-input" data-id="{{ @$gr->id }}" onclick="checkAllGr(this)">
										 {{ @$gr->display_name }}
									</label>
								</div>

							</h6>
						</div>
						<div id="collapseOne" class="collapse show">
							<div class="card-body">
								<div class="row">
									@foreach (@$gr->permissions as $key => $permission)
										<div class="col-sm-3 text-left">
											<div class="form-check">
												<label class="form-check-label">
													<input id="{{ @$permission->name }}" type="checkbox" name="permission[]"
														   class="form-check-input check-{{ @$gr->id }}"  value="{{ @$permission->id }}"
													@foreach (@$role->permission_role as $role_per)
														@if ($role_per->id == @$permission->id)
															{{ 'checked' }}
														@endif
													@endforeach> {{ $permission->display_name }}
												</label>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				@endforeach
				<div class="row">
					<div class="col-sm-12">
						<button type="submit" class="btn btn-primary save-form"><i class="fa fa-save"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection

@push ('myJs')
	<script src="{{ url('backend') }}/js/publishs/misc.js"></script>
	<script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        function checkAllGr(e) {
            var check = $(e).attr('data-id');
            $('.check-'+check).not(e).prop('checked', e.checked);
		}
	</script>
@endpush

@section ('myCss')
	
@endsection
