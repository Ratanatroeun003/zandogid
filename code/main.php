
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>main page</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../style/main.css">
</head>
<body style="margin-left :50px;margin-right :50px;">
      <?php
    session_start();

    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        ?>
        <script>
          Swal.fire({
             position: "top-end",
              icon: "<?php echo $alert['status']; ?>",
              title: "<?php echo $alert['message']; ?>",
              draggable: true
      });
        </script>
        <?php
        // Clear the session variable so it doesn't show up again
        unset($_SESSION['alert']);
    }
    ?>
    <?php
include 'header.php';
?>
    <div class="slideshow-container">
    <div class="slideshow">
      <img src="../img/new.png" >
      <img src="../img/logo.png">     
    </div>
  </div>
  <?php
  include 'content.php';
  ?>
</body>
</html>

