<?php
require './assets/includes/config.inc.php';
$page = 'resources';
if ($page = 'resources') {
?>
<style type="text/css">
  :root {
      --pageColor: var(--home);
      --pageColor-shade: var(--home-shade);
      --pageColor-link: var(--home-link);
  }
</style>
<?php
}
require './assets/includes/head.php';
?>

<body class="teamPage">
<!------ Header ------------>
<?php require './assets/includes/header.inc.php'; ?>

<!-- Main body content -->
<article id="mainContent" class="mainContent">
    <header class="mainHeading_Container">
       <h2 class="mainHeading">Meet Our Team</h2>
    </header>

    <div class="mainContent-wrapper">
        <section id="mainSection-one" class="mainSection-container">
            <div class="portrait-container">
                <img class="portrait" src="assets/images/temp.png" alt="Portrait">
            </div>
            <div class="mainSection-content">
                <h3 class="mainSection-heading subheading">Nicholas Ferrari</h3>
                <h4 class="role">Project Manager & SEO</h4>
                <p class="description">Nicholas is a battle-hardened veteran of the OKC restaurant industry who is trying to reintegrate back into society by learning web development. In his personal time, he likes to worry about how little time he has. Sometimes he writes and hosts unconventional parties for his friends, like murder-mysteries, roasts, and "Attend Your Own Funeral" events. He is currently coping with <a href="https://i.redd.it/h7d4mzqxwga21.jpg">imposter syndrome</a> by pursuing his newfound passion for <a href="https://www.gnu.org/philosophy/floss-and-foss.en.html">FLOSS</a> (Free/Libre and Open-Source Software). He thinks he's cool because he installed Ubuntu on his PC.</p>
                <a class="portfolioLink" href="yourportfolio.com">His Portfolio >></a>
            </div>
        </section>

        <section id="mainSection-two" class="mainSection-container">
            <div class="portrait-container">
                <img class="portrait" src="assets/images/temp.png" alt="Portrait">
            </div>
            <div class="mainSection-content">
                <h3 class="mainSection-heading subheading">Jerad Bowles</h3>
                <h4 class="role">Front-end Developer & Content Specialist</h4>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliq.</p>
                <a class="portfolioLink" href="yourportfolio.com">His Portfolio >></a>
            </div>
        </section>

        <section id="mainSection-three" class="mainSection-container">
            <div class="portrait-container">
                <img class="portrait" src="assets/images/temp.png" alt="Portrait">
            </div>
            <div class="mainSection-content">
                <h3 class="mainSection-heading subheading">Savannah Skinner</h3>
                <h4 class="role">Back-end Developer & UX</h4>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliq.</p>
                <a class="portfolioLink" href="https://savannahskinner.com">Her Portfolio >></a>
            </div>
        </section>

        <section id="mainSection-four" class="mainSection-container">
            <div class="portrait-container">
                <img class="portrait" src="assets/images/temp.png" alt="Portrait">
            </div>
            <div class="mainSection-content">
                <h3 class="mainSection-heading subheading">Noshin Rahman</h3>
                <h4 class="role">Design</h4>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliq.</p>
                <a class="portfolioLink" href="http://noshinr.com">Her Portfolio >></a>
            </div>
        </section>

    </div>
</article>

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
