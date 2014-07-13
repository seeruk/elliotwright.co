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

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A blog article
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 *
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article
{
    const string ERR_NO_ARTICLE = 'No article found with id "%s"';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=250)
     * @Assert\Length(
     *   min = "1",
     *   max = "250",
     *   minMessage = "Your title must be at least {{ limit }} character long.",
     *   maxMessage = "Your title must not exceed {{ limit }} characters."
     * )
     */
    protected string $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=16777215)
     */
    protected string $content;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    protected DateTime $created;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="published", type="datetime")
     */
    protected DateTime $published;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="articles")
     * @ORM\JoinTable(name="articles_categories")
     */
    protected ArrayCollection $categories;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct(): void
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle(string $title): Article
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent(string $content): Article
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set created
     *
     * @param DateTime $created
     *
     * @return Article
     */
    public function setCreated(\DateTime $created): Article
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * Set published
     *
     * @param DateTime $published
     *
     * @return Article
     */
    public function setPublished(\DateTime $published): Article
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return DateTime
     */
    public function getPublished(): DateTime
    {
        return $this->published;
    }

    public function getRelativePublished(): string
    {
        return '3 days ago';
    }

    public function addCategory(Category $category): Article
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Get categories
     *
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }
}
