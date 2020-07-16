$(function() {
    var SendURL = $('#url').val();
    var features = $('#features').val();
    var productid = $('#productid').val();
    var DeleteColors = [];
    var DeleteSizes = [];
    var DeleteUnits = [];
    var DeleteSizesColors = [];
    var DeleteSizesColorsInners = [];
    $(document).on('click', '.optionswitch', function() {
        if ($(this).find('input[type="checkbox"]').is(":checked")) {
            $(this).find('strong').html('Yes &nbsp;');
            $('.offtext').slideUp();
            $('.product_options').slideDown();
        } else {
            $(this).find('strong').html('No &nbsp;');
            $('.btns_wrapper').slideUp();
            $('.offtext').slideDown();
            $('.product_options').slideUp();
            $('.addoptionbtn_box').hide();
            $('.option_content').slideUp();
            $('.SwitchesProductOptions').find('input[type="checkbox"]').prop('checked', false);
        }
    });


    function SlideOptions(ActiveOption) {
        if ($.trim(ActiveOption) == 'sizes') {
            $('.DynamicAddOption').html('<i class="fa fa-plus"></i> ADD SIZES').data('addaction', 'sizes');
            $('.color_content_wrapper').slideUp();
            $('.unit_content_wrapper').slideUp();
            $('.size_color_content_wrapper').slideUp();
            setTimeout(function() {
                $('.size_content_wrapper').slideDown();
            }, 500);

        } else if ($.trim(ActiveOption) == 'sizescolors') {
            $('.DynamicAddOption').html('<i class="fa fa-plus"></i> ADD SIZES').data('addaction', 'sizescolors');
            $('.color_content_wrapper').slideUp();
            $('.unit_content_wrapper').slideUp();
            $('.size_content_wrapper').slideUp();
            setTimeout(function() {
                $('.size_color_content_wrapper').slideDown();
            }, 500);

        } else if ($.trim(ActiveOption) == 'colors') {
            $('.DynamicAddOption').html('<i class="fa fa-plus"></i> ADD COLORS').data('addaction', 'colors');
            $('.unit_content_wrapper').slideUp();
            $('.size_content_wrapper').slideUp();
            $('.size_color_content_wrapper').slideUp();
            setTimeout(function() {
                $('.color_content_wrapper').slideDown();
            }, 500);

        } else if ($.trim(ActiveOption) == 'units') {
            $('.DynamicAddOption').html('<i class="fa fa-plus"></i> ADD UNITS').data('addaction', 'units');
            $('.color_content_wrapper').slideUp();
            $('.size_content_wrapper').slideUp();
            $('.size_color_content_wrapper').slideUp();
            setTimeout(function() {
                $('.unit_content_wrapper').slideDown();
            }, 500);
        }
    }


    $('.SwitchesProductOptions').change(function() {
        var Value = $.trim($(this).data('action'));
        var SwitchAction = $.trim($(this).data('action'));
        $('#submitaction').val(SwitchAction);
        $('.SwitchesProductOptions').find('input[type="checkbox"]').prop('checked', false);
        $(this).find('input[type="checkbox"]').prop('checked', true);
        $('.addoptionbtn_box').show();
        $('.option_content').slideDown();
        SlideOptions(SwitchAction);
        $('.btns_wrapper').slideDown();
    });

    $(document).on('click', '.DynamicAddOption', function() {
        var AddAction = $(this).data('addaction');
        if ($.trim(AddAction) == 'sizes') {
            var SizeContent = $('.size_content_copy').html();
            $('.size_content_wrapper').append(SizeContent);
        } else if ($.trim(AddAction) == 'sizescolors') {

            var SizeColorContent = $('.size_color_content_box_copy').html();
            $('.size_color_content_wrapper').append(SizeColorContent);
        } else if ($.trim(AddAction) == 'colors') {
            var ColorContent = $('.color_content_copy').html();
            $('.color_content_wrapper').append(ColorContent);
        } else if ($.trim(AddAction) == 'units') {
            var UnitContent = $('.unit_content_copy').html();
            $('.unit_content_wrapper').append(UnitContent);
        }
    });


    $(document).on('click', '.addsizecolor', function() {
        var Quantity = $(this).parent().prev().find('input[type="text"]').val();
        var SizeName = $(this).parent().prev().prev().find('input[type="text"]').val();
        if ($.trim(SizeName) == '') {
            loadNotification('error', 'metroui', "Please Enter The Size Name", 3000);
            return false;
        } else if ($.trim(Quantity) == '') {
            loadNotification('error', 'metroui', "Please Enter The Qunatity", 3000);
            return false;
        } else {
            // $(this).parent().parent().find('.size_color_inner').remove();
            var SizeName = $(this).parent().parent().find('.sizecolor_name').val();
            var SizeInnerColorBox = $('.size_color_inner_copy').html();
            for (var i = 0; i < Quantity; i++) {
                $(this).parent().parent().append(SizeInnerColorBox);
            }
            $(this).parent().parent().find('.size_color_name_hidden').val(SizeName);
            $(this).parent().prev().find('input[type="text"]').val('');
        }
    });


    function loadNotification(type, theme, message, time) {
        $.getScript(SendURL + "admin/assets/js/notification.js")
            .done(function(script, textStatus) {
                noty(type, theme, message, time);
            })
            .fail(function(jqxhr, settings, exception) {});
    }

    function ShowHideSpinner(time = '') {
        var setTime = $.trim(time) == '' ? 1000 : time;
        $('#spinner').css('display', 'inline-block');
        setTimeout(function() {
            $('#spinner').css('display', 'none');
        }, setTime);
    }

    function SmoothScroll(element) {
        $('html, body').animate({
            scrollTop: $(element).offset().top
        }, 200);
    }

    $(document).on('click', '.delete_option', function() {
        var DeleteAction = $.trim($(this).data('action'));
        var ActionID = $.trim($(this).data('actionid'));
        // DeleteColors
        // DeleteSizes
        // DeleteUnits
        // DeleteSizesColors
        // DeleteSizesColorsInners
        if (confirm("Are You Sure Want To Delete..")) {
            if (DeleteAction == 'delete_sizecolor_inner') {
                $(this).parent().parent().remove();
                if ($.trim(ActionID) != '') {
                    DeleteSizesColorsInners.push(ActionID);
                }
            } else if (DeleteAction == 'delete_units') {
                $(this).parent().parent().remove();
                if ($.trim(ActionID) != '') {
                    DeleteUnits.push(ActionID);
                }
            } else if (DeleteAction == 'delete_size') {
                $(this).parent().parent().remove();
                if ($.trim(ActionID) != '') {
                    DeleteSizes.push(ActionID);
                }
            } else if (DeleteAction == 'delete_sizecolor') {
                $(this).parent().parent().remove();
                if ($.trim(ActionID) != '') {
                    DeleteSizesColors.push(ActionID);
                }
            } else if (DeleteAction == 'delete_colors') {
                $(this).parent().parent().remove();
                if ($.trim(ActionID) != '') {
                    DeleteColors.push(ActionID);
                }
            }
        } else {
            return false;
        }
    });



    $(document).on('submit', '#ProductAdditionalOptions', function(e) {
        e.preventDefault();
        var SubmitAction = $.trim($('#submitaction').val());
        var formData = new FormData($('#ProductAdditionalOptions')[0]);
        formData.append('SubmitAction', SubmitAction)
        formData.append('ProductID', productid);

        formData.append('DeleteInnerColors', DeleteSizesColorsInners);
        formData.append('DeleteUnits', DeleteUnits);
        formData.append('DeleteSizes', DeleteSizes);
        formData.append('DeleteSizesOfColor', DeleteSizesColors);
        formData.append('DeleteColors', DeleteColors);


        $.ajax({
            url: SendURL + "admin/back/General_Ecommerce_Setting.php",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if ($.trim(data) != 'success') {
                    loadNotification('error', 'metroui', data, 3000);
                    return false;
                } else {
                    window.location = SendURL + 'admin/manage_products.php?pro=' + productid + '&tab=tab2';
                    return false;
                }
            }
        });
    });
});