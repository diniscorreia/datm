jQuery(document).ready(function(){
    jQuery.datepicker.setDefaults({
       appendText: '(yyyy/mm/dd hh:mm)',
       dateFormat: 'yy/mm/dd'
    });
	if (jQuery("#datm_show_start_date").length) {
	   jQuery("#datm_show_start_date").datetimepicker({});
	};
	if (jQuery("#datm_show_end_date").length) {
	   jQuery("#datm_show_end_date").datetimepicker({});
	};
	if (jQuery("#datm_show_countdown_date").length) {
	   jQuery("#datm_show_countdown_date").datetimepicker({});
	};
	if (jQuery("#datm_release_date").length) {
	   jQuery("#datm_release_date").datepicker({ appendText: "(yyyy/mm/dd)" });
	};
});