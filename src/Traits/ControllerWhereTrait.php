<?php

   namespace Grayl\Database\Query\Traits;

   use Grayl\Database\Query\Entity\QueryData;
   use Grayl\Database\Query\Entity\WhereClause;

   /**
    * Trait ControllerWhereTrait.
    * The controller trait for working with WhereClause entities.
    *
    * @package Grayl\Database\Query
    */
   trait ControllerWhereTrait
   {

      /**
       * The QueryData instance to work with.
       *
       * @var QueryData
       */
      protected QueryData $query_data;


      /**
       * Returns a new WhereClause entity.
       *
       * @param ?string $glue        The glue of the where clause, i.e. "and" / "or".
       * @param string  $field_name  The name of the field.
       * @param string  $condition   The condition of the clause, i.e. =, <, >, etc.
       * @param mixed   $field_value The required value of the field.
       *
       * @return WhereClause
       */
      protected function newWhereClause ( ?string $glue,
                                          string $field_name,
                                          string $condition,
                                          $field_value ): WhereClause
      {

         // Return a new WhereClause
         return new WhereClause ( $glue,
                                  $field_name,
                                  $condition,
                                  $field_value );
      }


      /**
       * Sets a new WhereClause entity with no glue.
       *
       * @param string $field_name  The name of the field.
       * @param string $condition   The condition of the clause, i.e. =, <, >, etc.
       * @param mixed  $field_value The required value of the field.
       *
       * @return self
       */
      public function where ( string $field_name,
                              string $condition,
                              $field_value ): self
      {

         // Set a new WhereClause
         $this->query_data->putWhereClause( $this->newWhereClause( null,
                                                                   $field_name,
                                                                   $condition,
                                                                   $field_value ) );

         // Return self
         return $this;
      }


      /**
       * Sets a new WhereClause entity with 'and'.
       *
       * @param string $field_name  The name of the field.
       * @param string $condition   The condition of the clause, i.e. =, <, >, etc.
       * @param mixed  $field_value The required value of the field.
       *
       * @return self
       */
      public function andWhere ( string $field_name,
                                 string $condition,
                                 $field_value ): self
      {

         // Set a new WhereClause
         $this->query_data->putWhereClause( $this->newWhereClause( 'and',
                                                                   $field_name,
                                                                   $condition,
                                                                   $field_value ) );

         // Return self
         return $this;
      }


      /**
       * Sets a new WhereClause entity with 'or'.
       *
       * @param string $field_name  The name of the field.
       * @param string $condition   The condition of the clause, i.e. =, <, >, etc.
       * @param mixed  $field_value The required value of the field.
       *
       * @return self
       */
      public function orWhere ( string $field_name,
                                string $condition,
                                $field_value ): self
      {

         // Set a new WhereClause
         $this->query_data->putWhereClause( $this->newWhereClause( 'or',
                                                                   $field_name,
                                                                   $condition,
                                                                   $field_value ) );

         // Return self
         return $this;
      }

   }