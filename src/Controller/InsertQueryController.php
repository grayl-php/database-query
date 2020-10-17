<?php

   namespace Grayl\Database\Query\Controller;

   /**
    * Class InsertQueryController.
    * The controller for working with QueryData entities for INSERT statements.
    *
    * @package Grayl\Database\Query
    */
   class InsertQueryController extends QueryControllerAbstract
   {

      /**
       * Sets multiple fields using a passed array.
       *
       * @param string[] $modify_fields The associative array of fields to set ( key => value )
       *
       * @return self
       */
      public function insert ( array $modify_fields ): self
      {

         // Set the fields
         $this->query_data->setModifyFields( $modify_fields );

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
      public function into ( string $table ): self
      {

         // Set the table
         $this->query_data->setTable( $table );

         // Return self
         return $this;
      }

   }