<?php
// Démarrer la session
if (function_exists('pixmatch_maybe_start_session')) {
    pixmatch_maybe_start_session();
}

// Récupérer le profil depuis la session
if (isset($_SESSION['pixmatch_profile'])) {
    $current_profile = $_SESSION['pixmatch_profile'];
} else {
    $current_profile = 'visit'; // 'visit' = particuliers, 'pro' = créateurs
}

// Changer le profil si demandé dans l'URL
if (isset($_GET['set_profile'])) {
    $new_profile = ($_GET['set_profile'] === 'pro') ? 'pro' : 'visit';
    $_SESSION['pixmatch_profile'] = $new_profile;
    $current_profile = $new_profile;
    
    // Rediriger sans le paramètre set_profile pour avoir une URL propre
    $redirect_url = remove_query_arg('set_profile');
    wp_redirect($redirect_url);
    exit;
}

?>
<div style="
  background: <?php echo ($current_profile === 'pro') ? '#FFEB99' : '#ABAED8'; ?>;
  padding: 15px 30px;
  border-bottom: 2px solid black;
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-family: Arial, sans-serif;
">

  <!-- LOGO -->
  <a href="<?php echo esc_url(home_url('/')); ?>" style="display: flex; align-items: center;">
    <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/pixmatch-logo-1.png" style="height: 100px;">
  </a>
  
  <!-- SWITCH -->
  <!-- SWITCH -->
<div style="display: flex; border: 2px solid black; border-radius: 40px; background: <?php echo ($current_profile === 'pro') ? '#FFEB99' : '#ABAED8'; ?>; padding: 4px;">
    
    <a href="<?php echo esc_url(add_query_arg('set_profile', 'visit', home_url('/'))); ?>" 
       class="switch-btn switch-particuliers"
       style="font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px;">
        Particuliers
    </a>
    
    <a href="<?php echo esc_url(add_query_arg('set_profile', 'pro', home_url('/cdc-bienvenue-sur-pixmatch'))); ?>" 
       class="switch-btn switch-createurs"
       style="font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px;">
        Créateurs
    </a>
    
</div>

  <!-- MENU + RECHERCHE -->
  <div style="display: flex; flex-direction: column; gap: 5px;">
    <div style="display: flex; gap: 25px;">
      <?php
      // Définir les liens selon le profil
      if ($current_profile === 'pro') {
          // Menu pour les créateurs
          $menu_items = [
              'Nos professionnels' => '/nos-professionnels',
              'Service photo' => '/service-photo',
              'Service vidéo' => '/service-video',
          ];
      } else {
          // Menu pour les particuliers
          $menu_items = [
              'Couple & Mariage' => '/page-couple-et-mariage',
              'Maternité & Naissance' => '/page-maternite-et-naissance',
              'Famille' => '/page-famille',
              'Événements personnels' => '/evenement-personnel',
          ];
      }
      
      foreach ($menu_items as $name => $link) {
          echo '<a href="' . home_url($link) . '" style="color: black; text-decoration: none; font-size: 14px;">' . $name . '</a>';
      }
      ?>
    </div>

    <!-- RECHERCHE -->
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get" style="display: flex; border: 2px solid black; border-radius: 999px; background: white; height: 38px;">
      <input type="hidden" name="set_profile" value="<?php echo $current_profile; ?>">
      <input type="search" name="s" placeholder="Trouver un professionnel" style="border: none; background: transparent; padding: 0 15px; flex: 1;">
      <button type="submit" style="background: none; border: none; border-left: 2px solid #ccc; padding: 0 15px;">🔍</button>
    </form>
  </div>

  <!-- ICÔNES COMPTE ET DÉCONNEXION -->
  <div style="display: flex; align-items: center; gap: 15px; margin-left: 20px;">
    
    <?php if (is_user_logged_in()): ?>
      
      <?php 
      $user = wp_get_current_user();
      $roles = (array) $user->roles;
      
      // Si c'est un administrateur
      if (in_array('administrator', $roles)): 
      ?>
        <!-- Icône admin (lien vers dashboard) -->
        <a href="<?php echo esc_url(admin_url()); ?>" style="display: flex; align-items: center; text-decoration: none;">
          <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/admin-icon.png" alt="Admin" style="height: 32px; width: 32px;">
        </a>
      
      <?php else: 
        // C'est un client ou un pro
      ?>
        <!-- Icône compte (client ou pro) -->
<?php
if (is_user_logged_in()) {
    $user = wp_get_current_user();
    $roles = (array) $user->roles;
    
    if (in_array('um_professionnel', $roles)) {
        $compte_url = home_url('/mon-compte-pro');
    } else {
        $compte_url = home_url('/mon-compte-client');
    }
} else {
    $compte_url = home_url('/connexion');
}
?>
<a href="<?php echo esc_url($compte_url); ?>" style="display: flex; align-items: center; text-decoration: none;">
    <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/logo-compte.png" alt="Mon compte" style="height: 32px; width: 32px;">
</a>
        <!-- Icône déconnexion -->
        <a href="<?php echo wp_logout_url(home_url('/connexion')); ?>" style="display: flex; align-items: center; text-decoration: none;">
          <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/deconnexion.png" alt="Déconnexion" style="height: 32px; width: 32px;">
        </a>
      <?php endif; ?>
      
    <?php else: ?>
      
      <!-- Icône connexion (utilisateur non connecté) -->
      <a href="<?php echo esc_url(home_url('/choix-inscription')); ?>" style="display: flex; align-items: center; text-decoration: none;">
        <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/03/logo-compte.png" alt="Connexion" style="height: 32px; width: 32px;">
      </a>
      
    <?php endif; ?>
    <!-- BURGER POUR MOBILE -->
  <button class="burger-menu" id="burger-menu" style="display: none; background: none; border: 2px solid black; border-radius: 8px; padding: 8px 12px; font-size: 24px; cursor: pointer; margin-left: auto;">☰</button>
  </div>
  
<script>
document.addEventListener('DOMContentLoaded', function() {
    const burger = document.getElementById('burger-menu');
    const menuContainer = document.querySelector('div[style*="flex-direction: column"][style*="gap: 5px"]');
    
    if (burger && menuContainer) {
        burger.addEventListener('click', function() {
            menuContainer.classList.toggle('menu-open');
        });
    }
});
</script>
</div>
