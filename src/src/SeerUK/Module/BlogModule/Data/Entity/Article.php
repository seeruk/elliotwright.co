<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\BlogModule\Data\Entity;

use Carbon\Carbon;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use SeerUK\Module\SecurityModule\Data\Entity\User;
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
    const ERR_NO_ARTICLE = 'No article found with slug "%s"';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="SeerUK\Module\SecurityModule\Data\Entity\User", fetch="EAGER")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

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
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=250)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=16777215)
     */
    protected $content;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="published", type="datetime")
     */
    protected $published;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="articles")
     * @ORM\JoinTable(name="articles_categories")
     */
    protected $categories;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Article
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get first paragraph of content
     *
     * @return string
     */
    public function getFirstParagraph()
    {
        $split = explode("\n", $this->getContent());

        return trim($split[0]);
    }

    /**
     * Set created
     *
     * @param DateTime $created
     *
     * @return Article
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return DateTime
     */
    public function getCreated()
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
    public function setPublished(\DateTime $published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }

    public function getRelativePublished()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->published->format('Y-m-d H:i:s'))->diffForHumans();
    }

    public function addCategory(Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Get categories
     *
     * @return Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
