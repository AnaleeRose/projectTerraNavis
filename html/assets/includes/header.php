<header id="header">
    <a href="index.php"><img id="headerlogo" src="images/" alt="Terra Navis Living Logo"></a>
    <nav id="main-nav">
        <ul class="main-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="sustainability.php">Sustainability</a></li>
            <?php 
            // change the title in quotes below to match whatever the page title is on that page, all lower case in the quotes pls
            // also added the dropdownUl class for the styles that match both (like fo js to target it for special effects!)
            if (strtolower($page_title) == 'sustainability') { 
            ?>
                <ul class="sustain dropdownUl">
                    <li><a href="#renew-energy">Renewable Energy</a></li>
                    <li><a href="#food">Food</a></li>
                    <li><a href="#water">Water Collection</a></li>
                    <li><a href="#recycle">Recycling</a></li>
                </ul>
            <?php } ?>

            <li><a href="construction.php">Construction</a></li>

            <?php 
            // change the title in quotes below to match whatever the page title is on that page, all lower case in the quotes pls
            if (strtolower($page_title) == 'construction') { 
            ?>
                <ul class="construction dropdownUl">
                    <li><a href="#design">Design</a></li>
                    <li><a href="#materials">Materials</a></li>
                    <li><a href="#building">Building</a></li>
                    <li><a href="#building-code">Building Codes</a></li>
                </ul>
            <?php } ?>
            <li><a href="econews.php">Eco News</a></li>
            <li><a href="resources.php">Resources</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>
