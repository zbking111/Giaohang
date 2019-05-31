@extends('Backend.Layouts.default')
@section ('title', 'Tạo đơn hàng')
@section('content')
    <div class="content-wrapper" onload="initialize()">
        @if (!isset($customer))
            <form action="{{ route('orders.store') }}" method="POST">
        @else
            <form action="{{ route('orders.update', @$customer->id) }}" method="POST">
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
                                            Đơn hàng mới > {{ isset($customer) ? 'Cập nhật' : 'Tạo mới' }}
                                        </h4>
                                        <div class="form-group">
                                            <label for="name">Tên người nhận <span class="text-danger"> (*)</span></label>
                                            <input type="text" name="name" class="form-control" value="{{ @old('name') ?? @$customer->name }}" id="name">
                                            @if ($errors->has('name'))
                                                <p class="text-danger"> {{ $errors->first('name') }} </p>
                                            @endif
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="email">Email người nhận</label>
                                            <input type="text" name="email" class="form-control" value="{{ @old('email') ?? @$customer->email }}" id="email">
                                            @if ($errors->has('email'))
                                                <p class="text-danger"> {{ $errors->first('email') }} </p>
                                            @endif
                                        </div> -->
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại <span class="text-danger"> (*)</span></label>
                                            <input type="text" name="phone" class="form-control" value="{{ @old('phone') ?? @$customer->phone }}" id="phone">
                                            @if ($errors->has('phone'))
                                                <p class="text-danger"> {{ $errors->first('phone') }} </p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="COD">Số tiền thu hộ (VNĐ) </span></label>
                                            <input type="text" name="COD" class="form-control" value="{{ @old('COD') ?? @$customer->COD }}" id="COD">
                                            @if ($errors->has('COD'))
                                                <p class="text-danger"> {{ $errors->first('COD') }} </p>
                                            @endif
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
                                        <p class="text-danger">
                                            (*) Dưới 5km: đồng giá 25k <br>
                                            Trên 5km: mỗi km sau 5km đầu sẽ tính thêm {{ @$unit->price }}VNĐ

                                        </p>
                                        <div class="form-group">
                                            <label for="address1">Địa chỉ người nhận </label>
                                            <input type="text" name="address1" class="form-control" value="{{ @old('address1') ?? @$customer->address1 }}" id="address1">
                                            @if ($errors->has('address1'))
                                                <p class="text-danger"> {{ $errors->first('address1') }} </p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="address2">Địa chỉ lấy hàng</label>
                                            @php
                                                if (Auth::check()) {
                                                    $address2 = Auth::user()->address;
                                                }
                                            @endphp
                                            <input type="text" name="address2" class="form-control" value="{{ @old('address2') ?? (@$customer->address2 ?? $address2) }}" id="address2">
                                            @if ($errors->has('address2'))
                                                <p class="text-danger"> {{ $errors->first('address2') }} </p>
                                            @endif
                                        </div>
                                        <div  class="form-group date">
                                            <label for="date">Ngày lấy hàng chậm nhất</label>
                                            <input readonly type="text" name="date" class="form-control" value="{{ @old('date') ?? @$customer->date }}" id="date">
                                            @if ($errors->has('date'))
                                                <p class="text-danger"> {{ $errors->first('date') }} </p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Khoảng cách(km)<span class="text-danger"> (*)</span></label>
                                            <input type="text" readonly name="long" class="form-control" value="{{ @old('long') ?? @$customer->long }}" id="price">
                                            @if ($errors->has('long'))
                                                <p class="text-danger"> {{ $errors->first('long') }} </p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Giá tiền hàng (VNĐ)<span class="text-danger"> (*)</span></label>
                                            <input type="text" readonly name="price" class="form-control" value="{{ @old('price') ?? @$customer->price }}" id="price">
                                            @if ($errors->has('price'))
                                                <p class="text-danger"> {{ $errors->first('price') }} </p>
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
            <div id="map" style="width: 100%; height: 480px;"></div>
    </div>
