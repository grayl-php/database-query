<?php

   namespace Grayl\Database\Query;

   use Grayl\Database\Query\Controller\DeleteQueryController;
   use Grayl\Database\Query\Controller\InsertQueryController;
   use Grayl\Database\Query\Controller\SelectQueryController;
   use Grayl\Database\Query\Controller\UpdateQueryController;
   use Grayl\Database\Query\Entity\PlaceholderData;
   use Grayl\Database\Query\Entity\QueryData;
   use Grayl\Database\Query\Service\QueryService;
   use Grayl\Mixin\Common\Traits\StaticTrait;

   /**
    * Front-end for the Query package.
    *
    * @package Grayl\Database\Query
    */
   class QueryPorter
   {

      // Use the static instance trait
      use StaticTrait;

      /**
       * Creates a new SelectQueryController entity.
       *
       * @return SelectQueryController
       */
      public function newSelectQueryController (): SelectQueryController
      {

         // Return a new SelectQueryController
         return new SelectQueryController( new QueryData( 'select',
                                                          true ),
                                           new PlaceholderData(),
                                           new QueryService() );
      }


      /**
       * Creates a new InsertQueryController entity.
       *
       * @return InsertQueryController
       */
      public function newInsertQueryController (): InsertQueryController
      {

         // Return a new InsertQueryController
         return new InsertQueryController( new QueryData( 'insert',
                                                          false ),
                                           new PlaceholderData(),
                                           new QueryService() );
      }


      /**
       * Creates a new UpdateQueryController entity.
       *
       * @return UpdateQueryController
       */
      public function newUpdateQueryController (): UpdateQueryController
      {

         // Return a new UpdateQueryController
         return new UpdateQueryController( new QueryData( 'update',
                                                          false ),
                                           new PlaceholderData(),
                                           new QueryService() );
      }


      /**
       * Creates a new DeleteQueryController entity.
       *
       * @return DeleteQueryController
       */
      public function newDeleteQueryController (): DeleteQueryController
      {

         // Return a new DeleteQueryController
         return new DeleteQueryController( new QueryData( 'delete',
                                                          false ),
                                           new PlaceholderData(),
                                           new QueryService() );
      }

   }