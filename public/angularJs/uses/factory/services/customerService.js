ngApp.factory('$customerService', function ($http, $httpParamSerializer){

    var service = {
        action: {},
        data: {}
    };

    service.data.filter = function (freetext, page, perPage) {
        return params = {
            'freetext': freetext || '',
            'page': page || 1,
            'perPage': perPage || 20,
        };
    };


    service.action.list = function (params) {
        var url = SiteUrl + "/rest/admin/customers/?" + $httpParamSerializer(params);
        return $http.get(url);
    };

    service.action.delete = function ($id) {
        var url = SiteUrl + "/rest/admin/customers/" + $id;
        return $http.delete(url);
    };

    service.action.changeStatus = function ($id) {
        var url = SiteUrl + "/rest/admin/customers/status/" + $id;
        return $http.get(url);
    }

    return service;
})