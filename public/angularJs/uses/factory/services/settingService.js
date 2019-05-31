ngApp.factory('$settingService', function ($http, $httpParamSerializer){

    var service = {
        action: {},
        data: {}
    };

    service.data.filter = function (freetext, page) {
        return {
            freetext: freetext || '',
            page: page || 1
        };
    };

    service.action.getSetting = function (type) {
        var url = SiteUrl + "/rest/admin/setting?" + $httpParamSerializer(type);
        return $http.get(url);
    };


    service.action.insertSetting = function (params) {
        var url = SiteUrl + "/rest/admin/add-setting";
        return $http.post(url, params);
    };

    return service;
})
