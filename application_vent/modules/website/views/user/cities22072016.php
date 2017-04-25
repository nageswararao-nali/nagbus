<select name="select" onChange="getCities(this.value)">
<option value="" selected="selected" >Select City</option>
<?php foreach($cities as $cpin): ?>
<option value="<?php echo $cpin->Pincode; ?>"><?php echo $cpin->Location; ?></option>
<?php endforeach; ?> 
</select>