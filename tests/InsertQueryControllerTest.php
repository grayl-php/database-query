<?php

   namespace Grayl\Test\Database\Query;

   use Grayl\Database\Query\Controller\InsertQueryController;
   use Grayl\Database\Query\QueryPorter;
   use PHPUnit\Framework\TestCase;

   /**
    * Test class for the Query package (INSERT statements)
    *
    * @package Grayl\Database\Query
    */
   class InsertQueryControllerTest extends TestCase
   {

      /**
       * Tests the creation of a valid InsertQueryController object.
       *
       * @return InsertQueryController
       */
      public function testCreateInsertQueryController (): InsertQueryController
      {

         // Create a InsertQueryController entity
         $query = QueryPorter::getInstance()
                             ->newInsertQueryController();

         // Check the type of object created
         $this->assertInstanceOf( InsertQueryController::class,
                                  $query );

         // Get a random number
         $number = rand( 100,
                         1000 );

         // Build the query
         $query->insert( [ 'name'  => 'test' . $number,
                           'value' => 'success', ] )
               ->into( 'test_table' );

         // Return it
         return $query;
      }


      /**
       * Tests the data in a InsertQueryController.
       *
       * @param InsertQueryController $query A InsertQueryController to test.
       *
       * @depends testCreateInsertQueryController
       * @throws \Exception
       */
      public function testInsertQueryControllerData ( InsertQueryController $query ): void
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
         $this->assertArrayHasKey( ':name',
                                   $placeholders );
         $this->assertNotEmpty( $placeholders[ ':name' ] );
      }

   }
