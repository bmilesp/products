<div class="products index products-wrapper">
	
	<?php
	$i = 0;
	foreach ($products as $product):
		echo $this->element('product',array('product'=>$product));
	endforeach; ?>
	
</div>