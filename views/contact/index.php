<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';

echo "Здесь будет выводиться страница Contact<br>";
?>

<?php if($result) { ?>
  <p style="color:#49d705;">Message sent! We will respond to the specified email.</p>
<?php } else { ?>
  <?php if(isset($errors) && is_array($errors)) { ?>
    <ul>
      <?php foreach ($errors as $error) { ?>
        <li style="color:#e90d0d;">- <?php echo $error;?></li>
      <?php } ?>
    </ul>
  <?php }
} ?>

<form action="" method="post">
  <br/>Name: <input type="text" name="name" value=""><br/><br/>
  Email: <input type="email" name="email" value=""><br/><br/>
  Message: <textarea name="message" rows="8" cols="40"></textarea><br/><br/>
  <input type="submit" name="submit" value="Send">
</form>

<?php
require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
