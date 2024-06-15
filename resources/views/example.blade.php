@vite('resources/css/app.css')
  @vite('resources/js/app.js')




   {{-- for frontend start --}}
   <script src="{{ asset('/') }}frontend/js/jquery.min.js"></script>
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <link href="{{ asset('/') }}frontend/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="{{ asset('/') }}frontend/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('/') }}frontend/css/font-awesome.css" rel="stylesheet">
<script src="{{ asset('/') }}frontend/js/responsiveslides.min.js"></script>

<link href='//fonts.googleapis.com/css?family=Cagliostro' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>

<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
 </script>

<script src="{{ asset('/') }}frontend/js/simpleCart.min.js"></script>
<!-- cart -->
  <!--start-rate-->
<script src="{{ asset('/') }}frontend/js/jstarbox.js"></script>
	<link rel="stylesheet" href="{{ asset('/') }}frontend/css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
		<script type="text/javascript">
			jQuery(function() {
			jQuery('.starbox').each(function() {
				var starbox = jQuery(this);
					starbox.starbox({
					average: starbox.attr('data-start-value'),
					changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
					ghosting: starbox.hasClass('ghosting'),
					autoUpdateAverage: starbox.hasClass('autoupdate'),
					buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
					stars: starbox.attr('data-star-count') || 5
					}).bind('starbox-value-changed', function(event, value) {
					if(starbox.hasClass('random')) {
					var val = Math.random();
					starbox.next().text(' '+val);
					return val;
					}
				})
			});
		});
		</script>


  <script src="{{ asset('/') }}frontend/js/main.js"></script>
  <script type="text/javascript" src="{{ asset('/') }}frontend/js/bootstrap-3.1.1.min.js"></script>
  <link href="{{ asset('/') }}frontend/css/coreSlider.css" rel="stylesheet" type="text/css">
			<script src="{{ asset('/') }}frontend/js/coreSlider.js"></script>
			<script>
			$('#example1').coreSlider({
			  pauseOnHover: false,
			  interval: 3000,
			  controlNavEnabled: true
			});

			</script>
