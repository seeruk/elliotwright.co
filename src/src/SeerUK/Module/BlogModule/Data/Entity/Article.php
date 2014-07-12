<?hh

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\BlogModule\Data\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A blog article
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class Article
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * @ORM\Column(name="title", type="string", length=250)
     */
    protected string $title;

    /**
     * @ORM\Column(name="content", type="string", length=16777215)
     */
    protected string $content;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    protected DateTime $created;

    /**
     * @ORM\Column(name="published", type="datetime")
     */
    protected DateTime $published;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }
}
