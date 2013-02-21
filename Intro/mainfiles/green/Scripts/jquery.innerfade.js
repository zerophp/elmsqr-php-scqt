/* =========================================================

// jquery.innerfade.js

// Datum: 2008-02-14
// Firma: Medienfreunde Hofmann & Baldes GbR
// Author: Torsten Baldes
// Mail: t.baldes@medienfreunde.com
// Web: http://medienfreunde.com

// based on the work of Matt Oakes http://portfolio.gizone.co.uk/applications/slideshow/
// and Ralf S. Engelschall http://trainofthoughts.org/

 *
 *  <ul id="news"> 
 *      <li>content 1</li>
 *      <li>content 2</li>
 *      <li>content 3</li>
 *  </ul>
 *  
 *  $('#news').innerfade({ 
 *	  animationtype: Type of animation 'fade' or 'slide' (Default: 'fade'), 
 *	  speed: Fading-/Sliding-Speed in milliseconds or keywords (slow, normal or fast) (Default: 'normal'), 
 *	  timeout: Time between the fades in milliseconds (Default: '2000'), 
 *	  type: Type of slideshow: 'sequence', 'random' or 'random_start' (Default: 'sequence'), 
 * 		containerheight: Height of the containing element in any css-height-value (Default: 'auto'),
 *	  runningclass: CSS-Class which the container get’s applied (Default: 'innerfade'),
 *	  children: optional children selector (Default: null)
 *  }); 
 *

// ========================================================= */

(function($) {
		  
    $.fn.innerfade = function(options) {

        return this.each(function() {

            $.innerfade(this, options);

        });

    };



    $.innerfade = function(container, options) {

        var settings = {

            'container': container, // container's data is used as state memory
            'animationtype': 'fade',
            'type': 'sequence',
            'speed': 'normal',
            'timeout': 6000,
            'containerheight': 'auto',
            'runningclass': 'innerfade',
            'children': null,
            'next_selector': '.nextslide',
            'prev_selector': '.prevslide',

        };

        $.data(settings.container, 'paused', false);

        if (options)

            $.extend(settings, options);



        if (settings.children === null)

            var elements = $(container).children();

        else

            var elements = $(container).children(settings.children);



        if (elements.length < 1) return;



        if (settings.type == "sequence") {

            $.data(settings.container, 'current', 1);

            $.data(settings.container, 'last', 0);

        }



        if (settings.pause_selector !== null) {

            $(settings.pause_selector).hover(function () {

                $.data(settings.container, 'paused', true);

            }, function () {

                $.data(settings.container, 'paused', false);

            });

        }



        

        $(settings.prev_selector).click(function(e) {

            e.preventDefault();

            current = $.data(settings.container, 'current') - 2;

            if (current < 0) current = elements.length + current; // js modulo for negative numbers is strange (in IE)

            $.data(settings.container, 'current', current);

            $.innerfade.animate(elements, settings);

        });



        $(settings.next_selector).click(function(e) {

            e.preventDefault();

            $.innerfade.animate(elements, settings);

        });



        $(container).css('position', 'relative').css('height', settings.containerheight).addClass(settings.runningclass);

        for (var i = 0; i < elements.length; i++) {

            $(elements[i]).css('z-index', String(elements.length-i)).css('position', 'absolute').hide();

        };

        if (elements.length > 1) {

            setTimeout(function() { $.innerfade.next(elements, settings); }, settings.timeout);

        }

        $(elements[0]).show();

    };



    $.innerfade.next = function(elements, settings) {

        if (!$.data(settings.container, 'paused')) {

            $.innerfade.animate(elements, settings);

        }

        setTimeout((function() {

            $.innerfade.next(elements, settings);

        }), settings.timeout);

    };



    $.innerfade.animate = function(elements, settings) {

        current = $.data(settings.container, 'current');

        last = $.data(settings.container, 'last');

        if (settings.animationtype == 'slide') {

            $(elements[last]).slideUp(settings.speed);

            $(elements[current]).slideDown(settings.speed);

        } else if (settings.animationtype == 'fade') {

            $(elements[last]).fadeOut(settings.speed);

            $(elements[current]).fadeIn(settings.speed, function() {

                removeFilter($(this)[0]);

            });

        } else {

            alert('Innerfade-animationtype must either be \'slide\' or \'fade\'');

        }



        if (typeof(settings.callback) == "function") {

            settings.callback(current, elements[current]);

        }



        $.data(settings.container, 'last', current);

        $.data(settings.container, 'current', (current + 1) % elements.length);

    };
	


})(jQuery);

// **** remove Opacity-Filter in ie ****
function removeFilter(element) {
	if(element.style.removeAttribute){
		element.style.removeAttribute('filter');
	}
}