<?php

namespace Acme\CustomersBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Report
{    
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @var
     * @MongoDB\ReferenceOne(targetDocument="Client", inversedBy="reports")
     */
    private $user;

    /**
     * @MongoDB\String
     */
    protected $description;
       
    /**
     * @MongoDB\String
     */
    protected $docs;

    /**
     * @MongoDB\Boolean
     */
    protected $topublic;

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
     * Set user
     *
     * @param Acme\CustomersBundle\Document\Client $user
     * @return self
     */
    public function setUser(\Acme\CustomersBundle\Document\Client $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Acme\CustomersBundle\Document\Client $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set docs
     *
     * @param string $docs
     * @return self
     */
    public function setDocs($docs)
    {
        $this->docs = $docs;
        return $this;
    }

    /**
     * Get docs
     *
     * @return string $docs
     */
    public function getDocs()
    {
        return $this->docs;
    }

    /**
     * Set topublic
     *
     * @param boolean $topublic
     * @return self
     */
    public function setTopublic($topublic)
    {
        $this->topublic = $topublic;
        return $this;
    }

    /**
     * Get topublic
     *
     * @return boolean $topublic
     */
    public function getTopublic()
    {
        return $this->topublic;
    }
}
