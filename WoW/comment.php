<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
     <title>Simple Comment System</title>
     <link type="text/css" rel="stylesheet" href="css/style.css">
     <link type="text/css" rel="stylesheet" href="css/example.css">
     <script type="text/javascript" 
	 src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
     </script>
  </head>

<body style="background-image: url(PotentialBackgrounds/Horde_Charge_Background.jpg)">
	<br><center><h2><font face="Andalus">
		WoW Forum, Express your thoughts on all things WoW!</font></h2></center><br>
<?php 
include('config.php'); // Connect to the database  ?>

<div class="cmt-container" >

<?php 
	$query = $db->prepare("SELECT * FROM comments");
	$query->execute();  

	while($data = $query->fetch(PDO::FETCH_ASSOC))
	{ 
        $name = $data['name'];
        $comment = $data['comment'];
        $date = $data['date'];
		?>
    
    <div class="cmt-cnt">
        <img src="img/profile-img.jpg" />
        <div class="thecom">
            <h5><?php echo $name; ?>
            </h5><span class="com-dt"><?php echo $date; ?></span> 
            <br/>
            <p><?php echo $comment; ?></p>
        </div>
		</br>
    </div><!-- end "cmt-cnt" -->
    
<?php } ?>


    <div class="new-com-bt">
        <span>Write a comment ...</span>
    </div>
    
    <div class="new-com-cnt">
       <input type="text" id="name-com" name="name-com" 
                       value="" placeholder="Your name" />
      
        <textarea class="the-new-com"></textarea>
        <div class="bt-add-com">Post comment</div>
        <div class="bt-cancel-com">Cancel</div>
    </div>
    
    <div class="clear"></div>
</div>
<!-- end of comments container "cmt-container" -->


<script type="text/javascript">
   $(function(){ 
        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('#name-com').focus();
        });

        $('.the-new-com').bind('input propertychange', function() {
           $(".bt-add-com").css({opacity:0.6});
           var checklength = $(this).val().length;
		   if(checklength){ $(".bt-add-com").css({opacity:1}); }
        });
	
		// on clicking 'Cancel'
	   $('.bt-cancel-com').click(function(){
			$('.the-new-com').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on clicking 'Post comment'
        $('.bt-add-com').click(function(){
            var theCom = $('.the-new-com');
            var theName = $('#name-com');
           
		    if( !theCom.val()) { 
                alert('You need to write a comment!'); 
			 	}
			 
		else{ 
             $.ajax({
               type: "POST",
                url: "add-comment.php",
               data: {   name : theName.val(), 
					  comment : theCom.val()  },
            success: function(xyz) {
                       theCom.val('');
                       theName.val('');
                       $('.new-com-cnt').hide('fast', function(){
                           	$('.new-com-bt').show('fast');
							$('.new-com-bt').before(xyz); })
                      }  
                });
            }
      });
 });	</script></body></html>
