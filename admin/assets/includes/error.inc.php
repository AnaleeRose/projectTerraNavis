<?php
function produce_error_page($text, $links = []) {
	if (!empty($text)) {
		$text = htmlentities($text);
		?>
<article class="errorPage">
	<h2>Something went wrong...</h2>
	<?php
echo '<p class="errorText">' . $text . '</p>';
	if (!empty($links) && is_array($links)) {
		echo '<div class="errorBtnContainer">';
		foreach ($links as $key => $value) {
			if (!empty($key) && !empty($value)) echo '<a href="' . $value . '" class="adminBtn adminBtn_aqua">' . $key . '</a>';
		}
		echo '</div>';
	}
	?>
</article>
		<?php
	}
}
