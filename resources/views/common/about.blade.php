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
                {{ \App\Helpers\SettingsHelper::get('about_page_title', 'About Us') }}
              </h1>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                  <li class="breadcrumb-item">
                    <a class="text-white" href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item text-white active" aria-current="page">
                    About
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

    <!-- About Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="row g-5">
          <div
            class="col-lg-6 wow fadeInUp"
            data-wow-delay="0.1s"
            style="min-height: 400px"
          >
            <div class="position-relative h-100">
              <img
                class="img-fluid position-absolute w-100 h-100"
                src="img/about.jpg"
                alt=""
                style="object-fit: cover"
              />
            </div>
          </div>
          <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
            <h6 class="bg-white text-start text-primary-new pe-3">About Us</h6>
            <h1 class="mb-4">
              Welcome to <span class="text-primary-new">{{ \App\Helpers\SettingsHelper::get('site_name', 'Serendib Journeys') }}</span>
            </h1>
            <p class="mb-4">
              {{ \App\Helpers\SettingsHelper::get('about_intro', 'Your gateway to exploring the natural beauty, rich culture, and hidden gems of Sri Lanka. Our mission is to provide unforgettable travel experiences tailored to your preferences, ensuring every trip is a journey of discovery and delight.') }}
            </p>
            <p class="mb-4">
              {{ \App\Helpers\SettingsHelper::get('about_description', 'At Serendib Journeys, we are passionate travel enthusiasts with deep knowledge of Sri Lanka\'s most iconic destinations and its best-kept secrets. With years of experience in the travel and tourism industry, we specialize in creating custom tours that cater to individual interests, from adventure seekers to culture lovers.') }}
            </p>
            <div class="row gy-2 gx-4 mb-4">
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>{{ \App\Helpers\SettingsHelper::get('feature_1', 'Tailored Travel Packages') }}
                </p>
              </div>
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>{{ \App\Helpers\SettingsHelper::get('feature_2', 'Handpicked Hotels') }}
                </p>
              </div>
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>{{ \App\Helpers\SettingsHelper::get('feature_3', 'Unforgettable Experiences') }}
                </p>
              </div>
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>{{ \App\Helpers\SettingsHelper::get('feature_4', 'Local Expertise') }}
                </p>
              </div>
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>{{ \App\Helpers\SettingsHelper::get('feature_5', 'Flexible and Customizable Tours') }}
                </p>
              </div>
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>{{ \App\Helpers\SettingsHelper::get('feature_6', '24/7 Service') }}
                </p>
              </div>
            </div>
            <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
          </div>
        </div>
      </div>
    </div>
    <!-- About End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="bg-white text-center text-primary-new px-3">
            Travel Guide
          </h6>
          <h1 class="mb-5">Meet Our Guides</h1>
        </div>
        <div class="row g-4 align-items-center justify-content-center">
          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="team-item">
              <div class="overflow-hidden">
                <img class="img-fluid" src="img/team-1.jpg" alt="" />
              </div>
              <div
                class="position-relative d-flex justify-content-center"
                style="margin-top: -19px"
              >
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-whatsapp fw-normal"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
              <div class="text-center p-4">
                <h5 class="mb-0">Isuru Wickramasinghe</h5>
                <small>Chauffeur & Guide</small>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="team-item">
              <div class="overflow-hidden">
                <img class="img-fluid" src="img/team-2.jpg" alt="" />
              </div>
              <div
                class="position-relative d-flex justify-content-center"
                style="margin-top: -19px"
              >
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-whatsapp fw-normal"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
              <div class="text-center p-4">
                <h5 class="mb-0">Chinthaka Senarath</h5>
                <small>Chauffeur & Guide</small>
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="team-item">
              <div class="overflow-hidden">
                <img class="img-fluid" src="img/team-3.jpg" alt="" />
              </div>
              <div
                class="position-relative d-flex justify-content-center"
                style="margin-top: -19px"
              >
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-whatsapp fw-normal"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
              <div class="text-center p-4">
                <h5 class="mb-0">Dulmini Gamage</h5>
                <small>Guide</small>
              </div>
            </div>
          </div> -->
          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="team-item">
              <div class="overflow-hidden">
                <img class="img-fluid" src="img/team-4.jpg" alt="" />
              </div>
              <div
                class="position-relative d-flex justify-content-center"
                style="margin-top: -19px"
              >
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-whatsapp fw-normal"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
              <div class="text-center p-4">
                <h5 class="mb-0">Rashmi Tharangani</h5>
                <small>Guide</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Team End -->

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
              <a
                class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
                href="https://www.instagram.com/serendib_journeys/"
                target="_blank"
                rel="noopener noreferrer"
                ><i class="fab fa-instagram fw-normal"></i
              ></a>
              <a
                class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
                href="https://web.facebook.com/profile.php?id=61565812649360"
                target="_blank"
                rel="noopener noreferrer"
                ><i class="fab fa-facebook-f fw-normal"></i
              ></a>
              <a
                class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
                href="https://www.tiktok.com/@serendibjourneys"
                target="_blank"
                rel="noopener noreferrer"
                ><i class="fab fa-tiktok fw-normal"></i
              ></a>
              <a
                class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
                href="https://wa.me/94707777364"
                target="_blank"
                rel="noopener noreferrer"
                ><i class="fab fa-whatsapp fw-normal"></i
              ></a>
              <a
                class="btn btn-sm btn-outline-light btn-sm-square rounded-circle"
                href="https://www.youtube.com/@SerendibJourneys"
                target="_blank"
                rel="noopener noreferrer"
                ><i class="fab fa-youtube fw-normal"></i
              ></a>
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
