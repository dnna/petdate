<?php
namespace PD\UserBundle\Entity;

use PD\SiteBundle\Entity\Dog;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Users")
 * @ORM\Entity(repositoryClass="PD\UserBundle\Entity\Repositories\UserRepository")
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
}