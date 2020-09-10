
    <!-- Plugins JS File -->
    <script src="{{ $web_source }}/js/jquery.min.js"></script>
    <script src="{{ $web_source }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ $web_source }}/js/jquery.hoverIntent.min.js"></script>
    <script src="{{ $web_source }}/js/jquery.waypoints.min.js"></script>
    <script src="{{ $web_source }}/js/superfish.min.js"></script>
    <script src="{{ $web_source }}/js/owl.carousel.min.js"></script>
    <script src="{{ $web_source }}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ $web_source }}/js/isotope.pkgd.min.js"></script>
    <script src="{{ $web_source }}/js/wNumb.js"></script>
    <script src="{{ $web_source }}/js/nouislider.min.js"></script>
    <script src="{{ $web_source }}/js/bootstrap-input-spinner.js"></script>
    <script src="{{ $web_source }}/js/jquery.magnific-popup.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ $web_source }}/js/main.js"></script>
    <script src="{{ $web_source }}/js/demos/demo-11.js"></script>
    <script src="{{ $web_source }}/js/ajax.js"></script>

<!-- Tost-->
<script src="{{asset('toast')}}/jquery.toast.min.js"></script>

<!-- toastr init js-->
{{-- <script src="{{url('admin')}}/assets/js/pages/toastr.init.js"></script> --}}
<script>
	! function(p) {
		"use strict";
		var notifier;

		function t() {}
		t.prototype.send = function(t, i, o, e, n, a, s, r) {
				var c = {
					heading: t,
					text: i,
					position: o,
					loaderBg: e,
					icon: n,
					hideAfter: a = a || 3e3,
					stack: s = s || 1
				};
				r && (c.showHideTransition = r),
					// console.log(c),
					p.toast().reset("all"),
					p.toast(c)
			},
			p.NotificationApp = new t,
			p.NotificationApp.Constructor = t
	}(window.jQuery),
	function(i) {
		notifier = i;
		"use strict";
	}(window.jQuery);

	function successMsg(title, msg) {
		notifier.NotificationApp.send(title, msg, "top-right", "#5ba035", "success")
	}

	function errorMsg(title, msg) {
		notifier.NotificationApp.send(title, msg, "top-right", "#bf441d", "error")
	}
</script>


    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
        }
    </script>

    <script type="text/javascript">
        function myFunction2() {
            var x = document.getElementById("password1");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
        }
    </script>

    <script type="text/javascript">
        function myFunction1() {
            var y = document.getElementById("password_confirmation");
            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
        }
    </script>
