<?php
namespace OrderSaga\SharedObjects\Blog;

use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\SharedObjects\File\File;
use OrderSaga\SharedObjects\User\User;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDToArrayTrait;
use OrderSaga\Traits\IDTrait;

class BlogPost implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDTrait;

    /** @var boolean */
    private $isDraft;

    /** @var string */
    private $name;

    /** @var string */
    private $permalink;

    /** @var string */
    private $metaTitle;

    /** @var string */
    private $metaDescription;

    /** @var File|null */
    private $previewImg;

    /** @var string */
    private $content;

    /** @var integer */
    private $numViews;

    /** @var User|null */
    private $author;

    /** @var BlogCategoryCollection */
    private $categories;

    /** @var BlogPost|null */
    private $nextPost;

    /** @var BlogPost|null */
    private $previousPost;

    /** @var \DateTime */
    private $publishDate;

    /**
     * @param array $results
     * @return BlogPost
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        $this->setIsDraft((bool) $results['is_draft']);

        $this->setName($results['name']);
        $this->setPermalink($results['permalink']);
        $this->setMetaTitle($results['meta_title']);
        $this->setMetaDescription($results['meta_description']);
        if( !empty($results['preview_img']) ) {
            $this->setPreviewImg(File::create()->populateFromAPIResults($results['preview_img']));
        }
        $this->setContent($results['content']);

        $this->setNumViews((int) $results['num_views']);

        if( !empty($results['author']) ) {
            $this->setAuthor(User::create()->populateFromAPIResults($results['author']));
        }

        $this->setCategories(BlogCategoryCollection::createFromAPIResults(($results['categories'] ?: [])));

        if( $results['previous_post'] )
        {
            $this->setPreviousPost(BlogPost::create()->populateFromAPIResults($results['previous_post']));
        }

        if( $results['next_post'] )
        {
            $this->setNextPost(BlogPost::create()->populateFromAPIResults($results['next_post']));
        }

        $this->setPublishDate((!empty($results['publish_date']) ? new \DateTime($results['publish_date']) : null));

        return $this;
    }

    /**
     * @return bool
     */
    public function isDraft(): bool
    {
        return $this->isDraft;
    }

    /**
     * @param bool $isDraft
     * @return BlogPost
     */
    public function setIsDraft(bool $isDraft): BlogPost
    {
        $this->isDraft = $isDraft;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return BlogPost
     */
    public function setName(string $name): BlogPost
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPermalink(): string
    {
        return $this->permalink;
    }

    /**
     * @param string $permalink
     * @return BlogPost
     */
    public function setPermalink(string $permalink): BlogPost
    {
        $this->permalink = $permalink;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaTitle(): string
    {
        return $this->metaTitle;
    }

    /**
     * @param string $metaTitle
     * @return BlogPost
     */
    public function setMetaTitle(string $metaTitle): BlogPost
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     * @return BlogPost
     */
    public function setMetaDescription(string $metaDescription): BlogPost
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getPreviewImg(): ?File
    {
        return $this->previewImg;
    }

    /**
     * @param File|null $previewImg
     * @return BlogPost
     */
    public function setPreviewImg(?File $previewImg): BlogPost
    {
        $this->previewImg = $previewImg;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return BlogPost
     */
    public function setContent(string $content): BlogPost
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumViews(): int
    {
        return $this->numViews;
    }

    /**
     * @param int $numViews
     * @return BlogPost
     */
    public function setNumViews(int $numViews): BlogPost
    {
        $this->numViews = $numViews;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User|null $author
     * @return BlogPost
     */
    public function setAuthor(?User $author): BlogPost
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return BlogCategoryCollection
     */
    public function getCategories(): BlogCategoryCollection
    {
        return $this->categories;
    }

    /**
     * @param BlogCategoryCollection $categories
     * @return BlogPost
     */
    public function setCategories(BlogCategoryCollection $categories): BlogPost
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return BlogPost|null
     */
    public function getNextPost(): ?BlogPost
    {
        return $this->nextPost;
    }

    /**
     * @param BlogPost|null $nextPost
     * @return BlogPost
     */
    public function setNextPost(?BlogPost $nextPost): BlogPost
    {
        $this->nextPost = $nextPost;
        return $this;
    }

    /**
     * @return BlogPost|null
     */
    public function getPreviousPost(): ?BlogPost
    {
        return $this->previousPost;
    }

    /**
     * @param BlogPost|null $previousPost
     * @return BlogPost
     */
    public function setPreviousPost(?BlogPost $previousPost): BlogPost
    {
        $this->previousPost = $previousPost;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishDate(): \DateTime
    {
        return $this->publishDate;
    }

    /**
     * @param \DateTime $publishDate
     * @return BlogPost
     */
    public function setPublishDate(\DateTime $publishDate): BlogPost
    {
        $this->publishDate = $publishDate;
        return $this;
    }
}