ngApp.controller('languageCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $languageService, $apply) {

	$scope.data = {
		languages: {},
		page: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getLanguage: function () {
			var params = $languageService.data.filter($scope.filter.freetext, $scope.data.page.current_page);
			$languageService.action.getLanguage(params).then(function (resp) {
				if (resp) {
					$scope.data.languages = resp.data.data;
					$scope.data.page  = resp.data;
					if ($scope.data.page.current_page > resp.data.last_page) {
						$scope.data.page.current_page = resp.data.last_page;
						$scope.actions.getLanguage();
					}
				}
			}, function (error) {
			})
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getAboutTeam();
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('Bạn có muốn xóa？', function (resp) {
					if (resp) {
					$languageService.action.deleteLanguage($id).then(function (resp) {
						if (resp) {
							$myNotify.success('Thành công!');
							$scope.actions.getLanguage();
						}
						}, function (error) {
							$myNotify.error('Thất bại!');
						})
					}
				})
			}
		},

		filter: function () {
			$scope.actions.getLanguage();
		}

	}

	$scope.actions.getLanguage();
});