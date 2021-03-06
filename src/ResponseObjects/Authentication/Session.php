<?php
namespace OrderSaga\ResponseObjects\Authentication;

use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\SharedObjects\User\User;
use DateTime;

class Session implements APIObjectInterface
{
    use APIObjectTrait;

    /** @var Token */
    private $token;

    /** @var User */
    private $user;

    /** @var DateTime */
    private $dateCreated;

    /** @var DateTime */
    private $dateExpires;

    /**
     * @param array $results
     * @return Session
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->token = Token::create()->populateFromAPIResults($results['token']);
        $this->dateCreated = new DateTime($results['date_created']);
        $this->dateExpires = new DateTime($results['date_expires']);

        $this->user = User::create()->populateFromAPIResults($results['user']);

        return $this;
    }

    public function toArray(): array
    {
        return [
            'token'=>$this->getToken()
        ];
    }

    /**
     * @return Token
     */
    public function getToken(): Token
    {
        return $this->token;
    }

    /**
     * @return DateTime
     */
    public function getDateExpires(): DateTime
    {
        return $this->dateExpires;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param DateTime $dateCreated
     * @return Session
     */
    public function setDateCreated(DateTime $dateCreated): Session
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}