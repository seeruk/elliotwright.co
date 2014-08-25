/* =============================================================================
 * CSS Transition Support - Stolen from Twitter Bootstrap
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * ========================================================================== */

+function ($) { "use strict";

    function transitionEnd() {
        var el = document.createElement('trident');

        var transEndEventNames = {
            'WebkitTransition': 'webkitTransitionEnd',
            'MozTransition': 'transitionend',
            'OTransition': 'oTransitionEnd otransitionend',
            'transition': 'transitionend'
        };

        for (var name in transEndEventNames) {
            if (el.style[name] !== undefined) {
                return {
                    end: transEndEventNames[name]
                };
            }
        }

        return false;
    }

    $.fn.emulateTransitionEnd = function (duration) {
        var $el = this;
        var called = false;

        $(this).one('tridentTransitionEnd', function () {
            called = true
        });

        var callback = function () {
            if (!called) {
                $($el).trigger($.support.transition.end) ;
            }
        }

        setTimeout(callback, duration);

        return this;
    }

    $(function () {
        $.support.transition = transitionEnd();

        if (!$.support.transition) {
            return;
        }

        $.event.special.tridentTransitionEnd = {
            bindType: $.support.transition.end,
            delegateType: $.support.transition.end,
            handle: function (e) {
                if ($(e.target).is(this)) {
                    return e.handleObj.handler.apply(this, arguments);
                }
            }
        };
    })

}(jQuery);
