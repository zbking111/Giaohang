@extends('Backend.Layouts.default')
@section ('title', 'Tin tức mới')
@section('content')
    <div class="content-wrapper" ng-controller="settingCtrl">
        <div class="row" ng-enter="actions.saveContact()">
            <div class="col-md-6 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Cấu hình thông tin liên hệ
                                </h4>
                                <input type="hidden" name="type" value="{{ \App\Libs\Configs\StatusConfig::CONST_SETTING_CONTACT }}" class="form-control" >
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" name="phone" ng-model="data.phone" class="form-control" id="phone">
                                </div>

                                <div class="form-group">
                                    <label for="fax">Fax</label>
                                    <input type="text" name="fax" ng-model="data.fax" class="form-control" id="fax">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" ng-model="data.email" class="form-control" id="email">
                                </div>

                                <div class="form-group">
                                    <label for="address">Địa chỉ công ty</label>
                                    <input type="text" name="address" ng-model="data.address" class="form-control" id="address">
                                </div>

                                <div class="form-group">
                                    <label for="work_time">Thời gian làm việc</label>
                                    <input type="text" name="work_time" ng-model="data.work_time" class="form-control" id="work_time">
                                </div>

                                <div class="form-group">
                                    <label for="copy_right">Copy right</label>
                                    <input type="text" name="copy_right" ng-model="data.copy_right" class="form-control" id="copy_right">
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả ngắn</label>
                                    <textarea class="form-control" ng-model="data.description" rows="5" name="description"></textarea>
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
                                <h4 class="card-title">
                                    Cấu hình mạng xã hội (Đường dẫn)
                                </h4>
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" name="facebook" ng-model="data.facebook" class="form-control" id="facebook">
                                </div>
                                <div class="form-group">
                                    <label for="google">Google</label>
                                    <input type="text" name="google" ng-model="data.google" class="form-control" id="google">
                                </div>
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" name="instagram" ng-model="data.instagram" class="form-control" id="instagram">
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" name="twitter" ng-model="data.twitter" class="form-control" id="twitter">
                                </div>
                                <div class="form-group">
                                    <label for="google_map">Google Map</label>
                                    <textarea class="form-control" ng-model="data.google_map" rows="5" name="google_map"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary save-form"  ng-click="actions.saveContact()"><i class="fa fa-save"></i></button>
    </div>
@endsection

@push ('myJs')
    <script>
        var type = '{{ \App\Libs\Configs\StatusConfig::CONST_SETTING_CONTACT }}';
    </script>
    <script src="{{ url('angularJs/uses/factory/services/settingService.js') }}"></script>
    <script src="{{ url('angularJs/uses/ctrls/settingCtrl.js') }}"></script>
@endpush

@push ('myCss')
@endpush

