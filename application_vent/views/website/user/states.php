<select name="select" onChange="getstatedetails(this.value)">
<option value="" selected="selected" >Select State</option>
<?php foreach($state as $stt): ?>
<option value="<?php echo $stt->state_id; ?>"><?php echo $stt->State_Name; ?></option>
<?php endforeach; ?> 
</select> 