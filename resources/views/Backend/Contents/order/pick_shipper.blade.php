@extends('Backend.Layouts.default')
@section ('title', 'Chọn nhân viên')
@section('content')
    <div class="content-wrapper">
        <form action="{{ route('orders.pick.post', $order->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 d-flex align-items-stretch grid-margin">
                    <div class="row flex-grow">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="fa fa-home"></i>
                                       Đơn hàng mã {{ $order->code }} > Chọn nhân viên ship hàng
                                    </h4>
                                    @if ($order->status == 1)
                                        <p class="text-danger">
                                            Đơn hàng chưa được duyệt
                                        </p>
                                    @elseIf ($order->status == 3)
                                        <p class="text-danger">
                                            Đơn hàng đã được chuyên đi
                                        </p>
                                    @endif
                                    <div class="form-group">
                                        <label class="control-label text-bold">
                                            Chọn nhân viên giao hàng
                                            <span class="text-danger">*</span>

                                        </label>
                                        <select class="selectpicker js-example-basic-single" data-live-search="true" data-width="100%" name="shipper">
                                            @foreach ($staffs as $key => $staff)
                                                <option value="{{ $staff->id }}">
                                                    {{ $staff->name.' - ' }} 
                                                    @foreach ($staff->roles as $role)
                                                        {{ $role->display_name }}
                                                    @endforeach
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('parent_id'))
                                            <p class="text-left text-danger">{{ $errors->first('parent_id') }}</p>
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

@section ('myCss')
@endsection

