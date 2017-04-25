<div class="wrapper wrapper-content animated fadeInRight" ng-controller="commissionCtrl">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Commission Setup form</h5>
          <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-lg-5">
<!--              <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Select Module</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <select class="form-control" name="moduleid" ng-model="mid" ng-change="servic()" ng-options="item.name for item in modules track by item.module_id"><option value="" disabled="disabled">Select Module</option>
                    </select>
                  </div>
                </div>
              </div>-->
<!--            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6">-->
              <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Select Category</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <select class="form-control" name="categoryid" ng-model="cid" ng-change="cat()" ng-options="item.categoryname for item in categories track by item.category_id"><option value='' disabled="disabled">Select Category</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--<div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
              <button class="btn btn-sm btn-white" type="submit">Reset</button>
              <button class="btn btn-sm btn-white" type="submit">Create</button>
            </div>
          </div>--> 
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>All Operators Table </h5>
          <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#">Config option 1</a> </li>
              <li><a href="#">Config option 2</a> </li>
            </ul>
            <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
          <table class="table table-hover">
            <thead>
              <tr class="text-center">
                <!--<th>#</th>-->
                <th>Title</th>
                <th>Our Commission</th>
                <th>Agent Commission</th>
                <th>Agent Reference Commission</th>
                <th>Markup </th>
                <th>Discount</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="flat_currency_table">
              <tr style="background-color:#9CC">
                <!--<td>@</td>-->
                <td><label>Flat Commissions</label></td>
                <td><select class="input-sm" name="currency_type">
                    <option value=""></option>
                    <option value="R">Rs</option>
                    <option value="P">%</option>
                  </select>
                  <input type="text" class="input-sm" size="4"/></td>
                <td><select class="input-sm" name="currency_type">
                    <option value=""></option>
                    <option value="R">Rs</option>
                    <option value="P">%</option>
                  </select>
                  <input type="text" class="input-sm" size="4"/></td>
                <td><select class="input-sm" name="currency_type">
                    <option value=""></option>
                    <option value="R">Rs</option>
                    <option value="P">%</option>
                  </select>
                  <input type="text" class="input-sm" size="4"/></td>
                   <td><select class="input-sm" name="currency_type">
                    <option value=""></option>
                    <option value="R">Rs</option>
                    <option value="P">%</option>
                  </select>
                  <input type="text" class="input-sm" size="4"/></td>
                <td><select class="input-sm" name="currency_type">
                    <option value=""></option>
                    <option value="R">Rs</option>
                    <option value="P">%</option>
                  </select>
                  <input type="text" class="input-sm" size="4"/></td>
               <td><button class="btn btn-primary btn-xs dim" type="button" id="flat_apply"><i class="fa fa-check"></i>&nbsp;Apply</button></td>
              </tr>
            </tbody>
          </table>
          <hr/>
          <table class="table table-hover">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th>Operator Name</th>
                <th>Our Commission</th>
                <th>Agent Commission</th>
                <th>Markup </th>
                <th>Discount</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="tblCategories2">
              <tr ng-repeat="operator in operators">
                <td>{{operator.operator_code}}</td>
                <td>{{operator.operator_name}}</td>
                <td><select class="input-sm" name="our_cal_type" ng-model="our_cal_type">
                    <option value="R" ng-selected="{{operator.our_commission_amount!=null}}">Rs</option>
                    <option value="P" ng-selected="{{operator.our_commission_percentage!=null}}">%</option>
                  </select>
                  <input type="text" class="input-sm" name="our_amount" size="5" value="{{operator.our_commission_percentage!=null ? operator.our_commission_percentage : operator.our_commission_amount}}"/></td>
                <td><select class="input-sm" name="agent_cal_type">
                    <option value="R" ng-selected="{{operator.agent_commission_amount!=null}}">Rs</option>
                    <option value="P" ng-selected="{{operator.agent_commission_percentage!=null}}">%</option>
                  </select>
                  <input type="text" class="input-sm" name="agent_amount" size="5"  value="{{operator.agent_commission_percentage!=null ? operator.agent_commission_percentage : operator.agent_commission_amount }}"/></td>
                <td><select class="input-sm" name="mark_cal_type">
                    <option value="R" ng-selected="{{operator.markup_commission_amount!=null}}">Rs</option>
                    <option value="P" ng-selected="{{operator.markup_commission_percentage!=null}}">%</option>
                  </select>
                  <input type="text" class="input-sm" name="mark_amount" size="5"   value="{{operator.markup_commission_percentage!=null ? operator.markup_commission_percentage : operator.markup_commission_amount }}"/></td>
                <td><select class="input-sm" name="discount_cal_type">
                    <option value="R" ng-selected="{{operator.discount_amount!=null}}">Rs</option>
                    <option value="P" ng-selected="{{operator.discount_percentage!=null}}">%</option>
                  </select>
                  <input type="text" class="input-sm" name="discount_amount" size="5"  value="{{operator.discount_percentage!=null ? operator.discount_percentage : operator.discount_amount }}"/></td>
                <td><button class="btn btn-primary btn-xs update dim" type="button" data-oid="{{operator.operator_id}}"><i class="fa fa-check"></i>&nbsp;Update</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).on('click','.update', function(event){
	event.preventDefault();
		var g = $(this).parents('tr');
		var operator_id = $(this).attr('data-oid');
		
		var our_cal_type = g.find('select[name=our_cal_type]').val();
		var our_amount = g.find('input[name=our_amount]').val();
		
		var agent_cal_type = g.find('select[name=agent_cal_type]').val();
		var agent_amount = g.find('input[name=agent_amount]').val();
		
		var mark_cal_type = g.find('select[name=mark_cal_type]').val();
		var mark_amount = g.find('input[name=mark_amount]').val();
		
		var discount_cal_type = g.find('select[name=discount_cal_type]').val();
		var discount_amount = g.find('input[name=discount_amount]').val();
		
		var d = 'operator_id='+operator_id+'&our_cal_type='+our_cal_type+'&our_amount='+our_amount+'&agent_cal_type='+agent_cal_type+'&agent_amount='+agent_amount+'&mark_cal_type='+mark_cal_type+'&mark_amount='+mark_amount+'&discount_cal_type='+discount_cal_type+'&discount_amount='+discount_amount;
		
		swal({
			title: "Security Alert!",
			text: "Please enter security pin",
			type: "input",
			showCancelButton: true,
			closeOnConfirm: false,
			animation: "slide-from-top",
			inputPlaceholder: "Enter security pin"
		}, function(inputValue) {
			if (inputValue === false) return false;
			if (inputValue === "") {
				swal.showInputError("Please enter security pin");
				return false
			}
			$.ajax({url : baseurl+'Commission_Setup/save_operator_commission',data : d,type :'POST',success:function(res){
				console.log(res);
				swal("Nice!", "You wrote: " + inputValue, "success");
			}});
		});
});
</script>
<script>
//validation code
$(document).ready(function(){
	$('#create_operator').validate({
		rules : {
			moduleid : {
				required : true,
			},
			categoryid : {
				required : true,
			},
			operator_name : {
				required : true,
			},
			operator_code : {
				required : true,
			},
			description : {
				required : true,
			}
		}
	});
})
</script> 
<script>
$(document).ready(function(){
	$(document).on('click','#flat_apply',function(){
		var f = $(this).parents('tr').children('td');
		for(var i=2; i < f.length-1; i++){
			if(f.eq(i).children('select').val()!=""){
				var dep =$('.tblCategories2').children('tr');
				for(var j=0; j<dep.length; j++){
					dep.eq(j).children('td').eq(i).children('select').val(f.eq(i).children('select').val());
				}
			}
			if(f.eq(i).children('input').val()!=""){
				var dep =$('.tblCategories2').children('tr');
				for(var j=0; j < dep.length; j++){
					dep.eq(j).children('td').eq(i).children('input').val(f.eq(i).children('input').val());
				}
			}
		}
		
	});
});
</script>
