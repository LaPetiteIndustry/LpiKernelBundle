<?php
namespace Lpi\KernelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Validator\Constraints\Length;

class ContactType extends AbstractType {

    public static function createForm(FormFactory $formFactory, $action) {
        $form = $formFactory->createBuilder(new ContactType());
        $form->setAction($action);
        return $form;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('email','email');
        $builder->add('object');
        $builder->add('message','textarea', ['constraints'=> [new Length(['min'=> 4])]]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'lpi_basic_contact_form';
    }
}