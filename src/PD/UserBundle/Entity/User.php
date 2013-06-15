<?php
namespace PD\UserBundle\Entity;

use PD\SiteBundle\Entity\Dog;
use PD\UserBundle\Wantlet\ORM\Point;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Accessor;

/**
 * @ORM\Entity
 * @ORM\Table(name="Users")
 * @ORM\Entity(repositoryClass="PD\UserBundle\Entity\Repositories\UserRepository")
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     *
     * @Assert\MinLength(limit="3", message="The name is too short.")
     * @Assert\MaxLength(limit="50", message="The name is too long.")
     */
    protected $name;
    /**
     * @ORM\OneToOne(targetEntity="PD\SiteBundle\Entity\Dog", mappedBy="user")
     */
    protected $dog;
    /**
     * @ORM\Column(name="address", type="string", nullable=true)
     */
    protected $address;
    /**
     * @ORM\Column(name="point", type="point", nullable=true)
     * @Expose
     */
    protected $point;
    /**
     * @ORM\Column(name="lastpointupdate", type="datetime")
     */
    protected $lastpointupdate;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDog() {
        if(isset($this->dog)) {
            return $this->dog;
        } else {
            $dog = new Dog();
            $dog->setUser($this);
            return $dog;
        }
    }

    public function setDog($dog) {
        $this->dog = $dog;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getPoint() {
        return $this->point;
    }

    public function setPoint($point) {
        $this->point = $point;
    }

    public function setLatitude($latitude)
    {
        if(!isset($this->point)) {
            $this->point = new Point();
        }
        $this->point->setLatitude((float)$latitude);
        $this->lastpointupdate = new \DateTime('now');
    }

    public function getLatitude()
    {
        if(!isset($this->point) || $this->point->getLatitude() == null) {
            return 0;
        } else {
            return $this->point->getLatitude();
        }
    }

    public function setLongitude($longitude)
    {
        if(!isset($this->point)) {
            $this->point = new Point();
        }
        $this->point->setLongitude((float)$longitude);
        $this->lastpointupdate = new \DateTime('now');
    }

    public function getLongitude()
    {
        if(!isset($this->point) || $this->point->getLongitude() == null) {
            return 0;
        } else {
            return $this->point->getLongitude();
        }
    }
}