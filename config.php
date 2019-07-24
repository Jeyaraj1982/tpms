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



    function InvoiceDownload($InvoiceNumber,$isAdmin=0) {
        
        global $mysql;
        
        if ($isAdmin==0) {
          $InvoiceInfo = $mysql->select("select * from `_tbl_invoices` where `CreatedBy`='".$_SESSION['User']['BranchID']."' and `InvoiceNumber`='".$InvoiceNumber."'") ;  
        } else {
            $InvoiceInfo = $mysql->select("select * from `_tbl_invoices` where   `InvoiceNumber`='".$InvoiceNumber."'") ;
        }
        
        
        if (sizeof($InvoiceInfo)==0) {
            return 'error';
        }
        $InvoiceItems = $mysql->select("select * from _tbl_invoices_items where InvoiceID='".$InvoiceInfo[0]['InvoiceID']."'");
        
        $i=1;
                 
        $return = '<div class="table-responsive">
                           
                               <div style="border:1px solid #e5e5e5;margin:10px;padding:20px;">
                                '.PDFHeader().'
                                <table style="width:100%;">
                                <tr>
                                    <td style="width:50%;vertical-align:top">
                                        <div>
                                            <b>Customer Information</b><Br><br>'.
                                            $InvoiceInfo[0]['CustomerName'].'<br>'.
                                            (strlen(trim($InvoiceInfo[0]['AddressLine1']))>0 ?  $InvoiceInfo[0]['AddressLine1'].",<br>" : "") . 
                                            (strlen(trim($InvoiceInfo[0]['AddressLine2']))>0 ?  $InvoiceInfo[0]['AddressLine2'].",<br>" : "") . 
                                            (strlen(trim($InvoiceInfo[0]['AddressLine3']))>0 ?  $InvoiceInfo[0]['AddressLine3'].",<br>" : "") . 
                                            (strlen(trim($InvoiceInfo[0]['PinCode']))>0 ?  $InvoiceInfo[0]['PinCode'].",<br>" : "") . ' 
                                            Mobile: '.$InvoiceInfo[0]['MobileNumber'].'<br>
                                            Email: '.$InvoiceInfo[0]['EmailID'].',<br>
                                        </div>
                                    </td>
                                    <td style="text-align:right;width:50%;vertical-align:top">
                                        <b>Invoice Information</b><br><br>
                                        <b>Invoice #</b>&nbsp;:&nbsp;'.$InvoiceInfo[0]['InvoiceNumber'].'<br>
                                        <b>Invoiced</b>&nbsp;:&nbsp;'.putDateTime($InvoiceInfo[0]['InvoiceDate']).'<br><br>
                                       
                                        <b>Order #</b>&nbsp;:&nbsp;'.$InvoiceInfo[0]['OrderNumber'].'<br>
                                        <b>Ordered</b>&nbsp;:&nbsp;'.putDateTime($InvoiceInfo[0]['OrderDate']).'<br><br>
                                        <b>Branch</b>&nbsp;:&nbsp;'.$InvoiceInfo[0]['BranchName'].'<br><br>
                                    </td>
                                </tr>
                               </table>
                              
                               <p style="text-align:center;font-size:20px;">Invoice</p>
                          
                               <table id="add-row" class="display table table-striped table-hover"  style="width:100%;">
                                     <tr>
                                        <td colspan="7">  <hr> </td>
                                     </tr>
                                    <tr>
                                        <td style="text-align:right">Sl No</th>
                                        <td>Particulars</td>
                                        <td style="text-align:right">Qty</td>
                                        <td style="text-align:right">Price</td>
                                        <td style="text-align:right">Amount</td>
                                        <td style="text-align:right">Service Chrg</td>
                                        <td style="text-align:right">Total</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">  <hr> </td>
                                     </tr>
                                    
                                   ';
                                    foreach($InvoiceItems as $items) {
                                        $return .= '<tr>
                                            <td style="text-align:right">'.$i.'.&nbsp;</td>
                                            <td>'.$items['ProductName'].'<Br>
                                                <span style="color:#555">'.$items['Remarks'].'</span>
                                            </td>
                                            <td style="text-align:right">'.$items['Qty'].'</td>
                                            <td style="text-align:right">'.number_format($items['Amount'],2).'</td>
                                            <td style="text-align:right">'.number_format($items['TAmount'],2).'</td>
                                            <td style="text-align:right">'.number_format($items['ServiceCharge'],2).'</td>
                                            <td style="text-align:right">'.number_format($items['TsAmount'],2).'</td>
                                        </tr>';
                                        $i++; 
                                        $totalAmt+=$items['TsAmount'];
                                    }
                                   $return .= '
                                   <tr>
                                        <td colspan="7">  <hr> </td>
                                     </tr>
                                        <tr>
                                           <td colspan="6" style="text-align:right">Total Amount</td>
                                           <td style="text-align:right">'.number_format($InvoiceInfo[0]['InvoiceValue'],2).'</td>
                                        </tr>
                                     <tr>
                                        <td colspan="7">  <hr> </td>
                                     </tr>
                               </table>
                              
                               </div>
                                <div style=";margin:10px;padding:20px;padding-top:0px;padding-right:0px;padding-bottom:10px;text-align:right">';
                                if ($InvoiceInfo[0]['BalanceAmount']==0) {
                                    $return .= "Paid";
                                } else {
                                    $return .= "Not Paid<br>";
                                    $return .= "Unpaid Amount : Rs. ".number_format($InvoiceInfo[0]['BalanceAmount'],2);
                                }
                            $return .= '<p style="font-size:10px;color:#888">Generated on: '.date("Y-m-d H:i").'</div>
                        </div>';
        return $return;
}

    function OrderDownload($OrderNumber,$isAdmin=0) {
        global $mysql;
        if ($isAdmin==0) {
        $OrderInfo = $mysql->select("select * from `_tbl_orders` where `CreatedBy`='".$_SESSION['User']['BranchID']."' and `OrderNumber`='".$_GET['Order']."'") ;
        } else {
        $OrderInfo = $mysql->select("select * from `_tbl_orders` where `OrderNumber`='".$_GET['Order']."'") ;    
        }
       if (sizeof($OrderInfo)==0) {
        return "Error";
       } 
       
        $OrderItems = $mysql->select("select * from _tbl_orders_items where OrderID='".$OrderInfo[0]['OrderID']."'");
        $i=1;
      $return = '  <div class="table-responsive">
                     
                                <div style="border:1px solid #e5e5e5;margin:10px;padding:20px;">
                                
                                '.PDFHeader().'
                                <table style="width:100%;">
                                <tr>
                                    <td style="width:50%;vertical-align:top">
                                        <div>
                                            <b>Order From</b><Br><br>'.
                                            $OrderInfo[0]['CustomerName'].',<br>'.
                                            (strlen(trim($OrderInfo[0]['AddressLine1']))>0 ?  $OrderInfo[0]['AddressLine1'].",<br>" : "") . 
                                            (strlen(trim($OrderInfo[0]['AddressLine2']))>0 ?  $OrderInfo[0]['AddressLine2'].",<br>" : "") . 
                                            (strlen(trim($OrderInfo[0]['AddressLine3']))>0 ?  $OrderInfo[0]['AddressLine3'].",<br>" : "") . 
                                            (strlen(trim($OrderInfo[0]['PinCode']))>0 ?  $OrderInfo[0]['PinCode'].",<br>" : "") . 
                                            ' Mobile: '.$OrderInfo[0]['MobileNumber'].',<br>
                                             Email: '.$OrderInfo[0]['EmailID'].',<br>
                                        </div>
                                    </td>
                                    <td style="text-align:right;width:50%;vertical-align:top">
                                        <b>Order Information</b><br><br>
                                        <b>Order #</b>&nbsp;:&nbsp;'.$OrderInfo[0]['OrderNumber'].'<br>
                                        <b>Ordered</b>&nbsp;:&nbsp;'.putDateTime($OrderInfo[0]['OrderDate']).'<br><br>
                                        <b>Branch</b>&nbsp;:&nbsp;'.$OrderInfo[0]['BranchName'].'<br><br>
                                    </td>
                                </tr>
                               </table>
                               <hr> 
                               <table id="add-row" style="width:100%" class="display table table-striped table-hover">
                                    <tr>
                                        <td>Sl No</td>
                                        <td>Particulars</td>
                                        <td style="text-align:center">Qty</td>
                                        <td style="text-align:center">Price</td>
                                        <td style="text-align:center">Amount</td>
                                        <td style="text-align:center">Service Chrg</td>
                                        <td style="text-align:center">Total</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">  <hr> </td>
                                     </tr>
                                   ';
                                     
                                    foreach($OrderItems as $items) {
                                        $return .= '<tr>
                                            <td style="text-align:right">'.$i.'.&nbsp;</td>
                                            <td>'.$items['ProductName'].'<Br>
                                                <span style="color:#555">'.$items['Remarks'].'</span>
                                            </td>
                                            <td style="text-align:right">'.$items['Qty'].'</td>
                                            <td style="text-align:right">'.number_format($items['Amount'],2).'</td>
                                            <td style="text-align:right">'.number_format($items['TAmount'],2).'</td>
                                            <td style="text-align:right">'.number_format($items['ServiceCharge'],2).'</td>
                                            <td style="text-align:right">'.number_format($items['TsAmount'],2).'</td>
                                        </tr>';
                                        $i++; 
                                        $totalAmt+=$items['TsAmount'];
                                        } 
                                   $return .= '
                                    <tr>
                                        <td colspan="7">  <hr> </td>
                                     </tr>
                                        <tr>
                                           <td colspan="6" style="text-align:right">Total Amount</td>
                                           <td style="text-align:right">'.number_format($OrderInfo[0]['OrderValue'],2).'</td>
                                        </tr>
                                     <tr>
                                        <td colspan="7">  <hr> </td>
                                     </tr>
                               </table>
                        
                              
                         <p align="right" style="font-size:10px;color:#888">Generated on: '.date("Y-m-d H:i").'</p>
                                
                        </div>';
                        return $return;
    }
    
    function ReceiptDownload($ReceiptNumber,$isAdmin=0) {
        global $mysql;
        if ($isAdmin==0) {
        $ReceiptInfo = $mysql->select("select * from `_tbl_receipts` where `CreatedBy`='".$_SESSION['User']['BranchID']."' and `ReceiptNumber`='".$_GET['Receipt']."'") ;    
        } else {
            $ReceiptInfo = $mysql->select("select * from `_tbl_receipts` where   `ReceiptNumber`='".$_GET['Receipt']."'") ;
        }
         if (sizeof($ReceiptInfo)==0) {
             return "Error";
         }
        $return = ' 
                               
        <div class="table-responsive"> 
                                <div style="border:1px solid #e5e5e5;margin:10px;padding:20px;">
                                '.PDFHeader().'
                                <table style="width:100%;">
                                <tr>
                                    <td style="width:50%;vertical-align:top">
                                        <div>
                                            <b>Customer Information</b><Br><br>
                                            '.$ReceiptInfo[0]['CustomerName'].',<br>'.
                                            (strlen(trim($ReceiptInfo[0]['AddressLine1']))>0 ?  $ReceiptInfo[0]['AddressLine1'].",<br>" : "").
                                            (strlen(trim($ReceiptInfo[0]['AddressLine2']))>0 ?  $ReceiptInfo[0]['AddressLine2'].",<br>" : ""). 
                                            (strlen(trim($ReceiptInfo[0]['AddressLine3']))>0 ?  $ReceiptInfo[0]['AddressLine3'].",<br>" : ""). 
                                            (strlen(trim($ReceiptInfo[0]['Pincode']))>0 ?  $ReceiptInfo[0]['Pincode'].",<br>" : "").' 
                                            Mobile:'.$ReceiptInfo[0]['MobileNumber'].',<br>
                                            Email:'.$ReceiptInfo[0]['EmailID'].',<br>
                                        </div>
                                    </td>
                                    <td style="text-align:right;width:50%;vertical-align:top">
                                        <b>Receipt Information</b><br><br>
                                        <b>Receipt #</b>&nbsp;:&nbsp;'.$ReceiptInfo[0]['ReceiptNumber'].'<br>
                                        <b>Date</b>&nbsp;:&nbsp;'.putDateTime($ReceiptInfo[0]['ReceiptDate']).'<br><br>
                                        <b>Invoice Information</b><br> 
                                        <b>Invoice #</b>&nbsp;:&nbsp;'.$ReceiptInfo[0]['InvoiceNumber'].'<br><Br>
                                        <b>Branch</b>&nbsp;:&nbsp;'.$ReceiptInfo[0]['BranchName'].'<br><br>
                                    </td>
                                </tr>
                               </table>
                               <hr> 
                               <table style="width:100%" id="add-row" class="display table table-striped table-hover">
                                  
                                    <tr>
                                        <td>Sl No</td>
                                        <td>Particulars</td>
                                        <td style="text-align:center">Amount</td>
                                    </tr>
                                      <tr>
                                         <td colspan="3"><hr></td>
                                    </tr>
                                   <tr>
                                    <td>1.</td>
                                        <td>Part payment Recevied against Invoice Number '.$ReceiptInfo[0]['InvoiceNumber'].'</td>
                                        <td style="text-align:right">'.number_format($ReceiptInfo[0]['ReceiptAmount'],2).'</td>
                                   </tr>
                                     <tr>
                                         <td colspan="3"><hr></td>
                                    </tr>
                                       <tr>
                                        <td style="text-align:right" colspan="2">Paid Amount</td>
                                        <td style="text-align:right">'. number_format($ReceiptInfo[0]['ReceiptAmount'],2).'</td>
                                       </tr>
                                      <tr>
                                         <td colspan="3"><hr></td>
                                    </tr>
                                   </tbody> 
                               </table>
                             <p align="right" style="font-size:10px;color:#888">Generated on: '.date("Y-m-d H:i").'</p>    
                               </div>
                             
                            
                        
                        </div>';
        return $return;
        
    }
    
    function PDFHeader() {
        
        return "<div>
        <table style='width:100%' cellpadding='0' cellspacing='0' >
                <tr>
                    <td style='vertical-align:top;font-size:10px;'>
                         <p align='right'>No 520/3A, South Bye Pass Road,</p>
                        <p align='right'>Kurichi Signal Near K A Hotel,</p>
                        <p align='right'>Melapalayam, Tirunelveli - 627005.</p>
                        <p align='right'>PH: +91 9626787878,+91 9698989878. </p>
                    </td>
                    <td style='width:160px;vertical-align:top;text-align:right !important;'>
                      <img src='http://nahami.online/demo/tpms/assets/images/logo.jpg' style='height:50px;'>
                    </td>
                </tr>    
                </table>
                    </div>
                   <br><br><br>
        
        
        
        ";
    }
?>