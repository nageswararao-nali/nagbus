<select name="select" onChange="getstates(this.value)">
<option value="" selected="selected" >Select State</option>
<?php foreach($state as $stt): ?>
<option value="<?php echo $stt->State_Code; ?>"><?php echo $stt->State_Name; ?></option>
<?php endforeach; ?> 
</select> 