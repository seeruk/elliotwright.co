/* =============================================================================
 * Ultra Simple Collapse Module
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * ========================================================================== */

+function($) {
    $('[data-collapse]').click(function(e) {
        e.preventDefault();

        var $this   = $(this);
        var $target = $($this.data('target'));

        $this.toggleClass('open');

        $target.toggleClass('open').promise().done(function() {
            var $clone = $target.clone().css({'height': 'auto'}).appendTo($target.parent());
            var height = $clone.height();

            $clone.remove();

            if ($target.hasClass('open')) {
                $target.css({'height': height});
            } else {
                $target.css({'height': ''});
            }
        });
    });
}(jQuery);
