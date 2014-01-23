<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Form\ContactForm;
use Acme\DemoBundle\Model\ContactModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
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
        $model = new ContactModel();
        $availableCities = $this->getAvailableCities();
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
        $response = new JsonResponse($this->getContacts());
        return $response;
    }

    /**
     * @Route("contact/add", name="acme_demo_add_contact")
     * @return JsonResponse
     */
    public function addContactAction()
    {
        $request = $this->getRequest();

        $model = new ContactModel();
        $form = $this->createForm(new ContactForm($this->getAvailableCities()), $model);

        $data = $request->request->all();

        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $contacts = $this->getContacts();
            $contactCount = count($contacts);

            $model = $form->getData();
            $data = (array)$model;
            $data['id'] = $contactCount > 0 ? $contacts[$contactCount - 1]['id'] + 1 : 1;

            $contacts[] = $data;

            $this->setContacts($contacts);

            $response = new JsonResponse($data);
        } else {
            $errors = $this->getErrors($form);
            $response = new JsonResponse($errors, 409);
        }

        return $response;
    }

    /**
     * @Route("contact/update", name="acme_demo_update_contact")
     * @return JsonResponse
     */
    public function updateContactAction()
    {
        $request = $this->getRequest();

        $model = new ContactModel();
        $form = $this->createForm(new ContactForm($this->getAvailableCities()), $model);

        $data = $request->request->all();

        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldContacts = $this->getContacts();
            $newContacts = array();

            $model = $form->getData();
            $data = (array)$model;

            foreach ($oldContacts as $contact)
            {
                if ($contact['id'] == $model->getId()) {
                    $newContacts[] = $data;
                } else {
                    $newContacts[] = $contact;
                }
            }

            $this->setContacts($newContacts);

            $response = new JsonResponse($data);
        } else {
            $errors = $this->getErrors($form);
            $response = new JsonResponse($errors, 409);
        }

        return $response;
    }

    /**
     * Get list with available cities
     * @return array
     */
    protected function getAvailableCities()
    {
        return array(
            'B' => 'Brussels',
            'L' => 'London',
            'P' => 'Paris'
        );
    }

    /**
     * Get current contacts
     */
    protected function getContacts()
    {
        if (file_exists($this->contactsFile)) {
            $data = file_get_contents($this->contactsFile);

            $contacts = json_decode($data, true);
        } else {
            $contacts = array();
        }

        return $contacts;
    }

    /**
     * Save the contacts
     * @param $contacts
     */
    protected function setContacts($contacts)
    {
        file_put_contents($this->contactsFile, json_encode($contacts));
    }


    /**
     * Get all form errors
     * @param Form $form
     * @return array
     */
    private function getErrors(Form $form)
    {
        $errors = array();
        $children = $form->getIterator();

        /** @var Form $child */
        foreach ($children as $child) {
            if (!$child->isValid()) {
                $errors[$form->getName() . '[' . $child->getName() . ']'] = $this->getErrors($child);
            }
        }

        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }

        return $errors;
    }
}
