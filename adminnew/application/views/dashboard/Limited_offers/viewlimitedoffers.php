<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Limited Offers</h2>
        <ul class="breadcrumb">
            <li> <a href="">Dashboard</a> </li>
            <li class="active"><strong>Limited Offers</strong></li>
        </ul>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
        <!--<div class="ibox float-e-margins">-->
        <div class="col-lg-6">
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Title*</label>
                    <div class="col-lg-8">
                        <input type="text" id="title" placeholder="Title" class="form-control" required/>
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Offer Start*</label>
                    <div class="col-lg-8">
                        <input type="text" id="startDate"  name="offer_start" placeholder="YYYY-MM-DD" class="form-control" readonly />
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Offer End*</label>
                    <div class="col-lg-8">
                        <input type="text" id="endDate" name="offer_end" placeholder="YYYY-MM-DD" class="form-control" readonly/> 
                        <br>     
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Original Price*</label>
                    <div class="col-lg-8">
                        <input type="number" id="original_price" placeholder="Original price" class="form-control" required/>
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Discount Price*</label>
                    <div class="col-lg-8">
                        <input type="number" id="discount_price" placeholder="Discount Price" class="form-control" required/>
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Laabus Percent*</label>
                    <div class="col-lg-8">
                        <input type="number" id="laabus_price" placeholder="Laabus Percent" class="form-control" required/>
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
                        <input type="number" id="quantity" placeholder="Quantity" class="form-control" required min="1"/>
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">More Details</label>
                    <div class="col-lg-8">
                        <textarea id="details" placeholder="Product Details" class="form-control"></textarea>
                        <br>
                    </div>
                </div>
		<div class="form-group">
                    <label class="col-lg-4 control-label">Buy Now</label>
                    <div class="col-lg-8">
                        <input type="checkbox" id="buy_now" name="buy_now" value="1"/>
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
                    <button class="btn btn-sm btn-white" onclick="createdOffers()">Create</button>
                </div>
            </div>
        </div>
        
        
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Offer List</h5>
                </div>
                <div class="ibox-content">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th> ID</th>
                            <th>Name</th>
                            <th>Offer Start</th>
                            <th>Offer End</th>
                            <th>Original Price</th>
                            <th>Laabus Percent</th>
                            <th>Discount Price</th>
                            <th>Quantity</th>
                            <th>Buy Now</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
			if(count($offers)){ 
			foreach ($offers as $offer){?>
                            <tr id="chnl">
                                <td><?php echo $offer->id;?></td>
                                <td><?php echo $offer->offer_title;?></td>
                                <td><?php echo $offer->offer_start;?></td>
                                <td><?php echo $offer->offer_end;?></td>
                                <td><?php echo $offer->original_price;?></td>
                                <td><?php echo $offer->laabus_price;?></td>
                                <td><?php echo $offer->discount_price;?></td>
                                <td><?php echo $offer->offer_quantity;?></td>
                                <td><?= ($offer->buy_now == 1)?'True':'False';?></td>
                                <td>
                                    <button class="" onclick="updateOffer(<?php echo $offer->id;?>)">Edit
                                    </button>
                                    <button class="" onclick="viewUser(<?php echo $offer->id;?>)">
                                        Users
                                    </button>
                                    <button class="" onclick="deleteOffer(<?php echo $offer->id;?>)">
                                        <i class="fa fa-times">Delete</i>
                                    </button>
                                </td>
                            </tr>
                        <?php  }  }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
 function deleteOffer(id) {
        $.ajax({
            type: 'GET',
            url:  '<?php echo base_url().'Limited_offer/deleteOffers';?>',
            data: {
                id:id
            },
            success: function(response){
                console.log(response)
                window.location.reload();
            },
            error: function(response){
                console.log(response)
            }
        });
    }
    
 function createdOffers(){
 //	console.log("called");
	if (document.getElementById('buy_now').checked) {
            var buy_now = '1';
        } else {
	    var buy_now = '0';
        }

 	var title = $('#title').val();
        var offerStart = $('#startDate').val();
        //var DateinISO = $.datepicker.parseDate('mm/dd/yy', StartDateOldFormat); 
        //var offerStart = $.datepicker.formatDate( "yy-mm-dd", new Date( DateinISO ));
        $("#dateStart").val(offerStart);
        
        var offerEnd = $('#endDate').val();
        //var DateinISO = $.datepicker.parseDate('mm/dd/yy', EndDateOldFormat); 
        //var offerEnd = $.datepicker.formatDate( "yy-mm-dd", new Date( DateinISO ));
        $("#dateEndNewFormat").val(offerEnd);
        var originalprice = $('#original_price').val();
        var discountPrice = $('#discount_price').val();
        var laabusPrice = $('#laabus_price').val();
        var quantity = $('#quantity').val();
        var details = $('#details').val();
	
        console.log(offerStart);
        console.log(offerEnd);
         if(!title || title == ''){
	      alert("Title is NULL"); 
	      window.location.reload();
      
      }
     else if(!offerStart ||offerStart == ''){
      alert("Offer Period is null or not a number");
      window.location.reload();
      }
      else if(!offerEnd ||offerEnd == ''){
      alert("Offer Period is null or not a number");
      window.location.reload();
      }

     else if(!originalprice ||originalprice == ''){
       alert("Original Price is null or not a number");
     window.location.reload();
     }
        else if(!discountPrice || discountPrice == ''){
     alert("Discount Price null or not a number");
     window.location.reload();
     }
    else if(!laabusPrice ||laabusPrice == ''){
     alert("Laabus Price is null or not a number");
     window.location.reload();
     }
    else if(!quantity ||quantity == ''){
     alert("Quantity is null or not a number");
     window.location.reload();
     }
     else{
           $.ajax({
            type: 'POST',
            url : '<?php echo base_url() . 'Limited_offer/createOffers/';?>',
           
            data: {
                'title': title,
                'offer_start': offerStart,
                'offer_end': offerEnd,
                'original_price': originalprice,
                'discount_price': discountPrice,
                'quantity': quantity,
                'details' : details,
                'laabus_price': laabusPrice,
                'buy_now': buy_now
            },
            success: function(response){
                console.log(response);
                window.location.reload();
            },
            error: function(response){
                console.log(response);
            }
        });
    }
    }
    

    function updateOffer(id){
        $.ajax({
            type: 'GET',
            url:  '<?php echo base_url().'Limited_offer/rediretUpdateOffer';?>',
            data: {
                offer_id:id
            },
            success: function(response){
                console.log(response)
                window.location.href = '<?php echo base_url().'Limited_offer/rediretUpdateOffer';?>' + '?offer_id='+id;
            },
            error: function(response){
                console.log(response)
                return;
            }
        });
    }
    
        function viewUser(id){
        //console.log("called"); return;
        $.ajax({
            type: 'GET',
            url:  '<?php echo base_url().'Limited_offer/userListByOffer';?>',
            data: {
                id:id
            },
            success: function(response){
                console.log(response)
                window.location.href = '<?php echo base_url().'Limited_offer/userListByOffer';?>' + '?id='+id;
            },
            error: function(response){
                console.log(response)
                return;
            }
        });
    }
    

</script>
