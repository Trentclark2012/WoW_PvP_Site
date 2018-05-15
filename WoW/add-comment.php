<?php
$name = htmlentities($_POST['name']);
$comment = htmlentities($_POST['comment']);

// Connect to the database
include('config.php'); 
	
// If the user did not enter the 'name' field, set the name as 'Guest'
if(empty($name)){ $name = 'Guest';}
    
//insert the comment in the database
$query = $db->prepare("INSERT INTO comments (name, comment)
									VALUES( :name, :comment)");
$query->execute(array('name'=>$name, ':comment'=>$comment)); 
?>

<div class="cmt-cnt">
    <img src="img/profile-img.jpg" alt="" />
	<div class="thecom">
	     <h5><?php echo $name; ?></h5><span  class="com-dt">
					<?php echo date('Y-m-d H:i:s'); ?></span>
	     <br/><p><?php echo $comment; ?></p>
	 </div>
</div>


