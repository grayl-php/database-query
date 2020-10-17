<?php

   namespace Grayl\Database\Query\Traits;

   use Grayl\Database\Query\Entity\QueryData;

   /**
    * Trait ControllerLimitTrait.
    * The controller trait for working with limit fields.
    *
    * @package Grayl\Database\Query
    */
   trait ControllerLimitTrait
   {

      /**
       * The QueryData instance to work with.
       *
       * @var QueryData
       */
      protected QueryData $query_data;


      /**
       * Sets the query results limit.
       *
       * @param int $limit The query limit.
       *
       * @return self
       */
      public function limit ( int $limit ): self
      {

         // Set the limit
         $this->query_data->setLimit( $limit );

         // Return self
         return $this;
      }

   }