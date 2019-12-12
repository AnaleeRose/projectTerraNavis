<html>
<head>
	<title>test</title>
	<style type="text/css">
		:root {
			--color_1: grey;
		}

		html {
			font-family: sans-serif;
		}
		body {
			margin: 0;
		}

		.container {
			padding: 1rem;
		}


		.header {
			width: 85%;
			margin: 0 auto 3rem;
			max-width: 1300px;
		}

		.logo {
			width: 6rem;
		}
	
		.mainHeading {
			font-size: 1.5rem;
			margin-left: 1rem;
		}

		.headingSpace_large, .headingSpace_small {
			opacity: 0;
			font-size: .1px;
			
		}
		
			.headingSpace_large {width: 50%;}
			.headingSpace_small {width: 5%;}

		.unsubBtn {
			border: 2px solid var(--color_1);
			border-radius: 2rem;
			padding: .8rem 1rem;
			text-decoration: none;
		}


		.mainContent {
			width: 80%;
			margin: 0 auto;
			max-width: 1200px;
		}

		.articleHeading {
			font-size: 2rem;
			font-weight: bold;
			padding-bottom: 2rem;
			text-align: center;
		}

		.picture {
			margin: 0 auto;
			width: 50%;
		}

		.content {
			margin: 0 auto;
			width: 40%;
		}

		.readLink {
			text-align: right;
		}

		.margin {width: 5%;}

		.team, .socialLinks, .contact {
			width: 30vw;
		}

		.footer {
			width: 100vw;
			background: var(--color_1)
		}

	</style>
</head>
<body>
	<table class="container">
		<table class="header">
			<tr>
				<th></th>
				<th></th>
				<th class="headingSpace_large"></th>
				<th></th>
			</tr>
			<tr>
				<td><img class="logo" src="http://localhost/BPA/admin/assets/imgs/leaf_icon.jpg"></td>
				<td><h1 class="mainHeading">Terra Navis Living</td>
				<td></td>
				<td><a href="http://localhost/BPA/admin/" class="unsubBtn">Unsubscribe</a></td>
			</tr>
		</table>
		<table class="mainContent">
			<tr>
				<th class="margin"></th>
				<th class="picture"></th>
				<th class="content"></th>
				<th class="margin"></th>
			</tr>

			<tr>
				<td></td>
				<td class="articleHeading" colspan="2">Finding Long Nose Dolphins</td>
				<td></td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td><img class="articleImg" src="http://localhost/BPA/admin/assets/imgs/leaf_icon.jpg"></td>
				<td><p class="articleDescription">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td></td>
				<td><p class="readLink">Read More At Terra Navis >></p></td>
				<td></td>
			</tr>
		</table>
	</table>
	<table class="footer">
		<tr>
			<th class="team"></th>
			<th class="socialLinks"></th>
			<th class="contact"></th>
		</tr>
		<tr>
			<td class="teamContainer">
				<h4 class="teamHeading">Meet Our Team</h4>
				<p class="teamText">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="http://localhost/BPA/admin/" class="readLink">Read More At Terra Navis >></a>
			</td>
			<td>
				<h3 class="footerArticleHeading">Read Our Latest Articles</h3>
				<a class="footerTNLink" href="http://localhost/BPA/admin/">Terra Navis Living</a>
				<div class="socialLinkContainer">
					<a href="facebok.com">fb</a>
					<a href="twitter.com">twitter</a>
					<a href="instagram.com">insta</a>
				</div>
				
			</td>
			<td>
				<p class="teamText">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				
			</td>
		</tr>
	</table>

</body>
</html>