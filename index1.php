<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>TORAJA</title>
</head>
<body>
    <!--HEADER-->
    <header class="header">
        <a href="#" class="logo">Toraja.</a>

        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#event">Event</a>
            <a href="#location">Location</a>
            <!-- <a href="#feedback">Feedback</a> -->
            <a href="php/login.php">Join With Us</a>
        </nav>
    </header>

    <section class="home" id="home">
        <video autoplay loop muted poster="" id="background-video">
            <source src="img/opening.mp4" type="video/mp4">
        </video>
        <div class="home-content">
            <h3>Toraja In Art & Culture Festival</h3>
            <h1>BACK TO HERITAGE</h1>
            <h2>Tradition's Paradise, <span class="multiple-text">Toraja Inspires</span></h2>
        </div>
    </section>

    <!-- BOOKING FORM
    <section class="book-form" id="book-form">

        <form action="">
            <div class="inputBox">
                <span>where to?</span>
                <input type="text" placeholder="place name" value="">
            </div>
            <div class="inputBox">
                <span>when?</span>
                <input type="datetime">
            </div>
            <div class="inputBox">
                <span>how many?</span>
                <input type="number" placeholder="number of travelers" value="">
            </div>
            <input type="submit" value="find now" class="btn">
        </form>
    </section> -->

    <!--ABOUT-->
    <section class="about" id="about">

        <div class="video-container">
            <video src="img/video2.mp4" muted autoplay loop class="video"></video>
            <div class="controls">
                <span class="control-btn" data-src="img/video2.mp4"></span>
                <span class="control-btn" data-src="img/video3.mp4"></span>
                <span class="control-btn" data-src="img/Rambu Solo_ A Unique Farewell _ Aerial Indonesia _ CNA Insider.mp4"></span>
            </div>
        </div>

        <div class="content">
            <span>Our Home</span>
            <h3>Beneath Toraja's Sky: A Soul-Stirring Wonder</h3>
            <p>Toraja, where lush valleys and towering hills converge in natural harmony, revealing the captivating beauty and uniqueness of its cultural traditions. Here, ancient customs intertwine with modern life, as age-old rituals and traditional architecture weave tales of rich heritage and unforgettable legends, offering a glimpse into a world where time stands still and tradition thrives.</p>
            <!-- <a href="#" class="btn">Read More</a> -->
        </div>

    </section>

    <!-- EVENT -->
    <section class="event" id="event">
        <h2 class="heading"><span> Our Event</span></h2>

        <div class="event-container">
            <div class="event-box">
                <img src="img/rambu solo.jpg" alt="">
                <div class="event-layer">
                    <h4>Rambu Solo'</h4>
                    <p>A sacred Torajan traditional funeral ceremony, guiding the departed souls to the afterlife.</p>
                    <!-- <i class="fa-solid fa-up-right-from-square"></i> -->
                </div>
            </div>

            <div class="event-box">
                <img src="img/pa'gellu.png" alt="">
                <div class="event-layer">
                    <h4>Pa'gellu</h4>
                    <p>A traditional Torajan dance featuring strong and dynamic movements, narrating heroic tales from the past</p>
                    <!-- <i class="fa-solid fa-up-right-from-square"></i> -->
                </div>
            </div>

            <div class="event-box">
                <img src="img/kada tomina.jpg" alt="">
                <div class="event-layer">
                    <h4>Kada Tomina</h4>
                    <p>An important ritual of cleansing and purifying the soul in Torajan culture, performed as part of traditional funeral ceremonies</p>
                    <!-- <i class="fa-solid fa-up-right-from-square"></i> -->
                </div>
            </div>

            <div class="event-box">
                <img src="img/barana'.png" alt="">
                <div class="event-layer">
                    <h4>Barana' Choir</h4>
                    <p>A mesmerizing choir that blends the harmonies of traditional Torajan melodies with modern choral arrangements, showcasing the rich cultural heritage of Toraja</p>
                    <!-- <i class="fa-solid fa-up-right-from-square"></i> -->
                </div>
            </div>

            <div class="event-box">
                <img src="img/ma'lambuk.jpeg" alt="">
                <div class="event-layer">
                    <h4>Ma' Lambuk</h4>
                    <p>One of the rituals found in Toraja is a collective activity of pounding the long-shaped rice mortar using wood or bamboo, performed by several people together</p>
                    <!-- <i class="fa-solid fa-up-right-from-square"></i> -->
                </div>
            </div>

            <div class="event-box">
                <img src="img/ma' nganda'.jpg" alt="">
                <div class="event-layer">
                    <h4>Manganda'</h4>
                    <p>The ancestral dance of Toraja, accompanied by the ringing of bells and the shouts of 'aihihihihi' as a manifestation of joy and praise to Puang Matua (god in the belief of Aluk Todolo')</p>
                    <!-- <i class="fa-solid fa-up-right-from-square"></i> -->
                </div>
            </div>
        </div>
    </section>


    <!-- LOCATION -->
    <section class="location" id="location">
        <h2 class="heading"><span> Location </span></h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.961470230262!2d119.84925777312665!3d-3.104890340314403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d93ed45601bf3bf%3A0xa1290390eab9eab2!2sKolam%20Makale!5e0!3m2!1sid!2sid!4v1712219911144!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    
    
    <!-- FEEDBACK -->
    <!-- <section class="feedback" id="feedback">
        <h2 class="heading"><span>Event Feedback</span></h2>

        <form action="#">
            <div class="input-box">
                <input type="text" placeholder="Name">
                <input type="email" placeholder="Email Address">
            </div>

            <div class="input-box">
                <input type="number" placeholder="Mobile Number">
                <input type="text" placeholder="Event">
            </div>
            <textarea name="" id="" cols="30" rows="5" placeholder="Your Feedback"></textarea>
            <input type="submit" value="Send Feedback" class="btn">
        </form>
    </section> -->

    <!-- FOOTER -->

    <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2024 by @sunnyiuww | All Rights Reserved.</p>
        </div>
    </footer>


    <!-- TYPED JS -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <!-- SCROLL REVEAL -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- MAIN JS -->
    <script src="main.js"></script>
</body>
</html>