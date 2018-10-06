(function($){
    $.fn.confirmationAlert = function(options) {
        options = $.extend({
            message: 'Czy jesteś pewny?',
            buttons: {
                confirm: {
                    label: 'OK',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'Anuluj',
                    className: 'btn-default'
                }
            },
            onConfirm: function() { },
            onDeny: function () { }
        }, options);

        return this.each(function() {

            var $target = $(this);

            var openAlert = function() {
                bootbox.confirm({
                    message: options.message,
                    buttons: options.buttons,
                    callback: function (result) {
                        if (result === true) {
                            options.onConfirm($target);
                        } else {
                            options.onDeny($target);
                        }
                    }
                });
            };

            $target.bind('click', openAlert);
        });
    }
})(jQuery);