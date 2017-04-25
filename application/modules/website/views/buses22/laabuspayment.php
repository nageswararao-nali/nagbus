    <div class="row">
        <div class="col-md-8">
            <div class="panel mb20 panel-default panel-hovered">
                <div class="panel-body">
                   <!--<form action="/buses/booking_process" method="post">-->
					<form action="/buses/bookingstatus" method="post">
                        

                                <button type="submit" class="btn btn-group btn-success right">Continue</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        $('#coupon').click(function () {
            if (this.checked) {
                $(".couponcode").show();
            } else {
                $(".couponcode").hide();
            }
        });
    </script>