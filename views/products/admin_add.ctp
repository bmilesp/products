<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link(__('<< Products List', true), array('action' => 'index'));?></li>
	</ul>
</div>
<?php echo $this->element('product_edit',array('legend' => 'Add New Product')) ?>
