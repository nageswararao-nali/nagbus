$(document).ready(function() {
	function get_plan_types(){
        $.ajax({
            url: baseurl + 'APIS/recharge_api/get_offer_categories',
            success: function(res) {
                var obj = JSON.parse(res);
                if (obj.err_code == 1) {
                    $('.types').html('<option value="">Select Plan</option>');
                    for (var i = 0; i < obj.message.length; i++) {
                        $('.types').append('<option value="' + obj.message[i].recharge_category_id + '">' + obj.message[i].category_name + '</option>');
                    }
                } else $('.types').html('<option>No types</option>')
            }
        })
	}
    function get_offer_circles() {
        var ur = baseurl + 'APIS/recharge_api/get_mobile_offer_circles';
        $.ajax({
            url: ur,
            success: function(res) {
                var obj = JSON.parse(res);
                if (obj.err_code == 1) {
                    $('.offer_circles').html('');
                    for (var i = 0; i < obj.message.length; i++) {
						var s = $('select[name=operator_circle]>option:selected').text().substr(1, 3) == obj.message[i].circle_name.substr(1, 3) ? "selected" : "";
                        $('.offer_circles').append('<option value="' + obj.message[i].recharge_offer_circle_id + '" ' + s + '>' + obj.message[i].circle_name + '</option>')
                    }
					get_plan_types();
                } else $('.offer_circles').html('<option>No Circles</option>')
            },
            error: function(res) {}
        })
    }


    function ajax_call(went, cls) {
        var ur = baseurl + 'APIS/recharge_api/' + went;
        $.ajax({
            url: ur,
            success: function(res) {
                var obj = JSON.parse(res);
                if (obj.err_code == 1) {
                    $('.' + cls).html('');
                    for (var i = 0; i < obj.message.length; i++) {
                        var s = $('.operators>option:selected').text().substr(1, 3) == obj.message[i].operator_name.substr(1, 3) ? "selected" : "";
                        $('.' + cls).append('<option value="' + obj.message[i].recharge_offer_operators_id + '" ' + s + '>' + obj.message[i].operator_name + '</option>')
                    }
                    get_offer_circles();
                } else $('.' + cls).html('<option>No operators</option>')
            },
            error: function(res) {}
        })
    }

    function get_offer_operators() {
        ajax_call('get_mobile_offer_operators', 'offer_operators');
    }
	$('.fetch_network').keyup(function() {
        if ($(this).val().length == 4) {
            var m = $(this).val();
            $.ajax({
                url: baseurl + 'APIS/recharge_api/get_network',
                data: 'categoryid=3&mobileno=' + m,
                success: function(res) {
                    var obj = JSON.parse(res);
                    $('select[name=operator]').val(obj.operator);
					$('select[name=operator_circle]').val(obj.circle);
                    $('.operator_title').html($('.operators>option:selected').text());
					$('input[name=operator_name]').val($('.operators>option:selected').text());
                }
            })
        }
    });

    function operators() {
        var ur = baseurl + 'APIS/recharge_api/get_operatorsDatacard';
        $.ajax({
            url: ur,
            success: function(res) {
                var obj = JSON.parse(res);
                if (obj.err_code == 1) {
                    $('.operators').html('<option value="">Select Operator</option>');
                    for (var i = 0; i < obj.message.length; i++) {
                        $('.operators').append('<option value="' + obj.message[i].operator_code + '">' + obj.message[i].operator_name + '</option>');
                    }
                } else $('.operators').html('<option>No operators</option>')
            },
            error: function(res) {}
        })
    }
    operators();
	
    $('.rcValue').click(function() {
        $('.rcAmount').val($(this).val());
        $('#PlanModal').modal('hide');
    });
	
    $('#brwsePlans').click(function() {
        ajax_call('get_mobile_offer_operators', 'offer_operators');
    });
	
    $('.types').change(function() {
        var o_v = $('.offer_operators').val();
        var c_v = $('.offer_circles').val();
        var t_v = $(this).val();
        if (t_v !== "") {
            $.ajax({
                url: baseurl + 'APIS/recharge_api/get_offers',
                data: 'operatorid=' + o_v + '&circleid=' + c_v + '&planid=' + t_v,
                success: function(res) {
                    $('.offers_description').html('');
                    var obj = JSON.parse(res);
                    if (obj.err_code == 1) {
                        for (var i = 0; i < obj.message.length; i++) {
                            var k = obj.message[i];
                            $('.offers_description').append('<div class="row"><div class="col-md-4"><p><b>Talk time</b></p><p>' + k.price + '</p></div><div class="col-md-4"> <p><b>Validity</b></p><p>' + k.validity + '</p></div><div class="col-md-4 text-right"> <button type="button" class="btn btn-primary rcValue" onclick="selectPrice(' + k.price.substring(4) + ')" value="' + k.price.substring(4) + '">' + k.price + '</button> </div></div><div class="row"> <div class="col-lg-12"><b>Description</b> <div class="row"> <div class="col-lg-12">' + k.benifits + ' </div></div></div></div><hr/>');
                        }
                    } else {}
                }
            })
        }
    });

	
	/*$('#recForm').submit(function(){
		$('input[name=operator_name]').val($('.operators>option:selected').text());
		if($('.fetch_network').val().length!=10){ $('.fetch_network').focus();alert("Mobile number should be 10 digits");return false;}
		if($('.rcAmount').val().length==""){ $('.rcAmount').focus();alert("Please enter recharge amount");return false;}
			$('#loading').show();
			$.ajax({
				url: baseurl+'Recharge/validate',
				data : $('#recForm').serialize(),
				cache : false,
				type : 'post',
				success:function(a){
					$('#loading').hide();
					$('.login_show').html(a);
					$('.recharge_content').hide();
					//$('.content_with_ajax_modified').html(a);
					window.history.pushState("string", "Title", baseurl+'index/recharge/proceed');
				},error : function(){
					$('#loading').hide();
				}
			})
		return false;
	});*/
	$('.operators').change(function(){
		$('.operator_title').html($('.operators>option:selected').text());
		$('input[name=operator_name]').val($('.operators>option:selected').text());
	});
	function get_cirles(){
		$.ajax({
                url: baseurl + 'APIS/recharge_api/get_circles',
               success: function(res) {
                    $('select[name=operator_circle]').html('');
                    var obj = JSON.parse(res);
                    if (obj.err_code == 1) {
                        for (var i = 0; i < obj.message.length; i++) {
                            $('select[name=operator_circle]').append('<option value="' + obj.message[i].circle_id + '">' + obj.message[i].circle_name + '</option>');
                        }
                    } else {}
                }
            })
	}
	get_cirles();
});