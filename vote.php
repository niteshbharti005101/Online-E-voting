
<?php
  require_once('connection.php');

  session_start();
  
  if(empty($_SESSION['member_id'])){
    header("location:access-denied.php");
  }
?>
<html>
<head>
<title>online voting</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">
</div>

<div class="wrapper bgded overlay" style="background-image:url('https://action.aclu.org/files/aclu/COVID_stimulus_action_1160x650.png');">
    
  <header id="header" class="hoc clear"> 
    
    <div id="logo" class="fl_left">
      <h1><a href="index.html">Voting Panel</a></h1>
    </div>
<?php
    
    $positions= mysqli_query($con,"SELECT * FROM positions") or die("There are no records to display ... \n" . mysqli_error()); 
  $uid = $_SESSION['member_id'];

      $vchk = "SELECT * FROM members WHERE member_id = '$uid'";
      $vchk = mysqli_query($con, $vchk);
      $vchk = mysqli_fetch_assoc($vchk);
      //print_r($vchk);
      //echo $vchk['voteflag'];
      ?>
  <?php
    
      
     if (isset($_GET['vote']))
     {
        $vchk = "SELECT * FROM members WHERE member_id = '$uid'";
      $vchk = mysqli_query($con, $vchk);
      $vchk = mysqli_fetch_assoc($vchk);
        //echo $vchk['voteflag'];
       $id = $_GET['vote'];
         if($vchk['voteflag']==0){
         $result = mysqli_query($con,"SELECT * FROM candidate WHERE candidate_id='$id'") or die(" There are no rectabords at the moment ... \n"); 
       
         $row = mysqli_fetch_assoc($result);
         $votecount = $row['candidate_cvotes']+1;
         mysqli_query($con, "UPDATE candidate SET candidate_cvotes='$votecount' WHERE candidate_id='$id'");
         mysqli_query($con, "UPDATE members SET voteflag=1 WHERE member_id='$uid'");
         
        echo "<h3 style='color: green'>Your Vote has been recorded successfully.</h3>";}
     
     }
     // do something

      
$result = mysqli_query($con,"SELECT * FROM candidate") or die(" There are no records at the moment ... \n"); 
         
?>
<table border="0" width="620" align="center">
<CAPTION><h3>Available Candidates for vote</h3></CAPTION>
  <tr>
    <th>Candidate Name</th>
    <th>Candidate Position</th>
    <th>Vote/No Vote</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)){?>
  <tr>
   
    <td><?php echo $row['candidate_name']; ?></td>
    <td><?php echo $row['candidate_position']; ?></td>
    <?php  if($vchk['voteflag']!=1) echo '<td><a href="vote.php?vote='.$row["candidate_id"].'"> Please Vote </a></td>';
            else echo "<td>You have already voted..</td>"; ?>
  </tr>
  
  <?php } ?>
</table>
<hr>
      <br><br><br><br><br><br><br><br><br><br>
    </header></div>
<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <!-- ################################################################################################ -->
<div class="one_third first">
      <h6 class="title">Address</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
         
          <p>
          Name        : Nitesh Bharti <br>
          University  : SRM University AP <br>
          Batch       : 2022 <br>
          Dept        : CSE <br>
          </p>
          </address>
        </li>
      </ul>
    </div>

    <div class="one_third">
      <h6 class="title">Phone</h6>
      <ul class="nospace linklist contact">
       
        <li><i class="fa fa-phone"></i> +91 91231 19925<br>
          +91 88876 82459</li>


      </ul>
    </div>

    <div class="one_third">
      <h6 class="title">Email</h6>
      <ul class="nospace linklist contact">
        
        <li><i class="fa fa-envelope-o"></i> nitesh_bharti@srmap.edu.in</li>

      </ul>
    </div>


    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2020 - All Rights Reserved - <a href="#">Nitesh Bharti</a></p>
    <p class="fl_right"><!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
</html>