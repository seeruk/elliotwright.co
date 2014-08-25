/* =============================================================================
 * Ultra Simple Collapse Module
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * ========================================================================== */

+function($) { "use strict";

    var speed = 350;

    $('[data-collapse]').click(function(e) {
        e.preventDefault();

        var $this   = $(this);
        var $target = $($this.data('target'));

        var $clone = $target.clone().css({'height': 'auto'}).appendTo($target.parent());
        var height = $clone.height();
        $clone.remove();

        if ($target.data('transitioning')) {
            return;
        }

        $this.toggleClass('open');

        if ($target.hasClass('open')) {
            $target.data('transitioning', true);

            // Hide
            var complete = function() {
                $target.height(0);
                $target.data('transitioning', false);
            };

            if ( ! $.support.transition) {
                return complete.call(this);
            }

            $target
                .removeClass('open')
                .css({'height': height})
                .emulateTransitionEnd(0)
                .one('tridentTransitionEnd', $.proxy(complete, this))
            ;
        } else {
            $target.data('transitioning', true);

            // Show
            var complete = function() {
                $target.addClass('open');
                $target.css({'height': ''});
                $target.data('transitioning', false);
            };

            if ( ! $.support.transition) {
                return complete.call(this);
            }

            $target
                .one('tridentTransitionEnd', $.proxy(complete, this))
                .emulateTransitionEnd(speed)
                .height(height)
            ;
        }
    });

}(jQuery);
