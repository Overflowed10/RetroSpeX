<?php

    class User {
        public $id;
        public $firstname;
        public $lastname;
        public $email;
        public $globalRole;

        function __construct($id, $firstname, $lastname, $email, $globalRole){
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->globalRole = $globalRole; 
        }
        
        function getId() {
            return $this->id;
        }

        function getEmail() {
            return $this->email;
        }
        
        function getGlobalRole() {
            return $this->globalRole;
        }
    }
?>