<?php

namespace Acme\CustomersBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @MongoDB\Document(repositoryClass="Acme\CustomersBundle\Repository\SwindlerRepository")
 */
class Swindler
{    
    /**
     * @Assert\File(
     *     maxSize = "20M",
     *     mimeTypes = {"image/jpg","image/jpeg","image/bmp","image/png"},
     *     mimeTypesMessage = "Please upload a valid IMAGE"
     * )
     */
    protected $photo;
    
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $description;

    /**
     * @MongoDB\String
     */
    protected $photolink;

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
    protected $companyname;

    /**
     * @MongoDB\String
     */
    protected $contacts;    

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
     * Set photolink
     *
     * @param string $photolink
     * @return self
     */
    public function setPhotolink($photolink)
    {
        $this->photolink = $photolink;
        return $this;
    }

    /**
     * Get photolink
     *
     * @return string $photolink
     */
    public function getPhotolink()
    {
        return $this->photolink;
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

    /**
     * Set companyname
     *
     * @param string $companyname
     * @return self
     */
    public function setCompanyname($companyname)
    {
        $this->companyname = $companyname;
        return $this;
    }

    /**
     * Get companyname
     *
     * @return string $companyname
     */
    public function getCompanyname()
    {
        return $this->companyname;
    }

    /**
     * Get contacts
     *
     * @return string $contacts
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Set contacts
     *
     * @param string $contacts
     * @return self
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
        return $this;
    }

/////////////////////////////////////////////////////////////////////////////
    protected $datetime;
    /**
     * Get datetime
     *
     * @return string $datetime
     */
    public function getDatetime()
    {
        $this->datetime =  date('d_m_Y_H_i_s_');
        return $this->datetime;
    }

    public function getFullPath($filename)
    {
        $this->getDatetime();
        return 'http://' . $_SERVER['SERVER_NAME'] . '/' .$this->getUploadDirectory('Swindlers') . '/' . $this->datetime . $this->name . '_' . $this->surname . '_' . $this->companyname . '_' . $filename;
    }

    static public function getUploadDirectory($user)
    {
        return 'uploads/'.$user;
    }
    
    /**
     * Assumes 'type' => 'file'
     */
    public function setFile(File $file)
    {
        $this->photo = $file;
        foreach ($_FILES as $someFile) {
            $filename = $someFile['name']['file'];
            break;
        }
        $this->setPhotolink($this->getFullPath($filename));
    }
    
    public function getFile()
    {
        if ($this->photolink==null) {
            return $this->photo;
        }
        return $this->photo;
    }


    public function upload()
    {
        if ($this->photo==null) {
            return;
        }
        foreach ($_FILES as $someFile) {
            $filename = $someFile['name']['file'];
            break;
        }
        $this->photolink = $filename;

        // the file property can be empty if the field is not required
        if (null === $this->photolink) {
            return;
        }

        // move takes the target directory and then the target filename to move to
        $this->photo->move($this->getUploadDirectory('Swindlers'), $this->datetime . $this->name . '_' . $this->surname . '_' . $this->companyname . '_' . $this->photolink);
        $this->photolink = $this->getFullPath($filename);

    }

}
