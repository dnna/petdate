<?php
namespace PD\SiteBundle\Controller;

use PD\SiteBundle\Form\Type\DogType;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;

class DogController extends Controller {
    /**
     * @Route("/dog/edit", name="dog_edit")
     * @Secure(roles="ROLE_USER")
     */
    public function languageSettingsAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $dog = $user->getDog();
        $form = $this->createForm(new DogType(), $dog);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if($form->isValid()) {
                $em = $this->container->get('doctrine')->getEntityManager();
                $em->persist($dog);
                $em->flush();
                $this->container->get('session')->getFlashBag()->add('success', 'dog_edit.flash.success');
                return new RedirectResponse($this->get('router')->generate('dog_edit'));
            } else {
                throw new \Exception('Dog Edit Error');
            }
        }
        return $this->container->get('templating')->renderResponse('PDSiteBundle:Dog:edit.html.twig', array('form' => $form->createView())
        );
    }
}