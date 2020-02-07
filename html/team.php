<?php
require './assets/includes/config.inc.php';
$page = 'team';
require './assets/includes/head.php';
?>

<body class="teamPage">
<!-- Header -->
<?php require './assets/includes/header.inc.php'; ?>

<!-- Main body content -->
<article id="mainContent" class="mainContent">
    <div class="mainHeading_Container">
       <h2 class="mainHeading">Meet Our Team</h2>
    </div>

    <div class="mainContent-wrapper">
        <section id="mainSection-one" class="mainSection-container">
            <div class="portrait-container">
                <img class="portrait" src="assets/images/nicholas.jpg" alt="Portrait">
            </div>
            <div class="mainSection-content">
                <h3 class="mainSection-heading subheading">Nicholas Ferrari</h3>
                <h4 class="role">Project Manager & SEO</h4>
                <p class="description">Nicholas is a battle-hardened veteran of the OKC restaurant industry who is trying to reintegrate back into society by learning web development. In his personal time, he likes to worry about how little time he has. Sometimes he writes and hosts unconventional parties for his friends, like murder-mysteries, roasts, and "Attend Your Own Funeral" events. He is currently coping with <a href="https://i.redd.it/h7d4mzqxwga21.jpg">imposter syndrome</a> by pursuing his newfound passion for <a href="https://www.gnu.org/philosophy/floss-and-foss.en.html">FLOSS</a> (Free/Libre and Open-Source Software). He thinks he's cool because he installed Ubuntu on his PC.</p>
                <a class="portfolioLink" href="http://site12.wdd.francistuttle.edu/index.html">His Portfolio >></a>
            </div>
        </section>

        <section id="mainSection-two" class="mainSection-container">
            <div class="portrait-container">
                <img class="portrait" src="assets/images/savannah.jpg" alt="Portrait">
            </div>
            <div class="mainSection-content">
                <h3 class="mainSection-heading subheading">Savannah Skinner</h3>
                <h4 class="role">Front-end & Back-end Developer</h4>
                <p class="description">Savannah is bookworm who's been in love with technology since childhood. She was that kid who read while walking to class, brought a book to lunch, and read the cereal box during breakfast. Now you can usually find her reading a book on her tablet on the way to work or debating the superior programming language with her siblings. She also enjoys writing, drawing, and convincing others to become kpop fans. Combine all these passions together and you get a web developer who may or may not have based a class project around her favorite (and the best!) kpop group..</p>
                <a class="portfolioLink" href="https://savannahskinner.com">Her Portfolio >></a>
            </div>
        </section>

        <section id="mainSection-three" class="mainSection-container">
            <div class="portrait-container">
                <img class="portrait" src="assets/images/noshin.jpg" alt="Portrait">
            </div>
            <div class="mainSection-content">
                <h3 class="mainSection-heading subheading">Noshin Rahman</h3>
                <h4 class="role">Design</h4>
                <p class="description">Noshin is an aspiring web developer and visual designer who can’t help interrupting conversations to announce when a dog is nearby. She likes to spend her time bullet journaling, being a national alumna leader for her multicultural sorority, or wandering in local nurseries to find more tropical plants she has no room for. Noshin's occupation has been within the service industry as a veteran server and novice bartender for over 10 years, however she is currently in search for a workspace where she can enjoy being more creative and sharpen up her design skills. Rumor also has it that her own dog outweighs her (which is indeed a fact, at 140 pounds).</p>
                <a class="portfolioLink" href="http://noshinr.com">Her Portfolio >></a>
            </div>
        </section>

    </div>
</article>

<!-- Footer -->
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
