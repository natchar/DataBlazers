
<!--Test file to practice. Write notes questions here:
1) Connect php to sql data you have

The script assumes you already have a server set up
All OCI commands are commands to the Oracle libraries
To get the file to work, you must place it somewhere where your
Apache server can run it, and you must rename it to have a ".php"
extension.  You must also change the username and password on the
OCILogon below to be your ORACLE username and password -->



<!DOCTYPE html>
<html>
<body>
<fieldset>
<legend>Personal information:</legend>



<form action="Customer.php" method="POST">
<input type="submit" value="Customer">
</form>


<form action="Cid.php" method="POST">
<p>Enter your CustomerID:</p> <input type = "number" name="memberid" />
<input type="submit" value="Member">
</form>


<form action = "Eid.php" method="POST">
<p>Enter your EmployeeID:</p> <input type="number" name="employeeid" />
<input type="submit" value="Employee">
</form>




</fieldset>
</body>
</html>


/*
 
 <html>
 <body>
 <form action = "employee.php" method="POST">
 <p>Enter the Name:</p> <input type="text" name="Nameone" />
 <p>Enter the Barcode:</p> <input type="number" name="Barcodeone" />
 <p>Enter the ESRB:</p> <input type="text" name="rateone" />
 <p>Enter The Number Players:</p> <input type="number" name="playersone" />
 <input type="submit" value="AddGames">
 </form>
 
 </body>
 </html>
 
 <?php
 if(array_key_exists ('AddGames', $_Post)){
 $Name = $_Post['Nameone'];
 $Barcode = $_Post['Barcodeone'];
 $ESRB = $_Post['rateone'];
 $Players = $_Post['playersone'];
 }
 
 $queryone = Insert INTO Game values('".Barcodeone."','"rateone."','".playersone."');
 $querytwo = Insert INTO ProductBarcode values('".Nameone."','"..Barcodeone."');
 $selectedone = OCI_parse($dbhandle, $queryone);
 $selectedtwo = OCI_parse($dbhandle, $querytwo);
 
 $succuessone = OCI_execute($selectedone);
 $succuesstwo = OCI_execute($selectedtwo);
 
 }
 ?>

 */

