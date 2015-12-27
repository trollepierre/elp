 <script type="text/javascript" src="http://externals.recontact.me/bootstrap-datetimepicker.min.js"></script>
 <script type="text/javascript" src="http://externals.recontact.me/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script> <!---->

<!--  // <script type="text/javascript" src="../1external/bootstrap-datetimepicker.min.js"></script>
 // <script type="text/javascript" src="../1external/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>  -->

 
        <!-- Langue du calendrier -->
        <script type="text/javascript">
        $('.form_date').datetimepicker({
        	language: 'fr',
        	weekStart: 1,
        	todayBtn: 1,
        	autoclose: 1,
        	todayHighlight: 1,
        	startView: 2,
        	minView: 2,
        	forceParse: 0
        });
        $('.form_time').datetimepicker({
        	language: 'fr',
        	weekStart: 1,
        	todayBtn: 1,
        	autoclose: 1,
        	todayHighlight: 1,
        	startView: 1,
        	minView: 0,
        	maxView: 1,
        	forceParse: 0
        });
        </script>