<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!--div class="container ">

<h1>List Of Owners Property</h1>

<?php
 //var_dump($user_id) ;
//echo $_SESSION['id'];
$action="residents/request/";

echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data'));?>
<div class="form-area">
  <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>
  <div class="row tablereq">
    <div class="col-md-10">
      <table class="table text-left romtbl_borders">

        <tbody>

          <p>
    <button type="button" class="btn btn-info">
      <span class="glyphicon glyphicon-search"></span> Search
    </button>
  </p>
          <tr>
            <td>Date</td>
            <td>2017/11/02</td>

          </tr>
          <div class="col-md-2 text-right" >
        <a href="<?php echo base_url('publiczone/E-Residence/') ?>" class="edit-address"><span>EDIT ADDRESS</span></a>
      </div>
          <tr>
            <td>Resident Full Names</td>
            <td>
              <?php    

              foreach ($user_addinfor as $key ) {
                echo $key->name;
                ?>

              </td>
            </tr>
            <tr>
              <td rowspan="7">Address</td>               
              <td ><?php  echo $key->door_number. ' '.$key->street_name?></td>      
            </tr>


            <tr>
              <td><?php  echo $key->street_name?></td>

            </tr> 
            <tr>
              <td><?php  echo $key->town?></td>

            </tr>
            <tr>
              <td><?php  echo $key->zip_code?></td>

            </tr>
            <tr>
              <td><?php  echo $key->manucipality?></td>

            </tr>
            <tr>
              <td><?php  echo $key->district?></td>

            </tr>
            <tr>
              <td><?php  echo $key->province?></td>            
              </tr><?php
            }
            ?>
            
          </tbody>
        </table>
      </div>
    </div>
    


<div class="bs-example">
    <ul class="pagination">
        <li><a href="#">&laquo;</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">6</a></li>
        <li><a href="#">7</a></li>
        <li><a href="#">8</a></li>
        <li><a href="#">9</a></li>
        <li><a href="#">10</a></li>
        <li><a href="#">&raquo;</a></li>
    </ul>
</div-->

<script>

</script>