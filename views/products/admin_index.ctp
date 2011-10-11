<div class="products index products-wrapper">	
	<?php echo $this->Form->create('Product') ?>
		<fieldset>
			<legend>Search Filter</legend>
			<?php echo $this->Form->input('active',array(
				'options' => $activeOptions, 
				'empty' => 'All'),
				'') ?>
			<?php echo $this->Form->submit('Search'); ?>
		</fieldset>
	<?php echo $this->Form->end() ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Add New Product', true), array('controller' => 'products', 'action' => 'add')); ?></li>
		</ul>
	</div>
	<?php echo $this->element('paging'); ?>
	<?php
	$i = 0;
	foreach ($products as $product):
		echo $this->element('product_admin',array('product'=>$product));
	endforeach; ?>
	<?php echo $this->element('paging'); ?>
</div>