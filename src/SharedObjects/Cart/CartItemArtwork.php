<?php
namespace OrderSaga\SharedObjects\Cart;

use OrderSaga\SharedObjects\File\File;
use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDToArrayTrait;
use OrderSaga\Traits\IDTrait;

class CartItemArtwork implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDTrait;

    /** @var File */
    private $file;

    /**
     * @param array $results
     * @return CartItemArtwork
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int)$results['id']);
        $this->setFile(File::create()->populateFromAPIResults($results['file']));

        return $this;
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @param File $file
     * @return CartItemArtwork
     */
    public function setFile(File $file): CartItemArtwork
    {
        $this->file = $file;
        return $this;
    }
}