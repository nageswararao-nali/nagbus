<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Limited Offers</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php base_url(); ?>">Dashboard</a></li>
            <li><a href="<?php base_url(); ?>limitedOffers">Limited Offers</a></li>
            <li class="active"><strong>Update Channel Partner</strong></li>
        </ul>
    </div>
</div>
<?php if($offer->id){ ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
        <!--<div class="ibox float-e-margins">-->
        <form action="<?php echo base_url() . 'Limited_offer/updateOffers/';?>" method="post" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Title*</label>
                        <div class="col-lg-8">
                            <input type="hidden" name="id" value="<?php echo $offer->id;?>"/>
                            <input type="text" id="title" name="title" placeholder="Title" class="form-control" value="<?php echo $offer->offer_title;?>"/>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Offer Start Period*</label>
                        <div class="col-lg-8">
                            <input type="text" id="startDate" name="offer_start" placeholder="Offer Period" class="form-control" value="<?php echo $offer->offer_start;?>"/>
                        <br>    
                        </div>  
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Offer End Period*</label>
                    	<div class="col-lg-8">
                            <input type="text" id="endDate" name="offer_end" placeholder="Offer End Period" class="form-control" value="<?php echo $offer->offer_end;?>"/>
                          <br>  
                        </div>
                        </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Original Price*</label>
                        <div class="col-lg-8">
                            <input type="number" id="original_price" name="original_price" placeholder="Original price" class="form-control" value="<?php echo $offer->original_price;?>"/>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Discount Price*</label>
                        <div class="col-lg-8">
                            <input type="number" id="discount_price" name="discount_price" placeholder="Discount Price" class="form-control" value="<?php echo $offer->discount_price;?>"/>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Laabus Percent*</label>
                        <div class="col-lg-8">
                            <input type="number" id="laabus_price" name="laabus_price" placeholder="Laabus Price" class="form-control" value="<?php echo $offer->laabus_price;?>"/>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Quantity*</label>
                        <div class="col-lg-8">
                            <input type="number" id="quantity" name="quantity" placeholder="Quantity" class="form-control" value="<?php echo $offer->offer_quantity;?>"/>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">More Details</label>
                        <div class="col-lg-8">
                            <input type="text" id="details" name="details" placeholder="Product Details" class="form-control"/>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Choose Image</label>
                        <div class="col-lg-8">
                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control"/>
                            <br>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!--</div>-->
            <div class="col-lg-12">
            <div class="form-group">
            	<div class="col-lg-offset-5">
                    <input type="checkbox" id="is_registered"  class=""/>
                    <label class="">I am already registerd to Laabus</label>
                    <br>
                </div>
            </div>
                <div class="form-group">
                    <div class="col-lg-offset-5">
                    
                        <button class="btn btn-sm btn-white" type="reset">Reset</button>
                        <a class="btn btn-sm btn-white" id="back" href="#">Back</a>
                        <button class="btn btn-sm btn-white" type="submit">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php } ?>
