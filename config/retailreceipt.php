<?php
    /*
     * File Name: retailreceipt.php
     * Created By: R S DEVI PRASAD
     * Used For: Retail Receipt creation and functionality addition.
     * Description: Creation of retailreceipt object for the application.
     */
    require_once "filemaker/FileMaker.php";
    /*
     *
     */
    class RetailReceipt
    {
        public $connection;
        public $databaseName;
        public $hostName;
        public $userName;
        public $password;
        function __construct()
        {
            $this->connection = null;
        }

        //----- Initialize function -----

        public function initDB($db, $host, $user, $pass)
        {
            $this->databaseName = $db;
            $this->hostName = $host;
            $this->userName = $user;
            $this->password = $pass;
        }

        public function DBLogin()
        {
            $this->connection = new FileMaker($this->databaseName, $this->hostName, $this->userName, $this->password);
            if (FileMaker::isError($this->connection)) {
                //$this->handleError("Can't connect to database");
                return false;
            }
            //$this->reportLog("Connection Successful!");
            return true;
        }

        public function findData($layout, $sortR)
        {
            if (!$this->DBLogin()) {
                return false;
            }
            $request = $this->connection->newFindAllCommand($layout);
            $request->addSortRule($sortR, 1);
            $result = $request->execute();
            if (FileMaker::isError($result)) {
                //$this->handleError("Error fetching the data");
                return false;
            }
            //$this->reportLog("Data Fetch Successful!");
            return $result;
        }

        public function saveToDB()
        {
            # code...
        }

        public function handleError($str)
        {
            error_log($str, 3, "./logfiles/errorReport.log");
        }

        public function reportLog($value)
        {
            error_log($value, 3, "./logfiles/logreport.log");
        }
    }
 ?>