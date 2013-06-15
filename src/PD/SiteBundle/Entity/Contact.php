<?php
namespace PD\SiteBundle\Entity;

class Contact {
    protected $senderDog;

    protected $receiverDog;

    protected $location;

    protected $puppies;

    protected $message;

    public function getSenderDog() {
        return $this->senderDog;
    }

    public function setSenderDog($senderDog) {
        $this->senderDog = $senderDog;
    }

    public function getReceiverDog() {
        return $this->receiverDog;
    }

    public function setReceiverDog($receiverDog) {
        $this->receiverDog = $receiverDog;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function getPuppies() {
        return $this->puppies;
    }

    public function setPuppies($puppies) {
        $this->puppies = $puppies;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
}
?>
