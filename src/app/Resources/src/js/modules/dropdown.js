/* =============================================================================
 * Dropdown Menu Module
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * ========================================================================== */

+function($) { "use strict";

    $('[data-dropdown]').click(function(e) {
        e.preventDefault();
        e.stopPropagation();

        var $this   = $(this);
        var $parent = $this.parent();
        var $menu   = $this.siblings('.dropdown-menu');

        var state = $parent.hasClass('open');

        $('.dropdown-menu').parent().removeClass('open');

        if ( ! state) {
            $parent.toggleClass('open');
        }
    });

    $(document).click(function(e) {
        $('.dropdown-menu').parent().removeClass('open');
    });

}(jQuery);
