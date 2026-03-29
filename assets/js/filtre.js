// filtre.js - Gestion de la modale filtre avec recherche de villes
jQuery(document).ready(function($) {
    
    // Ouvrir la modale
    $('#btn-filter').on('click', function() {
        $('#filter-modal').addClass('active');
        $('body').css('overflow', 'hidden');
    });
    
    // Fermer la modale (bouton X)
    $('.close-modal').on('click', function() {
        $('#filter-modal').removeClass('active');
        $('body').css('overflow', '');
    });
    
    // Fermer en cliquant en dehors
    $(window).on('click', function(e) {
        if ($(e.target).is('#filter-modal')) {
            $('#filter-modal').removeClass('active');
            $('body').css('overflow', '');
        }
    });
    
    // Mise à jour de la valeur du slider
    $('#radius-range').on('input', function() {
        $('#radius-value').text($(this).val() + ' km');
    });
    
    // ===== RECHERCHE DE VILLES =====
    var searchTimeout;
    
    // Vérifier que villesFrance est défini
    if (typeof villesFrance !== 'undefined') {
        console.log('✅ villesFrance chargé,', villesFrance.length, 'villes disponibles');
    } else {
        console.error('❌ villesFrance non défini !');
    }
    
    $('#city-search').on('input', function() {
        clearTimeout(searchTimeout);
        var searchTerm = $(this).val().toLowerCase();
        var resultsContainer = $('#search-results');
        
        console.log('🔍 input détecté, recherche =', searchTerm);
        
        if (searchTerm.length < 2) {
            resultsContainer.removeClass('active').empty();
            return;
        }
        
        searchTimeout = setTimeout(function() {
            console.log('⏳ Recherche en cours pour:', searchTerm);
            
            if (typeof villesFrance === 'undefined') {
                console.error('❌ villesFrance non défini');
                return;
            }
            
            console.log('📊 villesFrance disponible,', villesFrance.length, 'villes');
            
            // Filtrer les villes
            var results = villesFrance.filter(function(ville) {
                return ville.nom.toLowerCase().includes(searchTerm) || 
                       ville.code.includes(searchTerm);
            });
            
            console.log('🔎 Résultats trouvés avant slice:', results.length);
            
            results = results.slice(0, 10); // Limiter à 10 résultats
            
            console.log('📋 Résultats après slice:', results.length);
            
            // Afficher les résultats
            if (results.length > 0) {
                var html = '';
                results.forEach(function(ville) {
                    html += '<div class="search-result-item" data-city="' + ville.nom + '" data-code="' + ville.code + '">';
                    html += '<span class="result-city">' + ville.nom + '</span>';
                    html += '<span class="result-code">' + ville.code + '</span>';
                    html += '<span class="result-region">' + ville.region + '</span>';
                    html += '</div>';
                });
                resultsContainer.html(html).addClass('active');
                console.log('✅ Suggestions affichées');
            } else {
                resultsContainer.html('<div class="search-result-item">Aucune ville trouvée</div>').addClass('active');
                console.log('⚠️ Aucune ville trouvée');
            }
        }, 300);
    });
    
   // Sélectionner une ville
$(document).on('click', '.search-result-item', function() {
    var cityName = $(this).data('city');
    var cityCode = $(this).data('code');
    
    console.log('✅ Ville sélectionnée:', cityName, cityCode);
    
    // Afficher la ville sélectionnée
    $('#selected-city .city-name').text(cityName + ' (' + cityCode + ')').show();
    $('#selected-city').show();
    
    // Vérifier que le texte est bien mis
    console.log('Texte après affectation:', $('#selected-city .city-name').text());
    
    // Vider la recherche
    $('#city-search').val('');
    $('#search-results').removeClass('active').empty();
});
    
    // Supprimer la ville sélectionnée
    $('.remove-city').on('click', function() {
        $('#selected-city').hide();
        console.log('🗑️ Ville supprimée');
    });
    
    // Cacher les résultats si on clique ailleurs
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-container').length) {
            $('#search-results').removeClass('active');
        }
    });
    
    // Bouton Réinitialiser
    $('.btn-reset').on('click', function() {
        $('#radius-range').val(25);
        $('#radius-value').text('25 km');
        $('#selected-city').hide();
        $('#city-search').val('');
        $('input[type="checkbox"]').prop('checked', false);
        console.log('🔄 Filtres réinitialisés');
    });
    // Bouton Appliquer (filtrage uniquement par ville)
$('.btn-apply').on('click', function() {
    $('#filter-modal').removeClass('active');
    $('body').css('overflow', '');
    
    // Vérifier ce qu'il y a dans la ville sélectionnée
    console.log('Contenu de #selected-city:', $('#selected-city').html());
    console.log('Texte de .city-name:', $('#selected-city .city-name').text());
    
    // Récupérer la ville sélectionnée
    var selectedCity = $('#selected-city .city-name').text().split(' ')[0];
    
    console.log('selectedCity brut:', $('#selected-city .city-name').text());
    console.log('Filtre appliqué - Ville:', selectedCity);

    // Filtrer les cartes par ville
    var visibleCount = 0;
    $('.pmpros-card').each(function() {
        var card = $(this);
        var city = card.data('city') || '';
        var show = true;

        if (selectedCity && city && city.toLowerCase() !== selectedCity.toLowerCase()) {
            show = false;
        }

        card.css('display', show ? 'block' : 'none');
        if (show) visibleCount++;
    });
    
    console.log('Cartes visibles après filtrage:', visibleCount);

    // Animation de confirmation
    $('#btn-filter').css('background', '#FFEB99');
    setTimeout(function() {
        $('#btn-filter').css('background', '#ABAED8');
    }, 300);
});
});