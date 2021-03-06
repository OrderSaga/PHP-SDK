<?php
namespace OrderSaga\SharedObjects\Company;

use OrderSaga\SharedObjects\Address\Address;
use OrderSaga\SharedObjects\Payment\PaymentMethod;
use OrderSaga\SharedObjects\Payment\PaymentTerms;
use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\DateAddedTrait;
use OrderSaga\SharedObjects\User\User;
use OrderSaga\Traits\IDTrait;

class Company implements APIObjectInterface
{
    use IDTrait;
    use APIObjectTrait;
    use DateAddedTrait;

    /** @var string|null */
    private $name;
    /** @var string|null */
    private $dba;
    /** @var Industry|null */
    private $industry;

    /** @var User|null */
    private $primaryRep;

    /** @var string|null */
    private $website;
    /** @var string|null */
    private $phone;
    /** @var string|null */
    private $fax;

    /** @var string|null */
    private $referrer;
    /** @var integer|null */
    private $referrerFee;

    /** @var PaymentMethod|null */
    private $paymentMethod;
    /** @var PaymentTerms|null */
    private $paymentTerms;
    /** @var int|null */
    private $creditLimit;

    /** @var LeadSource|null */
    private $leadSource;

    /** @var LeadStatus|null */
    private $leadStatus;

    /** @var NumberOfEmployees|null */
    private $numEmployees;
    /** @var NumberOfTradeshows|null */
    private $numTradeshows;
    /** @var NumberOfEvents|null */
    private $numEvents;

    /** @var Address|null */
    private $headquartersAddress;

    /**
     * @param array $results
     * @return Company
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);
        $this->setDba($results['dba']);
        if( !empty($results['industry']) )
        {
            $this->setIndustry(Industry::create()->populateFromAPIResults($results['industry']));
        }

        if( $results['primary_rep'] )
        {
            $this->primaryRep = User::create()->populateFromAPIResults($results['primary_rep']);
        }

        $this->setWebsite($results['website']);
        $this->setPhone($results['phone']);
        $this->setFax($results['fax']);

        $this->setReferrer($results['referrer']);
        $this->setReferrerFee($results['referrer_fee']);

        if( !empty($results['payment_terms']) )
        {
            $this->setPaymentTerms(PaymentTerms::create()->populateFromAPIResults($results['payment_terms']));
        }
        if( !empty($results['payment_method']) )
        {
            $this->setPaymentMethod(PaymentMethod::create()->populateFromAPIResults($results['payment_method']));
        }
        if( isset($results['credit_limit']) && !is_null($results['credit_limit']) )
        {
            $this->setCreditLimit((int) $results['credit_limit']);
        }

        if( !empty($results['lead_source']) )
        {
            $this->setLeadSource(LeadSource::create()->populateFromAPIResults($results['lead_source']));
        }
        if( $results['lead_status'] )
        {
            $this->setLeadStatus(LeadStatus::create()->populateFromAPIResults($results['lead_status']));
        }

        if( $results['num_employees'] )
        {
            $this->setNumEmployees(NumberOfEmployees::create()->populateFromAPIResults($results['num_employees']));
        }
        if( $results['num_tradeshows'] )
        {
            $this->setNumTradeshows(NumberOfTradeshows::create()->populateFromAPIResults($results['num_tradeshows']));
        }
        if( $results['num_events'] )
        {
            $this->setNumEvents(NumberOfEvents::create()->populateFromAPIResults($results['num_events']));
        }

        if( $results['hq_address'] )
        {
            $this->setHeadquartersAddress(Address::create()->populateFromAPIResults($results['hq_address']));
        }

        $this->setDateAdded((!empty($results['date_added']) ? new \DateTime($results['date_added']) : null));

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),
            'name'=>$this->getName(),
            'dba'=>$this->getDba(),
            'industry_id'=>($this->getIndustry() ? $this->getIndustry()->getId() : null),

            'primary_rep_id'=>($this->getPrimaryRep() ? $this->getPrimaryRep()->getId() : null),

            'website'=>$this->getWebsite(),
            'phone'=>$this->getPhone(),
            'fax'=>$this->getFax(),

            'referrer'=>$this->getReferrer(),
            'referrer_fee'=>$this->getReferrerFee(),

            'payment_method_id'=>($this->getPaymentMethod() ? $this->getPaymentMethod()->getId() : null),
            'payment_terms_id'=>($this->getPaymentTerms() ? $this->getPaymentTerms()->getId() : null),
            'credit_limit'=>$this->getCreditLimit(),

            'lead_source'=>($this->getLeadSource() ? $this->getLeadSource()->toArray() : null),
            'lead_status_id'=>($this->getLeadStatus() ? $this->getLeadStatus()->getId() : null),

            'num_employees_id'=>($this->getNumEmployees() ? $this->getNumEmployees()->getId() : null),
            'num_tradeshows_id'=>($this->getNumTradeshows() ? $this->getNumTradeshows()->getId() : null),
            'num_events_id'=>($this->getNumEvents() ? $this->getNumEvents()->getId() : null),

            'hq_address'=>($this->getHeadquartersAddress() ? $this->getHeadquartersAddress()->toArray() : null)
        ];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Company
     */
    public function setName(?string $name): Company
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDba(): ?string
    {
        return $this->dba;
    }

