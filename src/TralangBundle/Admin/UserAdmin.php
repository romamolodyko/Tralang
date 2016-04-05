<?php
namespace TralangBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('username')->add('email');
    }
}