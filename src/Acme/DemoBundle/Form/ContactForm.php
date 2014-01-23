<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactForm extends AbstractType
{
    protected $cities;

    public function __construct($cities)
    {
        $this->cities = $cities;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array('required' => false));
        $builder->add('firstName', 'text');
        $builder->add('lastName', 'text');
        $builder->add('emailAddress', 'email');
        $builder->add('colleague', 'checkbox', array('required' => false));
        $builder->add('sex', 'choice', array(
            'choices' => array('M' => 'Male', 'F' => 'Female'),
            'expanded' => true
        ));
        $builder->add('city', 'choice', array(
            'choices' => $this->cities,
            'required' => true,
            'empty_value' => 'Choose a city',
            'empty_data' => null,
            'attr' => array(
                'ng-options' => 'cityCode as cityName for (cityCode, cityName) in cities' // use angular
            ),
            'invalid_message' => 'invalid' // error message when the option is invalid ->
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'attr' => array(
                'name' => $this->getName() . 'Form',
                'novalidate' => 'novalidate'
            )
        ));
    }

    public function getName()
    {
        return 'contact';
    }
}
