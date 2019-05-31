$(document).ready (function () {

    if ($("#datepicker-popup").length) {
        $('#datepicker-popup input').datepicker({
            enableOnReadonly: true,
            todayHighlight: true,
            format: 'yyyy/mm/dd',
        });
    }

    var domain =  SiteUrl + '/admin/laravel-filemanager';
    function tinyMce() {
        var configs = {};
        if (typeof(configsTiny) != "undefined" && variable !== null) {
            configs = configsTiny;
        } else {
            configs = {
                height: 300,
                theme: 'modern',
                plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen media image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help',
                toolbar: 'bold italic underline strikethrough forecolor backcolor | link image redo undo fullscreen  | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | fontselect fontsizeselect formatselect |',
                file_browser_callback: function (field_name, url, type) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = SiteUrl + '/laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }
                    tinyMCE.activeEditor.windowManager.open({
                        file: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no"
                    });
                },
            };
        }
        configs.selector = '.my-tiny-mce';
        configs.path_absolute = SiteUrl;
        tinymce.init(configs);
    }
    tinyMce();

    var loadAction = function () {
        $('[class*="lfm"]').each(function() {
            $('.lfm').filemanager('image', {prefix: domain});
        });
    }
    loadAction();
    var count = $('.lfm').length + 1;
    $('#add-image-detail').click(function () {
        count += 1;
        var html = '<div class="col-sm-6" style="padding:0px;">' +
                        '  <div class="form-group">' +
                        '       <div class="input-group">' +
                        '           <a class="file-up-2 lfm" data-input="image_detail' + count + '" data-preview="image_detail_preview' + count + '" type="\'image\'">' +
                        '               <div class=" file-up">' +
                        '                   <img id="image_detail_preview' + count + '" src="/icon_add.png">' +
                        '                   <input id="image_detail' + count + '" class="form-control d-none" type="text" name="image_detail['+ count +']">' +
                        '               </div>' +
                        '               <span class="fa fa-times-circle delete-lfm"></span>' +
                        '           </a>' +
                        '       </div>' +
                        '  </div>'
                + '</div>';
        $('#image-detail').append(html);
        loadAction();
    });

    $(document).on('click', '.delete-lfm', function () {
        $(this).parent().find('input').val('');
        $(this).parent().find('input').trigger('input');
        $(this).parent().parent().find('img').attr('src', '/icon_add.png');
    });
});

