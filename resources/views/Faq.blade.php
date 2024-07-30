@extends('layouts.app_project')
<!DOCTYPE html>
<html lang="en">
	<head> 
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
		<title>EngyJob</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
				
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
	</head>		
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
					
			<!-- Start Navigation -->
			<!-- Header -->
			
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="bread-crumb-bar">
				<div class="container">
					<div class="row align-items-center inner-banner">
						<div class="col-md-12 col-12 text-center">
							<div class="breadcrumb-list">
								<h3>FAQ</h3>
								<nav aria-label="breadcrumb" class="page-breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="{{route('welcome')}}"> Maison</a></li>
										<li class="breadcrumb-item" aria-current="page">Faq</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container">
					
					<div class="row">
						<div class="col-md-12">
							
							<!-- FAQ Content -->
							<div class="faq p-0">
							<div id="accordion">
							
							<!-- Basic FAQ Content -->
							<div class="basics-faq">
								<h4>NOTIONS DE BASE</h4>
								
								<!-- FAQ Content -->
								<div class="card">
									<a class="card-link" data-bs-toggle="collapse" href="#collapseOne">
										<div class="card-header">																		  
											Questions générales sur EngyJob <i class="fa fa-angle-right"></i>
										</div>
									</a>								 
									<div id="collapseOne" class="collapse" data-parent="#accordion">
										<div class="card-body">
											EngyJob est une plateforme innovante conçue pour faciliter la mise en relation entre freelancers et entreprises. Que vous soyez à la recherche de talents pour vos projets ou que vous soyez un freelanceur cherchant des opportunités, EngyJob offre un espace dynamique où les compétences rencontrent les besoins. Grâce à notre interface conviviale et à nos outils avancés, nous facilitons le processus de collaboration tout en garantissant une expérience transparente et efficace pour toutes les parties impliquées.
										</div>
									</div>
								</div>
								<!-- /FAQ Content -->
								
								<!-- FAQ Content -->
								<div class="card">
									<a class="collapsed card-link" data-bs-toggle="collapse" href="#collapseTwo">	
										<div class="card-header">																	
											Comment fonctionne EngyJob?	<i class="fa fa-angle-right"></i>										
										</div>
									</a>
								  <div id="collapseTwo" class="collapse" data-parent="#accordion">
									<div class="card-body">
									 EngyJob fonctionne en connectant les freelancers et les entreprises à travers une plateforme intuitive et efficace. Voici comment cela se déroule :

Inscription et Profilage : Les freelancers et les entreprises s'inscrivent sur EngyJob et créent leur profil détaillé, mettant en avant leurs compétences, expériences et préférences.

Recherche et Filtrage : Les entreprises peuvent explorer une variété de profils de freelancers en utilisant des filtres comme les compétences spécifiques, l'expérience passée, et plus encore. De même, les freelancers peuvent rechercher des opportunités de projet qui correspondent à leurs compétences et intérêts.

Soumission des Projets : Les entreprises publient des projets détaillés, incluant les exigences, le budget et les délais. Les freelancers intéressés peuvent soumettre leurs propositions en démontrant leur expertise et leur capacité à répondre aux besoins du projet.

Sélection et Collaboration : Les entreprises évaluent les propositions des freelancers et sélectionnent ceux qui correspondent le mieux à leurs critères. Une fois sélectionnés, les freelancers et les entreprises peuvent collaborer directement sur la plateforme EngyJob, en utilisant ses outils intégrés pour gérer les projets, les paiements et les communications.
									</div>
								  </div>
								</div>
								<!-- /FAQ Content -->
								
								<!-- FAQ Content -->
								
								<!-- /FAQ Content -->
								
								
								<!-- /FAQ Content -->
							</div>
							<!-- /Basic FAQ Content -->
							
							<!-- Account FAQ Content -->
							<div class="basics-faq">							
								<h4>Support et assistance</h4>
							
								<div class="card">
									<a class="card-link" data-bs-toggle="collapse" href="#accOne">
										<div class="card-header">																		  
											Comment puis-je contacter le support client ? <i class="fa fa-angle-right"></i>
										</div>
									</a>								 
									<div id="accOne" class="collapse" data-parent="#accordion">
										<div class="card-body">
											Pour contacter notre service clientèle chez EngyJob, nous mettons à votre disposition plusieurs options :

Support par Email : Vous pouvez nous contacter par email à l'adresse support@engyjob.com. Notre équipe de support clientèle est disponible pour répondre à vos questions, résoudre vos problèmes et vous fournir l'assistance nécessaire.

