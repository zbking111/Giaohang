ngApp.factory('$categoryService', function ($http, $httpParamSerializer){

	var service = {
		action: {},
		data: {}
	};

	service.data.filter = function (freetext, orderName, orderBy , page, perPage) {
		return params = {
			'freetext': freetext || '',
			'orderName': orderName || 'id',
			'orderBy': orderBy || 'asc',
			'page': page || 1,
			'perPage': perPage || 20,
		}
	};

	service.action.getCategory = function (params) {
		var url = SiteUrl + "/rest/admin/categories?" + $httpParamSerializer(params);
        return $http.get(url);
	};

	service.action.deleteCategory = function ($id) {
		var url = SiteUrl + "/rest/admin/categories/" + $id;
        return $http.delete(url);
	};

	return service;
})