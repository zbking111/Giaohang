ngApp.factory('$userService', function ($http, $httpParamSerializer){

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

	service.action.getUser = function (params) {
		var url = SiteUrl + "/rest/admin/users?" + $httpParamSerializer(params);
        return $http.get(url);
	};

	service.action.deleteUser = function ($id) {
		var url = SiteUrl + "/rest/admin/users/" + $id;
        return $http.delete(url);
	};

	return service;
})