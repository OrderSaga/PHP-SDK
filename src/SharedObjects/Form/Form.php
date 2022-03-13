<?php
namespace OrderSaga\SharedObjects\Form;

use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class Form implements APIObjectInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    //form_key for each generic form
    const CONTACT_US = 'contact-us';
    const MAILING_LIST = 'mailing-list';
    const SAMPLE_REQUEST = 'sample-request';
    const QUOTE_REQUEST = 'quote-request';

    /** @var string */
    private $key;

    /**
     * @param array $results
     * @return Form
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);
        $this->setFormKey($results['key']);

        return $this;
    }

    /**
     * @return string
     */
    public function getFormKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return Form
     */
    public function setFormKey(string $key): Form
    {
        $this->key = $key;
        return $this;
    }
}