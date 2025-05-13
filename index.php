<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP USER DATABASE - KATIE SNAPE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js "> 
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5"
    style="background: #2A7B9B;
background: linear-gradient(90deg,rgba(42, 123, 155, 1) 0%, rgba(87, 199, 133, 1) 50%, rgba(237, 221, 83, 1) 100%);">
    CRUD PHP USER DATABASE 
    </nav>

    <div class="container">
        <?php 
        if(isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  '.$msg.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
        }
        
        ?>
        <a href="add_user.php" class="btn btn-dark mb-3">Add New User</a>

        <table class="table table-hover text-center">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Surname</th>
      <th scope="col">Email</th>
      <th scope="col">Gender</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    include "conn.php";
        $sql = "SELECT * FROM `users`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
    <tr>
      <td><?php echo $row ['id'] ?></td>
      <td><?php echo $row ['first_name'] ?></td>
      <td><?php echo $row ['surname'] ?></td>
      <td><?php echo $row ['email'] ?></td>
      <td><?php echo $row ['gender'] ?></td>
      <td>
        <a href="edit.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-4"></i></a>
        <a href="delete.php?id=<?php echo $row['id'] ?>" class="link-dark remove"><i class="fa-solid fa-trash fs-5 ms-4 btn-del"></i></a>
      </td>
    </tr>

            <?php
        }
    
    ?>
  </tbody>
</table>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-YUe2LzesAfftltw+PEaao2tjU/QATaW/rOitAq67e0CT0Zi2VVRL0oC4+gAaeBKu" crossorigin="anonymous"></script>
<script type="text/javascript" src="script/bootbox.min.js"></script>



</body>
<!--<script type="text/javascript">

    $(".remove").click(function(){

        var id = $(this).parents("tr").attr("id");



        if(confirm('Are you sure to remove this record ?'))

        {

            $.ajax({

               url: '/delete.php',

               type: 'GET',

               data: {id: id},

               error: function() {

                  alert('Something is wrong');

               },

               success: function(data) {

                    $("#"+id).remove();

                    alert("Record removed successfully");  

               }

            });

        }

    });



</script>-->
</html>