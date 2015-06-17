<html>

<body>
      <?php
      $success = True; //keep track of errors so it redirects the page only if there are no errors
      $db_conn = oci_connect("ora_r3v8", "a21491139", "ug");

      function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
        //echo "<br>running ".$cmdstr."<br>";
        global $db_conn, $success;
        $statement = OCIParse($db_conn, $cmdstr); //There is a set of comments at the end of the file that describe some of the OCI specific functions and how they work

        if (!$statement) {
          echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
          $e = OCI_Error($db_conn); // For OCIParse errors pass the       
          // connection handle
          echo htmlentities($e['message']);
          $success = False;
        }

        $r = OCIExecute($statement, OCI_DEFAULT);
        if (!$r) {
          echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
          $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
          echo htmlentities($e['message']);
          $success = False;
        } else {

        }
        return $statement;

      }
      
      function executeBoundSQL($cmdstr, $list) {
        /* Sometimes a same statement will be excuted for severl times, only
         the value of variables need to be changed.
         In this case you don't need to create the statement several times; 
         using bind variables can make the statement be shared and just 
         parsed once. This is also very useful in protecting against SQL injection. See example code below for       how this functions is used */

        global $db_conn, $success;
        $statement = OCIParse($db_conn, $cmdstr);

        if (!$statement) {
          echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
          $e = OCI_Error($db_conn);
          echo htmlentities($e['message']);
          $success = False;
        }

        foreach ($list as $tuple) {
          foreach ($tuple as $bind => $val) {
            //echo $val;
            //echo "<br>".$bind."<br>";
            OCIBindByName($statement, $bind, $val);
            unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype

          }
          $r = OCIExecute($statement, OCI_DEFAULT);
          if (!$r) {
            echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
            $e = OCI_Error($statement); // For OCIExecute errors pass the statementhandle
            echo htmlentities($e['message']);
            echo "<br>";
            $success = False;
          }
        }

      }

      function printResult($result) { //prints results from a select statement
        echo "<br>Got data from table tab1:<br>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th></tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["NID"] . "</td><td>" . $row["NAME"] . "</td></tr>"; //or just use "echo $row[0]" 
        }
        echo "</table>";

      }



      ?>



      <div class="row">
        <div class="large-3 columns">
          <h1><img src="http://placehold.it/400x100&text=DATABLAZERGAMES"/></h1>
        </div>
        <div class="large-9 columns">
          <ul class="right button-group">
          <li><a href="#" class="button">Link 1</a></li>
          <li><a href="#" class="button">Link 2</a></li>
          <li><a href="#" class="button">Link 3</a></li>
          <li><a href="#" class="button">Link 4</a></li>
          </ul>
         </div>
       </div>
      
     
     
     
     
      <div class="row">
        <div class="large-12 columns">
        <div id="slider">
          <img src="http://placehold.it/1000x400&text=[ img 1 ]"/>
        </div>
        
        <hr/>
        </div>
      </div>
      
     
     
      <div class="row">
        <div class="large-4 columns">
          <img src="http://placehold.it/400x300&text=[img]"/>
          <h4>Your Points!</h4>
          

          <?php
            $db_conn = oci_connect("ora_r3v8", "a21491139", "ug");
            //!!! NEED TO TAKE MEMBER ID FROM LOGIN
            $Memberid = 90876543;
            $Memberpoints = oci_parse($db_conn, "SELECT POINTS FROM MEMBER WHERE CID=:Memberid");

            oci_bind_by_name($Memberpoints, ":Memberid", $Memberid);
            $Memberpointsexecute = oci_execute($Memberpoints);
            echo "<p> MemberID: " . $Memberid . "</p>";
            if($Memberpointsexecute){
              while($row = oci_fetch_assoc($Memberpoints)){
                print "<p> You have " . $row['POINTS'] . " points. </p>";
              }
            }
          
            $MemberAffords = oci_parse($db_conn, "SELECT PB.NAME, PB.PRICE FROM MEMBER M, PRODUCTBARCODE PB WHERE M.POINTS > PB.PRICE AND M.CID = :Memberid ORDER BY PRICE");
            oci_bind_by_name($MemberAffords, ":Memberid", $Memberid);
            $MemberAffordsExecute = oci_execute($MemberAffords);

            echo "<p> You can afford the following items! </p>";

            if($MemberAffordsExecute){
              while ($row = oci_fetch_array($MemberAffords)){
                echo  $row[1]." points: ".$row[0] . "<br>";
              }
            }
          ?>
        </div>
        

        <div class="large-4 columns">
          <img src="http://placehold.it/400x300&text=[img]"/>
          <h4>What you got from us:</h4>

          <?php
            $MemberHistory = oci_parse($db_conn, "SELECT PB.NAME, SUM(PT.QUANTITY) FROM MEMBER M, PURCHASETRACKS PT, PRODUCTBARCODE PB WHERE M.CID=PT.CID AND PT.BARCODE=PB.BARCODE AND M.CID = :Memberid GROUP BY PB.NAME");

            oci_bind_by_name($MemberHistory, ":Memberid", $Memberid);
            $MemberHistoryExecute = oci_execute($MemberHistory);

            if($MemberHistoryExecute){
              while($row = oci_fetch_array($MemberHistory)){
                echo $row[1]. " " . $row[0] . "<br>";
              }
            }

          ?>
          <p> </p>


        </div>
        
        <div class="large-4 columns">
          <img src="http://placehold.it/400x300&text=[img]"/>
          <h4>This is a content section.</h4>
          <p> </p>
        </div>
      
        </div>
        <div class= "row">
  <!--- Add  ---->

  <!--- search bar -->
  <!--refresh page when submit-->

  <p> Search an item: <input type="text" name="searchitem" size="6">

<?php



$branchcity = oci_parse($db_conn, "SELECT distinct CITY FROM BRANCH");
$branchaddress = oci_parse($db_conn, "SELECT distinct ADDRESS FROM BRANCH");
$resultcity = oci_execute($branchcity);
$resultaddress = oci_execute($branchaddress);

echo '<p> Branch city </p>';

echo "<select name = 'branchcity'>";
echo "<option value = 'empty'> ---- </option>";
while ($row = oci_fetch_assoc($branchcity)) {
  echo "<option value='" . $row['CITY'] . "'>" . $row['CITY'] . "</option>";
}
echo "</select>";

echo '<p> Branch address </p>';
echo "<select name = 'branchaddress'>";
echo "<option value = 'empty'> ---- </option>";
while ($row = oci_fetch_array($branchaddress)) {
  echo "<option value='" . $row['ADDRESS'] . "'>" . $row['ADDRESS'] . "</option>";
}
echo "</select>";

?>

  <input type="submit" value="search" name="searchitembutton">
  </p>




  <!-- at branch -->

  <!--- list ALL items -->


</div>




      
     
  
    <div class="row">
        <div class="large-12 columns">
        
          <div class="panel">
            <h4>Get in touch!</h4>
                
            <div class="row">
              <div class="large-9 columns">
                <p>We'd love to hear from you, you attractive person you.</p>
              </div>
              <div class="large-3 columns">
                <a href="#" class="radius button right">Contact Us</a>
              </div>
            </div>
          </div>
          
        </div>
      </div>
     
       
      
      <footer class="row">
        <div class="large-12 columns">
          <hr/>
          <div class="row">
            <div class="large-6 columns">
              <p>© Copyright no one at all. Go to town.</p>
            </div>
            <div class="large-6 columns">
              <ul class="inline-list right">
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
                <li><a href="#">Link 4</a></li>
              </ul>
            </div>
          </div>
        </div> 
      </footer>

    </body>

</html>

     