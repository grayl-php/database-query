<?php

   namespace Grayl\Test\Database\Query;

   use Grayl\Database\Query\Controller\DeleteQueryController;
   use Grayl\Database\Query\QueryPorter;
   use PHPUnit\Framework\TestCase;

   /**
    * Test class for the Query package (DELETE statements)
    *
    * @package Grayl\Database\Query
    */
   class DeleteQueryControllerTest extends TestCase
   {

      /**
       * Tests the creation of a valid DeleteQueryController object.
       *
       * @return DeleteQueryController
       */
      public function testCreateDeleteQueryController (): DeleteQueryController
      {

         // Create a DeleteQueryController entity
         $query = QueryPorter::getInstance()
                             ->newDeleteQueryController();

         // Check the type of object created
         $this->assertInstanceOf( DeleteQueryController::class,
                                  $query );

         // Build the query
         $query->delete()
               ->from( 'test_table' )
               ->where( 'row_id',
                        '>',
                        1 )
               ->orderBy( [ 'name' ] )
               ->direction( 'ASC' )
               ->limit( 1 );

         // Return it
         return $query;
      }


      /**
       * Tests the data in a DeleteQueryController.
       *
       * @param DeleteQueryController $query A DeleteQueryController to test.
       *
       * @depends testCreateDeleteQueryController
       * @throws \Exception
       */
      public function testDeleteQueryControllerData ( DeleteQueryController $query ): void
      {

         // Test the data
         $this->assertFalse( $query->isFetchable() );
         $this->assertNotEmpty( $query->getSQL() );

         // Grab Placeholders
         $placeholders = $query->getPlaceholders();

         // Test their data
         $this->assertIsArray( $placeholders );
         $this->assertGreaterThan( 0,
                                   count( $placeholders ) );
         $this->assertArrayHasKey( ':row_id',
                                   $placeholders );
         $this->assertNotEmpty( $placeholders[ ':row_id' ] );
      }

   }
