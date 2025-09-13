<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fit SriLanka</title>
  <!-- -------- anime css ------ -->
  <link rel="stylesheet" href="assets/css/animate.css">

  <!-- --------- font awsome css ------ -->
  <link rel="stylesheet" href="assets/css/all.css">
  <!-- -------- venobox css ------- -->
  <link rel="stylesheet" href="assets/css/venobox.css" type="text/css" media="screen" />
  <!-- ---- Bootstrap css--- -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- ---------- default css --------- -->
  <link rel="stylesheet" href="assets/css/default.css">
  <!-- --- style css -->
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    html {
      scroll-behavior: smooth;
    }
    .active {
      color: red; /* Change this to your desired active link style */
    }
  </style>
  
  <link rel="shortcut icon" href="{{ asset('../assets/images/favicon.png') }}" />
</head>

<body>
  <!-- --------- preloader ------------ -->
  <div class="preloader">
    <div class="loader">
      <div class="spinner">
        <div class="spinner-container">
          <div class="spinner-rotator">
            <div class="spinner-left">
              <div class="spinner-circle"></div>
            </div>
            <div class="spinner-right">
              <div class="spinner-circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



<!-------   Header star ------>
<header class="header-area">
    <div class="navbar-area">
      <!---- navbar star--->
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img class="image" src="assets/img/header/logo/fsl-logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#features">Features</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#faq">FAQ</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
        <!---- Navbar end --->
   

<!---- Hero section start ------>
<div class="header-hero" id='home'>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>
    <div class="shape shape-5"></div>
    <div class="shape shape-6"></div>

    <div class="container">
        <div class="row align-items-center justify-content-center justify-content-lg-between">
            <!-- Left side content -->
            <div class="col-lg-6 col-md-10">
                <div class="header-hero-content">
                    <h1 class="header-title wow fadeInLeftBig" data-wow-duration="2s" data-wow-delay="0.2s" style="font-size: 2.8rem; line-height: 1.2;">
                        <span style="color: #1E90FF;">Fit SriLanka</span> <br> Transform Your Fitness Journey
                    </h1>
                    <p class="text wow fadeInLeftBig" data-wow-duration="2s" data-wow-delay="0.4s" style="margin-top: 0.8rem;">
                        Fit Sri Lanka offers a holistic fitness platform designed to help you stay on top of your health and wellness goals. Whether you're tracking your workouts, planning meals, or joining a vibrant community, we've got everything you need to succeed.
                    </p>
                    <div class="d-flex gap-3 wow fadeInLeftBig" data-wow-duration="2s" data-wow-delay="0.6s" style="margin-top: 1.2rem;">
                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 py-2" style="font-size: 1.1rem;">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-danger rounded-pill px-4 py-2" style="font-size: 1.1rem;">Register</a>
                    </div>
                    <p class="small text-muted wow fadeInLeftBig" data-wow-duration="2s" data-wow-delay="0.8s" style="font-size: 0.9rem; margin-top: 0.5rem;">
                        Are you a fitness professional? <a href="{{ route('PorfessionalReg') }}" class="text-decoration-underline">Join us now</a> to connect with clients and grow your career on our platform.
                    </p>
                </div>
            </div>

            <!-- Right side image -->
            <div class="col-lg-5 col-md-6">
                <div class="header-image wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="0.5s">
                    <img src="assets/img/header/header-app.png" alt="Fit Sri Lanka App" style="width: 90%; height: auto; max-width: 350px;">
                </div>
            </div>
        </div>
    </div>

    <!-- Shapes and background elements -->
    <div class="container">
        <div class="header-shape-1"></div>
        <div class="header-shape-2">
            <img src="assets/img/header/header-shape-2.svg" alt="Header Shape">
        </div>
    </div>
</div>
<!---- Hero section end ------>


</header>

  <!--------   Header End ----  -->

  <!-- ------- Feature Section Start ---------- -->
<section class="feature-section pt-80" id="features" >
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-7">
        <div class="section-title text-center mb-30">
          <h1 class="mb-25 wow fadeInUp" data-wow-delay=".2s">Key <span>Features</span></h1>
          <p class="wow fadeInUp" data-wow-delay=".4s">Fit Sri Lanka offers a comprehensive platform that combines fitness tracking, nutrition management, and community engagement to help you achieve your health goals.</p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.2s">
          <div class="icon color-1">
            <i class="fas fa-running"></i>
          </div>
          <div class="content">
            <h3>Comprehensive Activity Tracking</h3>
            <p>Track your workouts, monitor progress, and stay motivated with personalized fitness plans and real-time analytics.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.4s">
          <div class="icon color-2">
            <i class="fas fa-utensils"></i>
          </div>
          <div class="content">
            <h3>Nutrition Management</h3>
            <p>Plan your meals, track nutritional intake, and receive diet recommendations tailored to your fitness goals and preferences.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.6s">
          <div class="icon color-3">
            <i class="fas fa-users"></i>
          </div>
          <div class="content">
            <h3>Community Integration</h3>
            <p>Engage with fitness professionals, join local fitness groups, and participate in challenges that keep you connected and motivated.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ------- Feature Section End ---------- -->


 <!-- ----------- About Section Start --------- -->
