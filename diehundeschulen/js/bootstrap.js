jQuery(document).ready(function($) {
    $('.schoolDetail .thumbs img').on('click', function(evt) {
        var src = $.attr(this, 'src');
        $('.schoolDetail .image img').attr('src', src);
    });
});

jQuery(document).ready(function($) {
    function addScript(scriptSrc) {
        var js = document.createElement('script');
        js.async = true;
        js.type = 'text/javascript';
        js.src = scriptSrc;
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(js, s);
    }
    addScript('//connect.facebook.net/de_DE/all.js#xfbml=1');
});