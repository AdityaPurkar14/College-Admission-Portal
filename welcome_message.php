<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sinhgad Technical Institute.</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/hero-banner.png">
  <link rel="preload" as="image" href="./assets/images/hero-abs-1.png" media="min-width(768px)">
  <link rel="preload" as="image" href="./assets/images/hero-abs-2.png" media="min-width(768px)">

</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <h1><img src="<?= base_url('/resources/logo.png'); ?>" alt="Logo" class="img-fluid" style="width: 130px; height: 100px;">

        <a href="#" class="logo">Sinhgad Technical Education Society</a>
      </h1>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">
          <a href="#" class="logo">STES</a>

          <button class="nav-close-btn" aria-label="Close menu" data-nav-toggler>
            <ion-icon name="close-outline"></ion-icon>
          </button>
        </div>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="#home" class="navbar-link" data-nav-toggler>Home</a>
          </li>

          <li class="navbar-item">
            <a href="#about" class="navbar-link" data-nav-toggler>About</a>
          </li>

          <li class="navbar-item">
            <a href="#courses" class="navbar-link" data-nav-toggler>Courses</a>
          </li>

          

          <li class="navbar-item">
            <a href="#" class="navbar-link" data-nav-toggler>Contact</a>
          </li>

        </ul>

      </nav>

      <div class="header-actions">

        <button class="header-action-btn" aria-label="Open search" data-search-toggler>
          <ion-icon name="search-outline"></ion-icon>
        </button>

        <a href="<?= base_url('/login') ?>" class="header-action-btn login-btn">
          <ion-icon name="person-outline" aria-hidden="true"></ion-icon>

          <span class="span">Login</span>
        </a>

        <button class="header-action-btn nav-open-btn" aria-label="Open menu" data-nav-toggler>
          <ion-icon name="menu-outline"></ion-icon>
        </button>

      </div>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>





  <!-- 
    - #SEARCH BOX
  -->

  <div class="search-container" data-search-box>
    <div class="container">

      <button class="search-close-btn" aria-label="Close search" data-search-toggler>
        <ion-icon name="close-outline"></ion-icon>
      </button>

      <div class="search-wrapper">
        <input type="search" name="search" placeholder="Search Here..." aria-label="Search" class="search-field">

        <button class="search-submit" aria-label="Submit" data-search-toggler>
          <ion-icon name="search-outline"></ion-icon>
        </button>
      </div>

    </div>
  </div>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home" aria-label="hero" style="background-image: url('./assets/images/hero-bg.jpg')">
        <div class="container">

          <div class="hero-content">

            <p class="section-subtitle">Better Learning Future With Us</p>

            <h2 class="h1 hero-title">Education Is About Academic Excellence</h2>

            <p class="hero-text">
            Excited to join Sinhgad Technical Education Society? Register now and be a part of our thriving community!
            </p>

            <a href="<?= base_url('/register') ?>" class="btn btn-primary">
              <span class="span">Register</span>

              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>

          <figure class="hero-banner">

            <img src="./assets/images/hero-banner.png" width="500" height="500" loading="lazy" alt="hero image"
              class="w-100">

            <img src="./assets/images/hero-abs-1.png" width="318" height="352" loading="lazy" aria-hidden="true"
              class="abs-img abs-img-1">

            <img src="./assets/images/hero-abs-2.png" width="160" height="160" loading="lazy" aria-hidden="true"
              class="abs-img abs-img-2">

          </figure>

        </div>
      </section>





      <!-- 
        - #CATEGORY
      -->

      <section class="section category" aria-label="category">
        <div class="container">


          <h2 class="h2 section-title">Courses We Provide</h2>

          <ul class="grid-list">

            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="laptop-outline"></ion-icon>
                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">MCA</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="construct-outline"></ion-icon>
                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Engineering</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="category-card">

                <div class="card-icon">
                  <ion-icon name="color-palette-outline"></ion-icon>
                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Arts</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="category-card">

                <div class="card-icon">
                  <ion-icon name="layers-outline"></ion-icon>
                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Business Management</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="medkit-outline"></ion-icon>
                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Pharmacy</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="briefcase-outline"></ion-icon>

                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">MBA</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="document-text-outline"></ion-icon>



                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Diploma</a>
                  </h3>

                </div>

              </div>
            </li>

            <li>
              <div class="category-card">

                <div class="card-icon">
                  <ion-icon name="server-outline"></ion-icon>
                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Data Science</a>
                  </h3>

                  
                </div>

              </div>
            </li>

            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="heart-outline"></ion-icon>

                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Dr</a>
                  </h3>

                </div>

              </div>
            </li>
            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="home-outline"></ion-icon>

                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Architecture</a>
                  </h3>

                </div>

              </div>
            </li>
            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="brush-outline"></ion-icon>


                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Dentists</a>
                  </h3>

                </div>

              </div>
            </li>
            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="bed-outline"></ion-icon>


                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Hotel Management</a>
                  </h3>

                </div>

              </div>
            </li>
            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="business-outline"></ion-icon>


                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Civil Engineering</a>
                  </h3>

                </div>

              </div>
            </li>
            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="scale-outline"></ion-icon>


                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">LAW</a>
                  </h3>

                </div>

              </div>
            </li>
            <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="film-outline"></ion-icon>


                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Film Making</a>
                  </h3>

                </div>

              </div>
            </li>
          </ul>

        </div>
      </section>





      <!-- 
        - #ABOUT
      -->

      

        <!-- 
    - #FOOTER
  -->

  <footer class="footer">
    <div class="container">

      <div class="footer-top">

        <div class="footer-brand">

          <a href="#" class="logo">Sinhgad Technical Education Society</a>

          <p class="section-text">
          Through its commitment to innovation, research, and holistic learning, STES aims to empower students with the skills and knowledge needed to thrive in a rapidly evolving world. 
          </p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-pinterest"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Explore</p>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">About Us</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">Upcoming Events</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">Blog & News</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">FAQ Question</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">Testimonial</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">Privacy Policy</span>
            </a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Useful Links</p>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">Contact Us</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">Pricing Plan</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">Instructor Profile</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">FAQ</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">Popular Courses</span>
            </a>
          </li>

          <li>
            <a href="#" class="footer-link">
              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

              <span class="span">Terms & Conditions</span>
            </a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Contact Info</p>
          </li>

          <li class="footer-item">
            <ion-icon name="location-outline" aria-hidden="true"></ion-icon>

            <address class="footer-link">
            Sinhgad Technical Education Society, Pune, Maharashtra, India
            </address>
          </li>

          <li class="footer-item">
            <ion-icon name="call" aria-hidden="true"></ion-icon>

            <a href="tel:+13647657839" class="footer-link">+91 123 456 7890</a>
          </li>

          <li class="footer-item">
            <ion-icon name="call" aria-hidden="true"></ion-icon>

            <a href="tel:+13647657840" class="footer-link">+91 364 765 7840</a>
          </li>

          <li class="footer-item">
            <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>

            <a href="mailto:contact@eduhome.com" class="footer-link">info@sinhgad.edu</a>
          </li>

        </ul>

      </div>

      <div class="footer-bottom">
        <p class="copyright">
        &copy; Sinhgad Technical Education Society. All rights reserved.
        </p>
      </div>

    </div>
  </footer>





  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
    <ion-icon name="arrow-up"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons.js"></script>

</body>

</html>