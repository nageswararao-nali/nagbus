<select name="select" onChange="getDistrict(this.value)">
<option value="" selected="selected" >Select District</option>
<?php foreach($district as $dst): ?>
<option value="<?php echo $dst->District_Name; ?>"><?php echo $dst->District_Name; ?></option>
<?php endforeach; ?> 
</select> 