<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
require 'config.php';
date_default_timezone_get("Africa/Kampala");

if (isset($_SESSION['t_admin'])) {

}else{
       session_start();
$info=array();
$info=$_SESSION['t_admin'];
}

/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\DESKTOP-V8JT52G\Receipt Printer"
 *  del testfile
 */
try {
    // Enter the share name for your USB printer here
    $connector = null;
    $connector = new WindowsPrintConnector("smb://DESKTOP-V8JT52G/xp-80c");
    /* Print a "Hello world" receipt" */
   $printer = new Printer($connector);
  $printer -> initialize();
/* Information for the receipt */
class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }
    
    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 38;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;
        
        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}

function title(Printer $printer, $text)
{
    $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
    $printer -> text("\n" . $text);
    $printer -> selectPrintMode(); // Reset
}


$total=0;
      $cash=0;
      $change=0;
       $trans_code=$_POST['trans_code'];
       $details_grp_id=$_POST['group_id'];
       

      $receipts=mysqli_query($con,"SELECT a.name as aname, p.name,p.id as item_code,i.quantity,i.rate,r.trans_code,i.details_grp_id,r.received_by,r.cash_tendered,r.amount_paid,r.change_returned from invoice_details i,receipts r,menu_items p,accounts a where (i.details_grp_id='$details_grp_id' AND r.trans_code='$trans_code') AND ((p.id=i.pdt_code) AND (a.id=r.received_by)) ");
      $rm=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM invoice_details WHERE details_grp_id='$details_grp_id'"));
      $num=substr($rm['pdt_code'], 2);
      $rooms=mysqli_query($con,"SELECT a.name as aname, p.room_no as name,i.pdt_code as item_code,i.quantity,i.rate,r.trans_code,i.details_grp_id,r.received_by,r.cash_tendered,r.amount_paid,r.change_returned from invoice_details i,receipts r,bookings p,accounts a where (i.details_grp_id='$details_grp_id' AND r.trans_code='$trans_code') AND ((p.id='$num') AND (a.id=r.received_by)) ");
      $guest=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `guests` WHERE id=(SELECT guest_id FROM bookings WHERE id='$num')"));

      $i=1;
     // $items=array();
  

    $total=0;
      $cash=0;
      $change=0;
/* Date is kept the same for testing */
$date = date('l jS \of F Y h:i:s A');
//$date = "Monday 6th of April 2015 02:56:25 PM";

/* Start the printer */
// $logo = EscposImage::load("vendor/mike42/escpos-php/example/resources/escpos-php.png", false);
//$printer = new Printer($connector);
$tux = EscposImage::load("dist/img/timisha1.png");
$printer -> bitImageColumnFormat($tux);

/* Print top logo */
// $printer -> setJustification(Printer::JUSTIFY_CENTER);
// $printer -> graphics($logo);

/* Name of shop */
// title($printer, "Timisha Hotel:\n");
// $printer -> setTextSize(8, 8);
// $printer -> text("Hello\nworld!\n");


//$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer ->setJustification(Printer::JUSTIFY_CENTER);
$printer -> setEmphasis(true);
// $printer -> text("TIMISHA HOTEL SOROTI LTD.\n");
// $printer -> selectPrintMode();
// $printer -> setEmphasis();
// $printer -> text("Soak in Comfort.\n");
$printer -> text("P.O.Box  , Soroti\n");
$printer -> text("Tel: 0759392274 / 0773557719\n");
$printer -> text("Email: timishahotel@gmail.com\n");
$printer -> setEmphasis(false);
$printer -> feed();

/* Title of receipt */
$printer -> setEmphasis(true);

$printer -> text(" --- Cash Sale  -----   \n");
$printer -> setEmphasis(false);
$printer -> text(new item('--------------', '----------')."\n");
$printer -> text('Trans_ID: '.$trans_code."\n");
if (mysqli_num_rows($receipts)>0) {
}else{
$printer -> text('Guest: '.$guest['name']."\n");
}
if(isset($_POST['place'])){
    $printer -> text("Location:  ".$_POST['place']."\n");
}
/* Items */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> text(new item('Qty | Name', 'Amount'));
$printer -> setEmphasis(false);
    if (mysqli_num_rows($receipts)>0) {
     
    while(  $item=mysqli_fetch_array($receipts)){
    $printer -> text(new item($item['quantity'].' | '.$item['name'],$item['rate']*$item['quantity']));
                        $total=$item['amount_paid'];
                        $cash=$item['cash_tendered'];
                        $change=$item['change_returned'];
}
    }else{
       while(  $item=mysqli_fetch_array($rooms)){
    $printer -> text(new item($item['quantity'].' | Room '.$item['name'], $item['rate']));
                        $total=$item['amount_paid'];
                        $cash=$item['cash_tendered'];
                        $change=$item['change_returned'];
    }
}
$printer -> text(new item('--------------', '----------'));
//
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text(new item('Total: ', $total));
$printer -> selectPrintMode();
//$printer -> setEmphasis(false);
$printer -> feed();

/* Tax and total */
$printer -> setEmphasis(true);
$printer -> text(new item('Cash Tendered:',$cash));
$printer -> text(new item('Change:',$change));
$printer -> setEmphasis(false);

/* Footer */
//$printer -> feed(2);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Thank you for coming \n");
$printer -> text("www.timishahotel.co.ug\n");
$printer -> setUnderline(true);
$printer -> text("Above Rates Are VAT Inclusive \n");
$printer -> setUnderline(false);
$printer -> text("You were serverd by: ".$info['fname'].' '.$info['lname']."\n");
$printer -> text("Pos Software Powered By: \n Systems Master Ug.0703729371 \n");
$printer -> text($date . "\n");

//$printer -> feed();
$printer -> feed(2);



/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();

/* A wrapper to do organise item names & prices into columns */


} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}