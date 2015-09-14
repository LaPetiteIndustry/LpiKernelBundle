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
            ->add('content', 'ckeditor', array(
                'label' => 'Contenu',
                'config' => ['allowedContent' => true]
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
