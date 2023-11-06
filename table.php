<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$sr =1;
?>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Email</th>
        <th scope="col">Pass</th>
        <th>Document</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
       if(!empty($_SESSION['items'])){
       foreach($_SESSION['items'] as $key => $value)
      //  print_r($value);
       {
        if(!empty($value['email'])){
      ?>
      <tr>
        <td><?php echo $sr; ?></td>
        <td><?php echo $value['email'] ?? ''; ?></td>
        <td><?php echo $value['pass'] ?? '' ?></td>
        <td><img src="<?php echo $value['file'] ?>" alt="" width="10%" height="10%"></td>
        <td><button type="button" class="btn btn-primary edit" key="<?php echo $key; ?>">edit</button>
        <button type="button" class="btn btn-danger delete" key="<?php echo $key; ?>">delete</button></td>
      </tr>
      <?php
        $sr++;
        }
       }
      }
      ?>
    </tbody>
  </table>