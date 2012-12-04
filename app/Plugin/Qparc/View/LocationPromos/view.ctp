<div class="index" style="padding-top:30px;">
	<div style="width:250px;margin:0 auto;text-align:center;">
		<h3><?=$promo['LocationPromo']['name']?></h3>
		<br/>
		<?php 
			echo $this->Qrcode->text($promo['LocationPromo']['code']);
			echo $promo['LocationPromo']['code'];
			echo "<br/>Expires: " . date("l m/d/Y", strtotime($promo['LocationPromo']['expiration']));
			echo "<br/><br/>";
			echo $this->Html->link("Print/Download PDF", "/promos/" . $promo['LocationPromo']['id'] . ".pdf" , array('target'=>'_blank','style'=>'font-size:18px;'));
			//echo "<input type='button' value='Print' style='padding:5px;' href='#'/>";
		?>
	</div>
</div>