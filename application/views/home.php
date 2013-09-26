<!DOCTYPE html>
<html>
  <head>
    <title>IT1901</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "css/style.css"; ?>">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() . "js/map.js"; ?>"></script>
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
      <li class="active" id="navbtn"><a href="#">Kart</a></li>


      <li id="navbtn"><a href="<?php echo base_url(); ?>sau/regsau">Registrer sau</a></li>


       <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blablalba <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li><a href="#">Separated link</a></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>


</ul>

  <div class="nav navbar-nav navbar-right">
  <li class="navbar-text">Bruker: <?php echo $_SESSION['username']; ?></li>
    <a class="navbar-text" href="<?php echo base_url() . "logout" ?>">Logg ut!</a>
  </div>

</nav>
</div>
    <div class="row">

        <div class="col-md-9" id="maxmap">
                <div id="map-canvas"></div>
        </div>

        <div class="col-md-3" id="menu">
               <h3 id="menutitle">Saueliste</h3>
               <table class="table table-hover">
               <?php
                  foreach ($sheep->result() as $s) {
                    echo "<tr class=\"sauefaen\"><td><a href=endre/". $s->id.">". $s->name . "</a></td></tr>";
                  }
                ?>
                </table>

<script type="text/javascript">initialize(<?php echo json_encode($sheep->result()); ?>)</script>
        </div>

    </div>

  </body>
</html>
