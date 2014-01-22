<?php

namespace Acme\DemoBundle\Model;

class ContactModel
{
    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $emailAddress;

    /**
     * @var Boolean
     */
    protected $colleague;

    /**
     * @var string
     */
    protected $sex;

    /**
     * @var string;
     */
    protected $city;

    /**
     * @param string $emailAddress
     * @return ContactModel
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $firstName
     * @return ContactModel
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     * @return ContactModel
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param boolean $colleague
     * @return ContactModal
     */
    public function setColleague($colleague)
    {
        $this->colleague = $colleague;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getColleague()
    {
        return $this->colleague;
    }

    /**
     * @param string $city
     * @return ContactModel
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $sex
     * @return ContactModel
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }


}