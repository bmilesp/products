<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link(__('<< Products List', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $id), null, sprintf(__('Are you sure you want to delete this product?', true), $this->Form->value('Product.id'))); ?></li>
	</ul>
</div>
<?php echo $this->element('product_edit',array('legend' => 'Edit Product')) ?>
