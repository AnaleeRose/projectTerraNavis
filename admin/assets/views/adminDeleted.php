<?php
require './assets/includes/header.html';
?>
<article class="errorPage <?= $_SESSION['light_mode']; ?>">
	<h2>Admin Was Deleted</h2>
    <div class="errorBtnContainer">
        <a href="index.php" class="adminBtn adminBtn_aqua">Return To Home</a>
        <a href="profile.php" class="adminBtn adminBtn_aqua">Return To Profile</a>
    </div>
</article>
</body>
</html>
<?php require './assets/includes/footer.html'; ?>