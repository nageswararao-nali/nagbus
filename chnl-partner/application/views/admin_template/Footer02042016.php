<div class="footer">
    <div>
        <strong>Copyright</strong> Varini Info &copy; <?php echo date("Y");?>
    </div>    
</div>

</div>
</div>


<!-- Mainly scripts -->
<script src="<?= base_url() ?>admin_assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>admin_assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= base_url() ?>admin_assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?= base_url() ?>admin_assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>admin_assets/js/dataTables.bootstrap.min.js"></script>




<!-- Angular js-->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>
<script src="<?= base_url() ?>admin_assets/js/app.js"></script>

<!--Angular js end-->
<!-- Chosen -->
<script src="<?= base_url() ?>admin_assets/js/plugins/chosen/chosen.jquery.js"></script>
<script>
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }</script>

<!-- Custom and plugin javascript -->
<script src="<?= base_url() ?>admin_assets/js/inspinia.js"></script>
<script src="<?= base_url() ?>admin_assets/js/plugins/pace/pace.min.js"></script>

<script src="<?= base_url() ?>admin_assets/js/scripts.js"></script>

<!-- iCheck -->
<script src="<?= base_url() ?>admin_assets/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>


<!-- FooTable -->
<script src="<?= base_url() ?>admin_assets/js/plugins/footable/footable.all.min.js"></script>
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });

</script>

<!-- SUMMERNOTE -->
<script src="<?= base_url() ?>admin_assets/js/plugins/summernote/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
    var edit = function() {
        $('.click2edit').summernote({focus: true});
    };
    var save = function() {
        var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
        $('.click2edit').destroy();
    };
</script>
<!--Summernote end-->

<!-- Date picker -->
<script src="<?= base_url() ?>admin_assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script>
    $('#startDate').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
        toggleActive: true,
    });

    $('#endDate').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
        toggleActive: true,
    });
    $('#startDate').datepicker('setDate', new Date());
    var date2 = new Date()
    var nextDayDate = new Date();
    nextDayDate.setDate(date2.getDate() + 7);
    $('#endDate').datepicker('setDate', nextDayDate);
</script>
<!-- Data picker end-->

<!-- Jquery Validate -->
<script src="<?= base_url() ?>admin_assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url() ?>admin_assets/js/plugins/validate/jquery.validate.min.js"></script>
<!-- Jquery Validate end-->
<?php if (isset($jqueryJavaScript)) { ?>
    <script>
    <?php echo $jqueryJavaScript; ?>
    </script>
<?php } ?>
<!-- Sweet alert -->
<script src="<?= base_url() ?>admin_assets/js/plugins/sweetalert/sweetalert.min.js"></script>

<script>
    $(document).on('keypress', '.num_only', function(event) {
        return isNumberKey(event);
    })
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode == 46) {
            $('.altMessage').css('display', 'block');
            $('.altMessage').fadeOut(2000);
            return false;
        }
        if (charCode != 46 && charCode > 31
                && (charCode < 48 || charCode > 57)) {
            $('.altMessage').css('display', 'block');
            $('.altMessage').fadeOut(2000);
            return false;
        }
        return true;
    }

    $(document).ready(function() {
        $('a#back').click(function() {
            parent.history.back();
            return false;
        });
    });
</script>

</body>
</html>
