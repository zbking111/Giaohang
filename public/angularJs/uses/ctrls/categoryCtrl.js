ngApp.controller('categoryCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $categoryService, $apply) {

	$scope.data = {
		categories: {},
		page: {},
	}
	$scope.filter = {
		freetext: "",
		orderBy: "",
		orderByCheck: '',
		order: false,
	}

	$scope.checker = {
		btnCheckAll: false,
		checkedAll: []
	}
	$scope.actions = {
		getCategory: function () {
			var params = $categoryService.data.filter($scope.filter.freetext, $scope.filter.orderName, $scope.filter.orderBy,
											 $scope.data.page.current_page, $scope.data.page.per_page);
			$categoryService.action.getCategory(params).then(function (resp) {
				if (resp) {
					$apply(function () {
						$scope.data.categories = resp.data;
					})
				}
			}, function (error) {
			})
		},

		findParent: function(array, depth) {
			var strDepth  = "";
			var arrDepth = depth.split("/");
            for (var index = 0; index < arrDepth.length; index++) {
            	for (var i = 0; i < Object.keys(array).length; i++) {
            		if (arrDepth[index] == array[i].id) {
            			strDepth = strDepth + ' >> ' + array[i].name;
            		}
            	}
                
            }
            return strDepth;
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getCategory();
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('Bạn có muốn xóa？', function (resp) {
					if (resp) {
					$categoryService.action.deleteCategory($id).then(function (resp) {
						if (resp) {
							$myNotify.success();
							$scope.actions.getCategory();
						}
						}, function (error) {
							$myNotify.error();
						})
					}
				})
			}
		},

		filter: function () {
			$scope.actions.getCategory();
		},

		orderBy: function(propertyName) {
			$scope.filter.order = ($scope.filter.orderName == propertyName) ? !$scope.filter.order : false;
			$scope.filter.orderName = propertyName;
			$scope.filter.orderBy = $scope.filter.order ? 'desc' : 'asc'
			$scope.actions.getCategory();
		},

		checkAll: function(data) {
			$apply(function () {
				angular.forEach(data, function(val, key){
					$scope.checker.checkedAll[val.id] = $scope.checker.btnCheckAll;
				});
				console.log($scope.checker.checkedAll);
			});
		}, 

		actionCheckAll: function () {
			var ids = [];
			angular.forEach($scope.data.checkPost, function(val, key){
				if(val == true) {
					ids.push(key);
				}
			});
			if (ids.length != 0 ) {
				var params = {
					ids: ids
				};
				$myBootbox.confirm('',function (resp) {
					if (resp) {
					$categoryService.action.deleteCategory($id).then(function (resp) {
						if (resp) {
							$myNotify.success('Thành công!');
							$scope.actions.getCategory();
						}
						}, function (error) {
							$myNotify.error('Thất bại!');
						})
					}
				})
			}
		}

	}

	$scope.actions.getCategory();
});