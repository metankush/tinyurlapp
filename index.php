<?php
include_once 'db_conn.php';
if(isset($_REQUEST['url'])){
    //For Getting Total URL
    $short_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $select=mysqli_query($conn,"select long_url from short_urls where short_url='$short_url'");
    $result=mysqli_fetch_all($select,MYSQLI_ASSOC);

    if(sizeof($result) > 0 ){
       $res= $result[0]['long_url'];
       header("Location: $res");
       exit();
    }else{
        echo "URL Not Found.!";
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script> 
<script src="js/clipboard.min.js"></script>
</head>
<body>

<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">Tiny URL</div>
        <div class="panel-body">
            <form action="#" id="test_form">
                <div class="form-group">
                    <label for="url">Enter URL:</label>
                    <input type="text" class="form-control" id="url_value" placeholder="Enter Full URL" name="url_value">
                    <span><font color="red" id="url_error" style="display: none;">Please Enter URL</font></span>
                </div>

                <div class="form-group">
                    <label for="url">Tiny URL:</label>
                    <p id="tiny_url"></p>
                    <a class="copy-text btn btn-info" data-clipboard-target="#tiny_url" href="#" style="display: none;">Copy </a>
                   

                </div>

                <button type="button" class="btn btn-success" id="btn_submit">Submit</button>
            </form>
        </div>
    </div>

</div>

<script>
$(document).ready(function(){
	//For Insert URL in Table
    $("#btn_submit").click(function(){
        var url_value=$('#url_value').val();
        if(url_value ==''){
        	$('#url_error').show();
        	return 0;
        }
        $('#url_error').hide();
        $.ajax({
              url: "url_server.php",
              data:$('#test_form').serialize()+'&'+$.param({'action':'insert_url'}),
			  datatype: "json",
              success: function(data){
               $('#tiny_url').html(data.trim());
               $('.copy-text').show();
               $('#test_form').trigger("reset");
			  }

         }); //End Of Ajax
   
    }); //End of btn submit

   //For Copy
   $(function(){
   new Clipboard('.copy-text');
  });
});//Ready



</script>

</body>
</html>
