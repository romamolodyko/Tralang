<?php
namespace TralangBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class WordsAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content')
            ->add('name', 'text')
            ->end()

            ->with('Meta data')
            ->add('name', 'sonata_type_model', array(
                'class' => 'TralangBundle\Entity\Word',
                'property' => 'name',
            ))
            ->end();
    }
}