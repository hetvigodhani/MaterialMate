<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');

 if(!empty($_POST['subid'])){
 $sid=$_POST['subid'];
$sql="SELECT tblsubject.ID as sid,tblsubject.Subject from tblsubject  where tblsubject.ClassID=:sid";
$query = $dbh -> prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $rw)
{               ?>
 <option value="<?php echo $rw->sid;?>"><?php echo $rw->Subject;?></option>
                  

<?php }} ?>