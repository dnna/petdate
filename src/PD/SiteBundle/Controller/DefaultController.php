<?php

namespace PD\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {
    /**
     * @Route("/", name="home")
     * @Template
     */
    public function indexAction() {
            return $this->render('PDSiteBundle:Default:index.html.twig');
    }

    /**
     * @Route("/s", name="search")
     * @Template
     */
    public function searchAction() {
            return $this->render('PDSiteBundle:Search:search.html.twig');
    }
}
