<?php
	$GithubName = "Walien-dev"; //! Put your GitHub Name here

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://github.com/Walien-dev?tab=repositories');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
?>





<body>
	<div class="github-cards" id="WLNgithub">
	</div>
</body>


<style>
	body {
		font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
	}

	.github-cards {
		display: flex;
		flex-flow: row;
		flex-wrap: wrap;
		width: 900px;
	}

	.github-card {
		display: block;
		box-sizing: border-box;
		border: 1px solid #ccc;
		margin: 10px;
		padding: 20px;
		color: #555;
		text-decoration: none;
		font-size: 13px;
		flex: 1;
		min-width: 250px;
	}
	.github-card > h3 {
		margin-top: 0;
		color: #4078c0;
		font-size: 15px;
	}

	.github-card__meta {
		margin-right: 20px;
	}
	.github-card__meta > i {
		font-size: 16px;
	}

	.fa-spinner {
		animation: example 12s linear 0s infinite;
	}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/ada0a3530b.js" crossorigin="anonymous"></script>

<script>
	var div1 = document.createElement('div');
	div1.innerHTML = <?= json_encode($result) ?>;
	repos = div1.getElementsByClassName("col-10 col-lg-9 d-inline-block");	

	for (var i = 0; i < repos.length; i++) {
		var div2 = document.createElement('div');
		div2.innerHTML = '<a target="_blank" href="https://github.com/Walien-dev/" class="github-card"><h3>nexmo-ruby</h3><p>Nexmo REST API client for Ruby</p><span class="github-card__meta"><span class="github-card__language-icon" style="color: #7A0410;font-size:18px;">●</span> </span><span class="github-card__meta"><i class="far fa-star" aria-hidden="true"></i><span data-stars> <i class="fa fa-spinner" aria-hidden="true"></i></span></span><span class="github-card__meta"><i class="fa fa-code-fork" aria-hidden="true"></i><span data-forks> <i class="fa fa-spinner" aria-hidden="true"></i></span></span></a>'

		Repo = repos[i]
		NameRepo = Repo.getElementsByTagName('a')[0].href.split('/')[Repo.getElementsByTagName('a')[0].href.split('/').length - 1]
		DescRepo = Repo.getElementsByTagName('p')[0].innerText
		LanguageRepo = Repo.getElementsByClassName('ml-0 mr-3')[0].getElementsByTagName('span')[1].innerText
		LanguageColorRepo = Repo.getElementsByClassName('repo-language-color')[0].style.backgroundColor

		div2.getElementsByTagName('a')[0].href = div2.getElementsByTagName('a')[0].href + NameRepo
		div2.getElementsByTagName('h3')[0].innerText = NameRepo
		div2.getElementsByTagName('p')[0].innerText = DescRepo
		div2.getElementsByClassName('github-card__meta')[0].innerHTML = div2.getElementsByClassName('github-card__meta')[0].innerHTML + ' ' + LanguageRepo
		div2.getElementsByClassName('github-card__language-icon')[0].style.color = LanguageColorRepo
		

		fetch('https://api.github.com/repos/Walien-dev/YeelightControlPanel-').then(function (response) {
			return response.json();
		}).then(function (response) {
			div2.getElementsByClassName('fa-spinner')[0].innerText = response.stargazers_count
			div2.getElementsByClassName('fa-spinner')[1].innerText = response.forks
			div2.getElementsByClassName('fa-spinner')[0].className = ''
			div2.getElementsByClassName('fa-spinner')[0].className = ''
		});

		document.getElementById('WLNgithub').appendChild(div2)
	}
</script>
