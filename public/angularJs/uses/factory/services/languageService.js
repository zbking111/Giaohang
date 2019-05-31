ngApp.factory('$languageService', function ($http, $httpParamSerializer){

	var service = {
		action: {},
		data: {}
	};

	service.data.filter = function () {

	};

	service.action.getLanguage = function () {
		var url = SiteUrl + "/rest/admin/languages";
        return $http.get(url);
	};

	service.action.deleteLanguage = function ($id) {
		var url = SiteUrl + "/rest/admin/languages/" + $id;
        return $http.delete(url);
	};

	return service;
})