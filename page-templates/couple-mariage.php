<?php
/**
 * Template Name: Couple & Mariage
 */

get_header();
?>

<div class="page-couple-mariage">
    
    <!-- IMAGE D'ACCUEIL -->
<div class="hero-container">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/coupleetmariageaccueil.jpg" alt="Couple et Mariage" class="image-accueil">
</div>

<!-- TITRE SOUS L'IMAGE -->
<div class="page-title-container">
    <h1 class="page-title-couple">Couple & Mariage</h1>
</div>

<!-- BOUTON RETOUR ET FILTRES -->
<div class="action-bar">
    <a class="tips-back" href="<?php echo esc_url(home_url('/accueil-particuliers')); ?>">Retour</a>
    <button class="btn-filter" id="btn-filter" type="button">
        Filtres <span class="filter-icon" aria-hidden="true">≡</span>
    </button>
</div>

<!-- MODALE FILTRE -->
<div id="filter-modal" class="filter-modal">
    <div class="filter-modal-content">
        <div class="filter-modal-header">
            <h2>Filtres</h2>
            <span class="close-modal">&times;</span>
        </div>
        
        <div class="filter-modal-body">
            
            <!-- LOCALISATION AVEC RECHERCHE VILLE -->
<div class="filter-section">
    <h3>Localisation</h3>
    <div class="filter-location">
        
        <!-- RECHERCHE VILLE -->
        <div class="location-search">
            <label for="city-search">Ville ou code postal</label>
            <div class="search-container">
                <input type="text" id="city-search" class="city-input" placeholder="Ex: Paris, Lyon, 75001..." autocomplete="off">
                <div class="search-results" id="search-results"></div>
            </div>
        </div>
        
        <!-- RAYON -->
        <div class="location-radius">
            <span>📍</span>
            <div class="radius-control">
                <label>Dans un rayon de</label>
                <div class="radius-slider">
                    <input type="range" id="radius-range" min="1" max="100" value="25">
                    <span class="radius-value" id="radius-value">25 km</span>
                </div>
            </div>
        </div>
        
        <!-- VILLE SÉLECTIONNÉE (affichée après recherche) -->
        <div class="selected-city" id="selected-city" style="display: none;">
            <span class="city-name"></span>
            <button class="remove-city">✕</button>
        </div>
        
    </div>
</div>
            
            <!-- TARIFS -->
            <div class="filter-section">
                <h3>Tarifs</h3>
                <div class="filter-price">
                    <div class="price-input">
                        <label>Minimum</label>
                        <div class="price-field">
                            <span class="currency">€</span>
                            <input type="number" value="9" min="0" step="5">
                        </div>
                    </div>
                    <div class="price-input">
                        <label>Maximum</label>
                        <div class="price-field">
                            <span class="currency">€</span>
                            <input type="number" value="250" min="0" step="10">
                        </div>
                        <span class="price-plus">+</span>
                    </div>
                </div>
            </div>
            
            <!-- SPÉCIALITÉ -->
            <div class="filter-section">
                <h3>Spécialité</h3>
                <div class="filter-checkboxes">
                    <label class="checkbox-label">
                        <input type="checkbox"> Monteur-Vidéo
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox"> Photographe
                    </label>
                </div>
            </div>
            
            <!-- CATÉGORIE -->
            <div class="filter-section">
                <h3>Catégorie</h3>
                <div class="filter-checkboxes grid-2">
                    <label class="checkbox-label">
                        <input type="checkbox"> Mariage
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox"> Famille
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox"> EVJF
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox"> Anniversaire
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox"> Maternité
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox"> Remise de Diplôme
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox"> Baptême
                    </label>
                </div>
            </div>
            
        </div>
        
        <div class="filter-modal-footer">
            <button class="btn-reset">Réinitialiser</button>
            <button class="btn-apply">Appliquer</button>
        </div>
    </div>
</div>
    <main class="container">

        <!-- GRILLE DE PROFESSIONNELS -->
        <section class="grid">
            <?php for ($i = 1; $i <= 12; $i++) : ?>
            <article class="card">
                <button class="nav-in-card nav-left" aria-label="Précédent">‹</button>
                <button class="nav-in-card nav-right" aria-label="Suivant">›</button>
                <img class="card-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/photocarre1.avif" alt="Photo couple" />
                <div class="card-overlay">
                    <div class="card-name">Henri Cartier-Bresson</div>
                    <div class="card-stars">★★★★★</div>
                    <div class="card-city">Orléans</div>
                </div>
            </article>
            <?php endfor; ?>
        </section>

        <!-- BOUTON EN VOIR PLUS -->
        <div class="more-wrap">
            <button class="btn-more" type="button">En voir plus</button>
        </div>

        <br><br>

        <!-- SECTION CONSEILS -->
        <section class="tips">
            <h2 class="tips-title">Comment choisir le match parfait pour votre mariage ?</h2>
            <br><br>
            <div class="tips-columns">
                <p>
                    COUPLE &amp; MARIAGE Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. COUPLE &amp; MARIAGE Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <p>
                    COUPLE &amp; MARIAGE Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. COUPLE &amp; MARIAGE Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
            <br><br>
            <a class="tips-back1" href="<?php echo esc_url(home_url('/accueil-particuliers')); ?>">Retour</a>
        </section>

    </main>

</div>

<?php
get_footer();
?>