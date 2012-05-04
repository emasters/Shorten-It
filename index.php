<?php
require_once 'classes/Auth.class.php';
session_start();
$auth = new Auth();
$logged_in = $auth->checkSession();
?>
<!DOCTYPE html>
<html>
	<title>Shorten It - A URL shortener</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="./css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="./img/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./img/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./img/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="./img/apple-touch-icon-57-precomposed.png">
	<meta name="robots" content="noindex, nofollow">
	<script type="text/javascript" src="./js/jquery-1.7.2.min.js"></script>
	<!-- For Google Analytics tracking, paste code after this line and before </head> -->
</html>
<body>
	  <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
        	
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Shorten It</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <?php
              	if (empty($logged_in)) {
					  echo "<li><a href=\"login.php\">Login</a></li>";
				  } else {
					  echo "<li><a href=\"#profile\">".$_SESSION['email']."</a></li>";
				  }
				  
              ?>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	 <div class="container">
	 	<div class="modal hide fade" id="login">
		    <div class="modal-header">
		    <h3>Login</h3>
		    <a class="close" data-dismiss="modal">x</a>
		    </div>
		    <div class="modal-body">
		    <p>One fine body...</p>
		    </div>
		    <div class="modal-footer">
		    <a href="#" class="btn">Close</a>
		    <a href="#" class="btn btn-primary">Save changes</a>
		    </div>
		    </div>
		<div class="hero-unit">
	        <form action="shorten.php" id="shortener" class="well form-inline">
			<label for="longurl">URL to shorten</label> 
			<input type="text" name="longurl" class="input-xlarge"> 
			<input type="submit" value="Shorten" class="btn btn-primary">
			</form>
			<div id="shorturl"></div>
	     </div>
		<div class="row">
        <div class="span4">
          <h2>Bookmarklet</h2>
           <p>Drag the button below to your bookmark bar.</p>
          <p><a href="javascript:(function(){document.location='http://b.elide.us/shorten.php?longurl='+encodeURIComponent(location.href)}());" class="btn">Shorten It</a></p>
        </div>
        <div class="span4">
          <h2>API Key</h2>
           <p>Information about the API key will go here.</p>
           <p><a href="#" class="btn">View details</a></p>
        </div>
        <div class="span4">
          <h2>Help</h2>
          <p>Documentation and such go here.</p>
          <p><a href="#" class="btn">View details</a></p>
        </div>
      </div>
	</div>
<script type="text/javascript">
	$('#login').modal();
</script>
<script type="text/javascript">
window.onload = (function(){
try{ 
/* attach a submit handler to the form */
  $("#shortener").submit(function(event) {

    /* stop form from submitting normally */
    event.preventDefault(); 
        
    /* get some values from elements on the page: */
    var $form = $( this ),
        term = $form.find( 'input[name="longurl"]' ).val(),
        url = $form.attr( 'action' );

    /* Send the data using post and put the results in a div */
    $.post( url, { longurl: term },
      function( data ) {
          $( "#shorturl" ).empty().addClass('alert alert-success').append( data );
      }
    );
  });
}catch(e){}});
</script>
	<script src="./js/bootstrap/bootstrap-transition.js"></script>
    <script src="./js/bootstrap/bootstrap-alert.js"></script>
    <script src="./js/bootstrap/bootstrap-modal.js"></script>
    <script src="./js/bootstrap/bootstrap-dropdown.js"></script>
    <script src="./js/bootstrap/bootstrap-scrollspy.js"></script>
    <script src="./js/bootstrap/bootstrap-tab.js"></script>
    <script src="./js/bootstrap/bootstrap-tooltip.js"></script>
    <script src="./js/bootstrap/bootstrap-popover.js"></script>
    <script src="./js/bootstrap/bootstrap-button.js"></script>
    <script src="./js/bootstrap/bootstrap-collapse.js"></script>
    <script src="./js/bootstrap/bootstrap-carousel.js"></script>
    <script src="./js/bootstrap/bootstrap-typeahead.js"></script>
</body>
</html>