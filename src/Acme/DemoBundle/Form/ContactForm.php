<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactForm extends AbstractType
{
    protected $cities;

    public function __construct($cities)
    {
        $this->cities = $cities;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', 'text');
        $builder->add('lastName', 'text');
        $builder->add('emailAddress', 'email');
        $builder->add('colleague', 'checkbox');
        $builder->add('sex', 'choice', array(
            'choices' => array('M' => 'Male', 'F' => 'Female'),
            'expanded' => true
        ));
        $builder->add('city', 'choice', array(
            'choices' => $this->cities
        ));
    }

    public function getName()
    {
        return 'contact';
    }
}
