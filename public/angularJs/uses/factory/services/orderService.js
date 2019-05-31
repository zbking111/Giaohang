ngApp.factory('$orderService', function ($http, $httpParamSerializer){

    var service = {
        action: {},
        data: {}
    };

    service.data.filter = function (freetext, status, start, end, long, page, perPage) {
        return params = {
            'freetext': freetext || '',
            'status': status,
            'start': start,
            'end': end,
            'long': long,
            'page': page || 1,
            'perPage': perPage || 20,
        };
    };


    service.action.list = function (params) {
        var url = SiteUrl + "/rest/admin/orders/?" + $httpParamSerializer(params);
        return $http.get(url);
    };

    service.action.delete = function ($id) {
        var url = SiteUrl + "/rest/admin/orders/" + $id;
        return $http.delete(url);
    };

    service.action.changeStatus = function ($id, status) {
        var url = SiteUrl + "/rest/admin/orders/status/" + $id + '?' + $httpParamSerializer(status);
        return $http.get(url);
    }

    return service;
})