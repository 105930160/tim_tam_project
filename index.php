<!DOCTYPE html>
<html lang="en">
<head>
    <!--Change the meta tags for your ownnn documents-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Akira Ellis">
    <meta name="description" content="Landing page (home page) for the company 'Generic IT Company'">
    <meta name="keywords" content="Generic IT Company, Generic IT Company ltd., IT">
    <title>Generic IT Company - Home</title>
    <!--Possibly have unique stylesheets for each page (subject to discussion) in any case the css for this stuff is seperate to our individual work-->
    <link href="./styles/styles.css" rel="stylesheet">
</head>
<!--GitHub deployed Link: https://105930160.github.io/tim_tam_project/-->
<body>
    <!--didn't put in a header because i didn't see why we needed one-->
    <!--also we could make the navbar fixed at the top of the page. something to discuss also.-->

    <?php include 'header.inc'; ?>
    <!--Main for all the... Main stuff (:O)-->
    <main>
        <figure>
            <video loop autoplay muted>
                <!--Sources for video
                Video by olia danilevich from Pexels: https://www.pexels.com/video/a-man-using-laptop-4974708/
                Video by Mikhail Nilov from Pexels: https://www.pexels.com/video/men-working-together-in-an-office-7989689/
                Video by Mikhail Nilov from Pexels: https://www.pexels.com/video/men-working-using-laptop-7989443/
                Video by Coverr from Pexels: https://www.pexels.com/video/close-up-video-of-typing-on-keyboard-854182/
                Video by Coverr from Pexels: https://www.pexels.com/video/typing-of-codes-854053/
                Video by fauxels from Pexels: https://www.pexels.com/video/men-busy-in-their-workplace-aided-by-using-modern-technology-gadgets-3253041/
                Video by fauxels from Pexels: https://www.pexels.com/video/people-in-a-meeting-3255275/
                Video by Nicola Narracci: https://www.pexels.com/video/binary-code-animation-with-green-digits-31360633/
                Video by Pressmaster from Pexels: https://www.pexels.com/video/digital-presentation-of-data-and-information-3130284/
                Video by Pressmaster from Pexels: https://www.pexels.com/video/digital-projection-of-the-earth-s-mass-in-green-lights-3129785/
                Video by Colin Jones from Pexels: https://www.pexels.com/video/a-green-sphere-with-lines-and-dots-on-it-16499745/
                Video by Oleg Gamulinskii from Pexels: https://www.pexels.com/video/digital-code-rain-animation-10532470/-->
                <source src="video/homestockfootage.mp4">
            </video>
            <div id="overlaytext">
                <h1>Generic IT Company</h1>
                <p>Together, there's an endless sea of possibilities</p>
            </div>
        </figure>
        <section id="companydescriptions">
            <h2>About The Company</h2>
            <article class="companydescription">
                <h3>Our Company</h3>
                <p>We are a small company composed of a concentrated crew of conscientious, computer coders, committed to crafting customised concepts for our customers</p>
                <p>Purportedly, we are positioned in Perth, PAustralia </p>
            </article>
            <article class="companydescription">
                <h3>Our Aims</h3>
                <p>1. We b-want a b-country b-full of bureaucratic busywork and being blissfully blind to blue bananas</p>
                <p>2. she sells seashells by the seashore, the shells she sells are surely seashells, so if she sells shells on the seashore i'm sure she sells seashore shells</p>
            </article>
            <article class="companydescription">
                <h3>Past Projects</h3>
                <p>1. Nasa / The Moon</p>
                <p>2. Granite</p>
            </article>
        </section>
    </main>
    <footer>
        <a href="https://tamstim72.atlassian.net/jira/software/projects/SCRUM/boards/1" target="_blank"><p> Our Jira</p></a>
        <a href="https://github.com/105930160/tim_tam_project" target="_blank"><p>Our GitHub</p></a>
    </footer>
</body>
</html>