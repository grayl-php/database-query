<?php

   namespace Grayl\Database\Query\Service;

   use Grayl\Database\Query\Entity\PlaceholderData;
   use Grayl\Database\Query\Entity\QueryData;
   use Grayl\Database\Query\Entity\WhereClause;

   /**
    * Class QueryService.
    * The service for working with QueryData entities.
    *
    * @package Grayl\Database\Query
    */
   class QueryService
   {

      /**
       * Generates the SQL for a QueryData entity based on its action.
       *
       * @param QueryData       $query_data       A QueryData instance to use.
       * @param PlaceholderData $placeholder_data A PlaceholderData instance to save PDO placeholders.
       *
       * @return string
       * @throws \Exception
       */
      public function getQueryDataAsSQL ( QueryData $query_data,
                                          PlaceholderData $placeholder_data ): string
      {

         // Determine what to return based on query type
         switch ( $query_data->getAction() ) {
            case 'select':
               return $this->getQueryDataAsSelectSQL( $query_data,
                                                      $placeholder_data );
            case 'insert':
               return $this->getQueryDataAsInsertSQL( $query_data,
                                                      $placeholder_data );
            case 'update':
               return $this->getQueryDataAsUpdateSQL( $query_data,
                                                      $placeholder_data );
            case 'delete':
               return $this->getQueryDataAsDeleteSQL( $query_data,
                                                      $placeholder_data );
            default: // No fields specified
               throw new \Exception( 'No query action specified' );
         }
      }


      /**
       * Generates the SQL for a SELECT query.
       *
       * @param QueryData       $query_data       A QueryData instance to use.
       * @param PlaceholderData $placeholder_data A PlaceholderData instance to save PDO placeholders.
       *
       * @return string
       */
      private function getQueryDataAsSelectSQL ( QueryData $query_data,
                                                 PlaceholderData $placeholder_data ): string
      {

         // Create the base select SQL
         $sql = '{ACTION} {FIELDS} FROM {TABLE} {WHERE} {ORDER_BY} {LIMIT}';

         // Return a fully formatted select query
         return $this->replaceTags( $sql,
                                    [ 'action'   => strtoupper( $query_data->getAction() ),
                                      'fields'   => $this->getSelectFieldsAsSQL( $query_data ),
                                      'table'    => $this->addBackticks( $query_data->getTable() ),
                                      'where'    => $this->getWhereClausesAsSQL( $query_data,
                                                                                 $placeholder_data ),
                                      'order_by' => $this->getOrderByAsSQL( $query_data ),
                                      'limit'    => $this->getLimitAsSQL( $query_data ), ] );
      }


      /**
       * Generates the SQL for a INSERT query.
       *
       * @param QueryData       $query_data       An QueryData instance to use.
       * @param PlaceholderData $placeholder_data A PlaceholderData instance to save PDO placeholders.
       *
       * @return string
       * @throws \Exception
       */
      private function getQueryDataAsInsertSQL ( QueryData $query_data,
                                                 PlaceholderData $placeholder_data ): string
      {

         // Create the base insert SQL
         $sql = '{ACTION} INTO {TABLE} ({FIELD_NAMES}) VALUES ({PLACEHOLDERS})';

         // Return a fully formatted insert query
         return $this->replaceTags( $sql,
                                    [ 'action'       => strtoupper( $query_data->getAction() ),
                                      'table'        => $this->addBackticks( $query_data->getTable() ),
                                      'field_names'  => $this->getModifyFieldNamesAsSQLForInsertQuery( $query_data ),
                                      'placeholders' => $this->getModifyFieldPlaceholdersAsSQLForInsertQuery( $query_data,
                                                                                                              $placeholder_data ), ] );
      }


      /**
       * Generates the SQL for a UPDATE query.
       *
       * @param QueryData       $query_data       An QueryData instance to use.
       * @param PlaceholderData $placeholder_data A PlaceholderData instance to save PDO placeholders.
       *
       * @return string
       * @throws \Exception
       */
      private function getQueryDataAsUpdateSQL ( QueryData $query_data,
                                                 PlaceholderData $placeholder_data ): string
      {

         // Create the base insert SQL
         $sql = '{ACTION} {TABLE} SET {FIELDS} {WHERE} {ORDER_BY} {LIMIT}';

         // Return a fully formatted insert query
         return $this->replaceTags( $sql,
                                    [ 'action'   => strtoupper( $query_data->getAction() ),
                                      'table'    => $this->addBackticks( $query_data->getTable() ),
                                      'fields'   => $this->getModifyFieldsAsSQLForUpdateQuery( $query_data,
                                                                                               $placeholder_data ),
                                      'where'    => $this->getWhereClausesAsSQL( $query_data,
                                                                                 $placeholder_data ),
                                      'order_by' => $this->getOrderByAsSQL( $query_data ),
                                      'limit'    => $this->getLimitAsSQL( $query_data ), ] );
      }


      /**
       * Generates the SQL for a DELETE query.
       *
       * @param QueryData       $query_data       A QueryData instance to use.
       * @param PlaceholderData $placeholder_data A PlaceholderData instance to save PDO placeholders.
       *
       * @return string
       */
      private function getQueryDataAsDeleteSQL ( QueryData $query_data,
                                                 PlaceholderData $placeholder_data ): string
      {

         // Create the base delete SQL
         $sql = '{ACTION} FROM {TABLE} {WHERE} {ORDER_BY} {LIMIT}';

         // Return a fully formatted delete query
         return $this->replaceTags( $sql,
                                    [ 'action'   => strtoupper( $query_data->getAction() ),
                                      'table'    => $this->addBackticks( $query_data->getTable() ),
                                      'where'    => $this->getWhereClausesAsSQL( $query_data,
                                                                                 $placeholder_data ),
                                      'order_by' => $this->getOrderByAsSQL( $query_data ),
                                      'limit'    => $this->getLimitAsSQL( $query_data ), ] );
      }


      /**
       * Generates the SQL for selecting fields.
       *
       * @param QueryData $query_data A QueryData instance to use.
       *
       * @return string
       */
      private function getSelectFieldsAsSQL ( QueryData $query_data ): string
      {

         // If there are specific select fields specified
         if ( ! empty( $query_data->getSelectFields() ) ) {
            // Return all the select fields joined together
            return join( ',',
                         $this->addBackticksToArray( $query_data->getSelectFields() ) );
         }

         // No specific fields, select all
         return '*';
      }


      /**
       * Generates the SQL for inserting field names on an insert query.
       *
       * @param QueryData $query_data A QueryData instance to use.
       *
       * @return string
       * @throws \Exception
       */
      private function getModifyFieldNamesAsSQLForInsertQuery ( QueryData $query_data ): string
      {

         // If there are specific select fields specified
         if ( empty( $query_data->getModifyFields() ) ) {
            // No fields specified
            throw new \Exception( 'No modify fields specified' );
         }

         // Return all the modify field names separated by commas
         return join( ',',
                      $this->addBackticksToArray( array_keys( $query_data->getModifyFields() ) ) );
      }


      /**
       * Generates the SQL for inserting field placeholders on an insert query.
       *
       * @param QueryData       $query_data       A QueryData instance to use.
       * @param PlaceholderData $placeholder_data A PlaceholderData instance to save PDO placeholders.
       *
       * @return string
       * @throws \Exception
       */
      private function getModifyFieldPlaceholdersAsSQLForInsertQuery ( QueryData $query_data,
                                                                       PlaceholderData $placeholder_data ): string
      {

         // If there are specific select fields specified
         if ( empty( $query_data->getModifyFields() ) ) {
            // No fields specified
            throw new \Exception( 'No modify fields specified' );
         }

         // An array of field placeholders
         $placeholders = [];

         // Loop through each modify field
         foreach ( $query_data->getModifyFields() as $field => $value ) {
            // Create a PDO friendly placeholder name for the field
            $pdo_name = ':' . $field;

            // Add the placeholder into the array
            $placeholders[] = $pdo_name;

            // Save the placeholder value into the PlaceHolderData instance
            $placeholder_data->setPlaceholder( $pdo_name,
                                               $value );
         }

         // Return all the modify field placeholders separated by commas
         return join( ',',
                      $placeholders );
      }


      /**
       * Generates the SQL for setting modify fields on an update query.
       *
       * @param QueryData       $query_data       A QueryData instance to use.
       * @param PlaceholderData $placeholder_data A PlaceholderData instance to save PDO placeholders.
       *
       * @return string
       * @throws \Exception
       */
      private function getModifyFieldsAsSQLForUpdateQuery ( QueryData $query_data,
                                                            PlaceholderData $placeholder_data ): string
      {

         // If there are specific select fields specified
         if ( empty( $query_data->getModifyFields() ) ) {
            // No fields specified
            throw new \Exception( 'No modify fields specified' );
         }

         // An array of field placeholders
         $updates = [];

         // Loop through each modify field
         foreach ( $query_data->getModifyFields() as $field => $value ) {
            // Create a PDO friendly placeholder name for the field
            $pdo_name = ':' . $field;

            // Add the placeholder into the array
            $updates[] = $this->addBackticks( $field ) . '=' . $pdo_name;

            // Save the placeholder value into the PlaceHolderData instance
            $placeholder_data->setPlaceholder( $pdo_name,
                                               $value );
         }

         // Return all the modify field placeholders separated by commas
         return join( ',',
                      $updates );
      }


      /**
       * Generates the SQL for a group of where clause conditions.
       *
       * @param QueryData       $query_data       A QueryData instance to use.
       * @param PlaceholderData $placeholder_data A PlaceholderData instance to save PDO placeholders.
       *
       * @return string
       */
      private function getWhereClausesAsSQL ( QueryData $query_data,
                                              PlaceholderData $placeholder_data ): ?string
      {

         // If we have where clauses
         if ( ! empty( $query_data->getWhereClauses() ) ) {
            // Create the base where condition SQL
            $sql = 'WHERE {CONDITIONS}';

            // An array of completed where SQL statement
            $conditions = [];

            // Loop through each single where clause
            foreach ( $query_data->getWhereClauses() as $where_clause ) {
               // Generate the SQL for the single where clause
               $conditions[] = $this->getWhereClauseAsSQL( $where_clause,
                                                           $placeholder_data );
            }

            // Return a fully formatted where statement
            return $this->replaceTags( $sql,
                                       [ 'CONDITIONS' => join( ' ',
                                                               $conditions ), ] );
         }

         // No where clauses specified
         return null;
      }


      /**
       * Generates the SQL for a single where clause condition.
       *
       * @param WhereClause     $where_clause     A WhereClause instance to use.
       * @param PlaceholderData $placeholder_data A PlaceholderData instance to save PDO placeholders.
       *
       * @return string
       */
      private function getWhereClauseAsSQL ( WhereClause $where_clause,
                                             PlaceholderData $placeholder_data ): string
      {

         // Create the base where condition SQL
         $sql = '{GLUE} {FIELD}{CONDITION}{PLACEHOLDER}';

         // Create a PDO friendly placeholder name for the field
         $pdo_name = ':' . $where_clause->getFieldName();

         // Set the placeholder
         $placeholder_data->setPlaceholder( $pdo_name,
                                            $where_clause->getFieldValue() );

         // Return a fully formatted where clause
         return $this->replaceTags( $sql,
                                    [ 'glue'        => strtoupper( $where_clause->getGlue() ),
                                      'field'       => $this->addBackticks( $where_clause->getFieldName() ),
                                      'condition'   => $where_clause->getCondition(),
                                      'placeholder' => $pdo_name, ] );
      }


      /**
       * Generates the SQL for an order by clause.
       *
       * @param QueryData $query_data A QueryData instance to use.
       *
       * @return string
       */
      private function getOrderByAsSQL ( QueryData $query_data ): ?string
      {

         // If there are order by fields specified
         if ( ! empty( $query_data->getOrderByFields() ) ) {
            // Create the base order by SQL
            $sql = 'ORDER BY {FIELDS} {DIRECTION}';

            // Return a fully formatted order by clause
            return $this->replaceTags( $sql,
                                       [ 'fields'    => join( ',',
                                                              $this->addBackticksToArray( $query_data->getOrderByFields() ) ),
                                         'direction' => $query_data->getOrderByDirection(), ] );
         }

         // No specific fields, select all
         return null;
      }


      /**
       * Generates the SQL for a limit clause.
       *
       * @param QueryData $query_data A QueryData instance to use.
       *
       * @return string
       */
      private function getLimitAsSQL ( QueryData $query_data ): ?string
      {

         // If we have a limit
         if ( ! empty( $query_data->getLimit() ) ) {
            // Create the base limit SQL
            $sql = 'LIMIT {LIMIT}';

            // Return a fully formatted limit clause
            return $this->replaceTags( $sql,
                                       [ 'limit' => $query_data->getLimit() ] );
         }

         // No limit specified
         return null;
      }


      /**
       * Replaces tags in a string with data from an array.
       *
       * @param string   $string The string that contains the tags.
       * @param string[] $tags   An array of tags to replace in the string ( tag = replacement format).
       *
       * @return string
       */
      private function replaceTags ( string $string,
                                     array $tags ): string
      {

         // Loop through each tag and replace it in the string
         foreach ( $tags as $tag => $value ) {
            // Replace it
            $string = str_replace( '{' . strtoupper( $tag ) . '}',
                                   $value,
                                   $string );
         }

         // Return the modified and trimmed string
         return trim( $string );
      }


      /**
       * Adds backticks around a string to escape reserved words in queries.
       *
       * @param string $string The string to surround with backticks.
       *
       * @return string
       */
      private function addBackticks ( string $string ): string
      {

         // Do not add backticks to a field named *
         if ( $string == '*' ) {
            return $string;
         }

         // Return the string with surrounding backticks
         return '`' . $string . '`';
      }


      /**
       * Adds backticks to an array of strings to escape reserved words in queries.
       *
       * @param string[] $strings An array of strings to surround with backticks.
       *
       * @return string[]
       */
      private function addBackticksToArray ( array $strings ): array
      {

         // Loop through each string
         foreach ( $strings as $key => $string ) {
            // Add backticks
            $strings[ $key ] = $this->addBackticks( $string );
         }

         // Return the new array with backticks
         return $strings;
      }

   }