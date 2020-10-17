<?php

   namespace Grayl\Database\Query\Controller;

   use Grayl\Database\Query\Traits\ControllerLimitTrait;
   use Grayl\Database\Query\Traits\ControllerOrderByTrait;
   use Grayl\Database\Query\Traits\ControllerWhereTrait;

   /**
    * Class DeleteQueryController.
    * The controller for working with QueryData entities for DELETE statements.
    *
    * @package Grayl\Database\Query
    */
   class DeleteQueryController extends QueryControllerAbstract
   {

      // Traits
      use ControllerWhereTrait;
      use ControllerOrderByTrait;
      use ControllerLimitTrait;

      /**
       * Does nothing, for fluid chaining syntax only.
       *
       * @return self
       */
      public function delete (): self
      {

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