<div class="form-group">
	<?php foreach($pincode as $cpin): ?>
    <input type="text" readonly="readonly" id="old_pinc" value="<?php echo $cpin->Pincode; ?>" class="form-control" name="pincode" placeholder="Your Pincode" required/>
    <?php endforeach; ?>
</div>