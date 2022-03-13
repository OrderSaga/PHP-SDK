<?php
namespace OrderSaga\SharedObjects\Blog;

use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDToArrayTrait;
use OrderSaga\Traits\IDTrait;

class BlogCategory implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDTrait;

    /** @var string */
    private $name;

    /** @var string */
    private $permalink;

    /**
     * @param array $results
     * @return BlogCategory
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        $this->setName($results['name']);
        $this->setPermalink($results['permalink']);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return BlogCategory
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * @param mixed $permalink
     * @return BlogCategory
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;
        return $this;
    }
}