<script>
$(function() {
	
	$("#toDate").hide();
	$( "#radio" ).buttonset();
	
	$("#dateRange").click(function(){
		$("#toDate").show('fade');
		$("#LocationDateRange").val(1);
	});
	$("#dateSingle").click(function(){
		$("#toDate").hide('fade');
		$("#LocationDateRange").val(0);
	});
	
});
</script>

<div class="index" style="padding-top:20px;">
	<h3><?php echo $title_for_layout; ?></h3>
	<?php echo $this->Form->create('LocationDate'); ?>
	<br/>
	<div id="radio" style="float:right;padding-top:10px;">
		<input type="radio" id="dateSingle" name="radio" checked="checked" /><label for="dateSingle">Single Date</label>
		<input type="radio" id="dateRange" name="radio" /><label for="dateRange">Date Range</label>
		<a href="https://www.google.com/calendar/embed?src=usa__en@holiday.calendar.google.com&gsessionid=MTQx98UHlZQdpkaYoHXLew" target="_blank">US Holidays</a>
	</div>
	<?php 
		echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->input('location_id',array('type'=>'hidden'));
		echo $this->Form->input('range',array('type'=>'hidden','value'=>0));
		echo $this->Form->input('from',array('label'=>'Date<br/>','div'=>false));
		echo "<div id='toDate'>";
		echo $this->Form->input('to',array('label'=>'<br/>End Date<br/>','div'=>false));
		echo "</div>";
		
		echo $this->Form->input('notes');
		echo $this->Form->input('status',array('label'=>'Enabled','checked'=>'checked'));
		echo "<br/>";
		echo $this->Form->end('save'); 
	?>
</div>