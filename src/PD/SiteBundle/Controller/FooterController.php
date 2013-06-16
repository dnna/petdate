<?php

namespace PD\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FooterController extends Controller {
    /**
     * @Route("/how_it_works", name="how_it_works")
     * @Template
     */
    public function howItWorksAction() {
        return $this->render('PDSiteBundle:Footer:how_it_works.html.twig', array());
    }

    /**
     * @Route("/faq", name="faq")
     * @Template
     */
    public function faqAction() {
        return $this->render('PDSiteBundle:Footer:faq.html.twig', array());
    }

    /**
     * @Route("/terms", name="terms")
     * @Template
     */
    public function termsAction() {
        return $this->render('PDSiteBundle:Footer:terms.html.twig', array());
    }

    /**
     * @Route("/contact", name="contact")
     * @Template
     */
    public function contactAction() {
        return $this->render('PDSiteBundle:Footer:contact.html.twig', array());
    }
}