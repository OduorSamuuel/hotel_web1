<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hotel Website</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

    <!-- custom css link -->
   <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
   <style>
      .logoimg{
         height: 45px;
      }
   </style>
   <script src="style.js"></script>
</head>
<body>

   <!-- header -->

   <header class="header">
    <a href="#" class="logo"> <img src="{{asset('images/blimleylogo.png')}}" alt="" class="logoimg"> </a>
    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#room">room</a>
        <a href="#gallery">gallery</a>
        <a href="#review">review</a>
        <a href="#faq">faq</a>
        <a href="#room" class="btn"> book now</a>

        @if(session('isLoggedIn'))

            <div class="image-container">
            <img src="{{ asset($profile->photo_path ?? 'assets/images/avatar.png') }}" alt="User Profile" class="user-pic">

                <span class="user-label">HELLO</span>
            </div>

            <div class="user-container">
                <div class="hover-line"></div>
                <div class="sub-menu-wrap">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="{{ asset($profile->photo_path ?? 'assets/images/avatar.png') }}" alt="User Profile">
                            <h2>{{ $profile->name ?? 'User' }}</h2>
                        </div>
                        <hr>
                        <a href="{{ route('user') }}" class="sub-menu-link">
                            <i class="fas fa-user-edit"></i>
                            <p>My Profile</p>
                            <span>&rarr;</span>
                        </a>
                        <a href="{{ route('logout') }}" class="sub-menu-link">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

        @else
            <a href="{{ route('log') }}" class="btn">Sign In</a>
        @endif
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

   <!-- end -->

   <!-- home -->

   <section class="home" id="home">

      <div class="swiper home-slider">

         <div class="swiper-wrapper">

    

             

            <div class="swiper-slide slide" style="background: url({{ asset('assets/images/home-slide2.jpg') }}) no-repeat;">
               <div class="content">
     
               <h3>Luxury Redefined, Hospitality Perfected.</h3>
              
               </div>
            </div>

    <div class="swiper-slide slide" style="background: url({{ asset('assets/images/home-slide3.jpg') }}) no-repeat;">
               <div class="content">
                  <h3>it's where dreams come true</h3>
                 
               </div>
            </div>

            <div class="swiper-slide slide" style="background: url({{ asset('assets/images/home-slide4.jpg') }}) no-repeat;">
               <div class="content">
                  <h3>it's where dreams come true</h3>
                 
               </div>
            </div>

         </div>

         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>

      </div>

   </section>

   <!-- end -->

   <!-- availability -->

   <section class="availability">

      <form action="{{ route('check_availability') }}" method="post">
      @csrf
      <div class="box">
        <p>Check in <span>*</span></p>
        <input type="date" class="input" name="check_in" id="check_in">
    </div>

    <div class="box">
        <p>Check out <span>*</span></p>
        <input type="date" class="input" name="check_out" id="check_out" >
    </div>

         <div class="box">
            <p>adults <span>*</span></p>
            <select name="adults" id="" class="input">
               <option value="1">1 adults</option>
               <option value="2">2 adults</option>
               <option value="3">3 adults</option>
               <option value="4">4 adults</option>
               <option value="5">5 adults</option>
               <option value="6">6 adults</option>
            </select>
         </div>

         <div class="box">
            <p>children <span>*</span></p>
            <select name="child" id="" class="input">
               <option value="0">No children</option>
               <option value="1">1 child</option>
               <option value="2">2 child</option>
               <option value="3">3 child</option>
               <option value="4">4 child</option>
               <option value="5">5 child</option>
               <option value="6">6 child</option>
            </select>
         </div>


         <input type="submit" value="check availability" class="btn" name="check_availability">

      </form>

   </section>

   <!-- end -->


   <!-- about -->

   <section class="about" id="about">

      <div class="row">

         <div class="image">
         <img src="{{ asset('assets/images/about.jpg') }}" alt="">
         </div>

         <div class="content">
            <h3>about us</h3>
            <p>Located just 10 minutes from the airport, the Blimey Hotel, Mombasa Upper Hill, is in the heart of the fast-growing business district of Upper Hill.
             Our hotel is the perfect base for a business trip or a Kenyan safari. Discover Tsavo National Park around 20 minutes away. This well-known wildlife preserve is home to herds of zebras, lions, leopards, African buffalo, wildebeests, giraffes, and more—right on your doorstep.</p>
            <p>Step into a world of luxury at the premier 5-star hotel in Mombasa. Blimey Mombasa offers the perfect fusion of European style and Kenyan hospitality for leisure and business travel.</p>
         </div>

      </div>

   </section>

   <!-- end -->

   <!-- room -->

   <section class="room" id="room">
   <h1 class="heading">Our Rooms</h1>

   <div class="swiper room-slider">
      <div class="swiper-wrapper">
         <?php
            foreach ($roomTypes as $roomType) {
         ?>
            <?php
                $room = $rooms->where('RoomType', $roomType)->first();
            ?>
            <div class="swiper-slide slide">
               <div class="image">
                  <span class="price">${{ $room->PricePerNight }}/night</span>
                  <img src="{{ asset($room->image_data) }}" alt="Room Image">
            
               </div>
               <div class="content">
                  <h3>{{ $room->RoomType }} Room</h3>
                  <p>{{ $room->Amenities }}</p>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
                           
               </div> 
            </div>
         <?php
            }
         ?>
      </div>
      <div class="swiper-pagination"></div>
   </div>
