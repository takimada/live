jQuery(function() {  
    if(jQuery('#gateway_color_dark').length > 0) {
        jQuery('#gateway_color_dark').ColorPicker({
            color: '#' + jQuery('#gateway_color_dark').val(),
            onShow: function (colpkr) {
                    jQuery(colpkr).fadeIn(500);
                    return false;
            },
            onHide: function (colpkr) {
                    jQuery(colpkr).fadeOut(500);
                    return false;
            },
            onChange: function (hsb, hex, rgb) {

                    jQuery('#gateway_color_dark').val(hex);
                    jQuery('#gateway_color_dark').attr('value',hex);
                    jQuery('#gateway_color_preview table td.head').css('background-color', '#' + hex);
            }
        });
        jQuery('#gateway_color_light').ColorPicker({
            color: '#' + jQuery('#gateway_color_dark').val(),
            onShow: function (colpkr) {
                    jQuery(colpkr).fadeIn(500);
                    return false;
            },
            onHide: function (colpkr) {
                    jQuery(colpkr).fadeOut(500);
                    return false;
            },
            onChange: function (hsb, hex, rgb) {

                    jQuery('#gateway_color_light').val(hex);
                    jQuery('#gateway_color_light').attr('value',hex);
                    jQuery('#gateway_color_preview table td.body').css('background-color', '#' + hex);
            }
        });
        jQuery('#gateway_color_text').ColorPicker({
            color: '#' + jQuery('#gateway_color_text').val(),
            onShow: function (colpkr) {
                    jQuery(colpkr).fadeIn(500);
                    return false;
            },
            onHide: function (colpkr) {
                    jQuery(colpkr).fadeOut(500);
                    return false;
            },
            onChange: function (hsb, hex, rgb) {

                    jQuery('#gateway_color_text').val(hex);
                    jQuery('#gateway_color_text').attr('value',hex);
                    jQuery('#gateway_color_preview table td').css('color', '#' + hex);
            }
        });
    }
});