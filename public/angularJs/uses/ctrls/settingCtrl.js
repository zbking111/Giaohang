ngApp.controller('settingCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $settingService, $apply) {

    $scope.data = {
        contact: {},
    };

    $scope.actions = {
        getSetting: function () {
            $params = { 'type':  type.trim() };
            $settingService.action.getSetting($params).then(function (resp) {
                $scope.data = resp.data.data;
            }, function (error) {
            });
        },

        saveContact: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'address': $scope.data.address || '',
                        'phone': $scope.data.phone || '',
                        'work_time': $scope.data.work_time || '',
                        'copy_right': $scope.data.copy_right || '',
                        'fax': $scope.data.fax || '',
                        'email': $scope.data.email || '',
                        'facebook': $scope.data.facebook || '',
                        'google': $scope.data.google || '',
                        'instagram': $scope.data.instagram || '',
                        'google_map': $scope.data.google_map || '',
                        'description': $scope.data.description || '',
                        'twitter': $scope.data.twitter || '',
                    }
                ),
                'key' : 'CONTACT'
            };

            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success');
                }
            }, function (error) {
                $myNotify.error('Error');
            });
        },

        saveSeo: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'title': $scope.data.title || '',
                        'keyword'  : $scope.data.keyword || '',
                        'description'  : $scope.data.description || '',
                        'content'  : $scope.data.content || '',
                        'image'  : $scope.data.image || '',
                    }
                ),
                'key' : 'SEO_DEFAULT'
            };

            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success');
                }
            }, function (error) {
                $myNotify.error('Error');
            });
        },

        saveLogo: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'logo_top': $scope.data.logo_top || '',
                        'logo_bottom'  : $scope.data.logo_bottom || '',
                    }
                ),
                'key' : 'LOGO'
            };

            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success');
                }
            }, function (error) {
                $myNotify.error('Error');
            });
        },


        delete: function ($id) {
            if ($id) {
                $myBootbox.confirm('Are you sure?', function (resp) {
                    if (resp) {
                        $settingService.action.deleteUser($id).then(function (resp) {
                            if (resp) {
                                $myNotify.success('Sure!');
                                $scope.actions.getAboutTeam();
                            }
                        }, function (error) {
                            $myNotify.error('No!');
                        });
                    }
                });
            }
        },
    };

    $scope.actions.getSetting();
});
