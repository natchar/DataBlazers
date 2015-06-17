
<?php
    
    $dbhandle = oci_connect("ora_i8b9", "a46664124", "ug");
    if (!$dbhandle) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
    }
    else {
        print "Welcome to BlazerGames ";
    }
    
    //EMPLOYEE LOGIN STARTS HERE
    $myemployeeid = $_POST['employeeid'];
    $query = "SELECT * FROM Employee Where eID = '" .$myemployeeid."'";
    
    $selected = OCI_parse($dbhandle,$query);
    $succuess = OCI_execute($selected);
    
    
    $count = 0;
    while ($row = OCI_Fetch_ASSOC($selected)){
        $employee = $row['EID'];
        $count = $count + 1;
        setcookie("ForEmployeeCookie", $employee);
        
    }
    if($count!=1){
        echo "Incorrect EmployeeID";
    }
    else{
        echo "working";
    }
    //EMPLOYEE LOGIN ENDS HERE
    
    

    // Close the Oracle connection
    oci_close($dbhandle);
    ?>

