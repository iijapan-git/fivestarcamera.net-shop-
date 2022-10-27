(function($){
    $(function(){
        if($('#container.home').length){
            var slider = $("#slider ul").bxSlider({
                mode: "fade",
                auto: true,
                speed: 1500,
                pause: 5000,
                pager: true,
                controls: true
            });


            $('#top-visual').height($(window).height() - $('#header').height());

            var i = 0;
            (function move() {
                i = i > 0 ? -1 : 1;
                var p = parseInt($("#top-visual .ic-scroll").css('bottom'));
                $("#top-visual .ic-scroll").animate({ bottom: p + i * 20 }, { 
                    duration: 1500,
                    complete: move
                });
            })();
        }
    });

})(jQuery);