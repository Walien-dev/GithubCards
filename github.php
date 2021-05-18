<?php
	$GithubName = "Walien-dev"; //! Put your GitHub Name here

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://github.com/'. $GithubName .'?tab=repositories');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
?>





<body>
	<div class="container" id="WLNgithub">
	</div>
</body>


<style>
	@font-face {
		font-family: 'Raleway';
		font-style: normal;
		font-weight: 400;
		src: url(https://fonts.gstatic.com/s/raleway/v19/1Ptxg8zYS_SKggPN4iEgvnHyvveLxVvaorCIPrQ.ttf) format('truetype');
	}
	*,
	*::before,
	*::after {
		box-sizing: border-box;
	}
	html {
		background-color: #f8f8f8;
	}
	body {
		display: block;
		padding: 2rem 0.5rem;
		font-family: 'Raleway', Sans-serif;
		color: #32325d;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		text-rendering: optimizeLegibility;
		margin: 0;
	}
	@media (min-width: 40rem) {
		body {
			padding: 2rem;
		}
	}
	.container {
		display: flex;
		-webkit-display: box;
		-moz-display: box;
		-ms-display: flexbox;
		-webkit-display: flex;
		flex-wrap: wrap;
		padding: 0;
		margin: 0;
	}
	.cards {
		display: flex;
		padding: 1rem;
		margin-bottom: 2rem;
		width: 100%;
	}
	@media (min-width: 40rem) {
		.cards {
			width: 50%;
		}
	}
	@media (min-width: 56rem) {
		.cards {
			width: 33.3%;
		}
	}

	.cards .card-item {
		display: flex;
		flex-direction: column;
		background-color: #fff;
		width: 100%;
		border-radius: 6px;
		box-shadow: 0 20px 40px -14px rgba(0, 0, 0, 0.25);
		overflow: hidden;
		transition: transform 0.5s, background-color 0.5s ease;
		-webkit-transition: transform 0.5s, background-color 0.5s ease;
	}

	.cards .card-item:hover {
		cursor: pointer;
		transform: scale(1.1);
		-webkit-transform: scale(1.1);
	}

	.cards .card-item:hover .card-image {
		opacity: 1;
	}

	.cards a {
		text-decoration: none;
		color: black;
		padding: 15px;
	}

	.card-item:hover {
		background: #d6d6d6;
	
		h2 {}
	}

	.cards p {
		display: inline-block;
	}

	.cards .card-info {
		display: flex;
		flex: 1 1 auto;
		flex-direction: column;
		padding: 1rem;
		line-height: 1.5em;
	}

	.cards .card-title {
		font-size: 25px;
		line-height: 1.1em;
		color: #32325d;
		margin-bottom: 0.2em;
	}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/ada0a3530b.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
	var div1 = document.createElement('div');
	div1.innerHTML = <?= json_encode($result) ?>;
	repos = div1.getElementsByClassName("col-10 col-lg-9 d-inline-block");	
		
	for (var i = 0; i < repos.length; i++) {
		var div2 = document.createElement('div');
		div2.innerHTML = '<div class="card-item"><a target="_blank" href="https://github.com/<?= $GithubName ?>/" class="github-card"><h2 class="card-title"></h2><p></p><span class="github-card__meta"><br><span class="github-card__language-icon" style="color: #7A0410;font-size:18px;">●</span> </span><span class="github-card__meta">&#8239&#8239&#8239&#8239&#8239&#8239&#8239<i class="far fa-star" aria-hidden="true"></i><span data-stars> <p class="stars"></p></span></span><span class="github-card__meta">&#8239&#8239&#8239<i class="fa fa-code-fork" aria-hidden="true"></i><span data-forks> <p class="forks"></p></span></span></a></div>'
		div2.className = "cards"

		Repo = repos[i]
		NameRepo = Repo.getElementsByTagName('a')[0].href.split('/')[Repo.getElementsByTagName('a')[0].href.split('/').length - 1]
		DescRepo = Repo.getElementsByTagName('p')[0].innerText
		LanguageRepo = Repo.getElementsByClassName('ml-0 mr-3')[0].getElementsByTagName('span')[1].innerText
		LanguageColorRepo = Repo.getElementsByClassName('repo-language-color')[0].style.backgroundColor

		div2.getElementsByTagName('a')[0].href = div2.getElementsByTagName('a')[0].href + NameRepo
		div2.getElementsByTagName('h2')[0].innerText = NameRepo
		div2.getElementsByTagName('p')[0].innerText = DescRepo
		div2.getElementsByClassName('github-card__meta')[0].innerHTML = div2.getElementsByClassName('github-card__meta')[0].innerHTML + ' ' + LanguageRepo
		div2.getElementsByClassName('github-card__language-icon')[0].style.color = LanguageColorRepo
		
		div2.getElementsByClassName('stars')[0].classList.add(NameRepo)
		div2.getElementsByClassName('forks')[0].classList.add(NameRepo)

		document.getElementById('WLNgithub').appendChild(div2)
		delete div2

		$.getJSON('https://api.github.com/repos/<?= $GithubName ?>/' + NameRepo, function(data) {
			document.getElementsByClassName('stars ' + data['name'])[0].innerText = data['stargazers_count']
			document.getElementsByClassName('forks ' + data['name'])[0].innerText = data['forks']
		});
	}
</script>
