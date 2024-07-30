<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $loremIpsum = " 
Protection des données personnelles
La société ENGYJOB est attentive à la protection des données personnelles et au respect de la vie privée. La présente politique de protection des données personnelles vous informe des traitements mis en place par la société ENGYJOB pour le présent site.
La société ENGYJOB est responsable de traitement, au sens de la réglementation relative aux données à caractère personnel, et notamment du Règlement (UE) 2016/679 relatif à la protection des personnes physiques à l’égard du traitement des données à caractère personnel et à la libre circulation de ces données (ci-après le « RGPD ») :
ENGYJOB, société par actions simplifiée, dont le siège social est situé Balkuy, Ouagadougou, Burkina Faso, inscrite au Registre du Commerce sous le numéro 00180220W.
Quand et pourquoi recueillons-nous des informations à votre sujet ?
Nous recevons des informations de votre part pour permettre leur bonne transmission aux destinataires que vous voulez rencontrer sur notre plateforme. Ces informations permettent à la fois de vérifier l'authenticité des données transmises et d'assurer leur bon aiguillage sur notre logiciel. Certains éléments d'information sont obligatoires pour accéder aux services. Le caractère obligatoire de ces éléments est précisé dans les formulaires pour chaque question, par un astérisque ou par une mention 'obligatoire'.
Quelles informations recueillons-nous ?
Les données personnelles que nous recueillons peuvent inclure votre nom, votre adresse postale et électronique, votre numéro de téléphone fixe et mobile, vos informations bancaires, des informations sur votre société, votre chiffre d'affaires, votre expérience et vos réalisations professionnelles, des images présentant votre profil et vos réalisations, votre ville et votre région, vos offres de service et votre utilisation des services que nous proposons.
Certaines informations et certains commentaires ou contenus (par exemple, photographies, description de profil, mode de travail) que vous fournissez de façon optionnelle peuvent, sous votre responsabilité et à votre initiative, révéler des données sensibles comme votre origine ethnique, votre nationalité ou votre religion. En fournissant ces informations optionnelles, vous assumez l'entière responsabilité de la diffusion de ces informations sensibles sur notre plateforme.
Comment traitons-nous ces données ?
Nous utilisons vos données pour les finalités suivantes :
•    La création, la gestion et le suivi de votre compte sur notre site.
Base légale : exécution d’un contrat ou de mesures précontractuelles.
•    La gestion de vos demandes de contact ou d’information sur nos services
Base légale : exécution d’un contrat ou de mesures précontractuelles ; votre consentement lorsque celui-ci est requis.
•    Assurer le bon fonctionnement, la sécurité et l’amélioration de notre site internet, de ses services et de ses fonctionnalités ; Elaborer des statistiques commerciales
Base légale : notre intérêt légitime à garantir la qualité de notre site internet ; votre consentement lorsque celui-ci est requis.
•    Lutter contre la fraude et respecter nos obligations légales
Base légale : obligations légales
•    
Les données sont transmises à notre plateforme de façon sécurisée grâce au procédé de cryptage https. Nous faisons appel à diverses sociétés qui permettent de fournir nos services (hébergeur web, service d'envoi de mail, terminaux de paiement en ligne entre autres) qui peuvent recevoir, accueillir et traiter ces données. Selon leur sensibilité, différents procédés tels que le cryptage peuvent être appliqués aux données pour les protéger afin qu'elles ne soient pas accessibles ou lisibles. Par exemple, votre mot de passe est crypté à chaque utilisation, ce qui vous permet d'être seul à connaitre la combinaison de caractères que vous avez choisie.
Pour prévenir la fraude et les impayés, tout incident, déclaration fausse ou irrégulière, pourra faire l'objet d'un traitement spécifique destiné à empêcher une utilisation frauduleuse de nos services.
Destinataires et transfert de vos données personnelles
Les données que nous collectons sont accessibles à nos prestataires de services, agissant en qualité de sous-traitants, afin de vous permettre de bénéficier de nos services et d’assurer les finalités visées ci-dessus.
Nous pouvons être amenés à communiquer vos données personnelles à des sous-traitants situés hors du Burkina Faso. En cas de transfert de ce type, nous garantissons que celui-ci est effectué :
•    Vers un pays assurant un niveau de protection adéquat, c’est-à-dire un niveau de protection équivalent à ce que le RGPD exige ;
•    Ou dans le cadre de clauses contractuelles types.
Durées de conservation de vos données personnelles
Vos données sont conservées sous une forme permettant votre identification uniquement pendant le temps nécessaire à l’accomplissement des finalités poursuivies décrites ci-dessus.
Cependant, le traitement des données est possible pour fournir la preuve d’un droit ou d’un contrat. Ces données peuvent également être conservées dans l’objectif de respecter une obligation légale ou gardées dans des fichiers conformément aux règlements et lois applicables.
Par exception :
•    Les données sont conservées pendant une durée de 3 ans à compter de la fin de la relation commerciale ou de notre dernier contact avec vous ;
•    Si vous avez effectué une demande d’exercice de l’un de vos droits sur vos données personnelles : vos données seront conservées pendant une durée de 1 an après votre demande ;
•    Les données personnelles issues des cookies assurant l'analyse de la navigation sur notre site internet sont conservées pendant une durée de 6 mois ;
•    Les données personnelles issues des cookies nécessaires au fonctionnement et à la mesure d’audience de notre site internet sont conservées 25 mois.
Vos droits
Conformément à la réglementation applicable, vous disposez des droits suivants :
Droit d’accès : Vous pouvez accéder à l’ensemble des informations vous concernant, connaître l’origine des informations vous concernant, obtenir la copie de vos données (les frais n’excédant pas le coût de reproduction peuvent vous être demandés), exiger que vos données soient selon les cas, rectifiées, complétées, mises à jour ou supprimées.
Droit de rectification : Ce droit vous permet d’obtenir la rectification des données vous concernant lorsqu’elles sont inexactes, ou que les données incomplètes vous concernant soient complétées.
Droit d’effacement : Ce droit vous permet d’obtenir l’effacement des données vous concernant, sous certaines conditions telles que prévues par l’article 17 du RGPD.
Droit à la limitation du traitement : Vous avez le droit d’obtenir la limitation du traitement lorsque l’une des conditions prévues à l’article 18 du RGPD s’applique.
Droit d’opposition : Vous pouvez vous opposer à tout moment à l’utilisation de certaines de vos données pour des raisons tenant à votre situation particulière.
Droit à la portabilité de vos données : Vous avez le droit de récupérer une copie des données personnelles vous concernant ou d’obtenir leur transfert vers un autre organisme.
Droit d’organiser le sort de vos données personnelles après la mort : Vous avez le droit de nous indiquer vos directives relatives à la conservation, à l’effacement et à la communication de vos données après votre décès, notamment le droit de choisir que nous communiquions (ou non) vos données à un tiers que vous aurez préalablement désigné.
En cas de décès et à défaut d’instructions de votre part, nous nous engageons à détruire vos données, sauf si leur conservation s’avère nécessaire à des fins probatoires ou pour répondre à une obligation légale.
Si vous souhaitez exercer l’un de vos droits, ou si vous avez une question relative à la présente politique vous contacter notre délégué à la protection des données à caractère personnel par e-mail à l’adresse : contact@resusoft.com, en indiquant vos coordonnées (nom, prénom, adresse), et un motif légitime lorsque cela est exigé par la loi (notamment si vous souhaitez exercer votre droit d’opposition au traitement).
Transparence et liberté de choix
Pour vous permettre de choisir les services et traitements qui vous conviennent (lorsque cela est possible), nous vous prévenons explicitement des traitements dont ils peuvent faire l'objet avant de poursuivre votre utilisation des services. Nous affichons notamment des bandeaux d'alerte, des boutons ou coche pour que vous donniez explicitement votre consentement. En validant ces formulaires ou en continuant à utiliser nos services, vous consentez activement à transmettre des informations utilisées dans le cadre de traitements automatisés.
Vous pouvez à tout moment modifier vos préférences d'utilisation de nos services via les formulaires spécifiques. Pour les données nécessitant une authentification renforcée, nous pouvons vous demander de fournir des documents justifiant leur modification afin de prévenir la modification abusive ou frauduleuse des données authentifiées.
Suppression des données personnelles
Vous pouvez à tout moment supprimer vos données personnelles :
•    Depuis votre compte : rendez-vous sur votre espace personnel et cliquez sur 'Supprimer mon compte' en bas à gauche de votre écran.
•    En utilisant les formulaires de contact du site
•    En envoyant un mail à contact@resusoft.com
Chaque demande de suppression des données sera traitée dans les secondes qui suivent sa réception. Toutes les données seront supprimées de nos serveurs et irrécupérables.

Modification
La présente politique de confidentialité peut être amenée à changer. Toute diminution de vos droits dans le cadre de cette politique ne saurait être appliquée sans votre consentement exprès. Toute modification des règles de confidentialité sera indiquée sur cette page et dans le cas de modifications notoires, nous publierons un avertissement et pourrons vous en notifier par email au besoin.

Cookies
Des informations spécifiques peuvent être automatiquement collectées, avec votre accord préalable lorsqu’il est requis, lors de l'usage normal de notre site ou par l'utilisation de cookies (un cookie est un petit fichier, souvent anonyme, contenant des données, notamment un identifiant unique, transmis par le serveur d'un site Internet au navigateur de l’internaute et stocké sur le disque dur de son ordinateur).
Certains cookies nécessaires au bon fonctionnement du site sont obligatoires et ne peuvent être désactivés.
Les données collectées sont notamment : vos adresses IP, données de connexion, types et versions de navigateurs internet utilisés, types et versions des plugins de votre navigateur, systèmes et plateformes d’exploitation, données concernant votre parcours de navigation sur le site, notamment votre parcours sur les différentes pages de notre site internet, les contenus que vous consultez, les termes de recherches utilisés, la durée de consultation de certaines pages, les interactions avec la page.
Pour désactiver le ciblage publicitaire de vos appareils mobiles, vous pouvez suivre les procédures suivantes :
•    Sur iOS, rendez-vous sur les réglages de confidentialité, accédez à l’option 'publicité' et activez le 'suivi publicitaire limité' ;
•    Sur Android, rendez-vous dans l’application 'paramètres Google', activez l’option 'désactiver les annonces par centre d’intérêt' et 'réinitialiser l’identifiant publicitaire'.";
        
Config::insert([
    [
        'type' => 'confidentialité',
        'price' => 29.99,
        'confidentiality' => $loremIpsum
    ],
    [
        'type' => 'sticky',
        'price' => 2000.00,
        'confidentiality' => null
    ],
    [
        'type' => 'hidden',
        'price' => 3500.00,
        'confidentiality' => null
    ]
]);
    }
}
