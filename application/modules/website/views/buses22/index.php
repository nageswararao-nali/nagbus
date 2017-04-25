<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel mb20 panel-info panel-hovered">
            <div class="panel-heading">
                <h4 class="text-successs">Search for bus tickets</h4>
            </div>
            <div class="panel-body">
                <form id="busform" action="<?php echo base_url()?>buses/busesList" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-md-11 col-sm-11">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group"> <i class="input-group-addon fa fa-map-marker"></i>
                                            <input type="text" class="form-control" name="cities" id="tags" required/>
                                            <input type="hidden" class="form-control" name="cities_val" id="tags_val" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group"> <i class="input-group-addon fa fa-map-marker"></i>
                                            <input type="text" class="form-control" name="cities2" id="tags2" required/>
                                            <input type="hidden" class="form-control" name="cities2val" id="tags2val" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-1 col-sm-1">
                            <div class="form-group">
                                <br/>
                                <div class="input-group"> <img src="<?php echo base_url()?>assets/icons/twoway.png" alt="twoway" /> </div>
                            </div>
                        </div>-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group date datepickerDemo">
                                <input type="text" class="form-control" name="DateofJourney" readonly placeholder="Date of Journey" required/>
                                <span class="input-group-addon"><i class=" ion ion-calendar"></i></span> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group date datepickerDemo">
                                <input type="text" class="form-control" name="DateofReturn" id="DateofReturn" readonly placeholder="Date of Return">
                                <span class="input-group-addon"><i class="ion ion-calendar"></i></span> </div>
                        </div>
                    </div>
                    <?php /*?><div class="form-group">
                        <div class="col-md-6">
                            <input type="checkbox" id="cabselect">
                            <label for="cabselect">Add a cab</label>
                            <input type="text" class="form-control destination" style="display:none" placeholder="destination">
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" id="hotelselect">
                            <label for="hotelselect">Add a hotel</label>
                        </div>
                    </div><?php */?>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12"><br />
<br />

                                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

$citiesList="";
$cityListArray =array();
foreach($cities as $city){
	$citiesList .= '"'.$city->name.'",';	
	$cityListArray[] = array("name"=>$city->name, "id"=>$city->id);
}

	$sourceJson = json_encode($cityListArray);

?>
    <script>
        var sourceJson = <?=$sourceJson?>;

        var destJson = '';
        var destCityResult = [];
        $(function () {

            var availableTags = [<?=rtrim($citiesList,",")?>];

            $("#tags").on("blur", function () {
                var sourceCityName = $(this).val();

                var found = getIdbyCityName(sourceCityName);
                var sourceCityId = found[0].id;

                $("#tags_val").val(sourceCityId);

                if (sourceCityId > 0) {
                    $.ajax({
                        url: '/seatseller/destinationList.php?sourceList=' + sourceCityId,
                        dataType: 'json',
                        success: function (result) {

                            var destJson = result.cities;

                            for (var key in destJson) {
                                if (destJson.hasOwnProperty(key)) {
                                    destCityResult.push(destJson[key].name);
                                }
                            }

                            $("#tags2").autocomplete({
                                source: destCityResult
                            });
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });

                } else {

                    alert("Invalid Source City ID");
                }
            });


            $("#tags").autocomplete({
                source: availableTags
            });

        });

        function getIdbyCityName(name) {
            return sourceJson.filter(
                function (sourceJson) {
                    return sourceJson.name == name
                }
            );
        }

        function getDestID(id) {
            return sourceJson.filter(
                function (sourceJson) {
                    return sourceJson.name == id
                }
            );
        }

        $("#tags2").on("blur", function () {
            var destVal = $("#tags2").val();

            if (destVal != "") {

                var found = getDestID(destVal);
                var destCityID = found[0].id;
                $("#tags2val").val(destCityID);
            }

        });
    </script>
    <script>
        $('#cabselect').click(function () {
            if ($(this).is(":not(:checked)")) $(".destination").hide();
            else if ($(this).is(":checked") && $('#hotelselect').is(":checked")) $(".destination").hide();
            else if ($(this).is(":checked") && $('#hotelselect').is(":not(:checked)")) $(".destination").show();
        });
        $('#hotelselect').click(function () {
            if ($(this).is(":checked") && $('#cabselect').is(":checked")) $(".destination").hide();
            else if ($(this).is(":not(:checked)") && $('#cabselect').is(":checked")) $(".destination").show();
            else if ($(this).is(":not(:checked)") && $('#cabselect').is(":not(:checked)")) $(".destination").hide();
        });
    </script>
    <script>
        $(function () {
            $('.datepickerDemo').datepicker({
                startDate: new Date()
            })
        });
    </script>