</section>


   <!-- end -->

   <!-- services -->
   <section class="services-section">
      <div class="services-container">
        <h2 class="section-title">Our Services</h2>
        <div class="services-grid">
          <div class="service">
            <i class="fas fa-swimming-pool"></i>
            <h3>Swimming Pool</h3>
            <p>Enjoy a refreshing swim in our luxurious swimming pool.</p>
          </div>
          <div class="service">
            <i class="fas fa-dumbbell"></i>
            <h3>Gym & Yoga</h3>
            <p>Stay fit and relaxed with our well-equipped gym and yoga classes.</p>
          </div>
          <div class="service">
            <i class="fas fa-spa"></i>
            <h3>Spa & Massage</h3>
            <p>Indulge in ultimate relaxation with our rejuvenating spa treatments and massages.</p>
          </div>
          <div class="service">
            <i class="fas fa-ship"></i>
            <h3>Boat Tours</h3>
            <p>Embark on exciting boat tours to explore the stunning coastal scenery.</p>
          </div>
          <div class="service">
            <i class="fas fa-surfing"></i>
            <h3>Surfing Lessons</h3>
            <p>Learn to ride the waves with professional surfing lessons.</p>
          </div>
          <div class="service">
            <i class="fas fa-briefcase"></i>
            <h3>Conference Room</h3>
            <p>Host successful business conferences and meetings in our modern conference room.</p>
          </div>
          <div class="service">
            <i class="fas fa-ring"></i>
            <h3>Beach Weddings</h3>
            <p>Create unforgettable memories with a romantic beach wedding ceremony.</p>
          </div>
          <div class="service">
            <i class="fas fa-umbrella-beach"></i>
            <h3>Private Beach</h3>
            <p>Relax and unwind on our private beach, exclusive to our guests.</p>
          </div>
        </div>
      </div>
    </section>

   <!-- end -->

   <!-- gallery -->

   <section class="gallery" id="gallery">

      <h1 class="heading">our gallery</h1>

      <div class="swiper gallery-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
            <img src="{{ asset('assets/images/gallery1.jpg') }}" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
            <img src="{{ asset('assets/images/gallery2.jpg') }}" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
            <img src="{{ asset('assets/images/gallery3.jpg') }}" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
            <img src="{{ asset('assets/images/gallery4.jpg') }}" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
            <img src="{{ asset('assets/images/gallery5.jpg') }}" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
            <img src="{{ asset('assets/images/gallery6.jpg') }}" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

         </div>

      </div>

   </section>

   <!-- end -->

   <!-- review -->

   <section class="review" id="review">

