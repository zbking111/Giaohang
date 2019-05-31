@extends('Backend.Layouts.default')
@section ('title', '')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.language.language') !!}</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">{{ isset($language) ? trans('backend.actions.update') : trans('backend.actions.create') }}</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel">
			            <div class="panel-heading">
			               	<div class="panel-heading">
				                <h3 class="panel-title text-main text-bold mar-no">
				                	<i class="ti-pencil"></i> {{ isset($language) ? trans('backend.actions.update') : trans('backend.actions.create') }}
				                </h3>
				            </div>
			            </div>
		                <div class="panel-body col-sm-offset-2">
		                	<!-- data-parsley-validate -->
		                	@if (isset($language))
								<form action="{{ route('languages.update', @$language->id) }}" method="POST" enctype="multipart/form-data" >
									@method ('PUT')
		                	@else
								<form action="{{ route('languages.store') }}" method="POST" enctype="multipart/form-data" >
									@method ('POST')
		                	@endif
		                		@csrf

    		                    <div class="row">
    		                        <div class="col-sm-10">
    		                            <div class="form-group">
    		                                <label class="control-label text-bold">{!! trans('backend.language.name') !!}
    		                                	<span class="text-danger">*</span>
    		                                </label>
    		                                <input type="text" name="name_display" class="form-control"
    		                                value="{{ @$language->name_display ? $language->name_display : @old('title') }}">
    		                                @if ($errors->has('name_display'))
    			                            	<p class="text-left text-danger">{{ $errors->first('name_display') }}</p>
    			                            @endif
    		                            </div>
    		                        </div>
    		                        <div class="col-sm-10">
    		                            <div class="form-group">
    		                                <label class="control-label text-bold">{!! trans('backend.language.code') !!}
    		                                	<span class="text-danger">*</span>
    		                                </label>
    		                                <input type="text" name="locale" class="form-control"
    		                                value="{{ @$language->locale ? $language->locale : @old('locale') }}">
    		                                @if ($errors->has('locale'))
    			                            	<p class="text-left text-danger">{{ $errors->first('locale') }}</p>
    			                            @endif
    		                            </div>
    		                        </div>

    		                        <div class="col-sm-10">
    		                            <div class="form-group">
    		                                <label class="control-label text-bold">{!! trans('backend.language.icon') !!}
    		                                	<span class="text-danger">*</span>
    		                                </label>
    		                                <input type="text" name="icon" class="form-control"
    		                                value="{{ @$language->icon ? $language->icon : @old('icon') }}">
    		                                @if ($errors->has('icon'))
    			                            	<p class="text-left text-danger">{{ $errors->first('icon') }}</p>
    			                            @endif
    		                            </div>
    		                        </div>

	                                <div class="col-sm-10"  style="margin-bottom: 15px;">
	                                    <div class="form-group has-feedback row">
	        	                            <label class="col-sm-3 control-label text-bold" style="padding-top: 10px;">{!! trans('backend.status.status') !!}</label>
	        	                            <div class="col-sm-7">
	        	                                <div class="radio">
	        	                                    <input id="AVAILABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}"
	        	                                    @if (statusAvailable(old('status')) || statusAvailable(old('status')))
														checked
	        	                                    @endif
	        	                                    checked
	        	                                    >
	        	                                    <label for="AVAILABLE"> {!! trans('backend.status.available') !!}</label>

	        	                                    <input id="DISABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}"
            	                                    @if (statusDisable(old('status')))
    													checked
            	                                    @endif>
	        	                                    <label for="DISABLE"> {!! trans('backend.status.disable') !!}</label>
	        	                                </div>
	        	                        	</div>
	                                	</div>
	                            	</div>
    		                    </div>
		                		<button type="submit" class="btn btn-primary btn-block btn-form-submit"><i class="ti-save"></i></button>
		                	</form>
		                </div>
			        </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section ('myJs')
	
@endsection

@section ('myCss')
	
@endsection