@endsection

@push ('myJs')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy2pgHPUeNUzGCmQh5L0v3TwFMQN5no8A&callback=initialize"
            async defer></script>

    <script>

        if ($(".date").length) {
            $('.date').datepicker({
                enableOnReadonly: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            });
        }

        var geocoder;
        var map;
        var unit = '{{ str_replace(",", "", @$unit->price) }}';
        function initialize() {
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(21.005826, 105.843616);
            var mapOptions = {
                zoom: 12,
                center: latlng
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
        }
        function changePrice(data) {
            input = data ? parseInt( data, 10 ) : 0;
            return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
        }
        function codeAddress() {
            var address_1 = $(address1).val();
            var address_2 = $(address2).val();
            var location1, location2;
            if (geocoder)
            {
                geocoder.geocode( { 'address': address_1}, function(results, status)
                {
                    if (status == google.maps.GeocoderStatus.OK)
                    {
                        location1 = results[0].geometry.location;
                        map.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            title: "Địa chỉ nhận hàng"
                        });

                        geocoder.geocode( { 'address': address_2}, function(results, status)
                        {
                            if (status == google.maps.GeocoderStatus.OK)
                            {
                                location2 = results[0].geometry.location;
                                map.setCenter(results[0].geometry.location);
                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: results[0].geometry.location,
                                    title: "Địa chỉ giao hàng"
                                });
                                directionsService = new google.maps.DirectionsService();
                                directionsDisplay = new google.maps.DirectionsRenderer(
                                    {
                                        suppressMarkers: true,
                                        suppressInfoWindows: true
                                    });
                                directionsDisplay.setMap(map);
                                var request = {
                                    origin:location1,
                                    destination:location2,
                                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                                };
                                directionsService.route(request, function(response, status)
                                {
                                    if (status == google.maps.DirectionsStatus.OK)
                                    {
                                        directionsDisplay.setDirections(response);
                                        distance = "The distance between the two points on the chosen route is: "+response.routes[0].legs[0].distance.text;
                                        distance += "The aproximative driving time is: "+response.routes[0].legs[0].duration.text;
                                    }
                                });
                                calculateDistance();
                            } else
                            {
                                alert("Geocode was not successful for the following reason: " + status);
                            }
                        });
                    } else
                    {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
                var toRad = function(x) {
                    return x * Math.PI / 180;
                };
                function calculateDistance()
                {
                    try
                    {
                        var R = 6378137;
                        var dLat = toRad(location2.lat()-location1.lat());
                        var dLon = toRad(location2.lng()-location1.lng());
                        var dLat1 = toRad(location1.lat());
                        var dLat2 = toRad(location2.lat());
                        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                            Math.cos(dLat1) * Math.cos(dLat1) *
                            Math.sin(dLon/2) * Math.sin(dLon/2);
                        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                        var d = R * c;
                        var kmdistance = (d * 1.609344).toFixed(1)/1000;
                        if (kmdistance > 50) {
                            alert('Quá 50 km');
                        }

                        $('input[name="long"]').val(kmdistance);
                        if (kmdistance <= 5) {
                            $('input[name="price"]').val(changePrice(25000));
                        } else {
                            var total = 25000 + ((kmdistance - 5) * unit );
                            $('input[name="price"]').val(changePrice(total));
                        }

                    }
                    catch (error)
                    {
                        alert(error);
                    }
                }

            }
        }
        function address(address1, address2) {
            $(address1).change(function () {
                if ($(address2).val().length != 0 && $(address1).val().length != 0) {
                    initialize();
                    codeAddress();
                };
            });
        };

        address('input[name="address2"]', 'input[name="address1"]');
        address('input[name="address1"]', 'input[name="address2"]');

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
    </script>

@endpush

@section ('myCss')
@endsection