Assistance Téléphonique : Nous offrons également un support téléphonique. Vous pouvez nous appeler au numéro suivant : +1234567890. Nos agents sont prêts à vous aider du lundi au vendredi, de 9h à 17h, heure locale.
										</div>
									</div>
								</div>
								
								<div class="card">
									<a class="collapsed card-link" data-bs-toggle="collapse" href="#accTwo">	
										<div class="card-header">																	
											Quelle est la politique de remboursement ?	<i class="fa fa-angle-right"></i>										
										</div>
									</a>
								  <div id="accTwo" class="collapse" data-parent="#accordion">
									<div class="card-body">
									 Notre politique de remboursement chez EngyJob vise à garantir la satisfaction de nos utilisateurs dans toutes les interactions. Voici les principes clés de notre politique :

Annulation avant le début du service : Si vous décidez d'annuler votre commande avant le début du service, vous pouvez demander un remboursement intégral. Assurez-vous de contacter notre service clientèle dans les meilleurs délais pour initier le processus.

Annulation après le début du service : Si vous avez déjà commencé à utiliser nos services et que vous rencontrez un problème, veuillez nous contacter immédiatement. Nous évaluerons la situation au cas par cas pour déterminer la possibilité d'un remboursement partiel en fonction de la période de service utilisée.


									</div>
								  </div>
								</div>
								
								<div class="card">
									<a class="collapsed card-link" data-bs-toggle="collapse" href="#accThree">		
										<div class="card-header">
											Quelle est la politique de résolution des conflits entre freelancers et entreprises ? <i class="fa fa-angle-right"></i>
										</div>
									</a>									
									<div id="accThree" class="collapse" data-parent="#accordion">
										<div class="card-body">
										Chez EngyJob, nous comprenons l'importance d'une résolution rapide et équitable des conflits entre freelancers et entreprises. Notre politique de résolution des conflits vise à garantir une expérience positive pour toutes les parties impliquées. Voici les principes clés de notre approche :

Communication ouverte : Nous encourageons freelancers et entreprises à communiquer directement pour résoudre tout différend dès qu'il se présente. La communication ouverte et constructive est souvent la clé pour éviter les malentendus et trouver des solutions mutuellement acceptables.

Médiation : En cas de difficultés persistantes, nous facilitons la médiation entre les parties. Un médiateur impartial peut aider à clarifier les problèmes et à proposer des solutions qui tiennent compte des intérêts de chacun.

Évaluation équitable : Nous évaluons chaque cas individuellement, en tenant compte des preuves et des témoignages fournis par les freelancers et les entreprises. Notre objectif est de parvenir à une résolution qui soit juste et équitable pour toutes les parties concernées.


										</div>
									</div>
								</div>
							</div>
							<!-- /Account FAQ Content -->
							
							<!-- Privacy FAQ Content -->							
							<div class="basics-faq mb-4">
								<h4>Questions spécifiques aux freelancers</h4>
							
								<div class="card">
									<a class="card-link" data-bs-toggle="collapse" href="#PrivacyOne">
										<div class="card-header">																		  
											Comment les freelancers peuvent-ils promouvoir leurs services sur EngyJob ? <i class="fa fa-angle-right"></i>
										</div>
									</a>								 
									<div id="PrivacyOne" class="collapse" data-parent="#accordion">
										<div class="card-body">
											Les freelancers peuvent promouvoir efficacement leurs services sur EngyJob en suivant ces stratégies clés :

Création d'un profil complet et attractif : Assurez-vous de remplir tous les détails de votre profil de manière exhaustive. Incluez une biographie professionnelle engageante, mettez en avant vos compétences clés, et téléchargez un portfolio de vos meilleurs travaux si possible. Un profil complet et professionnel attire davantage l'attention.

Utilisation de mots-clés pertinents : Optimisez votre profil en utilisant des mots-clés spécifiques à votre domaine d'expertise. Cela améliorera votre visibilité dans les résultats de recherche lorsque les entreprises recherchent des freelancers pour des projets spécifiques.
Options de promotion payantes : EngyJob offre également des options de promotion payantes qui mettent en avant votre profil ou vos services dans les résultats de recherche ou sur la page d'accueil. Vous pouvez payer pour avoir votre profil en haut de page, augmentant ainsi significativement votre visibilité auprès des entreprises cherchant à embaucher des freelancers qualifiés.
										</div>
									</div>
								</div>
								
								<div class="card">
									<a class="collapsed card-link" data-bs-toggle="collapse" href="#PrivacyTwo">	
										<div class="card-header">																	
											Quels types de projets peuvent être trouvés sur EngyJob?<i class="fa fa-angle-right"></i>										
										</div>
									</a>
								  <div id="PrivacyTwo" class="collapse" data-parent="#accordion">
									<div class="card-body">
									 Sur EngyJob, vous pouvez trouver une large variété de projets dans différents domaines. Voici quelques types de projets courants que vous pouvez découvrir sur la plateforme :

Développement Web et Applications : Projets de création de sites web, applications mobiles, développement de plugins, etc.

Design Graphique et Créatif : Conception de logos, branding, illustration, design d'interfaces utilisateur (UI), design de produits, etc.

Rédaction et Traduction : Rédaction de contenus, révision et correction de textes, traduction de documents, etc.

