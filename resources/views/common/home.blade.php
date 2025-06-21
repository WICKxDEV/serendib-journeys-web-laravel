<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Serendib Journeys - Explore Sri Lanka with Expert Tour Guides</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
      content="Sri Lanka tours, expert tour guide, Ceylon travel, tourism"
      name="keywords"
    />
    <meta
      content="Discover the beauty of Sri Lanka with Serendib Journeys, the top tour guide service. Personalized itineraries, transport, and accommodations."
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

    <!--  Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
  </head>
  <style>
    .carousel-item img {
      transition: transform 0.5s ease, opacity 0.5s ease;
    }
  </style>

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
              ><i class="fa fa-map-marker-alt me-2"></i> Sigiriya, Sri
              Lanka</small
            >
            <small class="me-3 text-light"
              ><i class="fa fa-phone-alt me-2"></i>+94 70 7777 364</small
            >
            <small class="text-light"
              ><i class="fa fa-envelope-open me-2"></i
              >info@serendibjourneys.lk</small
            >
          </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
          <div class="d-inline-flex align-items-center" style="height: 45px">
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
      </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
      <nav
        class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0"
      >
        <a href="" class="navbar-brand p-0">
          <img src="img/logo-min.png" alt="Logo" />
        </a>
        <h2 class="text-primary-new-top m-0">Serendib Journeys</h2>
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
            <a href="{{ route('packages') }}" class="nav-item nav-link {{ request()->routeIs('packages') ? 'active' : '' }}">Packages</a>
            <a href="{{ route('gallery') }}" class="nav-item nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            @if (Route::has('login'))
                <!-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> -->
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-item nav-link">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                        @endif
                    @endauth
                <!-- </div> -->
            @endif
          </div>
          <!-- <a href="" class="btn btn-primary rounded-pill py-2 px-4">Register</a> -->
        </div>
      </nav>

      <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
          <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
              <h1
                class="display-3 text-white mb-3 animated slideInDown text-primary-new"
              >
                Discover Sri Lanka’s Hidden Wonders with Us
              </h1>
              <p class="fs-5 text-white mb-4 animated slideInDown">
                Embark on a remarkable adventure through Sri Lanka's vibrant
                landscapes, rich history, and hidden gems. Let us guide you to
                unforgettable moments and cherished memories. Your dream
                vacation starts here!
              </p>
              <div class="position-relative w-75 mx-auto animated slideInDown">
                <a
                  href="package.html"
                  class="btn btn-primary rounded-pill py-2 px-4"
                  >More Details</a
                >
                <!-- <input
                  class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5"
                  type="text"
                  placeholder="Eg: Thailand"
                />
                <button
                  type="button"
                  class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2"
                  style="margin-top: 7px"
                >
                  Search
                </button> -->
              </div>
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
              Welcome to <span class="text-primary-new">Serendib Journeys</span>
            </h1>
            <p class="mb-4">
              Your gateway to exploring the natural beauty, rich culture, and
              hidden gems of Sri Lanka. Our mission is to provide unforgettable
              travel experiences tailored to your preferences, ensuring every
              trip is a journey of discovery and delight.
            </p>
            <p class="mb-4">
              At Serendib Journeys, we are passionate travel enthusiasts with
              deep knowledge of Sri Lanka’s most iconic destinations and its
              best-kept secrets. With years of experience in the travel and
              tourism industry, we specialize in creating custom tours that
              cater to individual interests, from adventure seekers to culture
              lovers.
            </p>
            <div class="row gy-2 gx-4 mb-4">
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>Tailored
                  Travel Packages
                </p>
              </div>
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>Handpicked
                  Hotels
                </p>
              </div>
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i
                  >Unforgettable Experiences
                </p>
              </div>
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>Local
                  Expertise
                </p>
              </div>
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>Flexible
                  and Customizable Tours
                </p>
              </div>
              <div class="col-sm-6">
                <p class="mb-0">
                  <i class="fa fa-arrow-right text-primary me-2"></i>24/7
                  Service
                </p>
              </div>
            </div>
            <a class="btn btn-primary py-3 px-5 mt-2" href="itinerary.html"
              >Read More</a
            >
          </div>
        </div>
      </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="bg-white text-center text-primary-new px-3">Services</h6>
          <h1 class="mb-5">Our Services</h1>
        </div>
        <div class="row g-4">
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                <h5>Customized Tour Packages</h5>
                <p>
                  We specialize in creating fully customized travel itineraries
                  based on your interests, whether it's adventure, culture,
                  wildlife, or relaxation. Every trip is tailored to fit your
                  preferences, budget, and time.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-user text-primary mb-4"></i>
                <h5>Private Guided Tours</h5>
                <p>
                  Experience Sri Lanka with the knowledge and expertise of local
                  guides who offer in-depth insights into the history, culture,
                  and hidden treasures of each destination.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-star text-primary mb-4"></i>
                <h5>Luxury Travel Experiences</h5>
                <p>
                  For those seeking a touch of luxury, we offer exclusive
                  experiences such as stays in boutique hotels, private
                  transportation, and unique excursions that cater to high-end
                  travelers.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-paw text-primary mb-4"></i>
                <h5>Wildlife and Nature Tours</h5>
                <p>
                  Discover Sri Lanka’s breathtaking biodiversity with tours to
                  national parks, wildlife reserves, and eco-friendly
                  accommodations. Spot elephants, leopards, and other native
                  species in their natural habitats.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-university text-primary mb-4"></i>
                <h5>Cultural and Heritage Tours</h5>
                <p>
                  Immerse yourself in Sri Lanka’s rich cultural heritage with
                  guided visits to ancient temples, UNESCO World Heritage Sites,
                  traditional villages, and vibrant festivals.
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
                  ballooning, ensuring you experience Sri Lanka’s natural beauty
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

    <!-- Destination Start -->
    <div class="container-xxl py-5 destination">
      <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="bg-white text-center text-primary-new px-3">
            Destination
          </h6>
          <h1 class="mb-5">Popular Destination</h1>
        </div>
        <div class="row g-3">
          <div class="col-lg-7 col-md-6">
            <div class="row g-3">
              <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                <a class="position-relative d-block overflow-hidden" href="">
                  <img class="img-fluid" src="img/destination-1.jpg" alt="" />
                  <div
                    class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2"
                  >
                    Sigiriya
                  </div>
                </a>
              </div>
              <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                <a class="position-relative d-block overflow-hidden" href="">
                  <img class="img-fluid" src="img/destination-2.jpg" alt="" />
                  <!-- <div
                    class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2"
                  >
                    25% OFF
                  </div> -->
                  <div
                    class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2"
                  >
                    Kandy
                  </div>
                </a>
              </div>
              <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                <a class="position-relative d-block overflow-hidden" href="">
                  <img class="img-fluid" src="img/destination-3.jpg" alt="" />
                  <!-- <div
                    class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2"
                  >
                    35% OFF
                  </div> -->
                  <div
                    class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2"
                  >
                    Ella
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div
            class="col-lg-5 col-md-6 wow zoomIn"
            data-wow-delay="0.7s"
            style="min-height: 350px"
          >
            <a class="position-relative d-block h-100 overflow-hidden" href="">
              <img
                class="img-fluid position-absolute w-100 h-100"
                src="img/destination-4.jpg"
                alt=""
                style="object-fit: cover"
              />
              <!-- <div
                class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2"
              >
                20% OFF
              </div> -->
              <div
                class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2"
              >
                Mirissa
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Destination Start -->

    <!-- Package Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="bg-white text-center text-primary-new px-3">Packages</h6>
          <h1 class="mb-5">Awesome Packages</h1>
        </div>
        <div class="row g-4 justify-content-center">
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="package-item">
              <div
                id="carouselExample"
                class="carousel slide carousel-fade"
                data-ride="carousel"
                data-interval="3000"
                data-pause="hover"
              >
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="img-fluid" src="img/sigiriya-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/sigiriya-3.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/sigiriya-5.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/kandy-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/kandy-4.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/kandy-6.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-2.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-3.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-4.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/maduriver-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/maduriver-2.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/maduriver-3.jpg" alt="" />
                  </div>
                </div>
                <a
                  class="carousel-control-prev"
                  href="#carouselExample"
                  role="button"
                  data-slide="prev"
                >
                  <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                  ></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a
                  class="carousel-control-next"
                  href="#carouselExample"
                  role="button"
                  data-slide="next"
                >
                  <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                  ></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <div class="d-flex border-bottom">
                <small class="flex-fill text-center border-end py-2">
                  <i class="fa fa-car text-primary me-2"></i> Short and Sweet
                </small>
                <small class="flex-fill text-center border-end py-2">
                  <i class="fa fa-calendar-alt text-primary me-2"></i> 3 days
                </small>
                <small class="flex-fill text-center py-2">
                  <i class="fa fa-user text-primary me-2"></i> Customizable
                </small>
              </div>
              <div class="text-center p-4">
                <h3 class="mb-0">$349.00</h3>
                <div class="mb-3">
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                </div>
                <p>
                  A quick getaway to explore Sri Lanka's iconic sights in just 3
                  days, featuring Sigiriya, Kandy, and Mirissa with related
                  activities.
                </p>
                <p style="font-size: 12px">
                  Note that we can customize the tour based on your budget
                </p>
                <div class="d-flex justify-content-center mb-2">
                  <a
                    href="itinerary.html"
                    class="btn btn-sm btn-primary px-3 border-end"
                    style="border-radius: 30px 0 0 30px"
                    >Read More</a
                  >
                  <a
                    href="https://docs.google.com/forms/d/1ZCbUIeAIoT1xth3A4rN3XnP0q_A1EdX45BpyEPf7qZ0/"
                    class="btn btn-sm btn-primary px-3"
                    style="border-radius: 0 30px 30px 0"
                    >Book Now</a
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
            <div class="package-item">
              <div
                id="carouselExample"
                class="carousel slide carousel-fade"
                data-ride="carousel"
                data-interval="3000"
                data-pause="hover"
              >
                <div class="carousel-inner">
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/sigiriya-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/sigiriya-3.jpg" alt="" />
                  </div>
                  <div class="carousel-item active">
                    <img class="img-fluid" src="img/sigiriya-5.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/kandy-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/kandy-4.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/kandy-6.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-2.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-3.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-4.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/maduriver-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/maduriver-2.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/maduriver-3.jpg" alt="" />
                  </div>
                </div>
                <a
                  class="carousel-control-prev"
                  href="#carouselExample"
                  role="button"
                  data-slide="prev"
                >
                  <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                  ></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a
                  class="carousel-control-next"
                  href="#carouselExample"
                  role="button"
                  data-slide="next"
                >
                  <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                  ></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <div class="d-flex border-bottom">
                <small class="flex-fill text-center border-end py-2">
                  <i class="fa fa-car text-primary me-2"></i> Nature Escape
                </small>
                <small class="flex-fill text-center border-end py-2">
                  <i class="fa fa-calendar-alt text-primary me-2"></i> 6 days
                </small>
                <small class="flex-fill text-center py-2">
                  <i class="fa fa-user text-primary me-2"></i> Customizable
                </small>
              </div>
              <div class="text-center p-4">
                <h3 class="mb-0">$639.00</h3>
                <div class="mb-3">
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                </div>
                <p>
                  Discover Sri Lanka’s breathtaking landscapes in this 6 day
                  adventure, from lush tea plantations to wildlife safaris.
                </p>
                <p style="font-size: 12px">
                  Note that we can customize the tour based on your budget
                </p>
                <div class="d-flex justify-content-center mb-2">
                  <a
                    href="itinerary.html"
                    class="btn btn-sm btn-primary px-3 border-end"
                    style="border-radius: 30px 0 0 30px"
                    >Read More</a
                  >
                  <a
                    href="https://docs.google.com/forms/d/1ZCbUIeAIoT1xth3A4rN3XnP0q_A1EdX45BpyEPf7qZ0/"
                    class="btn btn-sm btn-primary px-3"
                    style="border-radius: 0 30px 30px 0"
                    >Book Now</a
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="package-item">
              <div
                id="carouselExample"
                class="carousel slide carousel-fade"
                data-ride="carousel"
                data-interval="3000"
                data-pause="hover"
              >
                <div class="carousel-inner">
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/sigiriya-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/sigiriya-2.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/sigiriya-3.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/sigiriya-5.jpg" alt="" />
                  </div>
                  <div class="carousel-item active">
                    <img class="img-fluid" src="img/kandy-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/kandy-4.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/kandy-6.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-2.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-3.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/mirissa-4.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/maduriver-1.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/maduriver-2.jpg" alt="" />
                  </div>
                  <div class="carousel-item">
                    <img class="img-fluid" src="img/maduriver-3.jpg" alt="" />
                  </div>
                </div>
                <a
                  class="carousel-control-prev"
                  href="#carouselExample"
                  role="button"
                  data-slide="prev"
                >
                  <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                  ></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a
                  class="carousel-control-next"
                  href="#carouselExample"
                  role="button"
                  data-slide="next"
                >
                  <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                  ></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <div class="d-flex border-bottom">
                <small class="flex-fill text-center border-end py-2">
                  <i class="fa fa-car text-primary me-2"></i> Heritage Quest
                </small>
                <small class="flex-fill text-center border-end py-2">
                  <i class="fa fa-calendar-alt text-primary me-2"></i> 12 days
                </small>
                <small class="flex-fill text-center py-2">
                  <i class="fa fa-user text-primary me-2"></i> Customizable
                </small>
              </div>
              <div class="text-center p-4">
                <h3 class="mb-0">$1249.00</h3>
                <div class="mb-3">
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                  <small class="fa fa-star text-primary"></small>
                </div>
                <p>
                  Immerse yourself in Sri Lanka’s rich culture and history over
                  12 days, visiting ancient cities and sacred sites relax and
                  calmly.
                </p>
                <p style="font-size: 12px">
                  Note that we can customize the tour based on your budget
                </p>
                <div class="d-flex justify-content-center mb-2">
                  <a
                    href="itinerary.html"
                    class="btn btn-sm btn-primary px-3 border-end"
                    style="border-radius: 30px 0 0 30px"
                    >Read More</a
                  >
                  <a
                    href="https://docs.google.com/forms/d/1ZCbUIeAIoT1xth3A4rN3XnP0q_A1EdX45BpyEPf7qZ0/"
                    class="btn btn-sm btn-primary px-3"
                    style="border-radius: 0 30px 30px 0"
                    >Book Now</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Package End -->

    <!-- Booking Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container">
        <div class="booking p-5">
          <div class="row g-5 align-items-center">
            <!-- Left Section with Descriptions -->
            <div class="col-md-6 text-white">
              <h6 class="text-white text-uppercase">Booking</h6>
              <h1 class="text-white mb-4">Online Booking</h1>
              <p class="mb-4">
                Welcome to our online booking platform! Secure your spot on one
                of our exclusive Sri Lankan tours. Explore the island's scenic
                beauty and rich culture with a customized travel experience.
              </p>
              <p class="mb-4">
                Book now for an unforgettable journey, featuring our handpicked
                destinations like Sigiriya, Kandy, and Galle. Select your
                preferred tour package, travel dates, and specify any special
                requests for a personalized adventure.
              </p>
              <a
                class="btn btn-outline-light py-3 px-5 mt-2"
                href="https://docs.google.com/forms/d/1ZCbUIeAIoT1xth3A4rN3XnP0q_A1EdX45BpyEPf7qZ0/"
                >Book Now</a
              >
            </div>
            <div class="col-md-6 text-white">
              <img class="img-fluid" src="img/logo.png" alt="Logo" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Booking End -->

    <!-- Process Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="bg-white text-center text-primary-new px-3">
            How It Works
          </h6>
          <h1 class="mb-5">3 Simple Steps to Book Your Adventure</h1>
        </div>
        <div class="row gy-5 gx-4 justify-content-center">
          <div
            class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp"
            data-wow-delay="0.1s"
          >
            <div class="position-relative border border-primary pt-5 pb-4 px-4">
              <div
                class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                style="width: 100px; height: 100px"
              >
                <i class="fa fa-map-marked-alt fa-3x text-white"></i>
              </div>
              <h5 class="mt-4">Select Your Package</h5>
              <hr class="w-25 mx-auto bg-primary mb-1" />
              <hr class="w-50 mx-auto bg-primary mt-0" />
              <p class="mb-0">
                Choose from our carefully curated travel packages designed to
                give you the best experience in Sri Lanka.
              </p>
            </div>
          </div>
          <div
            class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp"
            data-wow-delay="0.3s"
          >
            <div class="position-relative border border-primary pt-5 pb-4 px-4">
              <div
                class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                style="width: 100px; height: 100px"
              >
                <i class="fa fa-credit-card fa-3x text-white"></i>
              </div>
              <h5 class="mt-4">Secure Your Booking</h5>
              <hr class="w-25 mx-auto bg-primary mb-1" />
              <hr class="w-50 mx-auto bg-primary mt-0" />
              <p class="mb-0">
                Complete your booking effortlessly with our secure online
                payment options, ensuring your information is safe.
              </p>
            </div>
          </div>
          <div
            class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp"
            data-wow-delay="0.5s"
          >
            <div class="position-relative border border-primary pt-5 pb-4 px-4">
              <div
                class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                style="width: 100px; height: 100px"
              >
                <i class="fa fa-plane-departure fa-3x text-white"></i>
              </div>
              <h5 class="mt-4">Embark on Your Journey</h5>
              <hr class="w-25 mx-auto bg-primary mb-1" />
              <hr class="w-50 mx-auto bg-primary mt-0" />
              <p class="mb-0">
                Get ready for an unforgettable experience as you explore the
                beauty and culture of Sri Lanka with us!
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Process End -->

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
              first time in Sri Lanka, and it won’t be the last!
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

    <script src="js/script.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>