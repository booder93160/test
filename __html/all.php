<h1>Pas de chance, ca marche pas</h1>
<p style="display: none;">
	<?php
		for($i = 0 ; $i < rand(100, 2000) ; $i++)
		{
			printf("%c", rand() % 26 + 65);
		}
	?>
</p>
