
 @extends('Backend.Layouts.default')
@section ('title', 'Đơn hàng')
@section ('page_header')
    <style> 
input[type=text] {
      width: 130px;
      box-sizing: border-box;
      border: 2px solid black;
      border-radius: 4px;
      font-size: 16px;
      background-color: white;
      background-image: url('searchicon.png');
      background-position: 10px 10px; 
      background-repeat: no-repeat;
      padding: 12px 20px 12px 40px;
      -webkit-transition: width 0.4s ease-in-out;
      transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 100%;
}
</style>
@endsection
@section('content')
    <div class="content-wrapper" ng-controller="orderCtrl">
        <div id="page-content">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="fa fa-home"></i>
                            Đơn hàng > Danh sách đơn hàng
                        </h4>
                        <div class="row">
                            <div class="col-sm-6 float-left">
                                <select class="form-control border-primary" ng-model="filter.status" ng-change="actions.list()">
                                    <option ng-value="">Tất cả</option>
                                    <option ng-value="1">Chưa được duyệt</option>
                                    <option ng-value="2">Đã được duyệt</option>
                                    <option ng-value="3">Đơn thành công</option>
                                </select>
                            </div>
                            <div class="col-sm-6 float-right">
                                <div class="form-group col-sm-6 float-right">
                                    <input id="demo-input-search2" type="text" placeholder="{!! trans('backend.actions.search') !!}" class="form-control col-sm-
                                    8" autocomplete="off" ng-change="actions.list" ng-model="filter.name">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 float-left">
                                <p class="card-description">Chọn ngày bắt đầu</p>
                                <div id="datepicker-popup" class="input-group date datepicker">
                                    <input type="text" class="form-control" name="start" ng-model="filter.start" ng-change="actions.list()">
                                </div>
                            </div>
                            <div class="col-sm-4 float-left">
                                <p class="card-description">Ngày kết thúc</p>
                                <div id="datepicker-popup" class="input-group date datepicker">
                                    <input type="text" class="form-control" name="end" ng-model="filter.end" ng-change="actions.list()">
                                </div>
                            </div>
                            <div class="col-sm-4 float-left">
                                <p class="card-description">Lọc theo km</p>
                                <select class="form-control border-primary" ng-model="filter.long" ng-change="actions.list()">
                                    <option ng-value="">Tất cả</option>
                                    <option ng-value="1">Lớn hơn 30km</option>
                                    <option ng-value="2">Nhỏ hơn 30km</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-swap">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th style="min-width: 170px">Status</th>
                                        <th>Mã</th>
                                        @if (Auth::user()->can('order.pick_shipper'))
                                            <th>Chọn shipper</th>
                                        @endif
                                        <th>Shipper</th>
                                        <th>Người nhận</th>
                                        <th>Địa chỉ </th>
                                        <th>SĐT</th>
                                        <th>Người gửi</th>
                                        <th>Địa chỉ</th>
                                        <th>SĐT</th>
                                        <th>Khoảng cách</th>
                                        <th>Giá</th>
                                        
                                        <th>Ngày lập đơn</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="(key, item) in data.page.data">
                                        <td class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
                                        @if (Auth::user()->is_customer == 0)
                                            @if (Auth::user()->can('order.approve') && Auth::user()->can('order.shipped'))
                                                <td style="min-width: 170px">
                                                    <select class="form-control border-primary" ng-model="item.status" ng-change="actions.changeStatus(item.id, item.status)">
                                                        <option ng-selected="(item.status == 1)" ng-value="1">Chưa được duyệt</option>
                                                        <option ng-selected="(item.status == 2)" ng-value="2">Đã được duyệt</option>
                                                        <option ng-selected="(item.status == 3)" ng-value="3">Đã hoàn thành</option>
                                                    </select>
                                                </td>
                                            @elseif (Auth::user()->can('order.approve'))
                                                <td ng-if="item.status == 3">
                                                    <label class="badge badge-success"  ng-if="(item.status == 3)">Đã hoàn thành</label>
                                                </td>
                                                <td style="min-width: 170px" ng-if="item.status != 3">
                                                    <select class="form-control border-primary" ng-model="item.status" ng-change="actions.changeStatus(item.id, item.status)">
                                                        <option ng-selected="(item.status == 1)" ng-value="1">Chưa được duyệt</option>
                                                        <option ng-selected="(item.status == 2)" ng-value="2">Đã được duyệt</option>
                                                    </select>
                                                </td>
                                            @elseif (Auth::user()->can('order.shipped'))
                                                <td style="min-width: 170px">
                                                    <select class="form-control border-primary" ng-model="item.status" ng-change="actions.changeStatus(item.id, item.status)">
                                                        <option ng-selected="(item.status == 1 || item.status == 2)" ng-value="2">Chưa hoàn thành</option>
                                                        <option ng-selected="(item.status == 3)" ng-value="3">Đã hoàn thành</option>
                                                    </select>
                                                </td>
                                            @endif
                                        @else
                                            <td>
                                                <label class="badge badge-warning" ng-if="(item.status == 1)">Chưa duyệt đơn</label>
                                                <label class="badge badge-info"  ng-if="(item.status == 2)">Đã được duyệt</label>
                                                <label class="badge badge-success"  ng-if="(item.status == 3)">Đã hoàn thành</label>
                                            </td>
                                        @endif
                                        <td>@{{ item.code }}</td>
                                        @if (Auth::user()->can('order.pick_shipper'))
                                            <td ng-if="item.status == 2">
                                                <a href="{{ url('admin/orders') }}/@{{ item.id }}/pick-shipper" class="btn btn-outline-primary btn-sm" >
                                                    <i class="fa-lg ti-pencil-alt"></i>
                                                </a>
                                            </td>
                                            <td ng-if="item.status == 1">
                                                Chưa duyệt
                                            </td>
                                            <td ng-if="item.status == 3">
                                                Đã giao
                                            </td>
                                        @endif
                                        <td>@{{ item.shipper.name }}</td>
                                        <td>@{{ item.name }}</td>
                                        <td>@{{ item.address1 }}</td>
                                        <td>@{{ item.phone }}</td>
                                        <td>@{{ item.user.name }}</td>
                                        <td>@{{ item.address2 }}</td>
                                        <td>@{{ item.user.phone }}</td>
                                        <td>@{{ item.long }} km</td>
                                        <td>@{{ item.price }}</td>
                                        
                                        <td>@{{ item.created_at }}</td>
                                        <td style="width: 100px">
                                            <a class="btn btn-outline-primary btn-sm" href="{{ url('admin/units') }}/@{{ item.id }}/edit" title="{!! __('backend.actions.edit') !!}">
                                                <i class="fa-lg ti-pencil-alt"></i>
                                            </a>
                                            <button class="btn btn-outline-danger btn-sm" ng-click="actions.delete(item.id)" title="{!! __('backend.actions.delete') !!}">
                                                <i class="fa-lg ti-trash"></i>
                                            </button>
                                        </td>
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
    </div>
@endsection

@push ('myJs')
    <script src="{{ url('angularJs/uses/factory/services/orderService.js') }}"></script>
    <script src="{{ url('angularJs/uses/ctrls/orderCtrl.js') }}"></script>
    @if (Session::has('status'))
        <script>
            $.toast({
                heading: 'Đơn hàng',
                text: '{{ Session::get("messages") }}',
                showHideTransition: 'fade',
                position: 'top-right',
                icon: '{{ Session::get("status") }}'
            })
        </script>
    @endif
@endpush

@push ('myCss')
@endpush

