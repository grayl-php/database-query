<?php

   namespace Grayl\Database\Query\Controller;

   use Grayl\Database\Query\Traits\ControllerLimitTrait;
   use Grayl\Database\Query\Traits\ControllerOrderByTrait;
   use Grayl\Database\Query\Traits\ControllerWhereTrait;

   /**
    * Class UpdateQueryController.
    * The controller for working with QueryData entities for UPDATE statements.
    *
    * @package Grayl\Database\Query
    */
   class UpdateQueryController extends QueryControllerAbstract
   {

      // Traits
      use ControllerWhereTrait;
      use ControllerOrderByTrait;
      use ControllerLimitTrait;

      /**
       * Sets the table.
       *
       * @param string $table The table for the query.
       *
       * @return self
       */
      public function update ( string $table ): self
      {

         // Set the table
         $this->query_data->setTable( $table );

         // Return self
         return $this;
      }


      /**
       * Sets multiple fields using a passed array.
       *
       * @param string[] $modify_fields The associative array of fields to set ( key => value )
       *
       * @return self
       */
      public function set ( array $modify_fields ): self
      {

         // Set the fields
         $this->query_data->setModifyFields( $modify_fields );

         // Return self
         return $this;
      }

   }