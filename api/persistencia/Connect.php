	<?php

		// Connect to database
		$connection=mysqli_connect('localhost','root','root','controleacesso');

		if (mysqli_connect_errno())
		{
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
