ngApp.factory('$myBootbox', ['$rootScope', function ($rootScope) {
    var myBootbox = {
        basic: function(message){
            swal(message).catch(swal.noop);
        },

        success: function(message, title){
            swal({
                title: title || 'Good Job' ,
                text: message,
                icon: "success",
                confirmButtonColor: '#4fa7f3'
            });
        },

        successTimeOut: function (message, title, timer) {
            swal({  title: title || 'Good Job',
                text:  message,
                icon: "success",
                confirmButtonColor: '#4fa7f3',
                timer: timer || 2000
            }).then(
                function () {
                },
                function (dismiss) {
                });
        },

        confirm: function(message, callBackTrue, callBackFalse) {
            callBackTrue  = callBackTrue || function(){};
            callBackFalse = callBackFalse || function(){};
            swal({
                text: textConfirm,
                icon: "warning",
                buttons:{
                    cancel: {
                        text: ConfirmBtn.cancel,
                        value: false,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: ConfirmBtn.confirm,
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    },
                },
            }).then(callBackTrue, callBackFalse);
        },

        prompt: function (message, inputType, callback) {
            swal({
                title: 'Submit email to run ajax request',
                input:  inputType || 'text',
                showCancelButton: true,
                confirmButtonText: 'Gửi',
                showLoaderOnConfirm: true,
                cancelButtonText: 'Hủy bỏ',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
            }).then(callback, function () {
            });
        },
    };
    return myBootbox;
}]);

ngApp.factory('$myLoader', ['$rootScope', function ($rootScope) {
    var myLoader = {
        show: function(){
            $('#modalLoader').modal({
                show: true,
                backdrop: 'static'
            });
        },
        hide: function(){
            $('#modalLoader').modal('hide');
        }
    };
    return myLoader;
}]);

ngApp.factory('$myNotify', ['$rootScope', function ($rootScope) {
    var myNotify = {
        success: function() {
            var heading   = headingNotifi.success;
            var text      = messageNotifi.success;
            var position  = position || 'top-right';
            var loaderBg  = '#c6ede0';
            var icon      = 'success';
            var hideAfter = 3000;
            var stack     = 1;
            $.toast({ heading: heading,
                text: text,
                position: position,
                loaderBg: loaderBg,
                icon: icon,
                hideAfter: hideAfter,
                stack: stack,
            });
        },
        error: function() {
            var heading   = headingNotifi.failue;
            var text      = messageNotifi.failue;
            var position  = position || 'top-right';
            var loaderBg  = '#fcd8dc';
            var bgColor   = '#fcd8dc';
            var icon      = 'error';
            var hideAfter = 3000;
            var stack     = 1;
            console.log(text)
            $.toast({ heading: heading,
                text: text,
                position: position,
                loaderBg: loaderBg,
                icon: icon,
                hideAfter: hideAfter,
                stack: stack,
            });
        },

        warning: function() {
            var heading   = headingNotifi.warning;
            var text      = messageNotifi.warning;
            var position  = position || 'top-right';
            var loaderBg  = '#c6ede0';
            var icon      = 'warning';
            var hideAfter = 3000;
            var stack     = 1;
            $.toast({ heading: heading,
                text: text,
                position: position,
                loaderBg: loaderBg,
                icon: icon,
                hideAfter: hideAfter,
                stack: stack,
            });
        },
    };

    return myNotify;
}]);

ngApp.factory('$apply', ['$rootScope', function ($rootScope) {
    return function (fn) {
        setTimeout(function () {
            $rootScope.$apply(fn);
        });
    };
}]);