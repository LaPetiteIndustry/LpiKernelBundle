<?php

namespace Lpi\KernelBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ContentAdmin extends Admin
{
    protected $translationDomain = 'LpiKernelBundle';

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('content', 'sonata_formatter_type', array(
                'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
                'format_field' => 'contentFormatter',
                'source_field' => 'content',
                'source_field_options' => array(
                    'horizontal_input_wrapper_class' => $this->getConfigurationPool()->getOption('form_type') == 'horizontal' ? 'col-lg-12' : '',
                    'attr' => array('class' => $this->getConfigurationPool()->getOption('form_type') == 'horizontal' ? 'span10 col-sm-10 col-md-10' : '', 'rows' => 20)
                ),
                'ckeditor_context' => 'news',
                'target_field' => 'content',
                'listener' => true,
            ))
            ->add('zone');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('extrait', null, ['label' => 'Extrait'])
            ->add('zone', null, ['label' => 'Zone']);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('content');
    }


}
