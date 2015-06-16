<html>

<body>
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

<div class= "row">
  <!--- Add  ---->

  <!--- search bar -->
  <!--refresh page when submit-->

  <p><input type="text" name="searchitem" size="6">

<?php
$db_conn = oci_connect("ora_c6l8", "a49694110", "ug");

$branchcity = oci_parse($db_conn, "SELECT CITY FROM BRANCH");
$branchaddress = oci_parse($db_conn, "SELECT ADDRESS FROM BRANCH");
$resultcity = oci_execute($branchcity, OCI_DEFAULT);
$resultaddress = oci_execute($branchaddress, OCI_DEFAULT);

echo '<p> Branch city </p>';

echo '<select>';
while ($row = oci_fech_array($resultcity)) {
  echo '<option value="' . htmlspecialchars($row['CITY']) . '">' . htmlspecialchars($row['CITY']) . '</option>';
}
echo '</select>';

echo '<p> Branch address </p>';

echo '<select>';
while ($row = oci_fech_array($resultaddress)) {
  echo '<option value="' . htmlspecialchars($row['ADDRESS']) . '">' . htmlspecialchars($row['ADDRESS']) . '</option>';}
echo '</select>';


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
