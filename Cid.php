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
    
    

//MEMBER LOGIN STARTS HERE
    $mymemberid = $_POST['memberid'];
    $nextquery = "SELECT * FROM Member Where cID = '" .$mymemberid."'";
    
    $nextselected = OCI_parse($dbhandle, $nextquery);
    $nextsuccuess = OCI_execute($nextselected);
    
    $nextcount = 0;
    
    while($row = OCI_Fetch_ASSOC($nextselected)){
        $member = $row['CID'];
        $nextcount = $nextcount + 1;
        
    }
    if ($nextcount != 1){
        
        header("Location:Practice.php");
       
    }else{
        header("Location:MemberPage.php");
    }
        oci_close($dbhandle);
?>