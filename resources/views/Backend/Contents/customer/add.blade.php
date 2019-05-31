@extends('Backend.Layouts.default')
@section ('title', 'Khách hàng')
@section('content')
	<div class="content-wrapper">
		@if (!isset($customer))
			<form action="{{ route('customers.store') }}" method="POST">
		@else
			<form action="{{ route('customers.update', @$customer->id) }}" method="POST">
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
										Khách hàng > {{ isset($customer) ? 'Cập nhật' : 'Tạo mới' }}
									</h4>
									<div class="form-group">
										<label for="code">Mã khách hàng <span class="text-danger"> (*)</span></label>
										<input type="text" name="code" class="form-control" value="{{ @old('code') ?? @$customer->code }}" id="code">
										@if ($errors->has('code'))
											<p class="text-danger"> {{ $errors->first('code') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="name">Tên khách hàng <span class="text-danger"> (*)</span></label>
										<input type="text" name="name" class="form-control" value="{{ @old('name') ?? @$customer->name }}" id="name">
										@if ($errors->has('name'))
											<p class="text-danger"> {{ $errors->first('name') }} </p>
										@endif
									</div>

									<div class="form-group">
										<label for="email">Email khách hàng</label>
										<input type="text" name="email" class="form-control" value="{{ @old('email') ?? @$customer->email }}" id="email">
										@if ($errors->has('email'))
											<p class="text-danger"> {{ $errors->first('email') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="phone">Số điện thoại <span class="text-danger"> (*)</span></label>
										<input type="text" name="phone" class="form-control" value="{{ @old('phone') ?? @$customer->phone }}" id="phone">
										@if ($errors->has('phone'))
											<p class="text-danger"> {{ $errors->first('phone') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="address">Địa chỉ </label>
										<input type="text" name="address" class="form-control" value="{{ @old('address') ?? @$customer->address }}" id="address">
										@if ($errors->has('address'))
											<p class="text-danger"> {{ $errors->first('address') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="sorting">Trạng thái</label>
										<div class="form-radio form-radio-flat">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" value="DISABLE" name="status"
														{{ (@old('status') && old('status') == 'DISABLE') ? 'checked' : (@$customer->status == 'DISABLE' ? 'checked' : '') }}>
												{{ __('backend.status.disable') }}
												<i class="input-helper"></i>
											</label>
										</div>
										<div class="form-radio form-radio-flat">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" name="status" value="AVAILABLE" @if (!isset($customer)) checked @endif
														{{ (@old('status') && old('status') == 'AVAILABLE') ? 'checked' : (@$customer->status == 'AVAILABLE' ? 'checked' : '') }} >
												{{ __('backend.status.available') }}
												<i class="input-helper"></i>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 mt-3">
							<div class="card">
								<div class="card-body">
									<div class="form-group">
										<label>
											Ảnh <span class="text-danger"> (*)</span>
										</label>
										<div class="input-group">
											<div class="file-up-2">
												<div class="my-lfm file-up" data-input="main_image" data-preview="main_preview" type="'image'">
													<img id="main_preview"
														 @if (@$customer->image || @old('image'))
														 src="{{ @old('image') ?? @$customer->image }}"
														 @else
														 src="/icon_add.png"
														 @endif class="input-upload">
													<input id="main_image" class="form-control display-none" type="text" name="image" value="{{ @old('image') ?? @$customer->image }}">
												</div>
												<span class="fa fa-times-circle delete-lfm"></span>
											</div>
											@if ($errors->has('image'))
												<p class="text-left text-danger">{{ $errors->first('image') }}</p>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 d-flex align-items-stretch grid-margin">
					<div class="row flex-grow">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="form-group">
										<label for="atm">ATM</label>
										<input type="text" name="atm" class="form-control" value="{{ @old('atm') ?? @$customer->atm }}" id="atm">
										@if ($errors->has('atm'))
											<p class="text-danger"> {{ $errors->first('atm') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="price">Giá tiền mỗi kiện hàng(VNĐ) <span class="text-danger"> (*)</span></label>
										<input type="text" name="price" class="form-control" value="{{ @old('price') ?? @$customer->price }}" id="price">
										@if ($errors->has('price'))
											<p class="text-danger"> {{ $errors->first('price') }} </p>
										@endif
									</div>
									<!-- <div class="form-group">
										<label for="company">Công ty</label>
										<input type="text" name="company" class="form-control" value="{{ @old('company') ?? @$customer->company }}" id="company">
										@if ($errors->has('company'))
											<p class="text-danger"> {{ $errors->first('company') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="company_phone">Số điện thoại công ty</label>
										<input type="text" name="company_phone" class="form-control" value="{{ @old('company_phone') ?? @$customer->company_phone }}" id="company_phone">
										@if ($errors->has('company_phone'))
											<p class="text-danger"> {{ $errors->first('company_phone') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="company_email">Email công ty</label>
										<input type="text" name="company_email" class="form-control" value="{{ @old('company_email') ?? @$customer->company_email }}" id="company_email">
										@if ($errors->has('company_email'))
											<p class="text-danger"> {{ $errors->first('company_email') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="company_address">Địa chỉ công ty</label>
										<input type="text" name="company_address" class="form-control" value="{{ @old('company_address') ?? @$customer->company_address }}" id="company_address">
										@if ($errors->has('company_address'))
											<p class="text-danger"> {{ $errors->first('company_address') }} </p>
										@endif
									</div> -->
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