<div class="swiper review-slider">
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <h2 class="heading">Clients' reviews</h2>
         <i class="fas fa-quote-right"></i>
         <p>"My stay at the hotel was nothing short of wonderful. The rooms were spacious, impeccably clean, and the bed was incredibly comfortable. The attention to detail in the room decor and amenities truly made me feel at home. I can't wait to return!"</p>
         <div class="user">

            <img src="{{ asset('assets/images/pic-1.png') }}" alt="">
            <div class="user-info">
               <h3>Tom</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="swiper-slide slide">
         <h2 class="heading">Clients' reviews</h2>
         <i class="fas fa-quote-right"></i>
         <p>"The staff at the hotel went above and beyond to make our stay memorable. From the warm welcome at the front desk to the attentive service at the on-site restaurant, every team member seemed genuinely committed to ensuring our comfort. Kudos to the entire staff for their exceptional service!"</p>
         <div class="user">
            <img src="{{ asset('assets/images/pic-2.png') }}" alt="">
            <div class="user-info">
               <h3>Jamie Deo</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="swiper-slide slide">
         <h2 class="heading">Clients' reviews</h2>
         <i class="fas fa-quote-right"></i>
         <p>"The dining experience at the hotel was a culinary delight. The on-site restaurant offered a diverse menu with a perfect blend of local and international cuisines. The quality of the food, coupled with the inviting ambiance, made our dining experiences truly enjoyable."</p>
         <div class="user">
         <img src="{{ asset('assets/images/pic-3.png') }}" alt="">
            <div class="user-info">
               <h3>Sam</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="swiper-slide slide">
         <h2 class="heading">Clients' reviews</h2>
         <i class="fas fa-quote-right"></i>
         <p>"The location of the hotel couldn't be better. It's conveniently situated near popular attractions and public transportation, making it easy to explore the city. We appreciated the central location, which allowed us to make the most of our time in the area."</p>
         <div class="user">
            <img src="{{ asset('assets/images/pic-4.png') }}" alt="">
            <div class="user-info">
               <h3>Kiana Lede</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="swiper-slide slide">
         <h2 class="heading">Clients' reviews</h2>
         <i class="fas fa-quote-right"></i>
         <p>"One of the highlights of our stay was the breathtaking views from our room. Whether it was the city skyline or the scenic landscapes, every window provided a picturesque panorama. Waking up to such beauty was truly a treat."</p>
         <div class="user">
         <img src="{{ asset('assets/images/pic-5.png') }}" alt="">
            <div class="user-info">
               <h3>Mary</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="swiper-slide slide">
         <h2 class="heading">Clients' reviews</h2>
         <i class="fas fa-quote-right"></i>
         <p>"Staying at the felt like a retreat from the hustle and bustle of daily life. The serene atmosphere, coupled with the soothing decor, created a truly relaxing oasis. The spa services were a highlight, and the skilled therapists ensured a rejuvenating experience. It was the perfect escape, and I left feeling refreshed and renewed."</p>
         <div class="user">
         <img src="{{ asset('assets/images/pic-6.png') }}" alt="">
            <div class="user-info">
               <h3>Mary</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

   </div>
   <div class="swiper-pagination"></div>
</div>

