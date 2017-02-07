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

        public function findRelatedPortal($layout, $id, $relatedSet)
        {
            if (!$this->DBLogin()) {
                $this->writeLog("Failed to fetch portal", $this->errorFile);
                return false;
            }
            $record = $this->connection->getRecordById($layout, $id);
            if (FileMaker::isError($record)) {
                $this->writeLog("Unable to getRecordById in frp", $this->errorFile);
                return false;
            }
            $this->writeLog("getRecordById method Successful", $this->logFile);
            $retRecords = $record->getRelatedSet($relatedSet);
            if (FileMaker::isError($retRecords)) {
                $this->writeLog("getRelatedSet was unsuccessful", $this->errorFile);
                return false;
            }
            return $retRecords;

        }

        public function getFieldData($layout, $id, $fieldName)
        {
            if (!$this->DBLogin()) {
                $this->writeLog("Failed to getFieldData", $this->errorFile);
                return false;
            }
            $record = $this->connection->getRecordById($layout, $id);
            if (FileMaker::isError($record)) {
                $this->writeLog("Unable to getRecordById in gfd", $this->errorFile);
                return false;
            }
            return $record->getField($fieldName);
        }

        //----- CRUD Operations -----

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

        public function createOrder($layout, $name, $date, $phone)
        {
            if (!$this->DBLogin()) {
                $this->writeLog("Error in database connection", $this->errorFile);
                return false;
            }
            $record = $this->connection->createRecord($layout);
            $record->setField("OrderName_ot", $name);
            $record->setField("OrderDate_od", $date);
            $record->setField("PhoneNum_on", $phone);
            $result= $record->commit();
            if (FileMaker::isError($result)) {
                $this->writeLog("Unable to add record-".$result->getMessage(), $this->errorFile);
                return false;
            }
            $this->writeLog("Record Addition Successful!", $this->logFile);
            return $result;
        }

        public function deleteRecord($layout, $id)
        {
            if (!$this->DBLogin()) {
                $this->writeLog("Error in database connection", $this->errorFile);
                return false;
            }
            $delcmd = $this->connection->newDeleteCommand($layout, $id);
            $retvar = $delcmd->execute();
            if (FileMaker::isError($retvar)) {
                $this->writeLog("Error in deleting the file", $this->errorFile);
                return false;
            }
            $this->writeLog("Deletion Successful!", $this->logFile);
            return $retvar;
        }

        //----- Helper Methods -----

        public function writeLog($str, $fileName)
        {
            date_default_timezone_set($this->timeZone);
            $dateTime = date("Y-m-d h:i:sa");
            error_log("[".$dateTime."]-".$str.PHP_EOL, 3, $fileName);
        }

        public function Sanitize($value)
        {
            $retvar = trim($value);
            $retvar = strip_tags($retvar);
            $retvar = htmlspecialchars($retvar);
            return $retvar;
        }
    }
 ?>