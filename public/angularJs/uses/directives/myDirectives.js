ngApp.directive('myCkeditor', function($apply, $timeout) {
    return {
        restrict: 'C',
        require: '?ngModel',
        link: function(scope, element, attrs, ngModel) {
            $apply (function () {
                var ck = CKEDITOR.replace(element[0], {
                    language: 'vi',
                    filebrowserImageBrowseUrl: SiteUrl + '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: SiteUrl + '/laravel-filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: SiteUrl + '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: SiteUrl + '/laravel-filemanager/upload?type=Files&_token=',
                });
                if (!ngModel) return;
                ck.on('instanceReady', function () {
                    ck.setData(ngModel.$viewValue);
                });
                function updateModel() {
                    scope.$apply(function () {
                        ngModel.$setViewValue(ck.getData());
                    });
                }
                ck.on('change', updateModel);
                ck.on('key', updateModel);
                ck.on('dataReady', updateModel);

                ngModel.$render = function (value) {
                    ck.setData(ngModel.$viewValue);
                };
            })
        }
    }
});

ngApp.directive('myDatepicker', function($apply) {
    return {
        restrict: 'C',
        link: function(scope, element, attrs) {
            $apply(function () {
                $('.datepicker').datepicker();
                $('#sandbox-container input').datepicker({
                    language: "vi"
                });
            });
        }
    };
});

ngApp.directive('myLfm', function($apply) {
    return {
        restrict: 'C',
        scope: {
            type: "=type"
        },
        link: function(scope, element, attrs) {
            var domain = SiteUrl + '/admin/laravel-filemanager';
            $(element).filemanager(scope.type, {prefix: domain});
        }
    };
});

ngApp.directive('ngDom', function ($apply) {
    return {
        scope: {'ngDom': '='},
        link: function (scope, elem) {
            $apply(function () {
                scope.ngDom = elem[0];
            });
        }
    };
});

ngApp.directive('ngEnter', function ()
{   return function (scope, element, attrs)
    {   element.bind("keydown keypress", function (event) {
            if (event.which === 13) {
                scope.$apply(function () {
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
            }
        });
    };
});