</section>

   <!-- end -->

   <!-- faq -->

   <section class="faqs" id="faq">
      <h3>Frequently asked question</h3>
      <div class="container faqs__container">
          <article class="faq">
              <div class="faq__icon"><i class="fa-solid fa-plus"></i></div>

              <div class="question__answer">
                  <h4>What is your capacity for board room meetings?</h4>
                  <p style="font-size: small;">Our board room is designed to accommodate up to 20 participants comfortably. With state-of-the-art audiovisual equipment, ergonomic seating, and a professional atmosphere, our board room is an ideal space for productive meetings, presentations, and collaborative discussions. We also offer customizable catering options and dedicated staff support to ensure your meeting runs seamlessly. Whether you're hosting a corporate strategy session or a high-profile presentation, our board room is equipped to meet your business needs.</p>
              </div>

          </article>
          <article class="faq">
              <div class="faq__icon"><i class="fa-solid fa-plus"></i></div>
              <div class="question__answer ">
                  <h4>Do you have a golf course arena?</h4>
                  <p style="font-size: small;">We currently do not have a golf course arena. However, if you're passionate about golf, we can provide information about nearby golf courses that you might find interesting. Our concierge or front desk staff would be happy to assist you in finding the perfect golfing experience during your stay.</p>
              </div>

          </article>

          <article class="faq">
              <div class="faq__icon"><i class="fa-solid fa-plus"></i></div>
              <div class="question__answer">
                  <h4>Do you offer horse riding training?</h4>
                  <p style="font-size: small;">Yes, we do offer horse riding training at our facility. Our horse riding programs cater to riders of all skill levels, from beginners to advanced. Our experienced and certified instructors provide personalized instruction to ensure a safe and enjoyable learning experience. Whether you're looking to start your journey in horse riding or enhance your existing skills, we have programs tailored to meet your needs. Feel free to contact us for more information or to schedule a lesson. We look forward to helping you discover the joys of horse riding!</p>
              </div>

          </article>

          <article class="faq">
              <div class="faq__icon"><i class="fa-solid fa-plus"></i></div>
              <div class="question__answer">
                  <h4>Is you pool heated?</h4>
                  <p style="font-size: small;">Yes, our pool is heated for your comfort and enjoyment. Whether you're looking to take a refreshing swim or simply relax by the poolside, our heated pool provides the perfect temperature year-round. We strive to offer a pleasant and enjoyable experience for all our guests.</p>
              </div>


          </article>

          <article class="faq">
              <div class="faq__icon"><i class="fa-solid fa-plus"></i></div>
              <div class="question__answer">
                  <h4>Do you have bonfire events?</h4>
                  <p style="font-size: small;">Yes, we do host bonfire events at our venue! Our bonfire events are a fantastic way to bring warmth and a sense of community to your gatherings. Whether you're planning a corporate event, a family reunion, or a special celebration, our bonfire setups provide a cozy and inviting atmosphere. Guests can enjoy the crackling flames, roast marshmallows, and create lasting memories around the fire. Contact our events team for more information on how we can tailor a bonfire experience to suit your specific needs.</p>
              </div>

          </article>

          <article class="faq">
              <div class="faq__icon"><i class="fa-solid fa-plus"></i></div>
              <div class="question__answer">
                  <h4>What are your spa charges?</h4>
                  <p style="font-size: small;">Our spa offers a variety of rejuvenating treatments designed for ultimate relaxation. Prices for individual treatments range from $80 to $120, with special packages available, such as the Ultimate Relaxation Package for $250. Additionally, we offer a Weekday Wellness Special with a 15% discount on spa services booked Monday to Thursday. A spa access fee of $20 is included with any treatment, and we appreciate a 15% gratuity for our skilled spa therapists. We recommend booking in advance to secure your preferred time. Please note that prices are subject to change, and we encourage you to check our website or contact our spa concierge for the latest information.</p>
              </div>

          </article>

          <article class="faq ">
              <div class="faq__icon"><i class="fa-solid fa-plus"></i></div>
              <div class="question__answer">
                  <h4>How much does surfing cost?</h4>
                  <p style="font-size: small;">Our prices typically range from $50 per day, with discounts for longer rental periods. Surf lessons, which often include equipment rental, can range from $50 to $100 for a group lesson, while private lessons cost $150 per hour.</p>
              </div>
          </article>

      <article class="faq ">
          <div class="faq__icon"><i class="fa-solid fa-plus"></i></div>
          <div class="question__answer ">
              <h4>Can I access the beach at night?</h4>
              <p style="font-size: small;">Access to the beach at night depends on the specific rules and regulations set by the local authorities managing the area. In many cases, our beaches may have restricted access during nighttime hours for safety and security reasons. Some of our beaches may have designated hours, after which access is limited or prohibited to ensure the well-being of visitors and to prevent unauthorized activities</p>
          </div>
      </article>

      </div>

  </section>
   <!-- end -->
