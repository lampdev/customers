<?php

namespace Acme\CustomersBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @MongoDB\Document(repositoryClass="Acme\CustomersBundle\Repository\ReportRepository")
 */
class Report
{    
    /**
     * @Assert\File(
     *     maxSize = "20M",
     *     mimeTypes = {"application/pdf", "application/x-pdf", "text/html", "image/gif", "image/jpeg", "image/png"},
     *     mimeTypesMessage = "Please upload a valid PDF/IMAGE/DOC"
     * )
     */
    protected $file;

        /**
     * @Assert\File(
     *     maxSize = "20M",
     *     mimeTypes = {"image/jpg","image/jpeg","image/bmp","image/png"},
     *     mimeTypesMessage = "Please upload a valid IMAGE"
     * )
     */
    protected $photo;

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @var
     * @MongoDB\String
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
     * @MongoDB\String
     */
    protected $photolink;

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
     * @param string $user
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return string $user
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
/////////////////////////////////////////////////
  //   private $filename;
  //   private function getFileName()
  //   {
  //       if (empty($this->filename)) {
  //           $this->filename = $this->docs->getClientOriginalName();
  //       }
  //       return $this->filename;
  //   }
  // public function getAbsolutePath()
  // {
  //     return null === $this->getFileName() ? null : $this->getUploadRootDir().'/'.$this->getFileName();
  // }

  // public function getWebPath()
  // {
  //   return null === $this->getFileName() ? null : $this->getUploadDir().'/'.$this->getFileName();
  // }

  // protected function getUploadRootDir($basepath)
  // {
  //   // the absolute directory path where uploaded documents should be saved
  //   return $basepath.$this->getUploadDir();
  // }

  // protected function getUploadDir()
  // {
  //   // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
  //   return 'uploads/reportfiles';
  // }

  // private function setFileName($name)
  // {
  //   $this->filename = $name;
  //   return $this->filename;
  // }

  // public function upload($basepath)
  // {
  //   // the file property can be empty if the field is not required
  //   if (null === $this->docs) {
  //       return;
  //   }

  //   if (null === $basepath) {
  //       return;
  //   }

  //   // we use the original file name here but you should
  //   // sanitize it at least to avoid any security issues

  //   // move takes the target directory and then the target filename to move to
  //   $this->docs->move($this->getUploadRootDir($basepath), $this->docs->getClientOriginalName());

  //   // set the path property to the filename where you'ved saved the file
  //   $this->setFileName($this->docs->getClientOriginalName());

  //   // clean up the file property as you won't need it anymore
  //   $this->docs = $_SERVER['SERVER_NAME'] . '/' . $this->getUploadRootDir($basepath) . '/' . $this->filename;
  // }
///////////////////////////////////////////////////////////////////
    
    static public function getFileUploadDirectory($user)
    {
        return 'uploads/reportfiles/'.$user;
    }

    static public function getPhotoUploadDirectory($user)
    {
        return 'uploads/'.$user;
    }
    
    /**
     * Assumes 'type' => 'file'
     */
    public function setFile(File $file)
    {
        $this->file = $file;
        foreach ($_FILES as $someFile) {
            $filename = $someFile['name']['file'];
            break;
        }
        $this->setDocs($this->getFileFullPath($filename));
    }
    
    public function getFile()
    {
        if ($this->docs==null) {
            return $this->file;
        }
        return $this->file;
    }

    /**
     * Assumes 'type' => 'file'
     */
    public function setPhoto(File $file)
    {
        $this->photo = $file;
        foreach ($_FILES as $someFile) {
            $filename = $someFile['name']['photo'];
            break;
        }
        $this->setPhotolink($this->getPhotoFullPath($filename));
    }
    
    public function getPhoto()
    {
        if ($this->photolink==null) {
            return $this->photo;
        }
        return $this->photo;
    }

    public function getFileFullPath($filename)
    {
        $this->getDatetime();
        return 'http://' . $_SERVER['SERVER_NAME'] . '/' .$this->getFileUploadDirectory($this->user) . '/' . $this->datetime . $filename;
    }

    public function getPhotoFullPath($filename)
    {
        $this->getDatetime();
        return 'http://' . $_SERVER['SERVER_NAME'] . '/' .$this->getPhotoUploadDirectory('Swindlers') . '/' . $this->datetime . $this->swname . '_' . $this->swsurname . '_' . $this->swcompany . '_' . $filename;
    }

    public function upload()
    {
        $this->getDatetime();
        if (($this->file==null)&&($this->photo==null)) {
            return;
        }
        $filename = array();
        foreach ($_FILES as $someFile) {
            $filename['file']  = $someFile['name']['file'];
            $filename['photo'] = $someFile['name']['photo'];
        }
        // the file property can be empty if the field is not required
        if (null != $filename['file']) {
            // move takes the target directory and then the target filename to move to
            $this->file->move($this->getFileUploadDirectory($this->user), $this->datetime . $filename['file']);
            $this->docs = $this->getFileFullPath($filename['file']);
        }
        if (null != $filename['photo']) {
            $this->photo->move($this->getPhotoUploadDirectory('Swindlers'), $this->datetime . $this->swname . '_' . $this->swsurname . '_' . $this->swcompany . '_' . $filename['photo']);
            $this->photolink = $this->getPhotoFullPath($filename['photo']);
        }  
    }

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
     * @MongoDB\Int
     */
    protected $swid;

    protected $swname;
    protected $swsurname;
    protected $swdescript;
    protected $swcontacts;
    protected $swcompany;

    /**
     * Set swid
     *
     * @param int $swid
     * @return self
     */
    public function setSwid($swid)
    {
        $this->swid = $swid;
        return $this;
    }

    /**
     * Get swid
     *
     * @return int $swid
     */
    public function getSwid()
    {
        return $this->swid;
    }

    public function setSwname($swname)
    {
        $this->swname = $swname;
        return $this;
    }

    public function getSwname()
    {
        return $this->swname;
    }

    public function setSwsurname($swsurname)
    {
        $this->swsurname = $swsurname;
        return $this;
    }

    public function getSwsurname()
    {
        return $this->swsurname;
    }

    public function setSwdescript($swdescript)
    {
        $this->swdescript = $swdescript;
        return $this;
    }

    public function getSwdescript()
    {
        return $this->swdescript;
    }

    public function setSwcontacts($swcontacts)
    {
        $this->swcontacts = $swcontacts;
        return $this;
    }

    public function getSwcontacts()
    {
        return $this->swcontacts;
    }

    public function setSwcompany($swcompany)
    {
        $this->swcompany = $swcompany;
        return $this;
    }

    public function getSwcompany()
    {
        return $this->swcompany;
    }    
}
