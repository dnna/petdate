<?php

namespace PD\SiteBundle\Controller;

use PD\SiteBundle\Entity\SearchCriteria;
use PD\SiteBundle\Form\Type\SearchCriteriaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {
    /**
     * @Route("/", name="home")
     * @Template
     */
    public function indexAction() {
        $dogs = $this->container->get('doctrine')->getEntityManager()->getRepository('PD\SiteBundle\Entity\Dog')->findAll();
        $criteria = new SearchCriteria();
        $form = $this->createForm(new SearchCriteriaType(), $criteria);
        return $this->render('PDSiteBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'dogs' => $dogs,
        ));
    }

    /**
     * @Route("/s", name="search")
     * @Template
     */
    public function searchAction() {
        $criteria = new SearchCriteria();
        $form = $this->createForm(new SearchCriteriaType(), $criteria);
        $request = $this->getRequest();
        $form->bindRequest($request);
        if($form->isValid()) {
            $em = $this->container->get('doctrine')->getEntityManager();
            $dogs = $em->getRepository('PD\SiteBundle\Entity\Dog')->findDogs($form->getData());
            return $this->render('PDSiteBundle:Search:search.html.twig', array(
                'dogs' => $dogs,
                'form' => $form->createView(),
            ));
        }
        throw new \Exception('Invalid search');
    }
}
