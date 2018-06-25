<?php
    class Db{
        private $DB_SERVER   = 'localhost';
        private $DB_USERNAME =  'root';
        private $DB_PASSWORD =  '';
        private $DB_DATABASE =  'sbes';

        private $db_con;
        function connectPDO(){
            $db_con_str = "mysql:host=$this->DB_SERVER;dbname=$this->DB_DATABASE";
            $db_con = new PDO($db_con_str, $this->DB_USERNAME, $this->DB_PASSWORD);
            return $db_con;
        }

        function connectMySqli(){
            $db_con = new mysqli($this->DB_SERVER,$this->DB_USERNAME,$this->DB_PASSWORD,$this->DB_DATABASE);
            return $db_con;
        }

        function cleanString($str){
            return mysqli_real_escape_string($con, $str);
        }

        function CreateInsertValuesParameters($num){
            $str = "(";
            for($i = 0; $i< $num; $i++){
                $str .= ",?";
            }
            $str .= ")";
            return str_replace('(,', "(", $str);
        }
    }