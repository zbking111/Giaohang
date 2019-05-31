@extends('Backend.Layouts.default')
@section ('title', 'Tin tức mới')
@section('content')
    <div class="content-wrapper" ng-controller="settingCtrl">
        <div class="row" ng-enter="actions.saveContact()">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Cấu hình thông tin liên hệ
                                </h4>
                                <input type="hidden" name="type" value="{{ \App\Libs\Configs\StatusConfig::CONST_SETTING_CONTACT }}" class="form-control" >
                                <div class="form-group">
                                    <label for="phone">Tiêu đề</label>
                                    <input type="text" name="title" ng-model="data.title" class="form-control" id="phone">
                                </div>
                                <div class="form-group">
                                    <label for="keyword">Từ khóa</label>
                                    <input type="text" name="keyword" ng-model="data.keyword" class="form-control" id="keyword">
                                </div>
                                <div class="form-group">
                                    <label>
                                        Ảnh <span class="text-danger"> (*)</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="file-up-2">
                                            <div class="my-lfm file-up" data-input="main_image" data-preview="main_preview" type="'image'">
                                                <img id="main_preview" ng-src="{{ url('') }}/@{{ data.image }}" class="input-upload">
                                                <input id="main_image" class="form-control display-none" ng-model="data.image" type="text" name="image" value="{{ @old('image') ?? @$news->image }}">
                                            </div>
                                            <span class="fa fa-times-circle delete-lfm"></span>
                                        </div>
                                        @if ($errors->has('image'))
                                            <p class="text-left text-danger">{{ $errors->first('image') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả ngắn</label>
                                    <textarea class="form-control" ng-model="data.description" rows="3" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung</label>
                                    <textarea class="form-control" ng-model="data.content" rows="5" name="content"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary save-form"  ng-click="actions.saveSeo()"><i class="fa fa-save"></i></button>
    </div>
@endsection

@push ('myJs')
    <script>
        var type = '{{ \App\Libs\Configs\StatusConfig::CONST_SETTING_SEO_DEFAULT }}';
    </script>
    <script src="{{ url('angularJs/uses/factory/services/settingService.js') }}"></script>
    <script src="{{ url('angularJs/uses/ctrls/settingCtrl.js') }}"></script>
@endpush

@push ('myCss')
@endpush

