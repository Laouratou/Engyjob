'use strict';

$(document).ready(function() {
    // Fonction pour vérifier l'existence d'un élément dans le DOM
    function checkElementExists(selector) {
        return document.querySelector(selector) !== null;
    }

    // Fonction pour rendre le graphique linéaire
    function renderLineChart(data, title, elementId, color) {
        if (checkElementExists(elementId)) {
            var optionsLine = {
                series: [{
                    name: title,
                    data: data
                }],
                chart: {
                    height: 360,
                    type: 'line',
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                dataLabels: { enabled: false },
                colors: [color],
                stroke: {
                    curve: 'smooth',
                    width: [2]
                },
                markers: {
                    size: 4,
                    colors: [color],
                    strokeColors: color,
                    strokeWidth: 2,
                    hover: { size: 7 }
                },
                grid: {
                    position: 'front',
                    borderColor: '#ddd',
                    strokeDashArray: 5,
                    xaxis: { lines: { show: true } }
                },
                xaxis: {
                    categories: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                    lines: { show: false }
                },
                yaxis: {
                    lines: { show: true }
                }
            };

            var chartLine = new ApexCharts(document.querySelector(elementId), optionsLine);
            chartLine.render().catch(err => console.error("Erreur de rendu du graphique linéaire :", err));
        } else {
            console.error("Élément avec l'ID", elementId, "n'existe pas dans le DOM.");
        }
    }

    // Fonction pour rendre le graphique radial
    function renderRadialChart(data, labels, elementId, colors) {
        if (checkElementExists(elementId)) {
            var optionsRadial = {
                series: data,
                chart: {
                    toolbar: { show: false },
                    height: 250,
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        offsetY: 0,
                        startAngle: 0,
                        endAngle: 270,
                        hollow: {
                            margin: 5,
                            size: '50%',
                            background: 'transparent',
                        },
                        dataLabels: {
                            name: { show: false },
                            value: { show: true, color: '#333', fontSize: '16px' }
                        }
                    }
                },
                colors: colors,
                labels: labels,
                legend: { show: false }
            };

            console.log("Options du graphique radial:", optionsRadial); // Log des options pour le débogage

            var chartRadial = new ApexCharts(document.querySelector(elementId), optionsRadial);
            chartRadial.render().catch(err => console.error("Erreur de rendu du graphique radial :", err));
        } else {
            console.error("Élément avec l'ID", elementId, "n'existe pas dans le DOM.");
        }
    }

    // Fonction pour récupérer et afficher les données des graphiques radiaux
    function fetchAndRenderRadialCharts() {
        // Récupération des projets publiés
        $.ajax({
            url: '/published-projects',
            method: 'GET',
            success: function(publishedProjectsData) {
                const publishedProjectsCount = publishedProjectsData.total_projects || 0;
                console.log("Projets publiés :", publishedProjectsCount);

                // Récupération des propositions reçues
                $.ajax({
                    url: '/proposals-received',
                    method: 'GET',
                    success: function(proposalsReceivedData) {
                        const receivedProposalsCount = proposalsReceivedData.total_proposals || 0;
                        console.log("Propositions reçues :", receivedProposalsCount);

                        // Récupération des projets embauchés
                        $.ajax({
                            url: '/hired-projects',
                            method: 'GET',
                            success: function(hiredProjectsData) {
                                // Vérifiez la structure de la réponse et ajustez si nécessaire
                                console.log("Données reçues pour les projets embauchés :", hiredProjectsData);

                                const hiredProjects = hiredProjectsData.count || 0;
                                console.log("Projets embauchés :", hiredProjects);

                                // Déterminez les données et couleurs pour le graphique radial
                                const data = [publishedProjectsCount, receivedProposalsCount, hiredProjects];
                                const labels = ['Projets Publiés', 'Propositions Reçues', 'Projets Embauchés'];
                                
                                // Couleurs par défaut
                                const colors = ["#6a0dad", "#F0E500", "#FF007F"]; // Couleurs : violet, jaune, rose

                                // Vérifiez si des projets sont embauchés pour ajuster la couleur
                                if (hiredProjects > 0) {
                                    // Utilisez la couleur rose si des projets sont embauchés
                                    colors[2] = "#FF007F"; // Rose
                                } else {
                                    // Réinitialisez les données et la couleur pour les projets embauchés si aucun projet n'est embauché
                                    data[2] = 0;
                                    colors[2] = "#CCCCCC"; // Gris clair pour représenter l'absence de données
                                }

                                // Rendu du graphique radial
                                if (checkElementExists("#chartLineCompany")) {
                                    console.log("Données pour le graphique radial avant le rendu: ", data);
                                    renderRadialChart(data, labels, "#chartLineCompany", colors);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Erreur lors de la récupération des projets embauchés :", error);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Erreur lors de la récupération des propositions reçues :", error);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors de la récupération du nombre de projets publiés :", error);
            }
        });

        // Récupération des autres données pour les graphiques radiaux
        $.ajax({
            url: '/proposed-projects',
            method: 'GET',
            success: function(proposedProjectsData) {
                const proposedProjects = proposedProjectsData.count || 0;
                console.log("Projets proposés :", proposedProjects);

                $.ajax({
                    url: '/hired-projects',
                    method: 'GET',
                    success: function(hiredProjectsData) {
                        const hiredProjects = hiredProjectsData.count || 0;
                        console.log("Projets embauchés :", hiredProjects);

                        $.ajax({
                            url: '/user-proposals-count',
                            method: 'GET',
                            success: function(userProposalsData) {
                                const userProposalsCount = userProposalsData.count || 0;
                                console.log("Propositions de l'utilisateur :", userProposalsCount);

                                $.ajax({
                                    url: '/favorite-projects',
                                    method: 'GET',
                                    success: function(favoriteProjectsData) {
                                        const favoriteProjectsCount = favoriteProjectsData.count || 0;
                                        console.log("Projets favoris :", favoriteProjectsCount);

                                        if (checkElementExists("#chartradial")) {
                                            renderRadialChart(
                                                [proposedProjects, hiredProjects, userProposalsCount, favoriteProjectsCount],
                                                ['Projets Proposés', 'Projets Embauchés', 'Propositions', 'Projets Favoris'],
                                                "#chartradial",
                                                ['#7B46BE', '#FA6CA4', '#F0E500', '#24C0DC'] // Couleurs : violet, rose, jaune, bleu clair
                                            );
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("Erreur lors de la récupération du nombre de projets favoris :", error);
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error("Erreur lors de la récupération du nombre de propositions de l'utilisateur :", error);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Erreur lors de la récupération des projets embauchés :", error);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors de la récupération des projets proposés :", error);
            }
        });
    }

    // Fonction pour récupérer et afficher les données des graphiques linéaires
    function fetchAndRenderLineCharts() {
        if (checkElementExists("#chartprofile")) {
            $.ajax({
                url: '/api/propositions-per-month',
                method: 'GET',
                success: function(data) {
                    const userPropositions = Array(12).fill(0);

                    data.forEach(item => {
                        const monthIndex = item.month - 1;
                        if (monthIndex >= 0 && monthIndex < 12) {
                            userPropositions[monthIndex] = item.count;
                        }
                    });

                    console.log("Propositions par mois :", userPropositions);

                    if (checkElementExists("#chartprofile")) {
                        renderLineChart(userPropositions, "Propositions par mois", "#chartprofile", "#FF5B37");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Erreur lors de la récupération des propositions :", error);
                }
            });
        }

        if (checkElementExists("#charttransactions")) {
            $.ajax({
                url: '/transactions-per-month',
                method: 'GET',
                success: function(data) {
                    const monthlyTransactions = Array(12).fill(0);

                    if (Array.isArray(data)) {
                        data.forEach(item => {
                            if (item.month >= 1 && item.month <= 12 && item.total_transactions !== undefined) {
                                const monthIndex = item.month - 1;
                                monthlyTransactions[monthIndex] = item.total_transactions;
                            } else {
                                console.error("Donnée invalide pour le mois :", item.month);
                            }
                        });

                        console.log("Transactions par mois :", monthlyTransactions);

                        if (checkElementExists("#charttransactions")) {
                            renderLineChart(monthlyTransactions, "Transactions par mois", "#charttransactions", "#00C8F2");
                        }
                    } else {
                        console.error("Format de données invalide pour les transactions :", data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Erreur lors de la récupération des transactions :", error);
                }
            });
        }
    }

    // Appel des fonctions pour récupérer et afficher les données
    fetchAndRenderRadialCharts();
    fetchAndRenderLineCharts();
});
