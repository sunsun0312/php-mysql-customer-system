<!doctype html>
<html lang="en">
  <head>
    <title>crud-new</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <?php require "process.php" ?>
      <?php if (isset($_SESSION['message'])):?>
        <div class="alert alert-<?php echo $_SESSION['alert'];?>" role="alert">
          <?php echo $_SESSION['message'];
                unset($_SESSION['message']);?></div>
      <?php endif ?>

      <?php 
      
      $result = mysqli_query($db, "SELECT * FROM customers") or die(mysqli_error($db));
      if (mysqli_num_rows($result)):
      ?>
      <div class="card justify-content-center" style="margin:auto;width:70rem;margin-bottom:20px;">
          <h4 class="card-title text-center">Customer System</h4>
          <table class="table">
        <thead>
          <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row=mysqli_fetch_assoc($result)): ?>
          <tr>
            <td scope="row"><?php echo $row['email'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['phone'] ?></td>
            <td>
              <a class="btn btn-warning" href="index.php?edit=<?php echo $row['id']?>" role="button">Edit</a>
              <a class="btn btn-danger" href="process.php?delete=<?php echo $row['id']?>" role="button">Delete</a>
            </td>
          </tr>
          <?php endwhile ?>
        </tbody>
      </table>
      <?php endif ?>
      </div>
      

      
      
      <div class="card justify-content-center" style="width:30rem;margin:auto;margin-bottom:50px;">
          <form action="process.php" method="POST" style="margin:10px">
          <div class="form-group">
            <input type="hidden" class="form-control" name="id" value="<?php echo $id;?>">
          </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email;?>" placeholder="Enter Email">
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text"
                class="form-control" name="name" value="<?php echo $name;?>" placeholder="Enter Name">
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text"
                class="form-control" name="phone" value="<?php echo $phone;?>" placeholder="Enter Phone">
            </div>
            <?php if ($edit): ?>
              <button type="submit" name="update" class="btn btn-warning" btn-lg btn-block">Update</button>
            <?php else: ?>
              <button type="submit" name="insert" class="btn btn-primary" btn-lg btn-block">Add</button>
              <?php endif ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div>
                <br />
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error'];
                                unset($_SESSION['error']);?>
                </div>
        </div>
            <?php endif ?>
        </form>
      
      </div>
      
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>