/*
Author       : Dreamguys
Template Name: Kofejob - Bootstrap Admin Template
Version      : 1.0
*/

(function ($) {
    "use strict";

    // Variables declarations

    var $wrapper = $('.main-wrapper');
    var $pageWrapper = $('.page-wrapper');
    var $slimScrolls = $('.slimscroll');

    feather.replace();

    // Sidebar
    var Sidemenu = function () {
        this.$menuItem = $('#sidebar-menu a');
    };

    function init() {
        var $this = Sidemenu;
        $('#sidebar-menu a').on('click', function (e) {
            if ($(this).parent().hasClass('submenu')) {
                e.preventDefault();
            }
            if (!$(this).hasClass('subdrop')) {
                $('ul', $(this).parents('ul:first')).slideUp(350);
                $('a', $(this).parents('ul:first')).removeClass('subdrop');
                $(this).next('ul').slideDown(350);
                $(this).addClass('subdrop');
            } else if ($(this).hasClass('subdrop')) {
                $(this).removeClass('subdrop');
                $(this).next('ul').slideUp(350);
            }
        });
        $('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
    }

    // Sidebar Initiate
    init();

    // Check All

    /*document.getElementById('select-all').onclick = function() {
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
      }
    }*/

    // Mobile menu sidebar overlay
    $('body').append('<div class="sidebar-overlay"></div>');
    $(document).on('click', '#mobile_btn', function () {
        $wrapper.toggleClass('slide-nav');
        $('.sidebar-overlay').toggleClass('opened');
        $('html').addClass('menu-opened');
        return false;
    });

    // Sidebar overlay
    $(".sidebar-overlay").on("click", function () {
        $wrapper.removeClass('slide-nav');
        $(".sidebar-overlay").removeClass("opened");
        $('html').removeClass('menu-opened');
    });

    // Page Content Height
    if ($('.page-wrapper').length > 0) {
        var height = $(window).height();
        $(".page-wrapper").css("min-height", height);
    }

    // Page Content Height Resize
    $(window).resize(function () {
        if ($('.page-wrapper').length > 0) {
            var height = $(window).height();
            $(".page-wrapper").css("min-height", height);
        }
    });

    // Select 2
    if ($('.select').length > 0) {
        $('.select').select2({
            minimumResultsForSearch: -1,
            width: '100%'
        });
    }

    // Datetimepicker

    if ($('.datetimepicker').length > 0) {
        $('.datetimepicker').datetimepicker({
            format: 'DD-MM-YYYY',
            icons: {
                up: "fas fa-angle-up",
                down: "fas fa-angle-down",
                next: 'fas fa-angle-right',
                previous: 'fas fa-angle-left'
            }
        });
    }

    // Tooltip
    if ($('[data-toggle="tooltip"]').length > 0) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // Datatable
    if ($('.datatable').length > 0) {
        $('.datatable').DataTable({
            // "bFilter": false,
            language: {
                processing: "Traitement en cours...",
                search: "Rechercher&nbsp;:",
                lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix: "",
                loadingRecords: "Chargement en cours...",
                zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable: "Aucune donnée disponible dans le tableau",
                paginate: {
                    first: "Premier",
                    previous: "Pr&eacute;c&eacute;dent",
                    next: "Suivant",
                    last: "Dernier"
                },
                aria: {
                    sortAscending: ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
    }

    // Sidebar Slimscroll
    if ($slimScrolls.length > 0) {
        $slimScrolls.slimScroll({
            height: 'auto',
            width: '100%',
            position: 'right',
            size: '7px',
            color: '#ccc',
            allowPageScroll: false,
            wheelStep: 10,
            touchScrollStep: 100
        });
        var wHeight = $(window).height() - 60;
        $slimScrolls.height(wHeight);
        $('.sidebar .slimScrollDiv').height(wHeight);
        $(window).resize(function () {
            var rHeight = $(window).height() - 60;
            $slimScrolls.height(rHeight);
            $('.sidebar .slimScrollDiv').height(rHeight);
        });
    }

    // Password Show

    if ($('.toggle-password').length > 0) {
        $(document).on('click', '.toggle-password', function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $(".pass-input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }

    // Check all email

    $(document).on('click', '#check_all', function () {
        $('.checkmail').click();
        return false;
    });
    if ($('.checkmail').length > 0) {
        $('.checkmail').each(function () {
            $(this).on('click', function () {
                if ($(this).closest('tr').hasClass('checked')) {
                    $(this).closest('tr').removeClass('checked');
                } else {
                    $(this).closest('tr').addClass('checked');
                }
            });
        });
    }

    // Mail important

    $(document).on('click', '.mail-important', function () {
        $(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o');
    });

    // Small Sidebar
    $(document).on('click', '#toggle_btn', function () {
        if ($('body').hasClass('mini-sidebar')) {
            $('body').removeClass('mini-sidebar');
            $('.subdrop + ul').slideDown();
        } else {
            $('body').addClass('mini-sidebar');
            $('.subdrop + ul').slideUp();
        }
        return false;
    });

    $(document).on('mouseover', function (e) {
        e.stopPropagation();
        if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
            var targ = $(e.target).closest('.sidebar').length;
            if (targ) {
                $('body').addClass('expand-menu');
                $('.subdrop + ul').slideDown();
            } else {
                $('body').removeClass('expand-menu');
                $('.subdrop + ul').slideUp();
            }
            return false;
        }
    });

    $(document).on('click', '#filter_search', function () {
        $('#filter_inputs').slideToggle("slow");
    });

    // Chat

    var chatAppTarget = $('.chat-window');
    (function () {
        if ($(window).width() > 991)
            chatAppTarget.removeClass('chat-slide');

        $(document).on("click", ".chat-window .chat-users-list a.media", function () {
            if ($(window).width() <= 991) {
                chatAppTarget.addClass('chat-slide');
            }
            return false;
        });
        $(document).on("click", "#back_user_list", function () {
            if ($(window).width() <= 991) {
                chatAppTarget.removeClass('chat-slide');
            }
            return false;
        });
    })();

    if ($('#chart').length > 0) {
        var options = {
            series: [{
                name: 'freelance Developers',
                color: '#ff5b37',
                data: [31, 40, 28, 51, 42, 109, 100]
            }, {
                name: 'Developers per project',
                color: '#ffb8a8',
                data: [11, 32, 45, 32, 34, 52, 41]
            }, {
                name: 'completed projects',
                color: '#feb019',
                data: [12, 36, 42, 30, 39, 58, 40]
            }],
            chart: {
                height: 335,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },

            xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }

    // Project Chart

    // Logo Hide Btn

    $(document).on("click", ".logo-hide-btn", function () {
        $(this).parent().hide();
    });

    // Summernote

    if ($('.summernote').length > 0) {
        $('.summernote').summernote({
            height: 200,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]			// set focus to editable area after initializing summernote
        });
    }

    // Experience Add More

    $(".settings-form").on('click', '.trash', function () {
        $(this).closest('.links-cont').remove();
        return false;
    });

    $(document).on("click", ".add-links", function () {
        var experiencecontent = '<div class="row form-row links-cont">' +
            '<div class="col-12 col-md-11">' +
            '<div class="form-group d-flex">' +
            '<button class="btn social-icon"><i class="feather-github"></i></button>' +
            '<input type="text" class="form-control" placeholder="Social Link">' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-1 col-lg-1"><a href="#" class="btn trash"><i class="feather-trash-2"></i></a></div>' +
            '</div>';

        $(".settings-form").append(experiencecontent);
        return false;
    });

    // Editor
    if ($('#editor').length > 0) {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['bold', 'italic', 'link']
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    }

})(jQuery);
