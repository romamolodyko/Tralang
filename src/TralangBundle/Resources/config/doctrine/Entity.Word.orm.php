<?php

use Doctrine\ORM\Mapping\ClassMetadataInfo;

$metadata->setInheritanceType(ClassMetadataInfo::INHERITANCE_TYPE_NONE);
$metadata->customRepositoryClassName = 'TralangBundle\Repository\Entity\WordRepository';
$metadata->setChangeTrackingPolicy(ClassMetadataInfo::CHANGETRACKING_DEFERRED_IMPLICIT);
$metadata->mapField(array(
   'fieldName' => 'id',
   'type' => 'integer',
   'id' => true,
   'columnName' => 'id',
  ));
$metadata->mapField(array(
   'columnName' => 'en_words',
   'fieldName' => 'enWords',
   'type' => 'text',
  ));
$metadata->mapField(array(
   'columnName' => 'ru_words',
   'fieldName' => 'ruWords',
   'type' => 'text',
  ));
$metadata->mapField(array(
   'columnName' => 'class_words',
   'fieldName' => 'classWords',
   'type' => 'integer',
  ));
$metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);