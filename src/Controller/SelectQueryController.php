<?php

   namespace Grayl\Database\Query\Controller;

   use Grayl\Database\Query\Traits\ControllerLimitTrait;
   use Grayl\Database\Query\Traits\ControllerOrderByTrait;
   use Grayl\Database\Query\Traits\ControllerWhereTrait;

   /**
    * Class SelectQueryController.
    * The controller for working with QueryData entities for SELECT statements.
    *
    * @package Grayl\Database\Query
    */
   class SelectQueryController extends QueryControllerAbstract
   {

      // Traits
      use ControllerWhereTrait;
      use ControllerOrderByTrait;
      use ControllerLimitTrait;

      /**
       * Adds multiple select fields using a passed array.
       *
       * @param string[] $fields The fields to add ( key => value )
       *
       * @return self
       */
      public function select ( array $fields ): self
      {

         // Set the fields
         $this->query_data->setSelectFields( $fields );

         // Return self
         return $this;
      }


      /**
       * Sets the table.
       *
       * @param string $table The table for the query.
       *
       * @return self
       */
      public function from ( string $table ): self
      {

         // Set the table
         $this->query_data->setTable( $table );

         // Return self
         return $this;
      }

   }