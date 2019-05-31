ngApp.controller('unitCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $unitService, $apply) {

    $scope.data = {
        page: {}
    };

    $scope.filter = {
        freetext: ""
    };

    $scope.actions = {
        list: function () {
            var params = $unitService.data.filter($scope.filter.freetext, $scope.data.page.current_page);
            $unitService.action.list(params).then(function (resp) {
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
                        $unitService.action.delete($id).then(function (resp) {
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
            $unitService.action.changeStatus($id).then(function (resp) {
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
