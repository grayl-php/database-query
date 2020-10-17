<?php

   namespace Grayl\Database\Query\Entity;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Class PlaceholderData.
    * The base entity for PlaceholderData.
    *
    * @package Grayl\Database\Query
    */
   class PlaceholderData
   {

      /**
       * PDO named placeholders used in this query.
       *
       * @var KeyedDataBag
       */
      protected KeyedDataBag $placeholders;


      /**
       * The class constructor.
       */
      public function __construct ()
      {

         // Create the placeholder bag
         $this->placeholders = new KeyedDataBag();
      }


      /**
       * Retrieves the entire array of PDO placeholders.
       *
       * @return string[]
       */
      public function getPlaceholders (): array
      {

         // Return all placeholder fields
         return $this->placeholders->getVariables();
      }


      /**
       * Sets a single PDO placeholder.
       *
       * @param string $key   The key name for the field.
       * @param mixed  $value The value of the field.
       */
      public function setPlaceholder ( string $key,
                                       ?string $value ): void
      {

         // Set the field
         $this->placeholders->setVariable( $key,
                                           $value );
      }


      /**
       * Sets multiple placeholders using a passed array.
       *
       * @param string[] $placeholders The associative array of fields to set ( key => value )
       */
      public function setPlaceholders ( array $placeholders ): void
      {

         // Set the fields
         $this->placeholders->setVariables( $placeholders );
      }

   }