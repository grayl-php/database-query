<?php

   namespace Grayl\Database\Query\Controller;

   use Grayl\Database\Query\Entity\PlaceholderData;
   use Grayl\Database\Query\Entity\QueryData;
   use Grayl\Database\Query\Service\QueryService;

   /**
    * Abstract class QueryControllerAbstract.
    * The controller for working with QueryData entities.
    *
    * @package Grayl\Database\Query
    */
   abstract class QueryControllerAbstract
   {

      /**
       * The QueryData instance to work with.
       *
       * @var QueryData
       */
      protected QueryData $query_data;

      /**
       * A PlaceholderData instance to save PDO named placeholders.
       *
       * @var PlaceholderData
       */
      protected PlaceholderData $placeholder_data;

      /**
       * The QueryService instance to interact with.
       *
       * @var QueryService
       */
      protected QueryService $query_service;


      /**
       * The class constructor.
       *
       * @param QueryData       $query_data       The QueryData instance to work with.
       * @param PlaceholderData $placeholder_data A PlaceholderData instance to save PDO placeholders.
       * @param QueryService    $query_service    The QueryService instance to use.
       */
      public function __construct ( QueryData $query_data,
                                    PlaceholderData $placeholder_data,
                                    QueryService $query_service )
      {

         // Set the class data
         $this->query_data       = $query_data;
         $this->placeholder_data = $placeholder_data;

         // Set the service entity
         $this->query_service = $query_service;
      }


      /**
       * Returns the fetchable switch.
       *
       * @return bool
       */
      public function isFetchable (): bool
      {

         // Return it
         return $this->query_data->isFetchable();
      }


      /**
       * Returns the SQL action.
       *
       * @return string
       */
      public function getAction (): string
      {

         // Return the action
         return $this->query_data->getAction();
      }


      /**
       * Returns QueryData entity as an SQL statement.
       *
       * @return string
       * @throws \Exception
       */
      public function getSQL (): string
      {

         // Return the SQL statement
         return $this->query_service->getQueryDataAsSQL( $this->query_data,
                                                         $this->placeholder_data );
      }


      /**
       * Retrieves the entire array of PDO placeholders.
       *
       * @return string[]
       */
      public function getPlaceholders (): array
      {

         // Return all placeholders
         return $this->placeholder_data->getPlaceholders();
      }

   }