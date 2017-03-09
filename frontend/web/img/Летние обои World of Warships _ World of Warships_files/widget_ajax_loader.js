$(function() {
    $('.js-widget-placeholder').each(function() {
        var placeholder = $(this);
        $.ajax({
                url: '/layout/widget/' + placeholder.text() + '/',
                type: 'GET',
                dataType: 'html',
                success: function(data) { placeholder.after(data); placeholder.remove() }
            })
     })
 })

