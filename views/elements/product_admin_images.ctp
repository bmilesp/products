<?php $count = !empty($count)? $count : 0 ?>
<div class='input file-upload'>
	<?php echo $this->Form->file("Image.$count.file") ?>
	<?php echo $this->Form->input("Image.$count.category_id",array(
		'type' => 'hidden',
		'value' => 'Product'	
	)) ?>
</div>