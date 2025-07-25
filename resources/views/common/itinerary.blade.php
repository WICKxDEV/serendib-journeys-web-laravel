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
            <a href="{{ route('packages') }}" class="nav-item nav-link {{ request()->routeIs('packages') ? 'active' : '' }}">Packages</a>
            <a href="{{ route('gallery') }}" class="nav-item nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
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
                {{ \App\Helpers\SettingsHelper::get('itinerary_page_title', 'Tour Itineraries') }}
              </h1>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                  <li class="breadcrumb-item">
                    <a class="text-white" href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item text-white active" aria-current="page">
                    Itineraries
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

    <!-- Tour Itinerary Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="row g-5 align-items-center">
          <div class="col-lg-12">
            <!-- 3-Day Tour -->
            <h2 class="text-primary-new mb-4 text-center">
              3-Day Sri Lanka Highlights Tour
            </h2>
            <div class="accordion" id="itineraryAccordion3">
              <!-- Day 1 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button
                    class="accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne"
                    aria-expanded="true"
                    aria-controls="collapseOne"
                  >
                    Day 1: Arrival in Colombo & Drive to Waligama
                  </button>
                </h2>
                <div
                  id="collapseOne"
                  class="accordion-collapse collapse show"
                  aria-labelledby="headingOne"
                  data-bs-parent="#itineraryAccordion3"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Arrival at Bandaranaike International Airport.</li>
                      <li>
                        You will be greeted by our guide and begin your journey
                        to Mirissa.
                      </li>
                      <li>
                        On the way, you can enjoy a Maduriver boat safari.
                      </li>
                      <li>On the way, you can visit a turtle hatchery.</li>
                      <li>Check-in at the hotel in Waligama.</li>
                      <li>Relax on the beach.</li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a luxurious hotel in Waligama,
                      either a 3-star or 4-star accommodation, depending on your
                      choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      If there are any issues with the ongoing schedule, our
                      guide will manage them, particularly in case of
                      weather-related problems.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 2 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo"
                    aria-expanded="false"
                    aria-controls="collapseTwo"
                  >
                    Day 2: Waligama to Ella
                  </button>
                </h2>
                <div
                  id="collapseTwo"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingTwo"
                  data-bs-parent="#itineraryAccordion3"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>
                        Start your day with an exhilarating whale watching
                        excursion in Mirissa.
                      </li>
                      <li>After whale watching, check out from your hotel.</li>
                      <li>
                        Travel to Ella, taking in the picturesque views along
                        the way.
                      </li>
                      <li>
                        Stop at a hidden waterfall for a refreshing swim and
                        exploration.
                      </li>
                      <li>
                        Hike up to Little Adam's Peak for stunning panoramic
                        views.
                      </li>
                      <li>Check in to your hotel in Ella.</li>
                      <li>
                        Spend the evening relaxing in the Ella area, enjoying
                        the vibrant night atmosphere.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a luxurious hotel in Ella, either a
                      3-star or 4-star accommodation, depending on your choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will assist with all arrangements and ensure a
                      seamless experience throughout your journey.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 3 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseThree"
                    aria-expanded="false"
                    aria-controls="collapseThree"
                  >
                    Day 3: Ella to Colombo & Departure
                  </button>
                </h2>
                <div
                  id="collapseThree"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingThree"
                  data-bs-parent="#itineraryAccordion3"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>
                        Start your journey with a scenic train ride from Ella to
                        see the iconic Nine Arches Bridge.
                      </li>
                      <li>
                        Visit the beautiful waterfalls in the area for some
                        exploration and photography.
                      </li>
                      <li>
                        Tour a local tea factory to learn about the tea-making
                        process and sample some exquisite teas.
                      </li>
                      <li>
                        Continue your journey to Negombo Airport for your
                        departure.
                      </li>
                    </ul>

                    <h5>Note:</h5>
                    <p>
                      Our guide will assist with all arrangements and ensure a
                      smooth experience throughout your travels.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- 6-Day Tour -->
            <h2 class="text-primary-new mb-4 text-center mt-5">
              6-Day Sri Lanka Highlights Tour
            </h2>
            <div class="accordion" id="itineraryAccordion6">
              <!-- Day 1 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading6Day1">
                  <button
                    class="accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse6Day1"
                    aria-expanded="true"
                    aria-controls="collapse6Day1"
                  >
                    Day 1: Arrival in Colombo & Drive to Sigiriya
                  </button>
                </h2>
                <div
                  id="collapse6Day1"
                  class="accordion-collapse collapse show"
                  aria-labelledby="heading6Day1"
                  data-bs-parent="#itineraryAccordion6"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Arrival at Bandaranaike International Airport.</li>
                      <li>
                        You will be greeted by our guide and begin your journey
                        to Sigiriya.
                      </li>
                      <li>Check in at your hotel in Sigiriya.</li>
                      <li>
                        Explore the Sigiriya Rock Fortress, a UNESCO World
                        Heritage Site.
                      </li>
                      <li>
                        Relax at the hotel or enjoy local cuisine in the
                        evening.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a luxurious hotel in Sigiriya,
                      either a 3-star or 4-star accommodation, depending on your
                      choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will assist with all arrangements and ensure a
                      seamless experience throughout your journey.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 2 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading6Day2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse6Day2"
                    aria-expanded="false"
                    aria-controls="collapse6Day2"
                  >
                    Day 2: Sigiriya
                  </button>
                </h2>
                <div
                  id="collapse6Day2"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading6Day2"
                  data-bs-parent="#itineraryAccordion6"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Enjoy breakfast at the hotel.</li>
                      <li>Take a village tour to experience local life.</li>
                      <li>Lunch at a local restaurant.</li>
                      <li>
                        Relax or take a guided nature walk in the surrounding
                        area.
                      </li>
                      <li>
                        Go on a safari at Minneriya National Park to see
                        elephants and other wildlife.
                      </li>
                      <li>Dinner at a nice restaurant in Sigiriya.</li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will continue your stay at the same luxurious hotel in
                      Sigiriya, either a 3-star or 4-star accommodation,
                      depending on your choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      If there are any changes to the itinerary, our guide will
                      ensure that your experience remains enjoyable and
                      stress-free.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 3 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading6Day3">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse6Day3"
                    aria-expanded="false"
                    aria-controls="collapse6Day3"
                  >
                    Day 3: Sigiriya to Kandy
                  </button>
                </h2>
                <div
                  id="collapse6Day3"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading6Day3"
                  data-bs-parent="#itineraryAccordion6"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>
                        Check out from the hotel in Sigiriya and travel to
                        Kandy.
                      </li>
                      <li>Visit the Spice Gardens en route.</li>
                      <li>
                        Explore the Temple of the Tooth Relic, a significant
                        Buddhist site.
                      </li>
                      <li>Check in at your hotel in Kandy.</li>
                      <li>Visit the Gem Museum.</li>
                      <li>
                        Enjoy a cultural Kandyan dance performance in the
                        evening.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a comfortable hotel in Kandy,
                      either a 3-star or 4-star accommodation, based on your
                      preference.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will provide insights into Kandy's rich culture
                      and history, enhancing your overall experience.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 4 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading6Day4">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse6Day4"
                    aria-expanded="false"
                    aria-controls="collapse6Day4"
                  >
                    Day 4: Kandy to Ella
                  </button>
                </h2>
                <div
                  id="collapse6Day4"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading6Day4"
                  data-bs-parent="#itineraryAccordion6"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Enjoy breakfast at the hotel.</li>
                      <li>
                        Check out from the hotel in Kandy and travel to Ella via
                        train.
                      </li>
                      <li>
                        Visit a tea factory to learn about the tea production
                        process.
                      </li>
                      <li>
                        Experience a scenic train ride through the hill country.
                      </li>
                      <li>Check in at your hotel in Ella.</li>
                      <li>Visit the Nine Arches Bridge and enjoy the views.</li>
                      <li>
                        Hike to Little Adam's Peak for stunning views of the
                        surrounding mountains.
                      </li>
                      <li>
                        Enjoy the night vibe in Ella with dinner at a local
                        restaurant.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a cozy hotel in Ella, either a
                      3-star or 4-star accommodation, depending on your choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Enjoy the breathtaking landscapes along the train journey,
                      and our guide will ensure you don't miss any highlights
                      during your hikes.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 5 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading6Day5">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse6Day5"
                    aria-expanded="false"
                    aria-controls="collapse6Day5"
                  >
                    Day 5: Ella to Mirissa
                  </button>
                </h2>
                <div
                  id="collapse6Day5"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading6Day5"
                  data-bs-parent="#itineraryAccordion6"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>
                        Check out from the hotel in Ella and travel to Mirissa.
                      </li>
                      <li>Visit a hidden waterfall along the way.</li>
                      <li>Check in at your hotel in Mirissa.</li>
                      <li>Relax on the beach in the afternoon.</li>
                      <li>Enjoy dinner at a seaside restaurant.</li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a luxurious hotel in Mirissa,
                      either a 3-star or 4-star accommodation, based on your
                      preference.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will ensure you have the best experience during
                      your whale watching adventure and will be available to
                      assist with any needs throughout your stay.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 6 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading6Day6">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse6Day6"
                    aria-expanded="false"
                    aria-controls="collapse6Day6"
                  >
                    Day 6: Mirissa to Colombo & Departure
                  </button>
                </h2>
                <div
                  id="collapse6Day6"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading6Day6"
                  data-bs-parent="#itineraryAccordion6"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Go on a whale watching excursion in the morning.</li>
                      <li>Check out from your hotel in Mirissa.</li>
                      <li>
                        Visit a turtle hatchery to learn about sea turtle
                        conservation.
                      </li>
                      <li>Enjoy a Madhu River boat safari.</li>
                      <li>
                        Travel back to Bandaranaike International Airport for
                        your departure.
                      </li>
                    </ul>

                    <h5>Note:</h5>
                    <p>
                      If there are any last-minute changes or adjustments
                      needed, our guide will be there to assist you, ensuring a
                      smooth end to your journey.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- 12-Day Tour -->
            <h2 class="text-primary-new mb-4 text-center mt-5">
              12-Day Sri Lanka Adventure Tour
            </h2>
            <div class="accordion" id="itineraryAccordion12">
              <!-- Day 1 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day1">
                  <button
                    class="accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day1"
                    aria-expanded="true"
                    aria-controls="collapse12Day1"
                  >
                    Day 1: Arrival in Colombo & Drive to Sigiriya
                  </button>
                </h2>
                <div
                  id="collapse12Day1"
                  class="accordion-collapse collapse show"
                  aria-labelledby="heading12Day1"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Arrival at Bandaranaike International Airport.</li>
                      <li>
                        You will be greeted by our guide and begin your journey
                        to Sigiriya.
                      </li>
                      <li>Check in at your hotel in Sigiriya.</li>
                      <li>
                        Explore the Sigiriya Rock Fortress, a UNESCO World
                        Heritage Site.
                      </li>
                      <li>
                        Relax at the hotel or enjoy local cuisine in the
                        evening.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a luxurious hotel in Sigiriya,
                      either a 3-star or 4-star accommodation, depending on your
                      choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will assist with all arrangements and ensure a
                      seamless experience throughout your journey.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 2 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day2"
                    aria-expanded="false"
                    aria-controls="collapse12Day2"
                  >
                    Day 2: Sigiriya
                  </button>
                </h2>
                <div
                  id="collapse12Day2"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day2"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Enjoy breakfast at the hotel.</li>
                      <li>Take a village tour to experience local life.</li>
                      <li>Lunch at a local restaurant.</li>
                      <li>
                        Relax or take a guided nature walk in the surrounding
                        area.
                      </li>
                      <li>
                        Go on a safari at Minneriya National Park to see
                        elephants and other wildlife.
                      </li>
                      <li>Dinner at a nice restaurant in Sigiriya.</li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will continue your stay at the same luxurious hotel in
                      Sigiriya, either a 3-star or 4-star accommodation,
                      depending on your choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      If there are any changes to the itinerary, our guide will
                      ensure that your experience remains enjoyable and
                      stress-free.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 3 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day3">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day3"
                    aria-expanded="false"
                    aria-controls="collapse12Day3"
                  >
                    Day 3: Sigiriya to Kandy
                  </button>
                </h2>
                <div
                  id="collapse12Day3"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day3"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Check out from the hotel in Sigiriya.</li>
                      <li>Visit the ancient city of Polonnaruwa.</li>
                      <li>Stop by the Spice Gardens en route.</li>
                      <li>Check in at your hotel in Kandy.</li>
                      <li>
                        Explore the Temple of the Tooth Relic, a significant
                        Buddhist site.
                      </li>
                      <li>
                        Enjoy a cultural Kandyan dance performance in the
                        evening.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a comfortable hotel in Kandy,
                      either a 3-star or 4-star accommodation, based on your
                      preference.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will provide insights into Kandy's rich culture
                      and history, enhancing your overall experience.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 4 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day4">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day4"
                    aria-expanded="false"
                    aria-controls="collapse12Day4"
                  >
                    Day 4: Kandy
                  </button>
                </h2>
                <div
                  id="collapse12Day4"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day4"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Visit the Gem Museum.</li>
                      <li>Explore Peradeniya Botanical Gardens.</li>
                      <li>Visit Udawattakele Forest Reserve.</li>
                      <li>Enjoy a view from Kandy View Point.</li>
                      <li>Take a city walk through Kandy.</li>
                      <li>Dine at a local restaurant in the evening.</li>
                      <li>
                        Evening: Enjoy dinner at a local restaurant or your
                        hotel.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a comfortable hotel in Kandy,
                      either a 3-star or 4-star accommodation, based on your
                      preference.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will provide insights into Kandy's rich culture
                      and history, enhancing your overall experience.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 5 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day5">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day5"
                    aria-expanded="false"
                    aria-controls="collapse12Day5"
                  >
                    Day 5: Kandy to Ella
                  </button>
                </h2>
                <div
                  id="collapse12Day5"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day5"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Enjoy breakfast at the hotel.</li>
                      <li>
                        Check out from the hotel in Kandy and travel to Ella via
                        train.
                      </li>
                      <li>
                        Visit a tea factory to learn about the tea production
                        process.
                      </li>
                      <li>
                        Experience a scenic train ride through the hill country.
                      </li>
                      <li>Check in at your hotel in Ella.</li>
                      <li>
                        Enjoy the night vibe in Ella with dinner at a local
                        restaurant.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a cozy hotel in Ella, either a
                      3-star or 4-star accommodation, depending on your choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Enjoy the breathtaking landscapes along the train journey,
                      and our guide will ensure you don't miss any highlights
                      during your hikes.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 6 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day6">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day6"
                    aria-expanded="false"
                    aria-controls="collapse12Day6"
                  >
                    Day 6: Ella
                  </button>
                </h2>
                <div
                  id="collapse12Day6"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day6"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>
                        Visit the Nine Arches Bridge and take in the scenic
                        views.
                      </li>
                      <li>
                        Hike to Little Adam's Peak for stunning panoramic vistas
                        of the surrounding mountains.
                      </li>
                      <li>
                        Relax with a spa treatment or join a yoga session.
                      </li>
                      <li>
                        Unwind and enjoy the evening atmosphere in Ella, with
                        dinner at a local restaurant.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a cozy hotel in Ella, either a
                      3-star or 4-star accommodation, depending on your choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      The scenic beauty of Ella is best enjoyed at a leisurely
                      pace. Our guide will ensure you don't miss any important
                      viewpoints or experiences during your stay.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 7 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day7">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day7"
                    aria-expanded="false"
                    aria-controls="collapse12Day7"
                  >
                    Day 7: Ella to Mirissa
                  </button>
                </h2>
                <div
                  id="collapse12Day7"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day7"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>
                        Check out from the hotel in Ella and travel to Mirissa.
                      </li>
                      <li>Visit a hidden waterfall along the way.</li>
                      <li>Check in at your hotel in Mirissa.</li>
                      <li>Relax on the beach in the afternoon.</li>
                      <li>Enjoy dinner at a seaside restaurant.</li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a luxurious hotel in Mirissa,
                      either a 3-star or 4-star accommodation, based on your
                      preference.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will ensure you have the best experience during
                      your whale watching adventure and will be available to
                      assist with any needs throughout your stay.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 8 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day8">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day8"
                    aria-expanded="false"
                    aria-controls="collapse12Day8"
                  >
                    Day 8: Mirissa
                  </button>
                </h2>
                <div
                  id="collapse12Day8"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day8"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Go on a whale watching excursion in the morning.</li>
                      <li>Relax on the beach afterward.</li>
                      <li>Try skating by the seaside.</li>
                      <li>Snorkeling in the clear waters.</li>
                      <li>Relax on the beach in the afternoon.</li>
                      <li>
                        Enjoy dinner at a seaside restaurant in the evening.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a luxurious hotel in Mirissa,
                      either a 3-star or 4-star accommodation, based on your
                      preference.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will ensure you have the best experience during
                      your whale watching adventure and will be available to
                      assist with any needs throughout your stay.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 9 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day9">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day9"
                    aria-expanded="false"
                    aria-controls="collapse12Day9"
                  >
                    Day 9: Mirissa
                  </button>
                </h2>
                <div
                  id="collapse12Day9"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day9"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Relax on the beach.</li>
                      <li>
                        Enjoy dinner at a seaside restaurant in the evening.
                      </li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a luxurious hotel in Mirissa,
                      either a 3-star or 4-star accommodation, based on your
                      preference.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will assist with all arrangements and ensure a
                      seamless experience throughout your journey.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 10 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day10">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day10"
                    aria-expanded="false"
                    aria-controls="collapse12Day10"
                  >
                    Day 10: Mirissa to colombo
                  </button>
                </h2>
                <div
                  id="collapse12Day10"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day10"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Check out from your hotel in Mirissa.</li>
                      <li>
                        Visit a turtle hatchery to learn about sea turtle
                        conservation.
                      </li>
                      <li>Enjoy a Madhu River boat safari.</li>
                      <li>Check in at your hotel in Colombo.</li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a luxurious hotel in Colombo,
                      either a 3-star or 4-star accommodation, depending on your
                      choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will assist with all arrangements and ensure a
                      seamless experience throughout your journey.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 11 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day11">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day11"
                    aria-expanded="false"
                    aria-controls="collapse12Day11"
                  >
                    Day 11: Colombo
                  </button>
                </h2>
                <div
                  id="collapse12Day11"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day11"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Visit Galle Face.</li>
                      <li>Explore One Galle Face Mall.</li>
                      <li>Visit Pettah Market.</li>
                      <li>Enjoy street food in the evening.</li>
                    </ul>

                    <h5>Hotel Information</h5>
                    <p>
                      You will be staying at a luxurious hotel in Colombo,
                      either a 3-star or 4-star accommodation, depending on your
                      choice.
                    </p>

                    <h5>Note:</h5>
                    <p>
                      Our guide will assist with all arrangements and ensure a
                      seamless experience throughout your journey.
                    </p>
                  </div>
                </div>
              </div>
              <!-- Day 12 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading12Day12">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12Day12"
                    aria-expanded="false"
                    aria-controls="collapse12Day12"
                  >
                    Day 12: Departure from Colombo
                  </button>
                </h2>
                <div
                  id="collapse12Day12"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading12Day12"
                  data-bs-parent="#itineraryAccordion12"
                >
                  <div class="accordion-body">
                    <h5>Activities</h5>
                    <ul>
                      <li>Check out from your hotel in Colombo.</li>
                      <li>Visit Negombo.</li>
                      <li>
                        Travel back to Bandaranaike International Airport for
                        your departure.
                      </li>
                    </ul>

                    <h5>Note:</h5>
                    <p>
                      If there are any last-minute changes or adjustments
                      needed, our guide will be there to assist you, ensuring a
                      smooth end to your journey.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Tour Itinerary End -->

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
