<?php

session_start();

if($_SESSION['gameMode'] == 1)
{
	if(isset($_GET['lose']))
	{		
		$fName = $_SESSION['fbFname'];
		$lName = $_SESSION['fbLname'];
		$score = $_SESSION['score'];
		
		$url = "http://student.labranet.jamk.fi/~H9575/IZP2010/db-scores-insert.php?fname=" . $fName . "&lname=" . $lName . "&score=" . $score;
		
		echo file_get_contents($url);
		
		$_SESSION['gameMode'] = 0;
		$_SESSION['score'] = 0;
	}
	else
	{
		$_SESSION['score']++;
	}
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../styles/styles.css">
	</head>
	
	<body>
		<div id="content">
		
		<!-- Show your scores, if gameMode = 1 -->
		<?php if ($_SESSION['gameMode'] == 1): ?>
		
			<h3>Your scores: <?php echo $_SESSION['score']; ?></h3>
			
		<!-- Show high scores, if gameMode = 0 -->
		<?php else: ?>
		
			<h3>High scores:</h3>
			
			<!-- Show score table TOP 5 -->
			<?php echo file_get_contents('http://student.labranet.jamk.fi/~H9575/IZP2010/db-scores.php'); ?>
				
		<?php endif ?>
		
		<!-- Navigtion bar -->
		<ul>
			<!-- Show Back to menu (all conditions) -->
			<li><a href="../index.php">Main menu</a></li>
			
			<!-- Show continue, if gameMode = 1 -->
			<?php if ($_SESSION['gameMode'] == 1): ?>
			
				<li><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Play next round</a></li>
					
			<?php endif ?>
			
			<!-- Show play again, if lose -->
			<?php if(isset($_GET['lose'])): ?>
			
				<li><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Play again</a></li>
					
			<?php endif ?>
		</ul>
		
		<!-- Reset gameMode, prevent easy cheating -->
		<?php $_SESSION['gameMode'] = 0; ?>
		
		</div>
	</body>
</html>