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

</html>
<body>
	 <div class="container">
		<div class="hero-unit">
	        <form action="shorten.php" id="shortener" class="well form-inline">
			<label for="longurl">URL to shorten</label> 
			<input type="text" name="longurl" class="input-xlarge"> 
			<input type="submit" value="Shorten" class="btn btn-primary">
			</form>
			<div id="shorturl"></div>
	     </div>

	</div>
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
          $( "#shorturl" ).empty().append( data );
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