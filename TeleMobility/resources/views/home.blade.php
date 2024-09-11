@extends('layouts.user')

@section('content')


<!-- Slider Area -->
<section class="slider">
			<div class="hero-slider">
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('images/slider2.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>Offriamo il <span>supporto medico</span> di cui hai bisogno.<br> <span>Prova con noi!</span></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Slider -->
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('images/slider.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>Prova i nostri <span>Clinici</span>,<br> i più <span>Esperti nel settore</span></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Start End Slider -->
			</div>
		</section>
		<!--/ End Slider Area -->

		<!-- Start Schedule Area -->
		<section class="schedule">
			<div class="container">
				<div class="schedule-inner">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-12 ">
							<!-- single-schedule -->
							<div class="single-schedule first">
								<div class="inner">
									<div class="single-content">
										<h4>Telemonitoraggio</h4>
										<p>Monitoraggio di parametri vitali e dati sanitari e possibilità di controllo dei pazienti.
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-12">
							<!-- single-schedule -->
							<div class="single-schedule middle">
								<div class="inner">
									<div class="single-content">
										<h4>Principali patologie e trattamenti</h4>
										<p>Diagnosi e riabilitazione dei disturbi del movimento.
											Malattie neuromuscolari.

										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-12">
							<!-- single-schedule -->
							<div class="single-schedule last">
								<div class="inner">
									<div class="single-content">
										<h4>Assicurazione sanitaria </h4>
										<p>Trova i migliori specialisti convenzionati con la tua compagnia assicurativa sanitaria</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/End Start schedule Area -->


		<section class="slider">
			<div class="hero-slider">
                <!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('images/online-video-conference-call-doctor-260nw-1765316213.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<div class="text">

										<h1 style="text-align: justify;font-size: 100px;"> Chi siamo </h1>


								</div>
							</div>
						</div>
					</div>
				</div>

				
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('images/FotoDoc2.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1> <span> Telemobility </span> è una piattaforma di telemedicina,specializzata nella riabilitazione neurologica <br>
										di servizi altamente innovativi, dedicati alla salute e al <span> benessere dell’utente </span>,<br>
										che spaziano dalla televisita alla possibilità di monitorare i propri indici di salute</p></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Slider -->
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('images/medico-di-base.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>Con <span> Telemobility </span> puoi accedere ai servizi di <span>telemonitoraggio</span> che ti consentono
										di <span> monitorare i tuoi  disturbi motori </span> e di condividerli con gli specialisti durante
										il consulto, semplicemente mediante strumenti e dispositivi domiciliari per la telemedicina.</p></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Start End Slider -->
			</div>
		</section>

		<div class="container mb-5">
			<a class="btn btn-primary"  href="{{ asset('Relazione/Relazione_Progetto.pdf') }}"> <h5 style="color: white">Visualizza la Documentazione
			</h5>
			</a>
		</div>
@endsection
