

(function($) {
    // init bootstrap alert dismiss
    $(".alert").alert('fade');

    // init alerts
    $('.btn-delete-snippet').confirmationAlert({
        message: 'Czy napewno chcesz usunąć ten snippet?',
        onConfirm: function(target) {
            window.location.href = target.data('href');
        }
    });

    $( window ).unload(function() {
        if (editor !== null) {
            editor.destroy();
        }
    });
})(jQuery);