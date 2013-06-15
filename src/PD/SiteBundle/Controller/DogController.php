<?php
namespace PD\SiteBundle\Controller;

use PD\SiteBundle\Entity\Contact;
use PD\SiteBundle\Entity\Dog;
use PD\SiteBundle\Form\Type\DogType;
use PD\SiteBundle\Form\Type\ContactType;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;

class DogController extends Controller {
    /**
     * @Route("/dog/edit", name="dog_edit")
     * @Secure(roles="ROLE_USER")
     */
    public function editAction() {
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

    /**
     * @Route("/dog/{dog}", name="dog")
     */
    public function showAction(Dog $dog) {
        return $this->container->get('templating')->renderResponse('PDSiteBundle:Dog:show.html.twig', array(
            'dog' => $dog,
        ));
    }

    /**
     * @Route("/dog/{dog}/contact", name="dog_contact")
     * @Secure(roles="ROLE_USER")
     */
    public function contactAction(Dog $dog) {
        $user = $this->get('security.context')->getToken()->getUser();
        $contact = new Contact();
        $contact->setSenderDog($user->getDog());
        $contact->setReceiverDog($dog);
        $form = $this->createForm(new ContactType(), $contact);
        $request = $this->getRequest();
        $form->bindRequest($request);
        if ($this->getRequest()->getMethod() == 'POST') {
            if($form->isValid()) {
                $message = \Swift_Message::newInstance()
                        ->setContentType('text/html')
                        ->setSubject('Ο σκύλος σου έχει έναν νέο θαυμαστή')
                        ->setFrom('notification@petdate.dnna.gr', 'Pet Date')
                        ->setReplyTo($contact->getSenderDog()->getUser()->getEmail())
                        ->setTo($contact->getReceiverDog()->getUser()->getEmail())
                        ->setBody($this->container->get('twig')->render('PDSiteBundle:Email:contact.html.twig', array('contact' => $contact)));
                $this->container->get('mailer')->send($message);
                $this->container->get('session')->getFlashBag()->add('success', 'contact.flash.success');
                return new RedirectResponse($this->get('router')->generate('dog', array('dog' => $dog->getId())));
            }
        }
        return $this->container->get('templating')->renderResponse('PDSiteBundle:Dog:contact.html.twig', array(
            'form' => $form->createView(),
            'dog' => $dog,
        ));
    }
}