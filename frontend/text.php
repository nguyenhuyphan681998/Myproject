<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/php5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head><!--/head-->
<body>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
    <title>Refresh an image after an ajax file upload in jQuery?</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
</head>
 
<body>
 
<div id="resultImageProfile">
    <?php
    $user = $bdd->getOne('SELECT * FROM tc_tuto_upload_refresh_image WHERE user = 1'); // Get line with user 1 from database
    
    if (isset($user['image_profile']) && $user['image_profile'] != "") { // Test if image exists
        echo '<p class="myImage"><img src="/upload/image-profile/'.$user['image_profile'].'" width="100" alt="" /></p>'; // If image exists we display the image
    }
    ?>
    </div>
    
    <p>
    <form method="post" enctype="multipart/form-data" id="MyImageProfileUploadForm" action=""> <!-- Our form with a file type field and a hidden field containing the user ID (here 1) -->
        <div><b>Add / change your profile image: </b></div><div><input name="imageProfile" id="imageProfile" type="file" /><input name='userId' type='hidden' value="<?PHP echo $user['id']; ?>" /></div>
    </form>
    </p>
    <p>Maximum : <b>256 Kb</b></p>
    <p>Formats accepted : <b>jpg</b>, <b>jpeg</b></p>
 
<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="js/tuto-upload-refresh-image.js"></script>
 <script type="text/javascript">
     $('#imageProfile').bind('change', function() { // jQuery on change form
    $("#resultImageProfile").html('<img src="/design/loader.gif" alt="" />');
    $('#MyImageProfileUploadForm').ajaxForm({ // AJAX form plugin to upload a single image
        url: '/ajax/tuto-upload-refresh-image.php', // Call this file to update database and send back the correct new image and URL
        dataType: 'json', // JSON farmat
        success: function(data){
            $('#resultImageProfile').html(data.text); // We display text in the div resultImageProfile tank
            $(".myImage img").load(function() { // We break the cache and force the browser to check for the image again
                $(".myImage img").attr( 'src', data.imgURL + '?dt=' + (+new Date()) );
              }); 
        }
    }).submit();
});
</script>
 </script>
</body>
</html>
</body>