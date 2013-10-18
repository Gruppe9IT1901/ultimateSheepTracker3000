<!DOCTYPE html>
<html>
  <head>
    <title>IT1901</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
     <meta http-equiv='content-type' content='text/html; charset=utf-8' />
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


      <li id="navbtn"><a href="<?php echo base_url(); ?>index.php/sau/regsau">Registrer sau</a></li>


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

        <div class="col-md-9" id="maxmap">
                <div id="map-canvas"></div>
        </div>

        <div class="col-md-3" id="menu">
               <h3 id="menutitle">Saueliste</h3>
               <table class="table table-hover">
               <?php
                  foreach ($sheep->result() as $s) {
                    echo "<tr class=\"sheep\" id='$s->ID'><td width=20px>$s->ID</td><td class='sheepname'><span class='cursor'>". $s->navn . "</span></td></tr>";
                  }
                ?>
                </table>
                <table id="sheepinfo" class="table table-hover">

                </table>

<script type="text/javascript">initialize(<?php echo json_encode($sheep->result()); ?>)</script>
        </div>
<script>
      var yo;
	$('.sheep').click(function(){
		removeAnimations();
		var id = $(this).attr('id');
		for(var i = 0; i < markers.length; i++){
			if(markers[i].id == id){
				markers[i].setAnimation(google.maps.Animation.BOUNCE);
				$(".sheep").hide();
            yo = this;
            $("#menutitle").html($(this).children('.sheepname').text());
            $('.deletesheep').remove();
            $('.endre').remove();
            $('#sheepinfo').html('');
            $.ajax({
				type: "POST",
				dataType:'json',
                        // url:"http://localhost:8888/ultimateSheepTracker3000/index.php/ajax/getsheepinfo",
				url: "http://m111b.studby.ntnu.no/index.php/ajax/getsheepinfo",
				data: { id: this.id }
				})
				.done(function( msg ) {
                              $("#sheepinfo").append('<tr><td>ID: '+msg.ID+'</td></tr>');
					$("#sheepinfo").append('<tr><td>Født: '+msg.birthYear+'</td></tr>');
					$("#sheepinfo").append('<tr><td>Vekt: '+msg.weight+' kg</td></tr>');
					$("#sheepinfo").append('<tr><td>Helse: '+msg.health+'</td></tr>');
					console.log(msg);
					test = msg;
			});
            $("#menu").append("<a class='deletesheep' href=delete/" + this.id + ">Slett</a>  ");
            $("#menu").append("<a class='endre' href=endre/" + this.id + ">Endre</a>");
			}
		}
	});
</script>
    </div>

  </body>
</html>