<section class="about-area pt-70 pb-120" id='about'>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="about-image wow fadeInLeftBig" data-wow-duration="3s" data-wow-delay="0.5s">
          <div class="about-shape"></div>
          <img src="assets/img/about/fit-sri-lanka-app.png" alt="Fit Sri Lanka App" class="app">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="about-content mt-50 wow fadeInRightBig" data-wow-duration="3s" data-wow-delay="0.5s">
          <div class="section-title">
            <h1 class="title">Achieve Your Fitness Goals with Ease</h1>
            <p class="text">Fit Sri Lanka brings together expert fitness plans, personalized diet recommendations, and a community-driven approach, making it the ultimate tool for improving your health and well-being. Whether you're looking to lose weight, build muscle, or stay active, we’ve got everything you need to succeed.</p>
          </div>
          <a href="{{ route('register') }}" class="main-btn">Register Now!</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ----------- About Section End --------- -->


<!-- ----------- FAQ Section Start --------- -->
<section class="faq-section pt-120" id='faq'>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-7">
        <div class="section-title text-center mb-60">
          <h1 class="mb-25 wow fadeInUp" data-wow-delay=".2s">Frequently <span>Asked Questions</span></h1>
          <p class="mb-25 wow fadeInUp" data-wow-delay=".4s">
            Find answers to some common questions about using the Fit Sri Lanka app for tracking your fitness goals, diet plans, and workout schedules.
          </p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="accordion wow fadeInLeftBig" id="accordionExample" data-wow-duration="3s" data-wow-delay="0.5s">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                How do I schedule a workout session with a fitness coach?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
              data-bs-parent="#accordionExample">
              <div class="accordion-body">
                You can schedule a workout session by selecting your preferred fitness coach from the app, choosing a time slot, and confirming your appointment. You can view your upcoming sessions on the calendar page.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                aria-expanded="false" aria-controls="collapseTwo">
                Can I customize my diet plan?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
              data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Yes, your assigned professional can tailor your diet plan to suit your fitness goals and dietary preferences. You can also communicate any specific requirements through the app.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                aria-expanded="false" aria-controls="collapseThree">
                How can I track my workout history and progress?
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
              data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Your workout history and progress can be easily tracked through the app's "Workout History" section, where you'll find detailed logs of your completed workouts, durations, and improvements over time.
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="faq-image wow fadeInRightBig" data-wow-duration="3s" data-wow-delay="0.5s">
          <img src="assets/img/faq/faq-img.svg" alt="Fit Sri Lanka FAQ">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ----------- FAQ Section End --------- -->
  <!-- --------------Footer Section Start ------- -->
  <footer class="footer-area">
    <div class="footer-copyright">
      <div class="container">
        <div class="row justify-content-center">
          <div class="lo-lg-12">
            <div class="copyright">
              <div class="copyright-text text-center">
                <p class="text">ITE 3962 - Project 2023S1 &#169; E2046073 <a href="">Fit SriLanka</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- --------------Footer Section End ------- -->



  <script>
    window.addEventListener('scroll', () => {
      const sections = document.querySelectorAll('section');
      const navLinks = document.querySelectorAll('.nav-link');
      
      let current = '';
      
      sections.forEach(section => {
        const sectionTop = section.offsetTop;
        if (pageYOffset >= sectionTop - 60) {
          current = section.getAttribute('id');
        }
      });
      
      navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href').includes(current)) {
          link.classList.add('active');
        }
      });
    });
  </script>

  <!-- ---- jquery Js ---- -->
  <script src="assets/js/jquery-1.12.4.min.js"></script>

  <!-- ---------- wow js ---------- -->
  <script src="assets/js/wow.min.js"></script>
  <!-- ---------- tiny slider js --------- -->

  <!-- ---------- scrollit js ---------- -->

  <!-- -------- font awsome js --------- -->
  <script src="assets/js/all.js"></script>
  <!-- ---- Bootstrap Js ---- -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- ---- main js --- -->
  <script src="assets/js/main.js"></script>
</body>

</html>