>

   <!-- footer -->


   <footer>
      <div class=" footer__container footer__container1">
      <div class="footer__1">
          <a href="#home" class="footer_logo"><h4>Blimey Hotel</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, maxime.</p></a>
      </div>
      <div class="footer__2"><h4>permalink</h4>
      <ul class="permalinks">
      <li><a href="#home">home</a></li>
      <li><a href="#about">about</a></li>

      <li><a href="#review">contact</a></li>
      </ul>
      </div>
      <div class="footer__3">
          <h4>privacy</h4>
          <ul>
              <li><a href="#">Privacy policy</a></li>
              <li><a href="#">Terms and conditions</a></li>
              <li><a href="#">Refund policy</a></li>
          </ul>
  
      </div>
      <div class="footer__4">
          <h4>Contact us</h4>
          <div>
              <p>+254768045374</p>
              <P>info.blimey@gmail.com</P>
          </div>
          <ul class="footer__socials">
       <a href="#"><i class="fa-brands fa-instagram"></i></a>
       <a href="#"><i class="fa-brands fa-facebook"></i> </a>
       <a href="#"> <i class="fa-brands fa-twitter"></i></a>
       <a href="#"><i class="fa-brands fa-linkedin"></i> </a>
     
          </ul>
      
      </div>
     
      </div>
      <div class="footer__copy"><small>Copyright &copy; Blimey 2023</small></div>
  </footer>
  

   <!-- end -->


















   <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

   <script src="{{ asset('assets/script.js') }}"></script>
 
   <script>
        // Get the current date in 'YYYY-MM-DD' format
        const today = new Date().toISOString().split('T')[0];

        // Set the min attribute for both check-in and check-out inputs to the current date
        document.getElementById('check_in').min = today;
        document.getElementById('check_out').min = today;

        // Add event listener to the check-in input
        document.getElementById('check_in').addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            const checkOutInput = document.getElementById('check_out');

      
            checkOutInput.disabled = false;

            
            checkOutInput.min = this.value;

 
            if (this.value < today) {
                checkOutInput.value = this.value;
            } else {
              
                checkOutInput.min = this.value;
            }
        });
    </script>

   <script> 
      document.addEventListener('DOMContentLoaded', () => {
        const faqs = document.querySelectorAll('.faq');
      
        faqs.forEach(faq => {
          faq.addEventListener('click', () => {
            faq.classList.toggle('open');
      
            // Change icon
            const icon = faq.querySelector('.faq__icon i');
            if (icon.className === 'fa-solid fa-plus') {
              icon.className = 'fa-solid fa-minus';
            } else {
              icon.className = 'fa-solid fa-plus';
            }
          });
        });
      
        const toggle_btn1 = document.querySelector('.toggle_btn');
        const toggleButtonIcon = document.querySelector('.toggle_btn i');
        const dropDown = document.querySelector('.drop_down');
        let isClicked = false;
      
        toggle_btn1.onclick = function() {
          dropDown.classList.toggle('open');
          isClicked = true;
          const isOpen = dropDown.classList.contains('open');
          toggleButtonIcon.classList = isOpen ? 'fa-solid fa-times' : 'fa-solid fa-bars';
        };
      
        if (!isClicked) {
          dropDown.classList.remove('open');
        }
      });
      
          
          </script>
          
   <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script src="{{ asset('assets/script.js') }}"></script>
@if(session('error'))
 <script>
     $(document).ready(function(){
         alert("{{ session('error') }}");
     });
 </script>
@endif

<script> 

   document.addEventListener('DOMContentLoaded', function () {
      // Get necessary elements
      var userPic = document.querySelector('.user-pic');
      var userContainer = document.querySelector('.user-container');
      var subMenuWrap = document.querySelector('.sub-menu-wrap');

      // Add click event listener to the user pic
      userPic.addEventListener('click', function (event) {
         event.stopPropagation(); // Prevent the click event from reaching the document
         userContainer.classList.toggle('open'); // Toggle the 'open' class
      });

      // Add click event listener to the document to close the sub-menu when clicking outside
      document.addEventListener('click', function () {
         userContainer.classList.remove('open');
      });

      // Prevent closing the sub-menu when clicking inside the user-container
      userContainer.addEventListener('click', function (event) {
         event.stopPropagation();
      });
   });
</script>
</body>
</html>