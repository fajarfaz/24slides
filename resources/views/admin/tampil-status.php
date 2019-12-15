<?php

$conn = mysqli_connect("localhost","root","","slide");

if($conn){
}else{
    echo "koneksi gagal.<br/>";
}

$q = intval($_GET['q']);
$sql="SELECT * FROM tb_usaha WHERE id = '".$q."'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
?>
<form method="post" action="{{ route('update.status',$status->id) }}" class="text-center border border-light p-5">
    <div class="form-group">
      <label for="name">Name Employee Status :</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Nama Status Karyawan" name="name" 
      value="<?php echo $row['name'];?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>