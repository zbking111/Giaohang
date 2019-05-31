@extends('Frontend.Layouts.default')
@section('content')
    <section class="section-contact">
        <div class="container container-contact">
            <div class="row col-md-12 col-sm-12">
                <div class="col-md-7 col-sm-7 column-left">
                    <form action="{{ route('home.contact.post') }}" method="POST" style="width: 100%;">
                        @csrf
                        <div class="msg-text">
                            <h5><b>Gửi lời nhắn cho chúng tôi</b></h5>
                            <p class="text-muted">
                                Hãy cho chúng tôi biết nếu bạn có bất cứ câu hỏi,
                                thắc mắc, hài lòng hoặc không hài lòng với dịch vụ
                                của Transfast
                            </p>
                            @if (Session::has('actions'))
                                <p class="text-success">Gửi liên hệ đánh giá thành công</p>
                            @endif
                            <div class="form-group">
                                <label for="name">Họ và Tên</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control input-sm" id="name" placeholder="">
                                @if ($errors->has('name'))
                                    <p class="text-danger"> {{ $errors->first('name') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Địa chỉ E-mail</label>
                                <input type="text" value="{{ old('email') }}" name="email" class="form-control input-sm" id="email" placeholder="">
                                @if ($errors->has('email'))
                                    <p class="text-danger"> {{ $errors->first('email') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="mobile-number">Số điện thoại</label>
                                <input type="text" value="{{ old('phone') }}" name="phone" class="form-control input-sm" id="mobile-number" placeholder="">
                                @if ($errors->has('phone'))
                                    <p class="text-danger"> {{ $errors->first('phone') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="messages">Lời nhắn</label>
                                <textarea type="text" value="{{ old('messages') }}" name="messages" class="form-control input-sm" id="messages" placeholder="" rows="5"></textarea>
                                @if ($errors->has('messages'))
                                    <p class="text-danger"> {{ $errors->first('messages') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 text-right">
                                        <button type="submit" class="btn btn-default btn-sm sent-msg">Gửi Lời Nhắn</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection