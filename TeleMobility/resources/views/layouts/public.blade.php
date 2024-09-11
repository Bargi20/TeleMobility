<!DOCTYPE html>
<html>
    <head>
        <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Title -->
        <title>TeleMobility</title>

		<!-- Favicon -->
        <link rel="icon" href="img/faviconNoSfondo.png">

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<!-- Nice Select CSS -->
<link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<!-- icofont CSS -->
<link rel="stylesheet" href="{{ asset('css/icofont.css') }}">
<!-- Slicknav -->
<link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">
<!-- Descrizione Dottori CSS -->
<link rel="stylesheet" href="{{ asset('css/descrizione_dottori.css') }}">
<!-- Datepicker CSS -->
<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
<!-- Medipro CSS -->
<link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<!-- Responsive CSS -->
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
<!-- FAQ CSS -->
<link rel="stylesheet" href="{{ asset('css/Faq.css') }}">
<!--Paziente CSS-->
<link rel="stylesheet" href="{{asset('css/paziente.css')}}">

<link rel="stylesheet" href="{{ asset('css/login.css') }}">



    </head>
    <body>

        @include('layouts/_navpublic') <!-- include la navbar creata da unaltra parte che sta nella cartella layouts -->

            <!-- end #menu -->
            <div id="page">
                <div id="page-bgtop">
                    <div id="page-bgbtm">
                        @yield('content') <!--visualizza il contenuto di una sezione che si chiama content -->
                        <div style="clear: both;">&nbsp;</div>
                    </div>
                </div>
            </div>

            <!-- end #content -->
<!-- Footer Area -->
<footer id="footer" class="footer ">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2> Contattaci </h2>



								<p> Telefono: +39 0813 296 256</p>
								<p> Cellulare: +39 333 944 7274</p></p>
								<!-- Social -->
								<div>
									<img src = "images/faviconNoSfondo.png">
								</div>
								<!-- End Social -->
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer f-link">
								<h2>Dove siamo</h2>
								<div class="row">
									<div class="col-lg-12 col-md-6 col-12">
										<div style="width:fit-content; height: fit-content; border-style:inherit;">
											<p style="color: white;"> Terranova Sappo Minulio (RC)  <br> Via Vincenzo Cento 5</p>
											<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3130.1410463097927!2d16.006198375376826!3d38.32256448041774!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13151b0e837b4265%3A0x34f0b63e0d16244e!2sVia%20Vincenzo%20Cento%2C%205%2C%2089010%20Terranova%20Sappo%20Minulio%20RC!5e0!3m2!1sit!2sit!4v1715010261393!5m2!1sit!2sit"

											allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
										</iframe>

										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Orari Attività</h2>
								<p>Incontra un medico specialista, tramite videochiamata, dal tuo computer o dal tuo smartphone, ovunque tu sia.</p>
								<ul class="time-sidual">
									<li class="day">Lunedì - Venerdì <span>8.00-20.00</span></li>
									<li class="day">Sabato <span>9.00-18.30</span></li>
									<li class="day">Domenica <span> chiuso </span></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Newsletter</h2>
								<p>
									Nell’ottica di favorire la divulgazione scientifica nell’ambito della telemedicina e della salute digitale, abbiamo pensato di istituire la newsletter mensile, che viene inviata a tutti i soci iscritti</p>
									<p>Questa funzione sta per arrivare </p>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Footer Top -->
		</footer>
		<!--/ End Footer Area -->
        </div>
        <!-- jquery Min JS -->
		<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- jquery Migrate JS -->
<script src="{{ asset('js/jquery-migrate-3.0.0.js') }}"></script>
<!-- jquery Ui JS -->
<!-- Easing JS -->
<script src="{{ asset('js/easing.js') }}"></script>
<!-- Color JS -->
<!-- Popper JS -->
<!-- Bootstrap Datepicker JS -->
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<!-- Jquery Nav JS -->
<!-- Slicknav JS -->
<script src="{{ asset('js/slicknav.min.js') }}"></script>
<!-- ScrollUp JS -->
<!-- Niceselect JS -->
<!-- Tilt Jquery JS -->
<!-- Owl Carousel JS -->
<script src="{{ asset('js/owl-carousel.js') }}"></script>
<!-- counterup JS -->
<!-- Steller JS -->
<!-- Wow JS -->
<!-- Magnific Popup JS -->
<!-- Counter Up CDN JS -->
<script src="{{asset ('http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('js/main.js') }}"></script>
<!-- FAQ JS -->
<script src="{{ asset('js/Faq.js') }}"></script>

    </body>
</html>
