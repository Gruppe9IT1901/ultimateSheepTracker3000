<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv='content-type' content='text/html; charset=utf-8' />
    <title>IT1901</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "css/style.css"; ?>">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() . "js/map.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . "js/validate.min.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . "js/dropdown.js"; ?>"></script>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApcKB-YnG-wcLz5lZf90AEgSVe00DtHRY&sensor=false">
    </script>
  </head>

  <body>
  <nav class="navbar navbar-default" role="navigation">

 <div class="navbar-header">
    <a class="navbar-brand" href="#">IT1901 Prosjekt</a>
  </div>

<ul class="nav navbar-nav">
      <li id="navbtn"><a href="<?php echo base_url(); ?>index.php/welcome">Kart</a></li>
      <li class="active" id="navbtn"><a href="<?php echo base_url(); ?>sau/regsau">Registrer sau</a></li>
	   <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Endre bruker</a></li>
          <li><a href="#">Endre gård</a></li>
          <li><a href="#">Alarm</a></li>
        </ul>
      </li>
</ul>

  <div class="nav navbar-nav navbar-right">
  <li class="navbar-text">Bruker: <?php echo $_SESSION['username']; ?></li>
    <a class="navbar-text" href="<?php echo base_url() . "index.php/admin/logout" ?>">Logg ut!</a>
  </div>

</nav>
</div>
    <div class="row">

        <div class="col-md-9" id="hero">
              <form role="form" name="sheepreg" action="savesau" method="post">
    <div class="form-group">
    <label for="sauenavn">ID</label>
   <input type='text' class='form-control input-md' name='saueid' id='saueid' placeholder='00000' required>
  </div>
  <div class="form-group">
    <label for="sauenavn">Navn</label>
   <input type='text' class='form-control input-md' name='sauenavn' id='sauenavn' placeholder='' required>
  </div>

  <div class="form-group">
    <label for="sauenavn">Fødselsår</label>
   <input type='text' class='form-control input-md' name='birthYear' id='birthYear' placeholder='' required>
  </div>

  <div class="form-group">
    <label for="sauenavn">Vekt</label>
   <input type='text' class='form-control input-md' name='weight' id='weight' placeholder='' required>
  </div>

  <div class="form-group">
    <label for="sauenavn">Helse</label>
   <input type='text' class='form-control input-md' name='health' id='health' placeholder='' required>
  </div>


  <div class="form-group">
  <label for="lat">Plassering</label>
<div id="warning"></div>
    <div id="map-canvas" style="height:400px;"></div>
    <input id="lat" type="hidden" name="lat" value="">
    <input id="lng" type="hidden" name="lng" value="">
  </div>

  <button type="submit" class="btn btn-default">Submit</button>
</form>
        </div>

        <div class="col-md-3" id="menu">
               <h3 id="test">Saueliste</h3>
               <table class="table table-hover">
               <?php
                  foreach ($sheep->result() as $s) {
                    echo "<tr class=\"sheep\"><td>". $s->navn . "</td></tr>";
                  }
                ?>
                </table>
        </div>

    </div>
<?php if (isset($inDb)): ?>
<?php if($inDb): ?>
  <script type="text/javascript">
      $("#warning").html("<div class='alert alert-danger'>Velg en annen ID!</div>");
  </script>
<?php endif; ?>
<?php endif; ?>
<script type="text/javascript">
  initRegSheep();

var validator = new FormValidator('sheepreg',[{
  name:"lat",
  display:"required",
  rules:'required'
}],
 function(errors, event) {
    if (errors.length > 0) {
      $("#warning").html("<div class='alert alert-danger'>Du må gi sauen en plassering</div>");
    }
});

</script>
  </body>
</html>
