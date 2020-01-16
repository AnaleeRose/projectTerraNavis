<?php
ob_start();
require './assets/includes/config.inc.php';
require MYSQL;
require './assets/includes/form_functions.inc.php';

if (isset($_GET['article_id'])) $article_id = $_GET['article_id'];
$a_name = "Error";
$a_desc = "Something went wrong...";
require './assets/views/showArticles.inc.php';
get_c_article_info();

$page = "c_article";
require './assets/includes/head.php';
?>

<body>
<!------ Header ------------>
<?php
require './assets/includes/header.inc.php';
$showArticle_errors;
?>

<article id="mainContent" class="multiContentPage mainContent">
    <header class="mainHeading_Container">
	   <h2 class="mainHeading"><?=$a_name;?></h2>
    </header>

    <div class="mainContent-wrapper">
        <section class="readArticle mainSection-container">
			<?php
			if (!isset($_GET['article_id'])) {
			    echo '<div class="errorPage">';
			        echo '<p>That article doesn\'t seem to exist... ';
			    echo '</div>';
			    require './assets/includes/footer.inc.php';
			    echo '</body>
			    </html>';
			    exit();
			}


			showArticles('full_article');


			?>
				<div class="fbShareBtn-container">
					 <div class="fb-share-button fbShareBtn" data-href="<?= $this_url; ?>"data-layout="button_count">
		  			</div>
		  		</div>
	  		</div>
		</section>

	</div>


</article>
<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
