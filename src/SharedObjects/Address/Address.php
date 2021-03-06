<?php
namespace OrderSaga\SharedObjects\Address;

use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDTrait;
use OrderSaga\Interfaces\APIObjectInterface;

class Address implements APIObjectInterface
{
    use APIObjectTrait;
    use IDTrait;

    /** @var boolean */
    private $isBusiness = true;
    /** @var string|null */
    private $businessName;

    /** @var boolean */
    private $isShippingAddress = true;
    /** @var boolean */
    private $isPrimaryShippingAddress = true;
    /** @var boolean */
    private $isBillingAddress = true;
    /** @var boolean */
    private $isPrimaryBillingAddress = true;

    /** @var string|null */
    private $address;
    /** @var string|null */
    private $address2;
    /** @var string|null */
    private $city;
    /** @var string|null */
    private $state;
    /** @var string|null */
    private $zipcode;
    /** @var string|null */
    private $countryCode;

    /**
     * @param array $results
     * @return Address
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);

        $this->setIsBusiness((bool) $results['is_business']);
        $this->setBusinessName($results['business_name']);

        $this->setIsShippingAddress((bool) $results['is_shipping_address']);
        $this->setIsPrimaryShippingAddress((bool) $results['is_primary_shipping_address']);
        $this->setIsBillingAddress((bool) $results['is_billing_address']);
        $this->setIsPrimaryBillingAddress((bool) $results['is_primary_billing_address']);

        $this->setAddress($results['address']);
        $this->setAddress2($results['address2']);
        $this->setCity($results['city']);
        $this->setState($results['state']);
        $this->setZipcode($results['zipcode']);
        $this->setCountryCode($results['country_code']);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),

            'is_business'=>$this->isBusiness(),
            'business_name'=>$this->getBusinessName(),

            'is_shipping_address'=>$this->isShippingAddress(),
            'is_primary_shipping'=>$this->isPrimaryShippingAddress(),
            'is_billing_address'=>$this->isBillingAddress(),
            'is_primary_billing'=>$this->isPrimaryBillingAddress(),

            'address'=>$this->getAddress(),
            'address2'=>$this->getAddress2(),
            'city'=>$this->getCity(),
            'state'=>$this->getState(),
            'zipcode'=>$this->getZipcode(),
            'country_code'=>$this->getCountryCode(),
        ];
    }

    /**
     * @param string $recipient
     * @return string
     */
    public function getAsString($recipient = '')
    {
        $addr = '';

        if( $recipient )
        {
            $addr .= $recipient."\n";
        }

        if( $this->isBusiness() )
        {
            $addr .= $this->getBusinessName()."\n";
        }

        $addr .= $this->getAddress() . "\n";

        if( $this->getAddress2() )
        {
            $addr .= $this->getAddress2() . "\n";
        }

        $addr .= $this->getCity();

        if( $this->getState() )
        {
            $addr .= ', ' . $this->getState() . "\n";
        }
        else
        {
            $addr .=  "\n";
        }

        if( $this->getZipcode() )
        {
            $addr .= $this->getZipcode()." ";
        }

        $addr .= $this->getCountryCode();

        return trim($addr);
    }

    /**
     * @return bool
     */
    public function isBusiness(): bool
    {
        return $this->isBusiness;
    }

    /**
     * @param bool $isBusiness
     * @return Address
     */
    public function setIsBusiness(bool $isBusiness): Address
    {
        $this->isBusiness = $isBusiness;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    /**
     * @param string|null $businessName
     * @return Address
     */
    public function setBusinessName(?string $businessName): Address
    {
        $this->businessName = $businessName;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShippingAddress(): bool
    {
        return $this->isShippingAddress;
    }

    /**
     * @param bool $isShippingAddress
     * @return Address
     */
    public function setIsShippingAddress(bool $isShippingAddress): Address
    {
        $this->isShippingAddress = $isShippingAddress;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPrimaryShippingAddress(): bool
    {
        return $this->isPrimaryShippingAddress;
    }

    /**
     * @param bool $isPrimaryShippingAddress
     * @return Address
     */
    public function setIsPrimaryShippingAddress(bool $isPrimaryShippingAddress): Address
    {
        $this->isPrimaryShippingAddress = $isPrimaryShippingAddress;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBillingAddress(): bool
    {
        return $this->isBillingAddress;
    }

    /**
     * @param bool $isBillingAddress
     * @return Address
     */
    public function setIsBillingAddress(bool $isBillingAddress): Address
    {
        $this->isBillingAddress = $isBillingAddress;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPrimaryBillingAddress(): bool
    {
        return $this->isPrimaryBillingAddress;
    }

    /**
     * @param bool $isPrimaryBillingAddress
     * @return Address
     */
    public function setIsPrimaryBillingAddress(bool $isPrimaryBillingAddress): Address
    {
        $this->isPrimaryBillingAddress = $isPrimaryBillingAddress;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return Address
     */
    public function setAddress(?string $address): Address
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    /**
     * @param string|null $address2
     * @return Address
     */
    public function setAddress2(?string $address2): Address
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return Address
     */
    public function setCity(?string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     * @return Address
     */
    public function setState(?string $state): Address
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     * @param string|null $zipcode
     * @return Address
     */
    public function setZipcode(?string $zipcode): Address
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $countryCode
     * @return Address
     */
    public function setCountryCode(?string $countryCode): Address
    {
        $this->countryCode = $countryCode;
        return $this;
    }
}