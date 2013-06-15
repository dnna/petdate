<?php
namespace PD\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Review {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="review", type="text", nullable=true)
     */
    protected $message;

    /**
     * @ORM\ManyToOne(targetEntity="PD\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="reviewer_id", referencedColumnName="id")
     */
    protected $reviewer;

    /**
     * @ORM\ManyToOne(targetEntity="PD\SiteBundle\Entity\Dog", inversedBy="aboutMeReviews")
     * @ORM\JoinColumn(name="reviewee_id", referencedColumnName="id")
     */
    protected $reviewee;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    protected $date;

    public function __construct() {
        $this->date = new \DateTime('now');
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getReviewer() {
        return $this->reviewer;
    }

    public function setReviewer($reviewer) {
        $this->reviewer = $reviewer;
    }

    public function getReviewee() {
        return $this->reviewee;
    }

    public function setReviewee($reviewee) {
        $this->reviewee = $reviewee;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }
}
?>
