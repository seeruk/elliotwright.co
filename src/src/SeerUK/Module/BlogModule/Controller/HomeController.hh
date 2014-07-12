<?hh

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\BlogModule\Controller;

use SeerUK\Module\BlogModule\Data\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Trident\Module\FrameworkModule\Controller\Controller;

/**
 * Home Controller
 *
 * Controls the homepage of the portfolio/blog
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class HomeController extends Controller
{
    public function indexAction(): Response
    {
        ldd(new Article());

        return $this->get('caching.proxy')->proxy('rendered.homepage', function() {
            $twig = $this->get('bm.templating.engine.twig.string');

            // Pseudo entity
            $article            = new \stdClass;
            $article->title     = 'Framework development reflection - Trident';
            $article->published = new \DateTime('3 days ago');
            $article->relativePublished = '3 days ago';

            $catTrident = new \stdClass;
            $catTrident->name = 'Trident';
            $catWebdev  = new \stdClass;
            $catWebdev->name = 'Web Development';

            $article->categories = [
                $catTrident,
                $catWebdev
            ];
            $article->content = $twig->render(<<<HTML
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras libero lorem, pulvinar at consequat a, placerat ac lectus. Aliquam consequat justo sit amet orci tincidunt pretium. Nulla et tincidunt ligula. Phasellus cursus magna in tellus aliquam, sit amet volutpat quam blandit. Quisque commodo, metus sit amet cursus convallis, mauris mi convallis justo, et ornare ligula augue et neque. Etiam ac lectus sed nulla lobortis blandit. Proin adipiscing tellus et mi venenatis volutpat. Etiam in odio vulputate, rhoncus metus eget, cursus risus. Nunc vestibulum semper magna, quis euismod velit dapibus non.</p>
<pre>&lt;?hh

// ...

class BlogController extends Controller
{
    public function __construct(): Response
    {
        // ...
    }
}</pre>
<p>Maecenas elit eros, convallis eget varius non, accumsan eget tortor. Ut imperdiet aliquam nibh. Ut bibendum tincidunt nisl, non ornare magna. Quisque at elementum mi. Etiam tincidunt ac nisl id ultricies. Donec eget tellus quis nibh dictum ornare. Quisque sollicitudin orci vitae turpis eleifend, non egestas velit lacinia. Suspendisse ullamcorper, lacus et adipiscing condimentum, velit nunc consectetur ante, ut blandit augue massa eget massa. Sed rhoncus luctus erat, quis posuere nibh interdum at. Sed aliquet placerat magna a sodales. Proin pulvinar dolor metus, blandit euismod urna dictum eget. Aliquam tincidunt rhoncus tempor. Curabitur nec orci sed massa condimentum interdum eget sed ipsum.</p>
<p>Donec pretium vehicula lacinia. Curabitur pellentesque cursus turpis varius bibendum. Integer commodo, erat vel faucibus cursus, sem turpis vehicula quam, volutpat facilisis enim orci a mauris. Morbi ligula lectus, aliquam eu aliquam vel, mollis a risus. Integer iaculis nisi sagittis ipsum vehicula tempus. Sed consectetur metus ut velit fringilla, nec eleifend tellus consectetur. Donec nisi orci, vulputate eu nibh a, molestie tristique nisi. In eget orci rhoncus, pretium justo at, suscipit leo. Mauris faucibus tristique elit, quis sagittis erat tincidunt non. Donec nec dolor lacus. Ut ornare eros nisi, vel vehicula nunc rhoncus at. Vestibulum pellentesque, arcu ut laoreet aliquet, odio quam ultrices nisl, commodo commodo tellus ipsum quis est. Aenean convallis eleifend pretium. Ut blandit nec nibh a suscipit. Vestibulum quam augue, fermentum at nisi at, malesuada luctus enim.</p>
<p>Maecenas risus nisi, vehicula ac eros non, molestie dictum augue. Sed imperdiet aliquam odio et lacinia. Aliquam consequat turpis quis leo scelerisque, eget ultricies lacus sollicitudin. Etiam sit amet purus venenatis, iaculis nisl sed, tempor tellus. Mauris feugiat adipiscing porttitor. Etiam ut vulputate nisl. Sed nunc orci, adipiscing at magna at, adipiscing posuere nulla. Duis pharetra aliquam luctus. Nulla arcu metus, consectetur at dapibus nec, congue vel elit. Ut vel neque sem. Vestibulum non tristique est, fringilla adipiscing sapien. Nulla vulputate enim non libero mattis, ac suscipit nunc lobortis. Curabitur venenatis cursus purus nec tincidunt. Donec porta lacus sit amet est posuere ullamcorper. Etiam eu massa rhoncus, fringilla justo eu, egestas purus. Suspendisse euismod libero et arcu aliquet condimentum.</p>
<p>Aliquam malesuada nisi sem, gravida rutrum ante molestie sed. Donec volutpat euismod sem at ultrices. Curabitur id consequat sapien. Cras nec lectus ornare, eleifend neque dictum, volutpat ipsum. Vivamus sed sagittis orci, placerat auctor magna. Sed nec sem nibh. Pellentesque in lobortis nulla. Sed dapibus nisi vel eros dapibus feugiat. Proin posuere felis quam, vel dictum felis dictum sit amet. Cras pulvinar eleifend metus, eu rhoncus eros varius in. Morbi at consectetur diam. Sed a blandit purus. Etiam interdum neque dolor, nec aliquam magna vestibulum at. Duis non est ac sem mattis mollis. Curabitur iaculis dolor ut nisl imperdiet posuere.</p>
<p>Test</p>
HTML
, []);

            return $this->render('SeerUKBlogModule:Home:index.html.twig', [
                'article' => $article
            ]);
        }, 3600);
    }
}
