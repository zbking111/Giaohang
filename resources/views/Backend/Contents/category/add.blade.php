@extends('Backend.Layouts.default')
@section ('title', 'Tin tức mới')
@section('content')
	<div class="content-wrapper">
		@if (!isset($category))
			<form action="{{ route('categories.store') }}" method="POST">
		@else
			<form action="{{ route('categories.update', @$category->id) }}" method="POST">
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
										Loại >
										{{ isset($category) ? 'Cập nhật' : 'Tạo mới' }}
									</h4>
									<div class="form-group">
										<label for="name">Tiêu đề</label>
										<input type="text" name="name" class="form-control" value="{{ @old('name') ?? @$category->name }}" id="name">
										@if ($errors->has('name'))
											<p class="text-danger"> {{ $errors->first('name') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label class="control-label text-bold">
											{!! trans('backend.category.parent') !!}
											<span class="text-danger">*</span>

										</label>
										<select class="selectpicker js-example-basic-single" data-live-search="true" data-width="100%" name="parent_id">
											<option value="0">-- None --</option>
											{{ showCategories($categories, 0, "--", @$category->parent_id ? $category->parent_id : old('parent_id'),  @$category->id ? $category->id : '-1' ) }}
										</select>
										@if ($errors->has('parent_id'))
											<p class="text-left text-danger">{{ $errors->first('parent_id') }}</p>
										@endif
									</div>

									<div class="form-group">
										<label for="sorting">Trạng thái</label>
										<div class="form-radio form-radio-flat">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" value="0" name="status"
														{{ (@old('status') && old('status') == 0) ? 'checked' : (@$category->status == 0 ? 'checked' : '') }}>
												{{ __('backend.status.disable') }}
												<i class="input-helper"></i>
											</label>
										</div>
										<div class="form-radio form-radio-flat">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" name="status" value="1" @if (!isset($category)) checked @endif
														{{ (@old('status') && old('status') == 1) ? 'checked' : (@$category->status == 1 ? 'checked' : '') }} >
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
				<div class="col-md-6 d-flex align-items-stretch grid-margin">
					<div class="row flex-grow">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="form-group">
										<label for="seo_keyword">Seo từ khóa</label>
										<input type="text" name="seo_keyword" class="form-control" value="{{ @old('seo_keyword') ?? @$category->seo_keyword }}" id="seo_keyword">
										@if ($errors->has('seo_keyword'))
											<p class="text-danger"> {{ $errors->first('seo_keyword') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="seo_google">Seo google</label>
										<input type="text" name="seo_google" class="form-control" value="{{ @old('seo_google') ?? @$category->seo_google }}" id="seo_google">
										@if ($errors->has('seo_google'))
											<p class="text-danger"> {{ $errors->first('seo_google') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="seo_facebook">Seo facebook</label>
										<input type="text" name="seo_facebook" class="form-control" value="{{ @old('seo_facebook') ?? @$category->seo_facebook }}" id="seo_facebook">
										@if ($errors->has('seo_facebook'))
											<p class="text-danger"> {{ $errors->first('seo_facebook') }} </p>
										@endif
									</div>
									<div class="form-group">
										<label for="seo_description">Seo mô tả</label>
										<textarea class="form-control" rows="11" name="seo_description" id="seo_description">{{ @old('seo_description') ?? @$category->seo_description }}</textarea>
										@if ($errors->has('seo_description'))
											<p class="text-danger"> {{ $errors->first('seo_description') }} </p>
										@endif
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
	<script src="{{ url('backend/js/publishs/') }}/select2.js"></script>
@endpush

@push ('myCss')

@endpush

