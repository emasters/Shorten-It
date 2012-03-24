<!DOCTYPE html>
<html>
<title>URL shortener</title>
<meta name="robots" content="noindex, nofollow">
<script type="text/javascript" src="./js/jquery-1.7.2.min.js"></script>

</html>
<body>
<form action="shorten.php" id="shortener">
<label for="longurl">URL to shorten</label> 
<input type="text" name="longurl"> <input type="submit" value="Shorten">
</form>
<div id="shorturl"></div>

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
</body>
</html>