Marketing Digital : Campagnes publicitaires, gestion des réseaux sociaux, SEO (optimisation pour les moteurs de recherche), marketing par e-mail, etc.

Services Techniques et IT : Support informatique, gestion des systèmes, administration de bases de données, sécurité informatique, etc.

Consultation et Business : Conseil en gestion, études de marché, planification stratégique, développement commercial, etc.

Services Créatifs : Vidéo et animation, voix off, musique et audio, photographie, etc.

Support Administratif : Gestion de projet, assistance virtuelle, service client, saisie de données, etc.

Éducation et Formation : Développement de cours en ligne, tutorat, formation professionnelle, etc.
									</div>
								  </div>
								</div>
								
								<div class="card">
									<a class="collapsed card-link" data-bs-toggle="collapse" href="#PrivacyThree">		
										<div class="card-header">
											Existe-t-il des outils ou des ressources pour aider les freelancers à améliorer leurs compétences ou à gérer leurs projets ? <i class="fa fa-angle-right"></i>
										</div>
									</a>									
									<div id="PrivacyThree" class="collapse" data-parent="#accordion">
										<div class="card-body">
										 Réseautage et Collaboration : EngyJob facilite le réseautage entre freelancers et clients potentiels, offrant ainsi des opportunités de collaboration et d'expansion du réseau professionnel.

Bibliothèque de Formation Continue : Une bibliothèque de ressources étendue comprenant des cours en ligne, des articles spécialisés, et des livres électroniques pour permettre aux freelancers de continuer à apprendre et à se développer dans leur domaine.

Plateforme de Portfolio : Les freelancers peuvent créer et mettre en valeur leur portfolio professionnel sur EngyJob, ce qui leur permet de présenter leurs compétences et leurs réalisations de manière attrayante aux clients potentiels.

Notifications d'Opportunités : Des alertes personnalisées sur les nouvelles offres de projets correspondant aux compétences et aux intérêts des freelancers, les aidant ainsi à trouver et à postuler rapidement aux opportunités pertinentes.
										</div>
									</div>
								</div>
							</div>
							<!-- /Privacy FAQ Content -->
							
							</div>
							</div>
							<!-- /FAQ Content -->
								
						</div>
					</div>

				</div>

			</div>					
			<!-- /Page Content -->
   
			<!-- Footer -->	
			<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="footer-widget">
                        <h2 class="footer-title">À propos de nous</h2>
                        <p>Nous sommes toujours à la recherche de personnes talentueuses et motivées. N'hésitez pas à vous présenter !</p>
                        <ul class="list-inline social-icons">
                            <li class="list-inline-item"><a href="javascript:void(0);"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0);"><i class="fa-brands fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0);"><i class="fa-brands fa-linkedin"></i></a></li>
                        </ul>
                        <a href="javascript:void(0);" class="btn btn-connectus">En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="footer-widget">
                        <h2 class="footer-title">Liens utiles</h2>
                        <ul class="links">
                            <li><a href="{{route('contact')}}"><i class="fas fa-angle-right me-1"></i>À propos de nous</a></li>
                            <li><a href="{{route('login')}}"><i class="fas fa-angle-right me-1"></i>Connexion</a></li>
                            <li><a href="{{route('register')}}"><i class="fas fa-angle-right me-1"></i>Inscription</a></li>
                            <li><a href="/password.reset"><i class="fas fa-angle-right me-1"></i>Mot de passe oublié</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="footer-widget">
                        <h2 class="footer-title">Support d'aide</h2>
                        <ul class="links">
                            <li><a href="javascript:void(0);"><i class="fas fa-angle-right me-1"></i>Parcourir les candidats</a></li>
                            <li><a href="javascript:void(0);"><i class="fas fa-angle-right me-1"></i>Listes des projets</a></li>
                            <li><a href="javascript:void(0);"><i class="fas fa-angle-right me-1"></i>Emplois en vedette</a></li>
                            <li><a href="javascript:void(0);"><i class="fas fa-angle-right me-1"></i>Publier une offre</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="footer-widget">
                        <h2 class="footer-title">Connectez-vous avec nous</h2>
                        <ul class="links">
                            <li><a href="{{route('Faq')}}"><i class="fas fa-angle-right me-1"></i>FAQ</a></li>
                            <li><a href="{{route('freelancers.reviews')}}"><i class="fas fa-angle-right me-1"></i>Commentaires</a></li>
                            <li><a href=""><i class="fas fa-angle-right me-1"></i>Politique de confidentialité</a></li>
                            <li><a href=""><i class="fas fa-angle-right me-1"></i>Conditions d'utilisation</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright text-center">
                        <p class="mb-0">Copyright 2024 © RESUSOFT. Tous droits réservés.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Footer Bottom -->
</footer>
			<!-- /Footer -->
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="assets/js/jquery-3.7.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Slick JS -->
		<script src="assets/js/slick.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>
</html>