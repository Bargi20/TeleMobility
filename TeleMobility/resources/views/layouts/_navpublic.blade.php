		<header class="header">
			<!-- Header Inner -->
			<div class="header-inner">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo" style= "margin-left: 20px;">
									<a href="{{ route('home') }}"><img src="{{ asset('images/favicon.png') }}" alt="#"></a>
								</div>
								<!-- End Logo -->
								<div>
									<h3 style=" margin-top: 30px; margin-left: 80px ">TeleMobility</h3>
								</div>
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-md-auto" style="margin-right: 1em">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu" style="margin-left: 200px; margin-right: 70px">
											<li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                                            <li class="{{ Request::is('ListaDottori*') ? 'active' : '' }}"><a href="{{ route('Listadottori') }}">Dottori</a></li>
                                            <li class="{{ Request::is('Faq') ? 'active' : '' }}"><a href="{{ route('Faq') }}">FAQ</a></li>
											
											@can('isPaziente')
												<li class="{{ Request::is('Paziente/Notifiche') ? 'active' : '' }}"><a href="{{ route('NotifichePaziente') }}" id="notificheLink">Notifiche</a></li>
											@endcan

											@can('isClinico')
												<li class="{{ Request::is('Paziente/Notifiche') ? 'active' : '' }}"><a href="{{ route('NotifichePaziente') }}" id="notificheLink">Notifiche</a></li>
											@endcan

										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>


                            <!-- Bottone di login per utente non loggato -->

                            @guest
                            <div class="col-lg-2 col-12">
								<div class="get-quote">
									<a href="{{ route('login') }}" class="btn" style="margin-left: 100%;">Login</a>
								</div>
							</div>
                            @endguest


                             <!-- Bottone che cambia in base se l'utente è gia loggato -->

                            @can('isPaziente')
                            <div class="">
								<div class="get-quote">
									<a href="{{ route('Paziente') }}" class="btn" style="margin-right: 3em; margin-left: 3em;">Area Riservata</a>
								</div>
							</div>
                            @endcan
							
							@can('isClinico')
                            <div class="">
								<div class="get-quote">
									<a href="{{ route('Clinico') }}" class="btn" style="margin-right: 3em; margin-left: 3em;">Area Riservata</a>
								</div>
							</div>
                            @endcan
							
							@can('isAdmin')
                            <div class="">
								<div class="get-quote">
									<a href="{{ route('Amministratore') }}" class="btn" style="margin-right: 3em; margin-left: 3em;">Area Riservata</a>
								</div>
							</div>
                            @endcan

                            @auth
                            <div class="" style= "margin-right: 0em;">
                                <div class="get-quote">
                                    <form method="POST" action="{{ route('logout') }}" style="width: 0%">
                                        @csrf
                                        <button type="submit" class="btn">Logout</button>
                                    </form>
                                </div>
                            </div>
                            @endauth


						</div>
					</div>
			</div>
				<!--/ End Header Inner -->
		</header>
		<body>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script>
				$(document).ready(function() {
					$.ajax({
						url: '{{ route('verificaNotifiche') }}',
						type: "GET",
						success: function(response) {
							if (response.hasUnreadNotifications) {
								$('#notificheLink').addClass('text-danger');
								$('<img src="{{ asset('images/campana.png') }}" alt="foto campana" style="width: 30px; height: 30px; vertical-align: middle; position: absolute; top: -5px; right: 10px; margin-top: 1.84em; margin-right: 4.2em;">').insertBefore('#notificheLink');
								}
						},
						error: function(xhr, status, error) {
							console.error(xhr.responseText);
						}
					});
				});
			</script>
		</body>
		
		<!-- End Header Area -->
