// switch.js - Changement de page SANS RECHARGEMENT
jQuery(document).ready(function($) {
    
    $('.hero-switch .switch-btn').on('click', function(e) {
        e.preventDefault();
        
        var url = $(this).attr('href');
        var $this = $(this);
        
        if ($('body').hasClass('switching')) return;
        $('body').addClass('switching');
        
        $('body').append('<div class="page-loader">Chargement...</div>');
        
        $('.hero-switch .switch-btn').removeClass('switch-active');
        $this.addClass('switch-active');
        
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                var $data = $(data);
                
                // Récupérer le contenu principal
                var newContent = $data.find('.site-main').html();
                $('.site-main').html(newContent);
                
                // Changer la classe du body en fonction de l'URL
                if (url.includes('cdc-bienvenue-sur-pixmatch')) {
                    $('body').removeClass('page-particuliers').addClass('page-cdc');
                } else {
                    $('body').removeClass('page-cdc').addClass('page-particuliers');
                }
                
                // Mettre à jour le titre
                var newTitle = $data.filter('title').text();
                if (newTitle) document.title = newTitle;
                
                // Mettre à jour l'URL
                history.pushState({}, '', url);
                
                $('.page-loader').remove();
                $('body').removeClass('switching');
            },
            error: function() {
                window.location.href = url;
            }
        });
    });
    
    window.addEventListener('popstate', function() {
        location.reload();
    });
});