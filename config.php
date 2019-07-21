<?php
session_start();
date_default_timezone_set("Asia/Kolkata");

	class MySql {
        
        var $link; 
        var $dbName = "";
        var $qry    = "";
        
        function MySql($dbHost,$dbUser,$dbPass,$dbName){
            $this->dbName = $dbName;
            $this->link = mysql_connect($dbHost,$dbUser,$dbPass) or die("Error");
        }
        
        function select($sql,$ass=false) {
            
            mysql_select_db($this->dbName,$this->link);

            $resultData = array();
            $result     = mysql_query($sql,$this->link);
            
            if ($ass) {
                return mysql_fetch_assoc($result); 
            }
            
            if ($result) { 
                
                if (mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_assoc($result)) {
                        $resultData[]=$row;
                    }
                    mysql_free_result($result);  
                }
            }
            
            return $resultData;
        }
        
        function execute($sql) {
            
            $this->qry = $sql;
            mysql_select_db($this->dbName,$this->link);
            mysql_query($this->qry,$this->link);
            return mysql_affected_rows();
        }
        
        function insert($tableName,$rowData) {
            
            $r = "insert into `".$tableName."` (";
            $l = " values (";
            foreach($rowData as $key => $value) {
                $r.="`".$key."`,";
                if ($value=="Null") {
                    $l.="Null,";
                } else {
                    $l.="'".$value."',";    
                }
                
            }
            $r = substr($r,0,strlen($r)-1).")";
            $l = substr($l,0,strlen($l)-1).")";
            $sql = $r.$l;
            
            mysql_select_db($this->dbName,$this->link);

            $this->qry=$sql;  
            mysql_query($this->qry,$this->link) ;
            return mysql_insert_id($this->link);
        }
        
         function update($tableName,$rowData,$where) {
            
            $r = "update `".$tableName."` set ";
 
            foreach($rowData as $key => $value) {
                $r.="`".$key."`='".$value."',";
            }
            $r = substr($r,0,strlen($r)-1);
            $sql = $r." where ".$where;
            
            mysql_select_db($this->dbName,$this->link);
            $this->qry=$sql;  
            mysql_query($this->qry,$this->link);
            return mysql_affected_rows($this->link);
        }
        
        function dbClose() {
            mysql_close($this->link);
        }
    }
    function putDateTime($dateTime) {
        return date("M d, Y H:i",strtotime($dateTime));
    }
    
    function putDate($date) {
        return date("M d, Y",strtotime($date));
    }

     if (isset($_GET['action']) && $_GET['action']=="logout") {
        session_destroy();
        $_SESSION['User']=array();
    }
     class SeqMaster {
      
        function GenerateCode($prefix,$numberlength,$number) { 
            for($i=1;$i<=$numberlength-strlen($number);$i++) {
                $prefix .= "0";    
            }
            return $prefix.$number;
        }
        
        function GetNextCustomerCode() {
            global $mysql;
            $prefix = "CMR";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_customers`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
        }
        function GetNextSupplierCode() {
            global $mysql;
            $prefix = "SPR";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_suppliers`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
        }
        function GetNextProductCode() {
            global $mysql;
            $prefix = "PCT";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_products`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
        }
        function GetNextBranchCode() {
            global $mysql;
            $prefix = "BRN";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_branches`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
        }
        
        function GetNextOrderNumber() {
            global $mysql;
            $prefix = "ODR";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_orders`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
        }
        
        function GetNextInvoiceNumber() {
            global $mysql;
            $prefix = "INV";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_invoices`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
        }
        
        function GetNextReceiptNumber() {
            global $mysql;
            $prefix = "RPT";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_receipts`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
        }
}
        class Application {
            function GetBranchBalance($BranchID) {
               global $mysql;
               $data  = $mysql->select("select (sum(PaidToAdmin)-sum(ReceviedAmount))  as rTotal from `_tbl_branches_accounts` where BranchID='".$BranchID."'");   
               return isset($data[0]['rTotal']) ? $data[0]['rTotal'] : 0;
            }
        }
        $applicaiton = new Application();
$mysql   = new MySql("localhost","nahami_user","nahami_user","nahami_tpms");
?>