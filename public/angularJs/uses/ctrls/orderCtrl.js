ngApp.controller('orderCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $orderService, $apply) {

    $scope.data = {
        page: {}
    };

    $scope.filter = {
        freetext: ""
    };

    $scope.actions = {
        list: function () {

            var params = $orderService.data.filter($scope.filter.freetext, $scope.filter.status,
                                                    $scope.filter.start, $scope.filter.end, $scope.filter.long,
                                                    $scope.data.page.current_page);

            $orderService.action.list(params).then(function (resp) {
                if (resp) {
                    $scope.data.page  = resp.data;
                }
            }, function (error) {
            });
        },

        changePage: function (page) {
            $scope.data.page.current_page = page;
            $scope.actions.list();
        },

        delete: function ($id) {
            if ($id) {
                $myBootbox.confirm('Bạn muốn xóa tin tức này?', function (resp) {
                    if (resp) {
                        $orderService.action.delete($id).then(function (resp) {
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

        changeStatus: function ($id, event) {
            var status = {
                status: event || 0,
            };
            $orderService.action.changeStatus($id, status).then(function (resp) {
                if (resp) {
                    $myNotify.success('');
                }
            }, function (error) {
                $scope.actions.list();
            });
        },

        filter: function () {
            $scope.actions.list();
        }

    }

    $scope.actions.list();
});
