// filtre-cdc.js - Gestion du filtre pour la page CDC
jQuery(document).ready(function($) {
    
    // Ouvrir la modale
    $('#btn-filter-cdc').on('click', function() {
        $('#filter-modal-cdc').addClass('active');
        $('body').css('overflow', 'hidden');
    });
    
    // Fermer la modale (bouton X)
    $('.close-modal-cdc').on('click', function() {
        $('#filter-modal-cdc').removeClass('active');
        $('body').css('overflow', '');
    });
    
    // Fermer en cliquant en dehors
    $(window).on('click', function(e) {
        if ($(e.target).is('#filter-modal-cdc')) {
            $('#filter-modal-cdc').removeClass('active');
            $('body').css('overflow', '');
        }
    });
    
    // Mise à jour de la valeur du slider
    $('#radius-range-cdc').on('input', function() {
        $('#radius-value-cdc').text($(this).val() + ' km');
    });
    
    // ===== RECHERCHE DE VILLES =====
    var searchTimeout;
    
    $('#city-search-cdc').on('input', function() {
        clearTimeout(searchTimeout);
        var searchTerm = $(this).val().toLowerCase();
        var resultsContainer = $('#search-results-cdc');
        
        if (searchTerm.length < 2) {
            resultsContainer.removeClass('active').empty();
            return;
        }
        
        searchTimeout = setTimeout(function() {
            // Filtrer les villes
            var results = villesFrance.filter(function(ville) {
                return ville.nom.toLowerCase().includes(searchTerm) || 
                       ville.code.includes(searchTerm);
            }).slice(0, 10);
            
            // Afficher les résultats
            if (results.length > 0) {
                var html = '';
                results.forEach(function(ville) {
                    html += '<div class="search-result-item-cdc" data-city="' + ville.nom + '" data-code="' + ville.code + '">';
                    html += '<span class="result-city">' + ville.nom + '</span>';
                    html += '<span class="result-code">' + ville.code + '</span>';
                    html += '</div>';
                });
                resultsContainer.html(html).addClass('active');
            } else {
                resultsContainer.html('<div class="search-result-item-cdc">Aucune ville trouvée</div>').addClass('active');
            }
        }, 300);
    });
    
    // Sélectionner une ville
    $(document).on('click', '.search-result-item-cdc', function() {
        var cityName = $(this).data('city');
        var cityCode = $(this).data('code');
        
        $('#selected-city-cdc .city-name-cdc').text(cityName + ' (' + cityCode + ')');
        $('#selected-city-cdc').show();
        
        $('#city-search-cdc').val('');
        $('#search-results-cdc').removeClass('active').empty();
    });
    
    // Supprimer la ville sélectionnée
    $('.remove-city-cdc').on('click', function() {
        $('#selected-city-cdc').hide();
    });
    
    // Bouton Réinitialiser
    $('.btn-reset-cdc').on('click', function() {
        $('#radius-range-cdc').val(25);
        $('#radius-value-cdc').text('25 km');
        $('#selected-city-cdc').hide();
        $('#city-search-cdc').val('');
        $('input[type="checkbox"]').prop('checked', false);
    });
    
    // Bouton Appliquer
    $('.btn-apply-cdc').on('click', function() {
        $('#filter-modal-cdc').removeClass('active');
        $('body').css('overflow', '');
        
        // Récupérer la ville sélectionnée
        var selectedCity = $('#selected-city-cdc .city-name-cdc').text().split(' ')[0];
        
        // Récupérer les spécialités cochées
        var specialties = [];
        $('input[type="checkbox"]:checked').each(function() {
            specialties.push($(this).val());
        });
        
        // Filtrer les cartes
        $('.pmpros-card').each(function() {
            var card = $(this);
            var city = card.data('city') || '';
            var specialite = card.data('specialite') || '';
            var show = true;
            
            if (selectedCity && city && city.toLowerCase() !== selectedCity.toLowerCase()) {
                show = false;
            }
            
            if (specialties.length > 0 && !specialties.includes(specialite)) {
                show = false;
            }
            
            card.css('display', show ? 'block' : 'none');
        });
        
        // Animation
        $('#btn-filter-cdc').css('background', '#ABAED8');
        setTimeout(function() {
            $('#btn-filter-cdc').css('background', '#FFEB99');
        }, 300);
    });
});