<?php
/**
 * Template Name: PixMatch - Accueil Particuliers
 */

get_header();
?>

<div class="pixmatch-accueil">
    
   <!-- SECTION HERO AVEC SWITCH -->
<div class="hero-container" style="width: 100%; position: relative; margin-bottom: 60px;">
    <!-- IMAGE D'ACCUEIL -->
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Fichier1.png" alt="image accueil" class="image-accueil">
    
    <div class="hero-text">
        <h1>PIXMATCH</h1>
        <p>Quand le feeling fait clic</p>
    </div>
<!-- AJOUTE DES <br> POUR DESCENDRE LE SWITCH -->
    <br><br><br>
    <!-- SWITCH PARTICULIERS / CRÉATEURS -->
    <div class="hero-switch">
        <a href="<?php echo esc_url(home_url('/accueil-particuliers')); ?>" class="switch-btn switch-active">Particuliers</a>
        <a href="<?php echo esc_url(home_url('/accueil-createurs')); ?>" class="switch-btn">Créateurs</a>
    </div>
</div>
    <!-- SECTION TEXTE -->
    <section class="texte-section">
        <div class="colonne">
            <p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker</p>
        </div>
        <div class="colonne">
            <p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker</p>
        </div>
    </section>

    <br><br>

    <!-- SECTION PROFESSIONNELS -->
    <section class="pro-section">
        <h2 class="pro-title">Les dernier professionnels en vogue</h2>

        <div class="pro-row">
            <button class="nav-dot">–</button>

            <div class="pro-card">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/portrait1.jpg" alt="Photographe" class="pro-img">
                <div class="pro-overlay">
                    <p class="pro-name">Louis</p>
                    <p class="pro-job">photographe</p>
                    <p class="pro-stars">☆☆☆☆☆</p>
                </div>
            </div>

            <button class="nav-dot">–</button>

            <div class="pro-card">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/portrait1.jpg" alt="Photographe" class="pro-img">
                <div class="pro-overlay">
                    <p class="pro-name">Louise</p>
                    <p class="pro-job">photographe</p>
                    <p class="pro-stars">☆☆☆☆☆</p>
                </div>
            </div>

            <button class="nav-dot">–</button>

            <div class="pro-card">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/portrait1.jpg" alt="Photographe" class="pro-img">
                <div class="pro-overlay">
                    <p class="pro-name">Louis</p>
                    <p class="pro-job">photographe</p>
                    <p class="pro-stars">☆☆☆☆☆</p>
                </div>
            </div>

            <button class="nav-dot">–</button>

            <div class="pro-card">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/portrait1.jpg" alt="Photographe" class="pro-img">
                <div class="pro-overlay">
                    <p class="pro-name">Louise</p>
                    <p class="pro-job">photographe</p>
                    <p class="pro-stars">☆☆☆☆☆</p>
                </div>
            </div>

            <button class="nav-dot">–</button>

            <div class="pro-card">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/portrait1.jpg" alt="Photographe" class="pro-img">
                <div class="pro-overlay">
                    <p class="pro-name">Louis</p>
                    <p class="pro-job">photographe</p>
                    <p class="pro-stars">☆☆☆☆☆</p>
                </div>
            </div>

            <button class="nav-dot">–</button>
        </div>
    </section>

    <br><br>

    <!-- SECTION POURQUOI NOUS -->
    <section class="why">
        <h2 class="why-title">Pourquoi nous ?</h2>
        <br>

        <div class="why-row">
            <p class="why-item">+200 clients</p>
            <p class="why-item">+300 professionnels</p>

            <div class="why-group">
                <p class="why-item">pro certifiés</p>
                <div class="why-icons">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/Lightroom.svg" alt="Lightroom" class="why-icon">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/Photoshop.svg" alt="Photoshop" class="why-icon">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/Premierepro.svg" alt="Premiere Pro" class="why-icon">
                </div>
            </div>

            <div class="why-group">
                <p class="why-item">Paiements sécurisés</p>
                <div class="why-payments">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/Visa.svg" alt="Visa" class="why-pay">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/Mastercard.png" alt="Mastercard" class="why-pay">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/Carte.png" alt="Carte bancaire" class="why-pay">
                </div>
            </div>
        </div>
    </section>

    <br><br>

    <!-- SECTION AVIS -->
    <section class="avis-wrap">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Fleches/leftarrow.png" alt="Précédent" class="avis-arrow-img">

        <div class="avis-box">
            <div class="avis-inner">
                <div class="avis-left">
                    <div class="avis-photo">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/accueilaparticuliers/avisphoto.avif" alt="Photo avis" class="avis-img">
                    </div>
                    <div class="avis-meta">
                        <p class="avis-name">Nick</p>
                        <p class="avis-date">10 janvier 2026</p>
                        <p class="avis-job">Photographe et<br>Vidéaste</p>
                    </div>
                </div>

                <div class="avis-right">
                    <div class="avis-head">
                        <h3 class="avis-title">Super choix</h3>
                        <div class="avis-hearts">❤ ❤ ❤ ❤ ❤</div>
                    </div>

                    <br><br>

                    <p class="avis-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>
                </div>
            </div>
        </div>

        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Fleches/rightarrow.png" alt="Suivant" class="avis-arrow-img">
    </section>

    <!-- SECTION WORK -->
