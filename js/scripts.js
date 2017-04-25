// JavaScript Document
$(document).ready(function(){
var u = location.port!="" ? ':'+location.port :"";
var baseurl = location.protocol+"//"+document.domain+u+"/laabus/Admin/";
	$.ajax({
		url : baseurl+"/APIS/Countries",
		success : function(res){  
			var obj=JSON.parse(res);
			if(obj.err_code==0){
				for(var i=0; i<obj.message.length; i++){
					$('#drpCountry').append('<option value="'+obj.message[i].Country_Code+'">'+obj.message[i].Country_Name+'</option>');
				}
				$('#drpCountry').val($('#drpCountry > option:first').val())
			}
		}
	});
	
	//For header action purpose
	$(window).scroll(function(){
		if($('body').find('header').hasClass('object-visible')){
			$('#logo').removeClass('dpLogo');
			$('#logo').addClass('dpLogoA');
			$('.social-menu-links').parent('div').prev().show();
			$('.social-menu-links').hide();
		}else{
			$('#logo').addClass('dpLogo');
			$('#logo').removeClass('dpLogoA');
			$('.social-menu-links').show();
			$('.social-menu-links').parent('div').prev().hide();
		}
	});
	
	//For State fill autofill
	$(document).on('blur','.auto',function(){
		var address = $("input[name='address']").val();
		address = strReplaceAll(address, ",", "");
		clear();
		if(address.length!=0){
			$.ajax({
				url : baseurl+'APIS/Geo/'+address,
				success : function(res){
					var obj=JSON.parse(res);
					$("#drpCountry option[value='"+obj.country.short_name+"']").prop('selected',true);
					statecode =obj.state==null ?  0 : obj.state.short_name;
					districtcode = obj.district==null ? 0 : obj.district.short_name;
					get_states(obj.country.short_name, statecode, districtcode);
				}
			});
		}
	});
	
	$(document).on('change','#drpCountry',function(){
		get_states($(this).val(), 0, 0)
	});
	
	$(document).on('change','#drpState',function(){
		get_districts($('#drpCountry').val(), $(this).val(), 0)
	});
	
	$(document).on('change','#drpDistrict',function(){
		get_locations($('#drpCountry').val(), $('#drpState').val(), $(this).val())
	});
	
	$(document).on('change','#drpLocation',function(){
		get_pincode($('#drpCountry').val(), $('#drpState').val(), $('#drpDistrict').val(), $('#drpLocation').val())
	});
	
	//Signup module start
	
	$(document).on('submit','#SIGNUP',function(event){
		event.preventDefault();
		$.ajax({
			url : baseurl+'Auth/Register',
			data : $(this).serialize(),
			type : 'POST',
			cache : 'false',
			success : function(res){
				$(this).trigger('reset');
				var obj=JSON.parse(res);
				if(obj.err_code==0){
					$('#message_register_area').html('<div class="row"><div class="col-sm-12"><div class="alert alert-success"> <strong>Success!</strong> '+obj.message+' </div></div></div>');
				}else{
					$('#message_register_area').html('<div class="row"><div class="col-sm-12"><div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fail!</strong> '+obj.message+' </div></div></div>');
				}
			}
		})
		return false;
	});
	
	//Signup module End
	
	//Login moudle start
	$(document).on('submit','#login_form',function(event){
		event.preventDefault();
		$('#message_area').html('');
		$.ajax({
			url  : baseurl+'Auth/Login',
			data : $(this).serialize(),
			type : 'POST',
			cache : 'false',
			success : function(res){
				var obj=JSON.parse(res);
				if(obj.err_code==0){
					$('#message_area').html('<div class="row"><div class="col-sm-12"><div class="alert alert-success"> <strong>Success!</strong> '+obj.message+' </div></div></div>');
				location.reload();
				}else{
					$('#message_area').html('<div class="row"><div class="col-sm-12"><div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fail!</strong> '+obj.message+' </div></div></div>');
				}
			}
		});
		return false;
	})
	//Login module End
	
	//All functions
	function strReplaceAll(string, Find, Replace){
		try{
			return string.replace( new RegExp(Find, "gi"), Replace );
		}catch(ex){return string;}
	}
	
	function clear(){
		$("#drpCountry option[value='IN']").prop('selected',true);
		$("#drpState option[value=0]").prop('selected',true);
		$('#txtState').val("");
		$('#txtDistrict').val("");
		$('#txtPincode').val("");
	}
	
	function get_states(countryid, sltState, districtcode){
		var it = $('#drpState');
		$.ajax({
			url : baseurl+'APIS/Location/states/'+countryid,
			success : function(res){
				var obj=JSON.parse(res);
				it.empty();
				if(obj.err_code==1)
					it.append('<option value="-1">'+obj.message+'</option>');
				if(obj.err_code==0){
					it.append('<option value="0">Select State</option>');
					for(i=0; i<obj.message.length; i++){
						it.append('<option value="'+obj.message[i].State_Code+'">'+obj.message[i].State_Name+'</option>');
					}
					$("#drpState option[value='"+sltState+"']").prop('selected',true);
				}
				get_districts(countryid, sltState, districtcode);
			}
		});
	}
	
	function get_districts(countryid, stateid, sltDist){
		var it = $('#drpDistrict');
		$.ajax({
			url : baseurl+'APIS/Location/districts/'+countryid+'/'+stateid,
			success : function(res){
				var obj=JSON.parse(res);
				it.empty();
				if(obj.err_code==1)
					it.append('<option value="-1">'+obj.message+'</option>');
				if(obj.err_code==0){
					it.append('<option value="0">Select District</option>');
					for(i=0; i<obj.message.length; i++){
						it.append('<option value="'+obj.message[i].District_Name+'">'+obj.message[i].District_Name+'</option>');
					}
					$("#drpDistrict option[value='"+sltDist+"']").prop('selected',true);
					get_locations(countryid, stateid, sltDist);
				}
			}
		});
	}
	
	function get_locations(countryid, stateid, sltDist){
		var it = $('#drpLocation');
		$.ajax({
			url : baseurl+'APIS/Location/locations/'+countryid+'/'+stateid+'/'+sltDist,
			success : function(res){
				var obj=JSON.parse(res);
				it.empty();
				if(obj.err_code==1)
					it.append('<option value="-1">'+obj.message+'</option>');
				if(obj.err_code==0){
					it.append('<option value="0">Select Location</option>');
					for(i=0; i<obj.message.length; i++){
						it.append('<option value="'+obj.message[i].Location+'">'+obj.message[i].Location+'</option>');
					}
					//$("#drpLocation option[value='"+sltDist+"']").prop('selected',true);
				}
			}
		});
	}
	
	function get_pincode(countryid, stateid, sltDist, location){
		var it = $('#txtPincode');
		it.val("");
		$.ajax({
			url : baseurl+'APIS/Location/pincode/'+countryid+'/'+stateid+'/'+sltDist+'/'+location,
			success : function(res){
				var obj=JSON.parse(res);
				it.empty();
				if(obj.err_code==1){}
				if(obj.err_code==0){
						it.val(obj.message[0].Pincode);
				}
			}
		});
	}
	
});
//Number only validation
function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode
  if(charCode == 46 ) {$('.altMessage').css('display', 'block');
		 $('.altMessage').fadeOut(2000); return false;} 
  if (charCode != 46 && charCode > 31 
	&& (charCode < 48 || charCode > 57)){
		 $('.altMessage').css('display', 'block');
		 $('.altMessage').fadeOut(2000);
		 return false;
	 }
  return true;
}
$(document).ready(function(){
	$('#login').click();
});

