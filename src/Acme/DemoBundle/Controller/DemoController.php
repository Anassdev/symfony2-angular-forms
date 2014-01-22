<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Form\ContactForm;
use Acme\DemoBundle\Model\ContactModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DemoController extends Controller
{
    protected $contactsFile = '/tmp/contacts';

    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
        $availableCities = array('Brussels', 'London', 'Paris');
        $model = new ContactModel();
        $form = $this->createForm(new ContactForm($availableCities), $model);

        return array(
            'contactForm' => $form->createView(),
            'availableCities' => $availableCities
        );
    }


    /**
     * @Route("contacts", name="acme_demo_contacts")
     * @return JsonResponse
     */
    public function getContactsAction()
    {
        if (file_exists($this->contactsFile)) {
            $contacts = json_decode(file_get_contents($this->contactsFile));
        } else {
            $contacts = array();
        }

        $response = new  JsonResponse($contacts);
        return $response;
    }

    public function addContactAction()
    {

    }


}
