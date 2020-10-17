<?php

   namespace Grayl\Test\Database\Query;

   use Grayl\Database\Query\Controller\UpdateQueryController;
   use Grayl\Database\Query\QueryPorter;
   use PHPUnit\Framework\TestCase;

   /**
    * Test class for the Query package (UPDATE statements)
    *
    * @package Grayl\Database\Query
    */
   class UpdateQueryControllerTest extends TestCase
   {

      /**
       * Tests the creation of a valid UpdateQueryController object.
       *
       * @return UpdateQueryController
       */
      public function testCreateUpdateQueryController (): UpdateQueryController
      {

         // Create a UpdateQueryController entity
         $query = QueryPorter::getInstance()
                             ->newUpdateQueryController();

         // Check the type of object created
         $this->assertInstanceOf( UpdateQueryController::class,
                                  $query );

         // Build the query
         $query->update( 'test_table' )
               ->set( [ 'name'  => 'updated',
                        'value' => 'true', ] )
               ->where( 'row_id',
                        '=',
                        1 )
               ->orderBy( [ 'name' ] )
               ->direction( 'ASC' )
               ->limit( 1 );

         // Return it
         return $query;
      }


      /**
       * Tests the data in a UpdateQueryController.
       *
       * @param UpdateQueryController $query An UpdateQueryController to test.
       *
       * @depends testCreateUpdateQueryController
       * @throws \Exception
       */
      public function testUpdateQueryControllerData ( UpdateQueryController $query ): void
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
