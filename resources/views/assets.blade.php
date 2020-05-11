<!DOCTYPE html>
<html>
<header>
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="{{ asset('/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/css/animate.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/css/style.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/css/style-responsive.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/css/theme/default.css') }}" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{ asset('/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/ionRangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/password-indicator/css/password-indicator.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-combobox/css/bootstrap-combobox.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/jquery-tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css') }}" rel="stylesheet" />
	<link href="{{ asset('/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css') }}" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('/plugins/pace/pace.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->

		<!-- <style>
			img { width: 50%; }
		</style> -->
	@yield('css')
</header>
<body>
	<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
</body>
<footer>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
	<script src="{{ asset('/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
	<script src="{{ asset('/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<!--[if lt IE 9]>
		<script src="{{ asset('/crossbrowserjs/html5shiv.js') }}"></script>
		<script src="{{ asset('/crossbrowserjs/respond.min.js') }}"></script>
		<script src="{{ asset('/crossbrowserjs/excanvas.min.js') }}"></script>
	<![endif]-->
	<script src="{{ asset('/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{ asset('/plugins/parsley/dist/parsley.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('/js/ui-modal-notification.demo.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
	<script src="{{ asset('/plugins/masked-input/masked-input.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
	<script src="{{ asset('/plugins/password-indicator/js/password-indicator.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-combobox/js/bootstrap-combobox.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js') }}"></script>
	<script src="{{ asset('/plugins/jquery-tag-it/js/tag-it.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-daterangepicker/moment.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('/plugins/select2/dist/js/select2.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-show-password/bootstrap-show-password.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js') }}"></script>
	<script src="{{ asset('/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js') }}"></script>
	<script src="{{ asset('/plugins/clipboard/clipboard.min.js') }}"></script>
	<script src="{{ asset('/js/form-plugins.demo.min.js') }}"></script>
	<script src="{{ asset('/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js') }}"></script>
	<!-- <script src="{{ asset('/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js') }}"></script>
	<script src="{{ asset('/plugins/DataTables/extensions/Buttons/js/jszip.min.js') }}"></script>
	<script src="{{ asset('/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js') }}"></script>
	<script src="{{ asset('/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js') }}"></script>
	<script src="{{ asset('/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js') }}"></script> -->
	<script src="{{ asset('/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('/js/table-manage-buttons.demo.min.js') }}"></script>
	<script src="{{ asset('/js/table-manage-default.demo.min.js') }}"></script>
	<script src="{{ asset('/plugins/switchery/switchery.min.js') }}"></script>
	<script src="{{ asset('/js/form-slider-switcher.demo.min.js') }}"></script>
	<script src="{{ asset('/js/apps.min.js') }}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageDefault.init();
			FormSliderSwitcher.init();
			// TableManageButtons.init();
			FormPlugins.init();
		});
	</script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','../../../../www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-53034621-1', 'auto');
		ga('send', 'pageview');

	</script>

	<!-- reset the modal -->
	<script language="javascript">
		$('body').on('hidden.bs.modal', '.modal', function () {
			$(this).removeData('bs.modal');
		});
	</script>
	<!-- end reset modal -->

	<script type="text/javascript">
        $(document).ready(function () {
            $('.checkAll').on('click', function () {
                $(this).closest('table').find('tbody :checkbox').prop('checked', this.checked).closest('tr').toggleClass('selected', this.checked);
            });
            $('tbody :checkbox').on('click', function () {
                $(this).closest('tr').toggleClass('selected', this.checked); //Classe de seleção na row
                $(this).closest('table').find('.checkAll').prop('checked', ($(this).closest('table').find('tbody :checkbox:checked').length == $(this).closest('table').find('tbody :checkbox').length)); //Tira / coloca a seleção no .checkAll
            });
        });
    </script>
	@yield('javascript')
</footer>
</html>