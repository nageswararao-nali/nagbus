$(document).ready(function(){
	// var base_url = 'http://localhost/laabus/adminnew';
	var base_url = 'http://laabus.com/nag/laabus/adminnew';
	$(".activate_cashback_offer").on("click",function() {
		var cbk_id = $(this).attr('custdata');
		var cbk_isActive = $(this).attr('custisActive');
		var qData = {
			cbk_id : cbk_id,
			cbk_isActive : cbk_isActive
		}
		var self = $(this);
		$.ajax({
			type: 'POST',
			url: base_url + '/Cashback/activateCashbackOfer',
			data: qData,
			dataType : "text",
			success: function(resultData) {
				self.html(resultData);
				self.attr('custisActive', resultData);
			}
		});
	})
})