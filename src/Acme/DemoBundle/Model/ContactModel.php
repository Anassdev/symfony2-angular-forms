<?php

namespace Acme\DemoBundle\Model;

class ContactModel
{
    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $emailAddress;

    /**
     * @var Boolean
     */
    public $colleague;

    /**
     * @var string
     */
    public $sex;

    /**
     * @var string;
     */
    public $city;

    /**
     * @param int $id
     * @return ContactModel
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

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