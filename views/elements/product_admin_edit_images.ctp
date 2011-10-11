<?php $count = !empty($count)? $count : 1 ?>
<div class='input product-image'>
	<?php echo $this->Html->image('Image/'.$image['filename']) ?>
</div>
<div>
	<?php echo $this->Form->input('Order',array(
		'name' => "data[Image][$count][order]",
		'value' => $image['order']
	)); 
	?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete_image', $image['id'], $id), null, __('Are you sure you want to delete this image?', true)); ?></li>
	</ul>
</div>