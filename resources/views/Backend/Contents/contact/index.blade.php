@extends('Backend.Layouts.default')
@section('title','Đánh giá phản hồi')
@section('content')
    <div id="content-container" class="content-wrapper" ng-controller="contactCtrl">
        <div id="page-content">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-swap">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Nhận xét</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="(key, ct) in data.contact">
                                    <td class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1   }} </td>
                                    <td style="width: 150px">@{{ct.name}}</td>
                                    <td style="width: 150px">@{{ct.email}}</td>
                                    <td class="text-center">@{{ ct.phone }}</td>
                                    <td style="width: 450px" ng-bind-html="ct.message"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-center mt-3 float-right">
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

@push ('myJs')
    <script src="{{ url('angularJs/uses/factory/services/contactService.js') }}"></script>
    <script src="{{ url('angularJs/uses/ctrls/contactCtrl.js') }}"></script>


@endpush

@push ('myCss')

@endpush

