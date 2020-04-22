/**
 * Created by Admins on 4/13/2017.
 */
$(document).ready(function() {
	$("form").parsley();
    // ParsleyConfig definition if not already set
	window.ParsleyConfig = window.ParsleyConfig || {};
	window.ParsleyConfig.i18n = window.ParsleyConfig.i18n || {};

    // Define then the messages
	window.ParsleyConfig.i18n.en = jQuery.extend(window.ParsleyConfig.i18n.en || {}, {
		defaultMessage: "Định dạng dữ liệu không đúng.",
        type: {
            email:        "Địa chỉ email không đúng.",
            url:          "This value should be a valid url.",
            number:       "This value should be a valid number.",
            integer:      "This value should be a valid integer.",
            digits:       "This value should be digits.",
            alphanum:     "This value should be alphanumeric."
        },
        notblank:       "This value should not be blank.",
        required:       "Dữ liệu không được bỏ trống.",
        pattern:        "Định dạng dữ liệu không đúng.",
        min:            "This value should be greater than or equal to %s.",
        max:            "This value should be lower than or equal to %s.",
        range:          "This value should be between %s and %s.",
        minlength:      "Độ dài không đủ. Tối thiểu là %s ký tự.",
        maxlength:      "This value is too long. It should have %s characters or fewer.",
        length:         "This value length is invalid. It should be between %s and %s characters long.",
        mincheck:       "You must select at least %s choices.",
        maxcheck:       "You must select %s choices or fewer.",
        check:          "You must select between %s and %s choices.",
        equalto:        "Nội dung không trùng khớp."
	});
})
