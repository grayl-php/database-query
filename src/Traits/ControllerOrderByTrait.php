<?php

   namespace Grayl\Database\Query\Traits;

   use Grayl\Database\Query\Entity\QueryData;

   /**
    * Trait ControllerOrderByTrait.
    * The controller trait for working with OrderBy fields.
    *
    * @property QueryData $query_data The QueryData instance to work with.
    * @package Grayl\Database\Query
    */
   trait ControllerOrderByTrait
   {

      /**
       * Adds multiple order by fields using a passed array.
       *
       * @param string[] $order_by_fields The fields to add ( key )
       *
       * @return self
       */
      public function orderBy ( array $order_by_fields ): self
      {

         // Set the order fields
         $this->query_data->setOrderByFields( $order_by_fields );

         // Return self
         return $this;
      }


      /**
       * Sets the order by direction.
       *
       * @param string $order_by_direction The direction of the ordering (ASC, DESC)
       *
       * @return self
       */
      public function direction ( string $order_by_direction ): self
      {

         // Set the order by direction
         $this->query_data->setOrderByDirection( $order_by_direction );

         // Return self
         return $this;
      }

   }