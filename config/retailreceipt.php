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
        public $errorFile;
        public $logFile;
        public $timeZone;

        function __construct()
        {
            $this->connection = null;
            $this->errorFile = __DIR__."\..\logfiles\logerror.log";
            $this->logFile = __DIR__."\..\logfiles\logreport.log";
            $this->timeZone = "Asia/Kolkata";
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
                $this->writeLog("Can't connect to database",$this->errorFile);
                return false;
            }
            $this->writeLog("Connection Successful!", $this->logFile);
            return true;
        }

        //----- Main Operations -----

        public function findData($layout, $sortR)
        {
            if (!$this->DBLogin()) {
                $this->writeLog("Error in database connection", $this->errorFile);
                return false;
            }

            $request = $this->connection->newFindAllCommand($layout);
            $request->addSortRule($sortR, 1);
            $result = $request->execute();
            if (FileMaker::isError($result)) {
                $this->writeLog("Error in executing findData method", $this->errorFile);
                return false;
            }
            $this->writeLog("Data Fetch Successful!", $this->logFile);
            return $result->getRecords();
        }

        public function saveToDB()
        {
            # code...
        }

        //----- Helper Methods -----

        public function writeLog($str, $fileName)
        {
            date_default_timezone_set($this->timeZone);
            $dateTime = date("Y-m-d h:i:sa");
            error_log("[".$dateTime."]-".$str."\n", 3, $fileName);
        }
    }
 ?>