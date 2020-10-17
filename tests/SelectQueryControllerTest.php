<?php

   namespace Grayl\Test\Database\Query;

   use Grayl\Database\Query\Controller\SelectQueryController;
   use Grayl\Database\Query\QueryPorter;
   use PHPUnit\Framework\TestCase;

   /**
    * Test class for the Query package (SELECT statements)
    *
    * @package Grayl\Database\Query
    */
   class SelectQueryControllerTest extends TestCase
   {

      /**
       * Tests the creation of a valid SelectQueryController object.
       *
       * @return SelectQueryController
       */
      public function testCreateSelectQueryController (): SelectQueryController
      {

         // Create a SelectQueryController entity
         $query = QueryPorter::getInstance()
                             ->newSelectQueryController();

         // Check the type of object created
         $this->assertInstanceOf( SelectQueryController::class,
                                  $query );

         // Build the query
         $query->select( [ 'name',
                           'value', ] )
               ->from( 'test_table' )
               ->where( 'row_id',
                        '=',
                        1 )
               ->andWhere( 'name',
                           '=',
                           'test1' )
               ->orderBy( [ 'name' ] )
               ->direction( 'ASC' )
               ->limit( 1 );

         // Return it
         return $query;
      }


      /**
       * Tests the data in a SelectQueryController.
       *
       * @param SelectQueryController $query A SelectQueryController to test.
       *
       * @depends testCreateSelectQueryController
       * @throws \Exception
       */
      public function testSelectQueryControllerData ( SelectQueryController $query ): void
      {

         // Test the data
         $this->assertTrue( $query->isFetchable() );
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
