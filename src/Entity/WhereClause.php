<?php

   namespace Grayl\Database\Query\Entity;

   /**
    * Class WhereClause.
    * The entity for a single where clause.
    *
    * @package Grayl\Database\Query
    */
   class WhereClause
   {

      /**
       * The glue of the where clause, i.e. "and" / "or".
       *
       * @var ?string
       */
      private ?string $glue;

      /**
       * The name of the field.
       *
       * @var string
       */
      private string $field_name;

      /**
       * The condition of the clause, i.e. =, <, >, etc.
       *
       * @var string
       */
      private string $condition;

      /**
       * The required value of the field.
       *
       * @var mixed
       */
      private $field_value;


      /**
       * The class constructor
       *
       * @param ?string $glue        The glue of the where clause, i.e. "and" / "or".
       * @param string  $field_name  The name of the field.
       * @param string  $condition   The condition of the clause, i.e. =, <, >, etc.
       * @param mixed   $field_value The required value of the field.
       */
      public function __construct ( ?string $glue,
                                    string $field_name,
                                    string $condition,
                                    $field_value )
      {

         // Set the class data
         $this->setGlue( $glue );
         $this->setFieldName( $field_name );
         $this->setCondition( $condition );
         $this->setFieldValue( $field_value );
      }


      /**
       * Return the glue.
       *
       * @return string
       */
      public function getGlue (): ?string
      {

         // Return it
         return $this->glue;
      }


      /**
       * Sets the glue
       *
       * @param ?string $glue The glue of the where clause, i.e. "and" / "or".
       */
      public function setGlue ( ?string $glue ): void
      {

         // Set the glue
         $this->glue = $glue;
      }


      /**
       * Return the condition.
       *
       * @return string
       */
      public function getCondition (): string
      {

         // Return it
         return $this->condition;
      }


      /**
       * Sets the condition.
       *
       * @param string $condition The condition of the clause, i.e. =, <, >, etc.
       */
      public function setCondition ( string $condition ): void
      {

         // Set the condition
         $this->condition = $condition;
      }


      /**
       * Return the field name.
       *
       * @return string
       */
      public function getFieldName (): string
      {

         // Return it
         return $this->field_name;
      }


      /**
       * Sets the field name.
       *
       * @param string $field_name The name of the field
       */
      public function setFieldName ( string $field_name ): void
      {

         // Set the field name
         $this->field_name = $field_name;
      }


      /**
       * Return the field value.
       *
       * @return string
       */
      public function getFieldValue (): string
      {

         // Return it
         return $this->field_value;
      }


      /**
       * Set the field's required value.
       *
       * @param mixed $field_value The required value of the field.
       */
      public function setFieldValue ( $field_value ): void
      {

         // Set the field value
         $this->field_value = $field_value;
      }

   }