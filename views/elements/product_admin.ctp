<script>
	$(document).ready(
		$('.product').click(function(){
			window.location.href = $(this).find('.product-price').attr('href');
		})
	)
	
</script>

<?php $class = (!empty($product['Product']['active'])? 'product-active' : 'null') ?>
<div class='product <?php echo $class ?>'>
	<div class='product-image-wrapper'>
		<?php
			if(!empty($product['Image'])){
				echo $this->Html->image('Image/'.$product['Image'][0]['filename'],
					array('url' => array('action'=>'edit',$product['Product']['id'])));
			}
		?>
	</div>
	<div class='product-title'>
		<?php
			echo $this->Html->link($product['Product']['name'], 
				array('action'=>'edit',$product['Product']['id']));
		?>
		<br>
		<?php
			echo $this->Html->link('$'.$product['Product']['price'], 
				array('action'=>'edit',$product['Product']['id']),
				array('class' => 'product-price')
			);
		?>
	</div>
</div>
