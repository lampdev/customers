<?php

namespace Acme\CustomersBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @MongoDB\Document
 */
class Client extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $username;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Report", mappedBy="user")
     * @var Report[]
     */
    private $reports;



    public function __toString() {
        return $this->username;
    }
    
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @MongoDB\String
     */
    protected $password;

    /**
     * @MongoDB\String
     */
    protected $name;

    /**
     * @MongoDB\String
     */
    protected $surname;

    /**
     * @MongoDB\String
     */
    protected $email;

    /**
     * @MongoDB\String
     */
    protected $skype;

    /**
     * @MongoDB\String
     */
    protected $linkedin; 

    /**
     * @MongoDB\String
     */
    protected $fb; 

    /**
     * @MongoDB\String
     */
    protected $site;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Add report
     *
     * @param Acme\CustomersBundle\Document\Report $report
     */
    public function addReport(\Acme\CustomersBundle\Document\Report $report)
    {
        $this->reports[] = $report;
    }

    /**
     * Remove report
     *
     * @param Acme\CustomersBundle\Document\Report $report
     */
    public function removeReport(\Acme\CustomersBundle\Document\Report $report)
    {
        $this->reports->removeElement($report);
    }

    /**
     * Get reports
     *
     * @return Doctrine\Common\Collections\Collection $reports
     */
    public function getReports()
    {
        return $this->reports;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return self
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * Get surname
     *
     * @return string $surname
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set skype
     *
     * @param string $skype
     * @return self
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;
        return $this;
    }

    /**
     * Get skype
     *
     * @return string $skype
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set linkedin
     *
     * @param string $linkedin
     * @return self
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
        return $this;
    }

    /**
     * Get linkedin
     *
     * @return string $linkedin
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * Set fb
     *
     * @param string $fbF
     * @return self
     */
    public function setFb($fb)
    {
        $this->fb = $fb;
        return $this;
    }

    /**
     * Get fb
     *
     * @return string $fb
     */
    public function getFb()
    {
        return $this->fb;
    }

    /**
     * Set site
     *
     * @param string $site
     * @return self
     */
    public function setSite($site)
    {
        $this->site = $site;
        return $this;
    }

    /**
     * Get site
     *
     * @return string $site
     */
    public function getSite()
    {
        return $this->site;
    }

}
