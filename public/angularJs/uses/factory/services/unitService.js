ngApp.factory('$unitService', function ($http, $httpParamSerializer){

    var service = {
        action: {},
        data: {}
    };

    service.data.filter = function (freetext, page) {
        return {
            freetext: freetext || '',
            page: page || 1
        }
    };  

    service.action.list = function (params) {
        var url = SiteUrl + "/rest/admin/units?" + $httpParamSerializer(params);
        return $http.get(url);
    };

    service.action.delete = function ($id) {
        var url = SiteUrl + "/rest/admin/units/" + $id;
        return $http.delete(url);
    };

    service.action.changeStatus = function ($id) {
        var url = SiteUrl + "/rest/admin/units/status/" + $id;
        return $http.get(url);
    }

    return service;
})