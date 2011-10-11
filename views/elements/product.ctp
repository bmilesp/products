<script>
	$(function(){
		$('.product').click(function(){
			window.location.href = $(this).find('.product-price').attr('href');
		});
		$('.product').mouseenter(function(){
			$(this).find('.product-image-overlay-wrapper').stop().fadeTo(600,1);
			$(this).find('.product-image-wrapper').stop().fadeTo(600,0);
		});
		$('.product').mouseleave(function(){
			$(this).find('.product-image-overlay-wrapper').stop().fadeTo(600,0);
			$(this).find('.product-image-wrapper').stop().fadeTo(600,1);
		});
	});
	
</script>

<div class='product'>
	<div class="product-fade-image-wrapper">
		<div class='product-image-wrapper'>
			<?php
				echo $this->Html->image('Image/'.$product['Image'][0]['filename'],
					array('url' => array('action'=>'view',$product['Product']['id'])));
			?>
		</div>
		<div class='product-image-overlay-wrapper'>
			<?php
				$overLayImg = !empty($product['Image'][1]['filename'])? $product['Image'][1]['filename'] : $product['Image'][0]['filename'];
				echo $this->Html->image('Image/'.$overLayImg,
					array('url' => array('action'=>'view',$product['Product']['id'])));
			?>
		</div>
	</div>
	<div class='product-title'>
		<?php
			echo $this->Html->link($product['Product']['name'], 
				array('action'=>'view',$product['Product']['id']));
		?>
		<br>
		<?php
			echo $this->Html->link('$'.$product['Product']['price'], 
				array('action'=>'view',$product['Product']['id']),
				array('class' => 'product-price')
			);
		?>
	</div>
</div>
