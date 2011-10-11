<div class="products view products-wrapper">
	<div class='product-detail-left-panel'>
			<div class='product-image'>
				<?php foreach($product['Image'] as $image){ 
					echo $this->Html->image('Image/'.$image['filename']); 
				} ?>
			</div>	
		
		<div class='product-description'>
			<h2><?php echo $product['Product']['name'] ?></h2>
			<?php echo $product['Product']['description'] ?>
		</div>
	</div>
	<div class='view-actions actions'>
		<h3>Price: $<?php echo $product['Product']['price'] ?></h3>
		<?php echo $this->Html->link(__('Add to Cart', true), array('action' => 'index', 'cart-action' => 'add', 'item1-id' => $product['Product']['id'], 'item1-model' => 'Products.Product')); ?>
	</div>
</div>