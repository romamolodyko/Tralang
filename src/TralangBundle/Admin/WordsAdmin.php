<?php
namespace TralangBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use TralangBundle\Entity\Category;

class WordsAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('enWords', 'text')
            ->add('ruWords', 'text')
            ->add('category', 'entity', array(
                'class' => 'TralangBundle\Entity\Category',
                'choice_label' => 'categories',
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('enWords')->add('ruWords')->add('category', null, array(
            'associated_property' => 'categories'));
    }
}