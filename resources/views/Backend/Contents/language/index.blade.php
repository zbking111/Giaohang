@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container" ng-controller="languageCtrl">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.language.language') !!}</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">{{ trans("backend.actions.list") }}</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel-heading">
		            </div>
		            <div class="panel-body">
		            	<div class="pad-btm form-inline">
				            <div class="row">
				                <div class="col-sm-6 table-toolbar-left">
				                   <a href="{{ route('languages.create') }}" id="demo-btn-addrow" class="btn btn-purple"><i class="demo-pli-add"></i> {!! trans('backend.actions.create') !!}</a>
				                </div>
				                <div class="col-sm-6 table-toolbar-right">
				                    <div class="form-group col-sm-12">
				                        <input id="demo-input-search2" type="text" placeholder="Tìm kiếm" class="form-control col-sm-
				                        8" autocomplete="off" ng-change="actions.filter()" ng-model="filter.freetext">
				                    </div>
				                </div>
				            </div>
				        </div>
		                <div class="table-responsive">
		                    <table class="table table-bordered table-hover table-vcenter">
		                        <thead>
		                            <tr>
		                                <th class="text-center">#</th>
		                                <th>{!! trans('backend.language.name') !!}</th>
		                                <th>{!! trans('backend.language.code') !!}</th>
		                                <th>{!! trans('backend.language.icon') !!}</th>
		                                <th>{!! trans('backend.status.status') !!}</th>
		                                <th>{!! trans('backend.language.actions') !!}</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <tr ng-repeat="(key, language) in data.languages">
		                                <td class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
		                                <td>@{{language.name_display}}</td>
		                                <td>@{{language.locale}}</td>
		                                <td><i class="@{{language.icon}}"></i></td>
		                                <td>
		                                	<span ng-if="(language.status == '{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}')"> {!! trans('backend.status.disable') !!}</span>

		                                	<span ng-if="(language.status == '{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}')"> {!! trans('backend.status.available') !!}</span>
		                                </td>
		                                <td style="width: 180px">
		                                	<a href="{{ url('admin/languages') }}/@{{ language.id }}/edit" class="btn btn-info btn-icon btn-sm" >
		                                		<i class="fa-lg ti-pencil-alt"></i> {!! trans('backend.actions.update') !!}
		                                	</a>
		                                	<button class="btn btn-danger btn-sm btn-icon" ng-click="actions.delete(language.id)">
		                                		<i class="fa-lg ti-trash"></i> {!! trans('backend.actions.delete') !!}
		                                	</button>
		                                </td>
		                            </tr>
		                        </tbody>
		                    </table>
		                    <div class="text-center"> 
			                    <div paging
			                      page="data.page.current_page"  
	    						  show-first-last="true"
			                      page-size="data.page.per_page" 
			                      total="data.page.total"
			                      paging-action="actions.changePage(page)">
			                    </div> 
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section ('myJs')
	<script src="{{ url('angularJs/uses/factory/services/languageService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/languageCtrl.js') }}"></script>
	@if (Session::has('languages') && Session::get('languages') == 'success')
	<script>
		$.toast({
		    heading: '{!! trans("backend.confirm.success") !!}',
		    heading: '{!! trans("backend.language.success_message") !!}',
		    showHideTransition: 'fade',
		    position: 'top-right',
		    icon: 'success'
		})
	</script>
	@endif
@endsection
@section ('myCss')
@endsection

