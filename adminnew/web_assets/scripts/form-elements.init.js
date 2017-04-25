var u = location.port != "" ? ':' + location.port : "";
var baseurl = location.protocol + "//" + document.domain + u;
//baseurl += "/laabus/web_assets";
baseurl += "/web_assets";
jQuery(function() {
    "use strict";

    function initSelect2() {
        $(".personSelect").select2(), $("#stateSelect").select2(), $("#multiSelect").select2(), $(".templatingSelect").select2({
            templateResult: function(state) {
                return state.id ? $('<span><img src="' + baseurl + '/images/flags/' + state.element.value.toLowerCase() + '.png" class="img-flag" style="margin-right: 3px; height: 12px; width: 12px;"/> ' + state.text + "</span>") : state.text
            },
            templateSelection: function(state) {
                return $('<span><img src="' + baseurl + '/images/flags/' + state.element.value.toLowerCase() + '.png" class="img-flag" style="margin-right: 3px; height: 12px; width: 12px;"/> ' + state.text + "</span>")
            }
        })
    }

    function initColorpicker() {
        $("#colorpickerDemo").colorpicker(), $("#colorpickerDemo1").colorpicker()
    }

    function initTextEditor() {
        $("#textEditorDemo").summernote({
            height: 300
        })
    }

    function initRangeSlider() {
        var ids = ["#sliderEx1", "#sliderEx2", "#sliderEx3", "#sliderEx4", "#sliderEx5", "#sliderEx6", "#sliderEx7"];
        ids.forEach(function(id) {
            $(id).slider()
        })
    }

    function initDatepicker() {
        $("#datepickerDemo").datepicker({
            autoclose: !0
        }), $("#datepickerDemo1").datepicker({
            todayHighlight: !0
        })
    }

    function _init() {
        initSelect2(), initColorpicker(), initTextEditor(), initRangeSlider(), initDatepicker()
    }
    _init()
});