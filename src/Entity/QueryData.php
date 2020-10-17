<?php

   namespace Grayl\Database\Query\Entity;

   use Grayl\Mixin\Common\Entity\FlatDataBag;
   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Class QueryData.
    * The base entity for a query's data.
    *
    * @package Grayl\Database\Query
    */
   class QueryData
   {

      /**
       * The query action (select, insert, etc.)
       *
       * @var string
       */
      protected string $action;

      /**
       * Whether this query returns a result or not.
       *
       * @var bool
       */
      protected bool $fetchable;

      /**
       * The table for the query.
       *
       * @var string
       */
      protected string $table;

      /**
       * Fields to select.
       *
       * @var FlatDataBag
       */
      protected FlatDataBag $select_fields;

      /**
       * Fields to change or update (key => value)
       *
       * @var KeyedDataBag
       */
      protected KeyedDataBag $modify_fields;

      /**
       * A group of all WhereClause instances for this query.
       *
       * @var FlatDataBag
       */
      protected FlatDataBag $where_clauses;

      /**
       * The fields used to order results.
       *
       * @var FlatDataBag
       */
      private FlatDataBag $order_by_fields;

      /**
       * The direction of the ordering (ASC, DESC)
       *
       * @var string
       */
      private string $order_by_direction = 'ASC';

      /**
       * The query limiter.
       *
       * @var ?int
       */
      protected ?int $limit = null;


      /**
       * The class constructor.
       *
       * @param string $action    The query action (select, insert, etc.)
       * @param bool   $fetchable Whether this query returns a result or not.
       */
      public function __construct ( string $action,
                                    bool $fetchable )
      {

         // Set the class data
         $this->setAction( $action );
         $this->setFetchable( $fetchable );

         // Create the bags
         $this->select_fields   = new FlatDataBag();
         $this->modify_fields   = new KeyedDataBag();
         $this->where_clauses   = new FlatDataBag();
         $this->order_by_fields = new FlatDataBag();
      }


      /**
       * Gets the action.
       *
       * @return string
       */
      public function getAction (): string
      {

         // Return it
         return $this->action;
      }


      /**
       * Sets the query action.
       *
       * @param string $action The query action (select, insert, etc.)
       */
      public function setAction ( string $action ): void
      {

         // Set the query action
         $this->action = $action;
      }


      /**
       * Returns the fetchable switch.
       *
       * @return bool
       */
      public function isFetchable (): bool
      {

         // Return it
         return $this->fetchable;
      }


      /**
       * Sets the fetchable switch.
       *
       * @param bool $fetchable Whether the query returns a result or not.
       */
      public function setFetchable ( bool $fetchable ): void
      {

         // Set the fetchable switch
         $this->fetchable = $fetchable;
      }


      /**
       * Returns the table.
       *
       * @return string
       */
      public function getTable (): string
      {

         // Return it
         return $this->table;
      }


      /**
       * Sets the table.
       *
       * @param string $table The table for the query.
       */
      public function setTable ( string $table ): void
      {

         // Set the table
         $this->table = $table;
      }


      /**
       * Retrieves the entire array of select fields.
       *
       * @return string[]
       */
      public function getSelectFields (): array
      {

         // Return all select fields
         return $this->select_fields->getPieces();
      }


      /**
       * Sets a single select field.
       *
       * @param string $field The key name for the field.
       */
      public function setSelectField ( string $field ): void
      {

         // Set the field
         $this->select_fields->putPiece( $field );
      }


      /**
       * Adds multiple select fields using a passed array.
       *
       * @param string[] $fields The fields to add ( key => value )
       */
      public function setSelectFields ( array $fields ): void
      {

         // Set the fields
         $this->select_fields->putPieces( $fields );
      }


      /**
       * Retrieves the entire array of fields.
       *
       * @return string[]
       */
      public function getModifyFields (): array
      {

         // Return all fields
         return $this->modify_fields->getVariables();
      }


      /**
       * Sets a single field.
       *
       * @param string $key   The key name for the field.
       * @param mixed  $value The value of the field.
       */
      public function setModifyField ( string $key,
                                       ?string $value ): void
      {

         // Set the field
         $this->modify_fields->setVariable( $key,
                                            $value );
      }


      /**
       * Sets multiple fields using a passed array.
       *
       * @param string[] $modify_fields The associative array of fields to set ( key => value )
       */
      public function setModifyFields ( array $modify_fields ): void
      {

         // Set the fields
         $this->modify_fields->setVariables( $modify_fields );
      }


      /**
       * Returns all WhereClause entities for this query.
       *
       * @return WhereClause[]
       */
      public function getWhereClauses (): array
      {

         // Return all where clauses
         return $this->where_clauses->getPieces();
      }


      /**
       * Adds a WhereClause to the set of WhereClause entities.
       *
       * @param WhereClause $where_clause The WhereClause instance to add.
       */
      public function putWhereClause ( WhereClause $where_clause ): void
      {

         // Add the where clause
         $this->where_clauses->putPiece( $where_clause );
      }


      /**
       * Adds an array of WhereClause instances to the set.
       *
       * @param WhereClause[] $where_clauses An array of WhereClause instances to add.
       */
      public function putWhereClauses ( array $where_clauses ): void
      {

         // Add the where clauses
         $this->where_clauses->putPieces( $where_clauses );
      }


      /**
       * Retrieves the entire array of order by fields.
       *
       * @return string[]
       */
      public function getOrderByFields (): array
      {

         // Return all order by fields
         return $this->order_by_fields->getPieces();
      }


      /**
       * Adds an order by field.
       *
       * @param string $order_by_field The field to add ( key )
       */
      public function setOrderByField ( string $order_by_field ): void
      {

         // Set the order field
         $this->order_by_fields->putPiece( $order_by_field );
      }


      /**
       * Adds multiple order by fields using a passed array.
       *
       * @param string[] $order_by_fields The fields to add ( key )
       */
      public function setOrderByFields ( array $order_by_fields ): void
      {

         // Set the order fields
         $this->order_by_fields->putPieces( $order_by_fields );
      }


      /**
       * Return the order by direction.
       *
       * @return string
       */
      public function getOrderByDirection (): ?string
      {

         // Return it
         return $this->order_by_direction;
      }


      /**
       * Sets the order by direction.
       *
       * @param string $order_by_direction The direction of the ordering (ASC, DESC)
       */
      public function setOrderByDirection ( string $order_by_direction ): void
      {

         // Set the order by direction
         $this->order_by_direction = $order_by_direction;
      }


      /**
       * Returns the limit.
       *
       * @return ?int
       */
      public function getLimit (): ?int
      {

         // Return it
         return $this->limit;
      }


      /**
       * Sets the limit.
       *
       * @param int $limit The query limit
       */
      public function setLimit ( int $limit ): void
      {

         // Set the limit
         $this->limit = $limit;
      }

   }