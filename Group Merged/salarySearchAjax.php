<?php
require_once "includes/DataAccess.php";
require_once "includes/validation.php";
session_start();

if(!isset($_SESSION['u_id']) || !isset($_SESSION['u_name'])){
  header("Location: index.php");
}

$da=new DataAccess();

$users_query="select u_id, u_name, u_role from users";
$users_rows=$da->ExecuteQuery($users_query);
$users_rowCount=0;


if($_SERVER["REQUEST_METHOD"]=="GET"){
    $users_query="select * from users where u_name like '%".$_GET['u_name']."%'";
    $users_rows=$da->ExecuteQuery($users_query);
    $n=$da->GetTotalNumberOfRows($users_query);
      
    if($n>1){ $_SESSION['msg']=$n." results found!";}
    else{$_SESSION['msg']=$n." result found!";}

    $_SESSION['msg_type']="success"; 
}
?>

<?php while($users_arr = $da->ConvertRowsToArray($users_rows)){ 
          $users_rowCount++; 
          // ----------salary----------
          $salary_query="select s_id, s_amount from salary where u_id='".$users_arr['u_id']."'";
          $salary_rows=$da->ExecuteQuery($salary_query);
          $salary_arr = $da->ConvertRowsToArray($salary_rows);
          // ----------salary----------
      ?>
    <tr>
      <th scope="row"><?php if(isset($users_arr)){echo $users_rowCount;} ?></th>
      <td><?php if(isset($users_arr)){echo $users_arr['u_id'];} ?></td>
      <td><?php if(isset($users_arr)){echo $users_arr['u_name'];} ?></td>
      <td><?php if(isset($users_arr)){echo $users_arr['u_role'];} ?></td>

      <!-- ----------salary---------- -->
      <td><?php if(isset($salary_arr)){echo $salary_arr['s_id'];} else{echo "-";} ?></td> 
      <td><?php if(isset($salary_arr)){echo $salary_arr['s_amount'];} else{echo "-";} ?></td> 
      <!-- ----------salary---------- -->

      <td><a href="salary.php?s_u_id=<?php echo $users_arr['u_id']?>"><i class="fa fa-pencil text-warning" aria-hidden="true"></i></a></td>

    </tr>
<?php } ?>