<section class="work2">
    <h2 class="work2-title">Vous allez adorer travailler avec nous</h2>

    <div class="work2-grid">
        <!-- Première carte avec photo à gauche -->
        <div class="work2-card">
            <div class="work2-img-container">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/work-photo-1.jpg" alt="Professionnel au travail" class="work2-img">
            </div>
            <div class="work2-content">
                <h3>Des professionnels qui aiment leur métier</h3>
                <p>Des professionnels qui aiment leur métier avant tout, et qui le montrent dans chaque image et chaque vidéo qu'ils réalisent. Sur notre plateforme, nous mettons en avant des photographes et vidéastes animés par la passion, l'engagement et le souci du détail. Chacun d'eux exerce avec sérieux, créativité et professionnalisme, en prenant le temps de comprendre vos attentes et de s'adapter à votre projet. Leur objectif est simple : capturer des moments authentiques, raconter votre histoire et vous livrer un résultat à la hauteur de vos émotions.</p>
            </div>
        </div>

        <!-- Deuxième carte avec photo à droite -->
        <div class="work2-card work2-card-reverse">
            <div class="work2-img-container">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/work-photo-2.jpg" alt="Shooting photo" class="work2-img">
            </div>
            <div class="work2-content">
                <h3>Le photographe fait pour vous en un clic</h3>
                <p>Le photographe fait pour vous en un clic, sans stress ni perte de temps. Grâce à notre plateforme intuitive, trouvez rapidement le professionnel qui correspond à vos besoins, à votre style et à votre budget. En quelques étapes seulement, vous explorez les profils, découvrez les portfolios, échangez directement avec les créateurs et réservez en toute confiance. Nous avons simplifié chaque étape pour que vous puissiez vous concentrer sur l'essentiel : profiter de votre projet et vivre une expérience sereine et réussie.</p>
            </div>
        </div>
    </div>
</section>

    <!-- SECTION FAQ -->
    <section class="faq">
        <h2 class="faq-title">Les questions fréquemment posées</h2>

        <div class="faq-list">
            <div class="faq-item">
                <p>Qu'est-ce que Pixmatch ?</p>
                <span class="faq-chevron">⌄</span>
            </div>

            <div class="faq-item">
                <p>Dans quelles villes ou régions vos photographes sont-ils disponibles ?</p>
                <span class="faq-chevron">⌄</span>
            </div>

            <div class="faq-item">
                <p>Puis-je annuler ou modifier ma réservation ?</p>
                <span class="faq-chevron">⌄</span>
            </div>

            <div class="faq-item">
                <p>Comment s'inscrire en tant que photographe sur la plateforme ?</p>
                <span class="faq-chevron">⌄</span>
            </div>

            <div class="faq-item">
                <p>Comment fonctionne le paiement après une prestation ?</p>
                <span class="faq-chevron">⌄</span>
            </div>

            <div class="faq-item">
                <p>Combien de temps à l'avance dois-je réserver un photographe ?</p>
                <span class="faq-chevron">⌄</span>
            </div>

            <div class="faq-item">
                <p>En combien de temps recevrai-je mes photos ?</p>
                <span class="faq-chevron">⌄</span>
            </div>

            <div class="faq-item">
                <p>Comment puis-je être sûr(e) de la qualité des photographes inscrits ?</p>
                <span class="faq-chevron">⌄</span>
            </div>
        </div>
    </section>

</div>

<?php
get_footer();
?>