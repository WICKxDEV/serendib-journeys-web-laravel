<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>{{ \App\Helpers\SettingsHelper::get('site_title', 'Serendib Journeys - Explore Sri Lanka with Expert Tour Guides') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
      content="{{ \App\Helpers\SettingsHelper::get('seo_keywords', 'Sri Lanka tours, expert tour guide, Ceylon travel, tourism') }}"
      name="keywords"
    />
    <meta
      content="{{ \App\Helpers\SettingsHelper::get('seo_description', 'Discover the beauty of Sri Lanka with Serendib Journeys, the top tour guide service. Personalized itineraries, transport, and accommodations.') }}"
      name="description"
    />

    <!-- Favicon -->
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="img/favicon_io/apple-touch-icon.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="img/favicon_io/favicon-32x32.ico"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="img/favicon_io/favicon-16x16.ico"
    />
    <link rel="manifest" href="img/favicon_io/site.webmanifest" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link
      href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
      rel="stylesheet"
    />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Spinner Start -->
    <div
      id="spinner"
      class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
    >
      <div
        class="spinner-border text-primary"
        style="width: 3rem; height: 3rem"
        role="status"
      >
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
      <div class="row gx-0">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
          <div class="d-inline-flex align-items-center" style="height: 45px">
            <small class="me-3 text-light"
              ><i class="fa fa-map-marker-alt me-2"></i> {{ \App\Helpers\SettingsHelper::get('address', 'Sigiriya, Sri Lanka') }}</small
            >
            <small class="me-3 text-light"
              ><i class="fa fa-phone-alt me-2"></i>{{ \App\Helpers\SettingsHelper::get('phone', '+94 70 7777 364') }}</small
            >
            <small class="text-light"
              ><i class="fa fa-envelope-open me-2"></i>{{ \App\Helpers\SettingsHelper::get('email', 'info@serendibjourneys.lk') }}</small
            >
          </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
          <div class="d-inline-flex align-items-center" style="height: 45px">
            @if(\App\Helpers\SettingsHelper::get('social_instagram'))
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href="{{ \App\Helpers\SettingsHelper::get('social_instagram') }}"
              target="_blank"
              rel="noopener noreferrer"
              ><i class="fab fa-instagram fw-normal"></i
            ></a>
            @endif
            @if(\App\Helpers\SettingsHelper::get('social_facebook'))
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href="{{ \App\Helpers\SettingsHelper::get('social_facebook') }}"
              target="_blank"
              rel="noopener noreferrer"
              ><i class="fab fa-facebook-f fw-normal"></i
            ></a>
            @endif
            @if(\App\Helpers\SettingsHelper::get('social_tiktok'))
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href="{{ \App\Helpers\SettingsHelper::get('social_tiktok') }}"
              target="_blank"
              rel="noopener noreferrer"
              ><i class="fab fa-tiktok fw-normal"></i
            ></a>
            @endif
            @if(\App\Helpers\SettingsHelper::get('social_whatsapp'))
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
              href="{{ \App\Helpers\SettingsHelper::get('social_whatsapp') }}"
              target="_blank"
              rel="noopener noreferrer"
              ><i class="fab fa-whatsapp fw-normal"></i
            ></a>
            @endif
            @if(\App\Helpers\SettingsHelper::get('social_youtube'))
            <a
              class="btn btn-sm btn-outline-light btn-sm-square rounded-circle"
              href="{{ \App\Helpers\SettingsHelper::get('social_youtube') }}"
              target="_blank"
              rel="noopener noreferrer"
              ><i class="fab fa-youtube fw-normal"></i
            ></a>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
      <nav
        class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0"
      >
        <a href="{{ route('home') }}" class="navbar-brand p-0">
          <img src="img/logo-min.png" alt="Logo" />
        </a>
        <h2 class="text-primary-new-top m-0">{{ \App\Helpers\SettingsHelper::get('site_name', 'Serendib Journeys') }}</h2>
        <button
          class="navbar-toggler sticky-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse"
        >
          <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('services') }}" class="nav-item nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
            <a href="{{ route('packages') }}" class="nav-item nav-link {{ request()->routeIs('booking') ? 'active' : '' }}">Packages</a>
            <a href="{{ route('booking.form') }}" class="nav-item nav-link {{ request()->routeIs('booking.form') ? 'active' : '' }}">Booking</a>
            <a href="{{ route('gallery') }}" class="nav-item nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-item nav-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-item nav-link">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                    @endif
                @endauth
            @endif
          </div>
        </div>
      </nav>

      <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
          <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
              <h1
                class="display-3 text-white animated slideInDown text-primary-new"
              >
                {{ \App\Helpers\SettingsHelper::get('services_page_title', 'Our Services') }}
              </h1>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                  <li class="breadcrumb-item">
                    <a class="text-white" href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item text-white active" aria-current="page">
                    Services
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Elfsight WhatsApp Chat | Untitled WhatsApp Chat -->
    <script src="https://static.elfsight.com/platform/platform.js" async></script>
    <div class="elfsight-app-d84f2d3d-6afc-4b32-8691-cad69420693e" data-elfsight-app-lazy></div>
    <!-- Navbar & Hero End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="bg-white text-center text-primary-new px-3">Services</h6>
          <h1 class="mb-5">{{ \App\Helpers\SettingsHelper::get('services_title', 'Our Services') }}</h1>
        </div>
        <div class="row g-4">
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                <h5>{{ \App\Helpers\SettingsHelper::get('service_1_title', 'Customized Tour Packages') }}</h5>
                <p>
                  {{ \App\Helpers\SettingsHelper::get('service_1_description', 'We specialize in creating fully customized travel itineraries based on your interests, whether it\'s adventure, culture, wildlife, or relaxation. Every trip is tailored to fit your preferences, budget, and time.') }}
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-user text-primary mb-4"></i>
                <h5>{{ \App\Helpers\SettingsHelper::get('service_2_title', 'Private Guided Tours') }}</h5>
                <p>
                  {{ \App\Helpers\SettingsHelper::get('service_2_description', 'Experience Sri Lanka with the knowledge and expertise of local guides who offer in-depth insights into the history, culture, and hidden treasures of each destination.') }}
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-star text-primary mb-4"></i>
                <h5>{{ \App\Helpers\SettingsHelper::get('service_3_title', 'Luxury Travel Experiences') }}</h5>
                <p>
                  {{ \App\Helpers\SettingsHelper::get('service_3_description', 'For those seeking a touch of luxury, we offer exclusive experiences such as stays in boutique hotels, private transportation, and unique excursions that cater to high-end travelers.') }}
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-paw text-primary mb-4"></i>
                <h5>{{ \App\Helpers\SettingsHelper::get('service_4_title', 'Wildlife and Nature Tours') }}</h5>
                <p>
                  {{ \App\Helpers\SettingsHelper::get('service_4_description', 'Discover Sri Lanka\'s breathtaking biodiversity with tours to national parks, wildlife reserves, and eco-friendly accommodations. Spot elephants, leopards, and other native species in their natural habitats.') }}
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-university text-primary mb-4"></i>
                <h5>{{ \App\Helpers\SettingsHelper::get('service_5_title', 'Cultural and Heritage Tours') }}</h5>
                <p>
                  {{ \App\Helpers\SettingsHelper::get('service_5_description', 'Immerse yourself in Sri Lanka\'s rich cultural heritage with guided visits to ancient temples, UNESCO World Heritage Sites, traditional villages, and vibrant festivals.') }}
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-mountain text-primary mb-4"></i>
                <h5>Adventure and Outdoor Activities</h5>
                <p>
                  For thrill-seekers, we offer a range of adventure activities
                  such as hiking, rock climbing, snorkeling, diving, and hot air
                  ballooning, ensuring you experience Sri Lanka's natural beauty
                  up close.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-car text-primary mb-4"></i>
                <h5>Airport Transfers and Transportation</h5>
                <p>
                  We provide hassle-free transportation services, including
                  airport pickups, private chauffeurs, and comfortable vehicles,
                  ensuring smooth travel between destinations.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-bed text-primary mb-4"></i>
                <h5>Hotel Reservations and Travel Assistance</h5>
                <p>
                  Let us take care of your accommodation needs, from luxury
                  resorts to cozy guesthouses. We also offer 24/7 travel
                  assistance to ensure your journey is stress-free.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Service End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container">
        <div class="text-center">
          <h6 class="bg-white text-center text-primary-new px-3">
            Testimonial
          </h6>
          <!-- <h1 class="mb-5">Our Clients Say!!!</h1> -->
        </div>
        <!-- <div class="owl-carousel testimonial-carousel position-relative">
          <div class="testimonial-item bg-white text-center border p-4">
            <img
              class="bg-white rounded-circle shadow p-1 mx-auto mb-3"
              src="img/testimonial-1.jpg"
              style="width: 80px; height: 80px"
            />
            <h5 class="mb-0">Sarah K</h5>
            <p>Emirates, UAE</p>
            <p class="mb-0">
              A truly unforgettable experience! Serendib Journeys organized
              everything perfectly, from the scenic tour of Sigiriya to the
              relaxing beach days in Mirissa. Our guide was professional,
              friendly, and knowledgeable, making the entire trip enjoyable and
              stress-free. Highly recommend for anyone visiting Sri Lanka!
            </p>
          </div>
          <div class="testimonial-item bg-white text-center border p-4">
            <img
              class="bg-white rounded-circle shadow p-1 mx-auto mb-3"
              src="img/testimonial-2.jpg"
              style="width: 80px; height: 80px"
            />
            <h5 class="mb-0">Michael R</h5>
            <p>Emirates, UAE</p>
            <p class="mt-2 mb-0">
              We had an amazing family vacation thanks to Serendib Journeys. The
              itinerary was well-planned, and our chauffeur-guide made sure we
              were comfortable at all times. The kids loved the wildlife safari
              in Yala, and we enjoyed every moment of our trip. Definitely
              booking with them again!
            </p>
          </div>
          <div class="testimonial-item bg-white text-center border p-4">
            <img
              class="bg-white rounded-circle shadow p-1 mx-auto mb-3"
              src="img/testimonial-3.jpg"
              style="width: 80px; height: 80px"
            />
            <h5 class="mb-0">David P</h5>
            <p>Mumbai, India</p>
            <p class="mt-2 mb-0">
              The team at Serendib Journeys was fantastic from start to finish.
              They helped us customize our trip to include all the places we
              wanted to see. Our guide was punctual, polite, and shared so much
              fascinating history about the places we visited. This was our
              first time in Sri Lanka, and it won't be the last!
            </p>
          </div>
          <div class="testimonial-item bg-white text-center border p-4">
            <img
              class="bg-white rounded-circle shadow p-1 mx-auto mb-3"
              src="img/testimonial-4.jpg"
              style="width: 80px; height: 80px"
            />
            <h5 class="mb-0">Anna M</h5>
            <p>Emirates, UAE</p>
            <p class="mt-2 mb-0">
              What a seamless experience! Booking with Serendib Journeys was
              easy, and the trip exceeded all expectations. The highlight was
              our visit to Kandy, where we got to explore the Temple of the
              Tooth. The accommodations were excellent, and our guide was simply
              the best. Worth every penny!
            </p>
          </div>
        </div> -->
      <!-- Elfsight Google Reviews | Untitled Google Reviews -->
      <script src="https://static.elfsight.com/platform/platform.js" async></script>
      <div class="elfsight-app-dc60c22d-ba88-49ae-8a82-388b7fde4723" data-elfsight-app-lazy></div>
      </div>
    </div>
    <!-- Testimonial End -->

    <!-- Footer Start -->
    <div
      class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container py-5">
        <div class="row g-5">
          <div class="col-lg-3 col-md-6">
            <h4 class="text-white mb-3">Company</h4>
            <a class="btn btn-link" href="about.html">About Us</a>
            <a class="btn btn-link" href="contact.html">Contact Us</a>
            <a class="btn btn-link" href="">Privacy Policy</a>
            <a class="btn btn-link" href="">Terms & Condition</a>
            <a class="btn btn-link" href="">FAQs & Help</a>
          </div>
          <div class="col-lg-3 col-md-6">
            <h4 class="text-white mb-3">Contact</h4>
            <p class="mb-2">
              <i class="fa fa-map-marker-alt me-3"></i>
              Sigiriya, Sri lanka
            </p>
            <p class="mb-2">
              <i class="fa fa-phone-alt me-3"></i>+94 70 7777 364
            </p>
            <p class="mb-2">
              <i class="fa fa-envelope me-3"></i>info@serendibjourneys.lk
            </p>
            <div class="d-flex pt-2">
              @if(\App\Helpers\SettingsHelper::get('social_instagram'))
              <a
                class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
                href="{{ \App\Helpers\SettingsHelper::get('social_instagram') }}"
                target="_blank"
                rel="noopener noreferrer"
                ><i class="fab fa-instagram fw-normal"></i
              ></a>
              @endif
              @if(\App\Helpers\SettingsHelper::get('social_facebook'))
              <a
                class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
                href="{{ \App\Helpers\SettingsHelper::get('social_facebook') }}"
                target="_blank"
                rel="noopener noreferrer"
                ><i class="fab fa-facebook-f fw-normal"></i
              ></a>
              @endif
              @if(\App\Helpers\SettingsHelper::get('social_tiktok'))
              <a
                class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
                href="{{ \App\Helpers\SettingsHelper::get('social_tiktok') }}"
                target="_blank"
                rel="noopener noreferrer"
                ><i class="fab fa-tiktok fw-normal"></i
              ></a>
              @endif
              @if(\App\Helpers\SettingsHelper::get('social_whatsapp'))
              <a
                class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
                href="{{ \App\Helpers\SettingsHelper::get('social_whatsapp') }}"
                target="_blank"
                rel="noopener noreferrer"
                ><i class="fab fa-whatsapp fw-normal"></i
              ></a>
              @endif
              @if(\App\Helpers\SettingsHelper::get('social_youtube'))
              <a
                class="btn btn-sm btn-outline-light btn-sm-square rounded-circle"
                href="{{ \App\Helpers\SettingsHelper::get('social_youtube') }}"
                target="_blank"
                rel="noopener noreferrer"
                ><i class="fab fa-youtube fw-normal"></i
              ></a>
              @endif
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <h4 class="text-white mb-3">Gallery</h4>
            <div class="row g-2 pt-2">
              <div class="col-4">
                <img
                  class="img-fluid bg-light p-1"
                  src="img/sigiriya-1.jpg"
                  alt=""
                />
              </div>
              <div class="col-4">
                <img
                  class="img-fluid bg-light p-1"
                  src="img/kandy-2.jpg"
                  alt=""
                />
              </div>
              <div class="col-4">
                <img
                  class="img-fluid bg-light p-1"
                  src="img/mirissa-1.jpg"
                  alt=""
                />
              </div>
              <div class="col-4">
                <img
                  class="img-fluid bg-light p-1"
                  src="img/sigiriya-5.jpg"
                  alt=""
                />
              </div>
              <div class="col-4">
                <img
                  class="img-fluid bg-light p-1"
                  src="img/maduriver-2.jpg"
                  alt=""
                />
              </div>
              <div class="col-4">
                <img
                  class="img-fluid bg-light p-1"
                  src="img/kandy-4.jpg"
                  alt=""
                />
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <h4 class="text-white mb-3">Newsletter</h4>
            <p>Sign up for our newsletter to stay updated</p>
            <div class="position-relative mx-auto" style="max-width: 400px">
              <input
                class="form-control border-primary w-100 py-3 ps-4 pe-5"
                type="text"
                placeholder="Your email"
              />
              <button
                type="button"
                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2"
              >
                SignUp
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="copyright">
          <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
              &copy; <a class="border-bottom" href="#">Serendib Journeys</a>,
              All Right Reserved. Designed By
              <a class="border-bottom" href="">Serendib Digital</a>
            </div>
            <div class="col-md-6 text-center text-md-end">
              <div class="footer-menu">
                <a href="index.html">Home</a>
                <a href="">Cookies</a>
                <a href="">Help</a>
                <a href="">FQAs</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
      ><i class="bi bi-arrow-up"></i
    ></a> -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </body>
</html>
