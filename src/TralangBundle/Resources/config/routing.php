<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

/*$collection->add('Auth', new Route('/', array(
    '_controller' => 'TralangBundle:Auth:auth'
)));*/

$collection->add('Home', new Route('/homepage', array(
    '_controller' => 'TralangBundle:View:index'
)));

$collection->add('Reg', new Route('/reg', array(
    '_controller' => 'TralangBundle:Auth:reg'
)));


return $collection;
