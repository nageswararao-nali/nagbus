
$(document).ready(function(){
	$('#block').hide();
	
	$('#cbxShowHide').click(function(){
		this.checked ? $('#block').show() : $('#block').hide(); //time for show
	});
});


$(document).ready(function(){
	$('#txtReturnDateFlight').hide();
	$('#btnAddCity').hide();
	$('#rdRoundtripFlight').click(function(){
		this.checked ? $('#txtReturnDateFlight').show() : $('#').hide(); //time for show
		this.checked ? $('#btnAddCity').hide() : $('#').hide(); //time for show
	
	});
	$('#rdOnewayFlight').click(function(){
		this.checked ? $('#txtReturnDateFlight').hide() : $('#').show(); //time for show
		this.checked ? $('#btnAddCity').hide() : $('#').show();
	});
	$('#rdMultyCity').click(function(){
		this.checked ? $('#btnAddCity').show() : $('#').hide(); //time for show
	this.checked ? $('#txtReturnDateFlight').hide() : $('#').hide(); //time for show
	});
	
});


$(document).ready(function(){
	$('#txtReturnDateBus').hide();
	$('#rdRoundtripBus').click(function(){
		this.checked ? $('#txtReturnDateBus').show() : $('#').hide(); //time for show
		
	});
	$('#rdOnewayBus').click(function(){
		this.checked ? $('#txtReturnDateBus').hide() : $('#').show(); //time for show
		
	});
	
});



$(document).ready(function(){
	$('#txtReturn').hide();
	$('#rdRoundtripCab').click(function(){
		this.checked ? $('#txtReturn').show() : $('#').hide(); //time for show
		
	});
	$('#rdOnewayCab').click(function(){
		this.checked ? $('#txtReturn').hide() : $('#').show(); //time for show
		
	});
	
});


$(document).ready(function(){
	$('#txtPostpaid').hide();
	$('#rdPostpaid').click(function(){
		this.checked ? $('#txtPostpaid').show() : $('#').hide(); //time for show
		this.checked ? $('#txtPrepaid').hide() : $('#').show(); //time for show
	});
	$('#rdPrepaid').click(function(){
		this.checked ? $('#txtPrepaid').show() : $('#').hide(); //time for show
		this.checked ? $('#txtPostpaid').hide() : $('#').show(); //time for show
	});
	
});
$(document).ready(function(){
	$('#txtPostpaidDataCard').hide();
	$('#rdPostpaidDataCard').click(function(){
		this.checked ? $('#txtPostpaidDataCard').show() : $('#').hide(); //time for show
		this.checked ? $('#txtPrepaidDataCard').hide() : $('#').show(); //time for show
	});
	$('#rdPrepaid').click(function(){
		this.checked ? $('#txtPrepaidDataCard').show() : $('#').hide(); //time for show
		this.checked ? $('#txtPostpaidDataCard').hide() : $('#').show(); //time for show
	});
	
});




$(document).ready(function(){
	
	$('#mtblock2').hide();
	$('#mtblock3').hide();	
	$('#mtblock22').click(function(){
		$('#mtblock2').show();
		$('#mtblock1').hide();
		});
		$('#mtblock22').click(function(){
		$('#mtblock2').show();
		$('#mtblock3').hide();
		});
	$('#mtblock33').click(function(){
		$('#mtblock3').show();
		$('#mtblock2').hide();
		});
		$('#mtblock33').click(function(){
		$('#mtblock3').show();
		$('#mtblock1').hide();
		});
		$('#mtblock11').click(function(){
		$('#mtblock1').show();
		$('#mtblock2').hide();
		});
		$('#mtblock11').click(function(){
		$('#mtblock1').show();
		$('#mtblock3').hide();
		});
	
});


$(document).ready(function(){
	
	$('#mtblock2').hide();
	$('#mtblock3').hide();	
	$('#btnblock1next').click(function(){
		$('#mtblock2').show();
		$('#mtblock1').hide();
		});
		$('#btnblock1next').click(function(){
		
		$('#mtblock3').hide();
		});
	$('#btnblock2next').click(function(){
		$('#mtblock3').show();
		$('#mtblock2').hide();
		});
		$('#btnblock1next').click(function(){
		$('#mtblock3').show();
		$('#mtblock1').hide();
		});
	$('#btnblock3next').click(function(){
		
		$('#mtblock2').hide();
		});
		$('#mtblock11').click(function(){
		
		$('#mtblock3').hide();
		});
	
});

/*$(function () {
       $('#datetimepicker1').datetimepicker();
});*/
      
	  
	  
