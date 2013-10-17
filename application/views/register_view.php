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
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
  </head>

  <body>
  <nav class="navbar navbar-default" role="navigation">

 <div class="navbar-header">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">IT1901 Prosjekt</a>
  </div>

<ul class="nav navbar-nav">
</ul>

  <div class="nav navbar-nav navbar-right">
  </div>

</nav>
</div>
    <div class="row">
        <div class="col-md-9" id="hero">
      <form role="form" name="sheepreg" action="" method="post">

  <div class="form-group">
<label for="farmName"> Gårdsnavn</label>
      <input type='text' class='form-control input-md' name='farmName' id='farmName' placeholder='' required>
  <label for="lat">Plassering</label>
  <style>
      #target {
        width: 345px;
      }
    </style>
   <div id="panel">
      <input id="target" class="form-control input-md" type="text" placeholder="Search Box">
    </div>
<div id="warning"></div>
    <div id="map-canvas" style="height:400px;"></div>
    <input id="lat" type="hidden" name="lat" value="">
    <input id="lng" type="hidden" name="lng" value="">
  </div>

  <button type="submit" class="btn btn-default">Submit</button>
        </div>

        <div class="col-md-3" id="menu">
               <h3 id="test">Registrer</h3>
               <div class="form-group">
                 <label for="epost">Epost</label>
                 <input type="text" class="form-control input-md" name="epost" id="epost" required>
                 <label for="passord">Passord</label>
                 <input type="password" class="form-control input-md" name="passord" id="passord" required>
                 <label for="passord2">Passord</label>
                 <input type="password" class="form-control input-md" name="passord2" id="passord2" required>
                 <label for="tlf">Telefon</label>
                 <input type="text" class="form-control input-md" name="tlf" id="tlf">

               </div>
        </div>
</form>
    </div>
<script type="text/javascript">
  initBondeMap();
</script>
  </body>
</html>
