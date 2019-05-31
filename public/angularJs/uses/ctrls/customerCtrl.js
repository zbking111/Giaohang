ngApp.controller('customerCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $customerService, $apply) {

    $scope.data = {
        page: {}
    };

    $scope.filter = {
        freetext: ""
    };

    $scope.actions = {
        list: function () {
            var params = $customerService.data.filter($scope.filter.freetext, $scope.data.page.current_page);
            $customerService.action.list(params).then(function (resp) {
                if (resp) {
                    $scope.data.page  = resp.data;
                }
            }, function (error) {
            })
        },

        changePage: function (page) {
            $scope.data.page.current_page = page;
            $scope.actions.list();
        },

        delete: function ($id) {
            if ($id) {
                $myBootbox.confirm('Bạn muốn xóa tin tức này?', function (resp) {
                    if (resp) {
                        $customerService.action.delete($id).then(function (resp) {
                            if (resp) {
                                $myNotify.success('');
                                $scope.actions.list();
                            }
                        }, function (error) {
                            $myNotify.error('');
                        });
                    }
                });
            }
        },

        changeStatus: function ($id) {
            $customerService.action.changeStatus($id).then(function (resp) {
                if (resp) {
                    $myNotify.success('');
                }
            }, function (error) {
                $apply(function () {
                    $scope.data.page = $scope.data.page;
                });
            });
        },

        filter: function () {
            $scope.actions.list();
        }

    }

    $scope.actions.list();
});
