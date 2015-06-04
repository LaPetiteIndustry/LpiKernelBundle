<?php


namespace Lpi\KernelBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ZoneAdmin extends Admin
{
    protected $translationDomain = 'LpiKernelBundle';

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // define group zoning
        $formMapper
            ->with($this->trans('Informations'), array('class' => 'col-md-3'))->end()
            ->with($this->trans('News'), array('class' => 'col-md-9'))->end()
        ;

        $formMapper
            ->with('Informations')
                ->add('name')
                ->add('slug')
            ->add('enabled', null, array('data' => true))
            ->end()
            ->with('News')
            ->add('zoneHasNews', 'sonata_type_collection', array(
                'cascade_validation' => true,
            ), array(
                    'edit'              => 'inline',
                    'inline'            => 'table',
                    'sortable'          => 'position',
                    'admin_code'        => 'lpi.news.admin.zone_has_news'
                )
            )
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('enabled', 'boolean', array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($group)
    {
        // fix weird bug with setter object not being call
        $group->setZoneHasNews($group->getZoneHasNews());
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($group)
    {
        // fix weird bug with setter object not being call
        $group->setZoneHasNews($group->getZoneHasNews());
    }

}
