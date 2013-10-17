<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "css/style.css"; ?>">
</head>
<body>


<div id="login-wrap">
<h1>Logg in!</h1>
<br />
<?php echo form_open('admin'); ?>

<div class="form-group">
    <label for="email">Epost</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="saue@bonde.no">
  </div>
  <div class="form-group">
    <label for="password">Passord</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Passord">
  </div>
    <button type="submit" class="btn btn-default">Logg inn</button>
    <a href="register" button class="btn btn-warning">Registrer</button></a>
<?php echo form_close(); ?>
</div>

<div class="errors" style="color:red">

</div>

</body>
</html>