    /**
     * @param string|null $dba
     * @return Company
     */
    public function setDba(?string $dba): Company
    {
        $this->dba = $dba;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getPrimaryRep(): ?User
    {
        return $this->primaryRep;
    }

    /**
     * @param User|null $primaryRep
     * @return Company
     */
    public function setPrimaryRep(?User $primaryRep): Company
    {
        $this->primaryRep = $primaryRep;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     * @return Company
     */
    public function setWebsite(?string $website): Company
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Company
     */
    public function setPhone(?string $phone): Company
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string|null $fax
     * @return Company
     */
    public function setFax(?string $fax): Company
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferrer(): ?string
    {
        return $this->referrer;
    }

    /**
     * @param string|null $referrer
     * @return Company
     */
    public function setReferrer(?string $referrer): Company
    {
        $this->referrer = $referrer;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCreditLimit(): ?int
    {
        return $this->creditLimit;
    }

    /**
     * @param int|null $creditLimit
     * @return Company
     */
    public function setCreditLimit(?int $creditLimit): Company
    {
        $this->creditLimit = $creditLimit;
        return $this;
    }

    /**
     * @return Industry|null
     */
    public function getIndustry(): ?Industry
    {
        return $this->industry;
    }

    /**
     * @param Industry|null $industry
     * @return Company
     */
    public function setIndustry(?Industry $industry): Company
    {
        $this->industry = $industry;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getReferrerFee(): ?int
    {
        return $this->referrerFee;
    }

    /**
     * @param int|null $referrerFee
     * @return Company
     */
    public function setReferrerFee(?int $referrerFee): Company
    {
        $this->referrerFee = $referrerFee;
        return $this;
    }

    /**
     * @return PaymentTerms|null
     */
    public function getPaymentTerms(): ?PaymentTerms
    {
        return $this->paymentTerms;
    }

    /**
     * @param PaymentTerms|null $paymentTerms
     * @return Company
     */
    public function setPaymentTerms(?PaymentTerms $paymentTerms): Company
    {
        $this->paymentTerms = $paymentTerms;
        return $this;
    }

    /**
     * @return NumberOfEmployees|null
     */
    public function getNumEmployees(): ?NumberOfEmployees
    {
        return $this->numEmployees;
    }

    /**
     * @param NumberOfEmployees|null $numEmployees
     * @return Company
     */
    public function setNumEmployees(?NumberOfEmployees $numEmployees): Company
    {
        $this->numEmployees = $numEmployees;
        return $this;
    }

    /**
     * @return NumberOfTradeshows|null
     */
    public function getNumTradeshows(): ?NumberOfTradeshows
    {
        return $this->numTradeshows;
    }

    /**
     * @param NumberOfTradeshows|null $numTradeshows
     * @return Company
     */
    public function setNumTradeshows(?NumberOfTradeshows $numTradeshows): Company
    {
        $this->numTradeshows = $numTradeshows;
        return $this;
    }

    /**
     * @return NumberOfEvents|null
     */
    public function getNumEvents(): ?NumberOfEvents
    {
        return $this->numEvents;
    }

    /**
     * @param NumberOfEvents|null $numEvents
     * @return Company
     */
    public function setNumEvents(?NumberOfEvents $numEvents): Company
    {
        $this->numEvents = $numEvents;
        return $this;
    }

    /**
     * @return LeadSource|null
     */
    public function getLeadSource(): ?LeadSource
    {
        return $this->leadSource;
    }

    /**
     * @param LeadSource|null $leadSource
     * @return Company
     */
    public function setLeadSource(?LeadSource $leadSource): Company
    {
        $this->leadSource = $leadSource;
        return $this;
    }

    /**
     * @return LeadStatus|null
     */
    public function getLeadStatus(): ?LeadStatus
    {
        return $this->leadStatus;
    }

    /**
     * @param LeadStatus|null $leadStatus
     * @return Company
     */
    public function setLeadStatus(?LeadStatus $leadStatus): Company
    {
        $this->leadStatus = $leadStatus;
        return $this;
    }

    /**
     * @return PaymentMethod|null
     */
    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @param PaymentMethod|null $paymentMethod
     * @return Company
     */
    public function setPaymentMethod(?PaymentMethod $paymentMethod): Company
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * @return Address|null
     */
    public function getHeadquartersAddress(): ?Address
    {
        return $this->headquartersAddress;
    }

    /**
     * @param Address|null $headquartersAddress
     * @return Company
     */
    public function setHeadquartersAddress(?Address $headquartersAddress): Company
    {
        $this->headquartersAddress = $headquartersAddress;
        return $this;
    }
}