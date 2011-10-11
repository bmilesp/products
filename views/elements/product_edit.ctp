<script>
	function newImageInput(){
		var dfi = $('.dummy_element').html();
		var pieces = dfi.split('[n]');
		var count = $("#images-list").children().length;
		var element = pieces.join(count);
		console.log(count);
		console.log(dfi);
		$("#images-list").append(element);

	}
</script>
<div class="products form">
<?php echo $this->Form->create('Product',array('type' => 'file'));?>
	<fieldset>
		<legend><?php __($legend); ?></legend>
	<?php
		if(!empty($this->data['Product']['id'])){
			echo $this->Form->input('id');
		}
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('price', array('label' => 'Price $'));
		echo $this->Form->input('active', array('options' => $activeOptions));
	?>
	<fieldset>
		<legend><?php __('Images'); ?></legend>
		<div id='images-list'>
			<?php 
				if (!empty($this->data['Image'])){
					foreach($this->data['Image'] as $key=>$image){
						echo $this->element('product_admin_edit_images',array(
							'image'=>$image,
							'id' =>$id,
							'count' =>$key,
							'legend' => 'Edit Product'));	
					}
				}
			?>
		</div>
		<?php echo $this->Form->button('Add Image',array(
			'onclick' => 'newImageInput()',
			'type' => 'button'
		)); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class='dummy_element'>
	<?php echo $this->element('product_admin_images',array('count'=> '[n]'));?>
</div>