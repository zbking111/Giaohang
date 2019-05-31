@extends('Backend.Layouts.default')
@section ('title', 'Giá vận đơn')
@section('content')
	<div class="content-wrapper">
		@if (!isset($unit))
			<form action="{{ route('units.store') }}" method="POST">
		@else
			<form action="{{ route('units.update', @$unit->id) }}" method="POST">
			@method('PUT')
		@endif
			@csrf
			<div class="row">
				<div class="col-md-6 d-flex align-items-stretch grid-margin">
					<div class="row flex-grow">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">
										<i class="fa fa-home"></i>
										Giá tiền mỗi kiện > Thêm mới
									</h4>
									<div class="form-group">
										<label for="price">Giá tiền mỗi kiện hàng(VNĐ) <span class="text-danger"> (*)</span></label>
										<input type="text" name="price" class="form-control" value="{{ @old('price') ?? @$unit->price }}" id="price">
										@if ($errors->has('price'))
											<p class="text-danger"> {{ $errors->first('price') }} </p>
										@endif
									</div>

									<div class="form-group">
										<label for="sorting">Trạng thái</label>
										<div class="form-radio form-radio-flat">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" value="0" name="status"
														{{ (@old('status') && old('status') == 0) ? 'checked' : (@$unit->status == 0 ? 'checked' : '') }}>
												{{ __('backend.status.disable') }}
												<i class="input-helper"></i>
											</label>
										</div>
										<div class="form-radio form-radio-flat">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" name="status" value="1" @if (!isset($unit)) checked @endif
														{{ (@old('status') && old('status') == 1) ? 'checked' : (@$unit->status == 1 ? 'checked' : '') }} >
												{{ __('backend.status.available') }}
												<i class="input-helper"></i>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary save-form"><i class="fa fa-save"></i></button>
		</form>
	</div>
@endsection

@push ('myJs')
	<script>

        $(document).ready(function (){
           	$('input[name="price"]').keyup(function (e) {
                	var selection = window.getSelection().toString();
                    if ( selection !== '' ) {
                        return;
                    }
                    var $this = $(this);
                    var input = $this.val();
                    var input = input.replace(/[\D\s\._\-]+/g, "");
                        input = input ? parseInt( input, 10 ) : 0;
                        $this.val( function() {
                            return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                        } );
			});
		});
	</script>
@endpush

@section ('myCss')
@endsection

