<?php
/**
 * Template pour les résultats de recherche - Version autonome
 */

// Inclure WordPress
require_once(dirname(__FILE__) . '/../../../wp-load.php');

$search = get_search_query();

// Démarrer la session si possible
if (function_exists('pixmatch_maybe_start_session')) {
    pixmatch_maybe_start_session();
}

// Récupérer le profil depuis la session ou depuis la fonction
if (isset($_SESSION['pixmatch_profile'])) {
    $current_profile = $_SESSION['pixmatch_profile'];
} elseif (function_exists('pixmatch_get_profile')) {
    $current_profile = pixmatch_get_profile();
} else {
    $current_profile = 'visit';
}

// Permettre le changement de mode via l'URL (ex: ?set_profile=pro)
if (isset($_GET['set_profile'])) {
    $new_profile = ($_GET['set_profile'] === 'pro') ? 'pro' : 'visit';
    $_SESSION['pixmatch_profile'] = $new_profile;
    $current_profile = $new_profile;
}

$mode_class = ($current_profile === 'pro') ? 'page-cdc' : 'page-particuliers';
$search = get_search_query();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche : <?php echo esc_html($search); ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;800&family=Manrope:wght@400;600;700&display=swap">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Manrope', sans-serif; background: #f5f5f5; color: #333; }
        
        /* HEADER DYNAMIQUE */
        .pixmatch-header {
            padding: 15px 30px;
            border-bottom: 2px solid black;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: Arial, sans-serif;
        }
        
        /* Version Particuliers (violet) */
        .page-particuliers .pixmatch-header {
            background: #ABAED8 !important;
        }
        
        /* Version Créateurs (jaune) */
        .page-cdc .pixmatch-header {
            background: #FFEB99 !important;
        }
        
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .search-title { font-family: 'Fraunces', serif; font-size: 36px; margin-bottom: 30px; }
        .result-count { background: #ABAED8; color: white; padding: 10px 20px; border-radius: 30px; display: inline-block; margin-bottom: 30px; }
        .resultat { background: white; border: 2px solid #ddd; border-radius: 10px; padding: 25px; margin-bottom: 25px; }
        .resultat h2 { font-family: 'Fraunces', serif; font-size: 24px; margin-bottom: 10px; }
        .resultat h2 a { text-decoration: none; color: #333; }
        .resultat h2 a:hover { color: #ABAED8; }
        .resultat p { line-height: 1.6; color: #555; margin-bottom: 10px; }
        .resultat .type { font-size: 12px; color: #888; }
        .no-results { background: white; padding: 40px; text-align: center; border-radius: 10px; }
        
        /* FOOTER */
        .pixmatch-footer {
            background: #b8bbdf;
            padding: 26px 18px;
            border-top: 2px solid #000;
        }
        
        .pixmatch-footer__inner {
            display: flex;
            gap: 28px;
            align-items: flex-start;
        }
        
        .pixmatch-footer__left {
            width: 220px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        
        .pixmatch-footer__brand .custom-logo {
            width: 80px !important;
            height: auto !important;
            display: block !important;
            margin-bottom: 15px !important;
        }
        
        .pixmatch-footer__social {
            display: flex;
            gap: 10px;
        }
        
        .pixmatch-social {
            width: 34px;
            height: 34px;
            border: 2px solid #000;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            transition: background .2s ease, color .2s ease;
        }
        
        .pixmatch-social:hover {
            background: #000;
            color: #fff;
        }
        
        .pixmatch-footer__newsletter-title {
            font-weight: 800;
            letter-spacing: .5px;
        }
        
        .pixmatch-footer__cols {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(5, minmax(140px, 1fr));
            gap: 22px;
        }
        
        .pixmatch-footer__col h4 {
            margin: 0 0 10px 0;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            color: #000;
        }
        
        .pixmatch-footer__col ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        
        .pixmatch-footer__col li {
            margin: 6px 0;
        }
        
        .pixmatch-footer__col a {
            color: #000;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }
        
        .pixmatch-footer__col a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 992px) {
            .pixmatch-footer__inner {
                flex-direction: column;
            }
            .pixmatch-footer__left {
                width: 100%;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
            }
            .pixmatch-footer__cols {
                grid-template-columns: repeat(2, minmax(160px, 1fr));
            }
        }
        
        @media (max-width: 520px) {
            .pixmatch-footer__cols {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="<?php echo $mode_class; ?>">

    <!-- HEADER DYNAMIQUE -->
    <div class="pixmatch-header">
        <!-- LOGO -->
        <a href="<?php echo esc_url(home_url('/')); ?>" style="display: flex; align-items: center;">
            <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/pixmatch-logo-1.png" style="height: 100px;">
        </a>

        <!-- SWITCH DYNAMIQUE -->
        <div style="display: flex; border: 2px solid black; border-radius: 40px; background: <?php echo ($current_profile === 'pro') ? '#FFEB99' : '#ABAED8'; ?>; padding: 4px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" 
               style="padding: 6px 20px; border-radius: 40px; 
                      background: <?php echo ($current_profile === 'visit') ? 'white' : 'transparent'; ?>; 
                      color: black; text-decoration: none; font-weight: <?php echo ($current_profile === 'visit') ? 'bold' : 'normal'; ?>;">
                Particuliers
            </a>
            <a href="<?php echo esc_url(home_url('/cdc-bienvenue-sur-pixmatch')); ?>" 
               style="padding: 6px 20px; border-radius: 40px; 
                      background: <?php echo ($current_profile === 'pro') ? 'white' : 'transparent'; ?>; 
                      color: black; text-decoration: none; font-weight: <?php echo ($current_profile === 'pro') ? 'bold' : 'normal'; ?>;">
                Créateurs
            </a>
        </div>

        <!-- MENU + RECHERCHE -->
        <div style="display: flex; flex-direction: column; gap: 5px;">
            <div style="display: flex; gap: 25px;">
                <?php
                $menu_items = [
                    'Couple & Mariage' => '/page-couple-et-mariage',
                    'Maternité & Naissance' => '/page-maternite-et-naissance',
                    'Famille' => '/page-famille',
                    'Événements personnels' => '/evenement-personnel',
                ];
                foreach ($menu_items as $name => $link) {
                    echo '<a href="' . home_url($link) . '" style="color: black; text-decoration: none; font-size: 14px;">' . $name . '</a>';
                }
                ?>
            </div>

            <!-- RECHERCHE -->
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get" style="display: flex; border: 2px solid black; border-radius: 999px; background: white; height: 38px;">
                <input type="search" name="s" placeholder="Trouver un professionnel" value="<?php echo esc_attr($search); ?>" style="border: none; background: transparent; padding: 0 15px; flex: 1;">
                <button type="submit" style="background: none; border: none; border-left: 2px solid #ccc; padding: 0 15px;">🔍</button>
            </form>
        </div>

        <!-- ICÔNES COMPTE ET DÉCONNEXION -->
        <div style="display: flex; align-items: center; gap: 15px; margin-left: 20px;">
            <?php if (is_user_logged_in()): ?>
                <?php 
                $user = wp_get_current_user();
                $roles = (array) $user->roles;
                
                if (in_array('administrator', $roles)): ?>
                    <a href="<?php echo esc_url(admin_url()); ?>" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/admin-icon.png" alt="Admin" style="height: 32px; width: 32px;">
                    </a>
                <?php else: ?>
                    <a href="<?php echo esc_url(home_url('/mon-compte-client')); ?>" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/logo-compte.png" alt="Mon compte" style="height: 32px; width: 32px;">
                    </a>
                    <a href="<?php echo wp_logout_url(home_url('/connexion')); ?>" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/deconnexion.png" alt="Déconnexion" style="height: 32px; width: 32px;">
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="<?php echo esc_url(home_url('/connexion')); ?>" style="display: flex; align-items: center; text-decoration: none;">
                    <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/logo-compte.png" alt="Connexion" style="height: 32px; width: 32px;">
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <h1 class="search-title">Résultats de recherche pour : "<?php echo esc_html($search); ?>"</h1>

        <?php
        // Forcer Relevanssi
        if (function_exists('relevanssi_do_query')) {
            add_filter('relevanssi_modify_wp_query', '__return_true');
        }

        global $wp_query;

        if (have_posts()) : ?>
            <div class="result-count"><?php echo $wp_query->post_count; ?> résultat(s) trouvé(s)</div>
            
            <?php while (have_posts()) : the_post(); ?>
                <div class="resultat">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 40); ?></p>
                    <div class="type">Type : <?php echo get_post_type(); ?></div>
                </div>
            <?php endwhile; ?>
            
        <?php else : ?>
            <div class="no-results">
                <p>Aucun résultat trouvé pour votre recherche.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- FOOTER -->
    <div class="pixmatch-footer">
        <div class="pixmatch-footer__inner">
            <div class="pixmatch-footer__left">
                <div class="pixmatch-footer__brand">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/pixmatch-logo-1.png" alt="PixMatch" class="custom-logo">
                    </a>
                </div>
                <div class="pixmatch-footer__social">
                    <a href="https://www.instagram.com/pixmatch_officiel" class="pixmatch-social" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm10 2a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.9a1.1 1.1 0 100 2.2 1.1 1.1 0 000-2.2z"/>
                        </svg>
                    </a>
                    <a href="https://www.tiktok.com/@pixmatch_officiel" class="pixmatch-social" aria-label="TikTok">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M16.5 3a5.2 5.2 0 003.5 1.4v3.1a8.3 8.3 0 01-3.5-.8v6.4a5.9 5.9 0 11-5.9-5.9c.4 0 .8 0 1.2.1v3.3a2.6 2.6 0 10 2.4 2.6V3h2.3z"/>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/company/pixmatchofficiel/" class="pixmatch-social" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM0 8h5v16H0V8zm7.98 0h4.8v2.2h.07c.67-1.27 2.3-2.6 4.73-2.6 5.05 0 5.98 3.33 5.98 7.66V24h-5v-6.92c0-1.65-.03-3.77-2.3-3.77-2.3 0-2.65 1.8-2.65 3.65V24h-5V8z"/>
                        </svg>
                    </a>
                </div>
                <div class="pixmatch-footer__email">
                    <a href="mailto:contact.pixmatch@gmail.com">contact.pixmatch@gmail.com</a>
                </div>
            </div>
            <div class="pixmatch-footer__cols">
                <div class="pixmatch-footer__col">
                    <h4>INFORMATIONS LEGALES</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/notre-histoire')); ?>">Notre histoire</a></li>
                        <li><a href="<?php echo esc_url(home_url('/notre-expertise')); ?>">Notre expertise</a></li>
                        <li><a href="<?php echo esc_url(home_url('/notre-fonctionnement')); ?>">Notre fonctionnement</a></li>
                        <li><a href="<?php echo esc_url(home_url('/cgu-cgv')); ?>">CGU/CGV</a></li>
                        <li><a href="<?php echo esc_url(home_url('/mentions-legales')); ?>">Mentions légales</a></li>
                        <li><a href="<?php echo esc_url(home_url('/rgpd')); ?>">RGPD</a></li>
                    </ul>
                </div>
                <div class="pixmatch-footer__col">
                    <h4>PARTICULIERS</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/page-couple-et-mariage')); ?>">Couple &amp; Mariage</a></li>
                        <li><a href="<?php echo esc_url(home_url('/page-maternite-et-naissance')); ?>">Maternité &amp; Naissance</a></li>
                        <li><a href="<?php echo esc_url(home_url('/page-famille')); ?>">Famille</a></li>
                        <li><a href="<?php echo esc_url(home_url('/evenement-personnel')); ?>">Événements personnels</a></li>
                    </ul>
                </div>
                <div class="pixmatch-footer__col">
                    <h4>CREATEURS DE CONTENU</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/nos-professionnels')); ?>">Nos professionnels </a></li>
                        <li><a href="<?php echo esc_url(home_url('/service-photo')); ?>">Service photo</a></li>
                        <li><a href="<?php echo esc_url(home_url('/service-video')); ?>">Service vidéo</a></li>
                    </ul>
                </div>
                <div class="pixmatch-footer__col">
                    <h4>AIDE ET SUPPORT</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/faq')); ?>">FAQ</a></li>
                        <li><a href="<?php echo esc_url(home_url('/aides')); ?>">Aide</a></li>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a></li>
                    </ul>
                </div>
                <div class="pixmatch-footer__col">
                    <h4>ESPACE PERSO</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/connexion')); ?>">Connexion</a></li>
                        <li><a href="<?php echo esc_url(home_url('/choix-inscription')); ?>">Inscription</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>
</html>