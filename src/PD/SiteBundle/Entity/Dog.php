<?php
namespace PD\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\ReadOnly;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass="PD\SiteBundle\Entity\Repositories\DogRepository")
 * @ORM\HasLifecycleCallbacks
 * @ExclusionPolicy("all")
 * @AccessType("public_method")
 */
class Dog {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     /**
     * @ORM\OneToOne(targetEntity="PD\UserBundle\Entity\User", inversedBy="dog")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     * @Expose
     */
    protected $user;
    /**
     * @ORM\Column(type="string")
     * @Expose
     */
    protected $name;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $photoPath;
    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $photo;
    /**
     * @ORM\ManyToOne(targetEntity="Breed")
     * @ORM\JoinColumn(name="color_id", referencedColumnName="id")
     */
    protected $breed;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $gender;
    /**
     * @ORM\ManyToOne(targetEntity="Color")
     * @ORM\JoinColumn(name="color_id", referencedColumnName="id")
     */
    protected $color;
    /**
     * @ORM\Column(type="date")
     */
    protected $birthyear;
    /**
     * @ORM\Column(type="text")
     */
    protected $description;
    /**
     * @ORM\Column(type="text")
     */
    protected $vaccinations;
    /**
     * @ORM\Column(type="text")
     */
    protected $diseases;
    /**
     * @ORM\OneToMany(targetEntity="PD\SiteBundle\Entity\Review", mappedBy="reviewee")
     * @ORM\OrderBy({"date" = "DESC"})
     */
    protected $aboutMeReviews;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function getPhotoPath() {
        return $this->photoPath;
    }

    public function setPhotoPath($photoPath) {
        $this->photoPath = $photoPath;
    }

    public function getBreed() {
        return $this->breed;
    }

    public function setBreed($breed) {
        $this->breed = $breed;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getGenderAsString() {
        if($this->gender == false) {
            return 'Αρσενικό';
        } else {
            return 'Θηλυκό';
        }
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getBirthyear() {
        return $this->birthyear;
    }

    public function setBirthyear($birthyear) {
        $this->birthyear = $birthyear;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getVaccinations() {
        return $this->vaccinations;
    }

    public function setVaccinations($vaccinations) {
        $this->vaccinations = $vaccinations;
    }

    public function getDiseases() {
        return $this->diseases;
    }

    public function setDiseases($diseases) {
        $this->diseases = $diseases;
    }

    public function getAboutMeReviews() {
        return $this->aboutMeReviews;
    }

    public function setAboutMeReviews($aboutMeReviews) {
        $this->aboutMeReviews = $aboutMeReviews;
    }

    // Photo functions
    public function getPhotoAbsolutePath()
    {
        return null === $this->photoPath ? null : $this->getUploadRootDir().'/'.$this->photoPath;
    }

    public function getPhotoWebPath()
    {
        return null === $this->photoPath ? null : $this->getUploadDir().'/'.$this->photoPath;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'upload/dogs';
    }

    // Callbacks
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->photo) {
            $this->removePhotoUpload();
            // do whatever you want to generate a unique name
            $this->photoPath = uniqid().'_photo.'.$this->photo->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null !== $this->photo) {
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error
            $this->photo->move($this->getUploadRootDir(), $this->photoPath);
            unset($this->photo);
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removePhotoUpload()
    {
        $file = $this->getPhotoAbsolutePath();
        if (file_exists($file)) {
            unlink($file);
        }
    }
}
?>
