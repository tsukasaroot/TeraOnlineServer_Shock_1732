<?php 
require 'core/init.php';
$general->logged_out_protect();
$username	= htmlentities($account['login']); // storing the user's username after clearning for any html tags.
?>

<!doctype html>
<html lang="en">
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<title>Welcome <?php echo $username, '!'; ?></title>
</head>
<body>
<div id="header">
</div>	
	<div id="container">
		<?php include 'includes/menu.php'; ?>
		<h2_std>Welcome User... <?php echo $username, '!'; ?></h2_std><br>
		<h2_std>You are successfully logged in!</h2_std><br>
		<h2_std>
		<?php
			echo 'Your IP is'.$_SERVER['REMOTE_ADDR'];
		?>
		</h2_std>
		<br />
		<input type="button" id="test" value="Ping these!"/>
		<table>
			<tr>
				<td>Europe</td>
				<td><div id="statusEU" value="51.210.41.122"></div></td>
			</tr>
		</table>
		<script>
		$("#test").click(function(){
			//Pinger_ping("128.114.119.137"); //http://genome.ucsc.edu/
			
			$("div").each( function(){
				var msg = this.id;
				var ip = $(this).attr("value");
				var avg = 0;
				var cpt = 0;
				var i=0;
				for(i=0; i<10;i++){
					var ping = $.now();
					$.ajax({ type: "HEAD",
							url: "http://"+ip,
							cache:false,
							complete: function(output){ 
								ping = $.now() - ping;
								//alert("#"+ip+" Response "+ping);
								
								if (ping < 1000) { // 1 times out of 2, the diff is not computed
									cpt++;
									avg+= ping/cpt - avg/cpt; //update average val
									$("#"+msg).text(Math.round(avg / 10) +" ms (on "+cpt+"tests)");
									if(avg < 400) {
										$("#"+msg).css({"color": "green"});
									} else if (avg < 700) {
										$("#"+msg).css({"color": "orange"});
									} else {
										$("#"+msg).css({"color": "red"});
									}                                
								}
							}
					  });
				}        
			});
		});
		</script>
		<a href="/client/TERA-setup.exe" download><h2_hl>Downloading launcher</h2_hl></a>
	</div>
</body>
</html>