<?php
namespace PD\SiteBundle\Entity;

use PD\UserBundle\Wantlet\ORM\Point;

class SearchCriteria {
    protected $address;

    protected $point;

    protected $gender;

    protected $breed;

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getBreed() {
        return $this->breed;
    }

    public function setBreed($breed) {
        $this->breed = $breed;
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
?>
