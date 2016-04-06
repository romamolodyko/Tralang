<?php
namespace TralangBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CategoriesAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('categories', 'text')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('id')->add('categories');
    }
}
