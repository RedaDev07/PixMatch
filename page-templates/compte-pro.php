<?php
/**
 * Template Name: Compte Professionnel
 */

get_header();

// Récupérer les infos de l'utilisateur connecté
$current_user = wp_get_current_user();
$prenom = get_user_meta($current_user->ID, 'first_name', true);
$nom = get_user_meta($current_user->ID, 'last_name', true);
$entreprise = get_user_meta($current_user->ID, 'company_name', true);
$siret = get_user_meta($current_user->ID, 'siret', true);
$competences = get_user_meta($current_user->ID, 'competences', true);
$competences = get_user_meta($current_user->ID, 'competences', true);

// Si c'est une chaîne JSON, on la décode
if (is_string($competences) && !empty($competences)) {
    $competences = json_decode($competences, true);
}

// Si ce n'est pas un tableau, on initialise un tableau vide
if (!is_array($competences)) {
    $competences = [];
}

// Récupérer les rôles choisis (multiselect)
$roles_choisis = get_user_meta($current_user->ID, 'roles', true);
if (is_string($roles_choisis) && !empty($roles_choisis)) {
    $roles_choisis = maybe_unserialize($roles_choisis);
}
if (!is_array($roles_choisis)) {
    $roles_choisis = [];
}
// Récupérer l'avatar
$avatar_id = get_user_meta($current_user->ID, 'avatar_id', true);
if ($avatar_id) {
    $avatar = wp_get_attachment_url($avatar_id);
} else {
    $avatar = get_avatar_url($current_user->ID, ['size' => 180]);
}
$default_avatar = get_template_directory_uri() . '/assets/images/default-avatar.jpg';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mon Compte Pro</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
<?php echo file_get_contents(get_template_directory() . '/assets/css/compte-pro.css'); ?>
</style>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<h1 class="title">Mon Compte Professionnel</h1>

<!-- PROFILE HEADER -->
<div class="profile-header">
    <div class="avatar-container">
        <img src="<?php echo esc_url($avatar ?: $default_avatar); ?>" class="profile-img">
        <label for="avatar-upload" class="avatar-upload-label">
            <i class="fa-solid fa-camera"></i>
        </label>
        <input type="file" id="avatar-upload" accept="image/*" style="display: none;">
    </div>

    <div class="profile-infos">
        <div class="pro-noms">
            <h2><?php echo esc_html($prenom ?: 'Prénom'); ?> <?php echo esc_html($nom ?: 'Nom'); ?></h2>
            <p class="pro-entreprise"><?php echo esc_html($entreprise ?: 'Nom de l\'entreprise'); ?></p>
            <p class="pro-siret">SIRET : <?php echo esc_html($siret ?: 'Non renseigné'); ?></p>
            <!-- EMAIL -->
<p class="pro-email">Email : <?php echo esc_html($current_user->user_email); ?></p>

<!-- RÔLES CHOISIS -->
<?php if (!empty($roles_choisis)) : ?>
    <div class="pro-roles">
        <h3>Rôle(s)</h3>
        <div class="roles-list">
            <?php foreach ($roles_choisis as $role) : ?>
                <span class="role-tag"><?php echo esc_html($role); ?></span>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
        </div>
        
        <div class="pro-competences">
    <h3>Compétences</h3>
    <div class="competences-list">
        <?php if (!empty($competences) && is_array($competences)) : ?>
            <?php foreach ($competences as $comp) : ?>
                <span class="competence-tag"><?php echo esc_html($comp); ?></span>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Aucune compétence renseignée.</p>
        <?php endif; ?>
    </div>
</div>
    </div>

    <div class="edit">
        <a href="#" id="edit-profile-btn">Modifier le profil</a>
    </div>
</div>

<!-- FORMULAIRE DE MODIFICATION (CACHÉ) -->
<div id="edit-profile-form" style="display: none; background: #f9f9f9; padding: 20px; border-radius: 10px; margin: 20px;">
    <h3>Modifier mes informations</h3>
    <form id="profile-update-form">
        <div style="margin-bottom: 10px;">
            <label>Prénom :</label>
            <input type="text" id="edit-prenom" value="<?php echo esc_attr($prenom); ?>" style="width: 100%; padding: 8px;">
        </div>
        <div style="margin-bottom: 10px;">
            <label>Nom :</label>
            <input type="text" id="edit-nom" value="<?php echo esc_attr($nom); ?>" style="width: 100%; padding: 8px;">
        </div>
        <div style="margin-bottom: 10px;">
            <label>Entreprise :</label>
            <input type="text" id="edit-entreprise" value="<?php echo esc_attr($entreprise); ?>" style="width: 100%; padding: 8px;">
        </div>
        <div style="margin-bottom: 10px;">
            <label>SIRET :</label>
            <input type="text" id="edit-siret" value="<?php echo esc_attr($siret); ?>" style="width: 100%; padding: 8px;">
        </div>
        <div style="margin-bottom: 10px;">
    <label>Email :</label>
    <input type="email" id="edit-email" value="<?php echo esc_attr($current_user->user_email); ?>" style="width: 100%; padding: 8px;">
</div>
        
        <!-- SECTION COMPÉTENCES -->
        <div style="margin-bottom: 15px;">
            <label>Compétences :</label>
            <div id="competences-container">
                <!-- Les compétences seront ajoutées ici par JavaScript -->
            </div>
            <button type="button" id="add-competence" style="margin-top: 10px; background: #ABAED8; border: none; padding: 5px 10px; border-radius: 5px;">➕ Ajouter une compétence</button>
        </div>
        
        <button type="submit" style="background: #000; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">Enregistrer</button>
    </form>
</div>

<div class="container">
    <!-- LEFT COLUMN (menu) -->
    <div class="left">
        <div class="menu">
            <button class="menu-btn active" data-tab="messagerie"><i class="fa-solid fa-envelope"></i> Messagerie</button>
            <button class="menu-btn" data-tab="corbeille"><i class="fa-solid fa-trash"></i> Corbeille</button>
            <button class="menu-btn" data-tab="devis"><i class="fa-solid fa-file"></i> Devis</button>
        </div>
        <div class="calendar">
            <p class="date-title" id="current-date"></p>
            <input type="date" id="calendar">
        </div>
    </div>

    <!-- RIGHT COLUMN (discussions) -->
    <div class="right">
        <div id="tab-messagerie" class="tab-content active">
            <h3>Vos discussions</h3>
            <?php
            $discussions = pixmatch_get_client_discussions($current_user->ID, false);
            if ($discussions) :
                foreach ($discussions as $discussion) :
            ?>
                <div class="discussion">
                    <div class="user">
                        <img src="<?php echo $discussion['pro_avatar']; ?>">
                        <div>
                            <strong><?php echo $discussion['pro_nom']; ?></strong>
                            <p><?php echo esc_html(substr($discussion['last_message'], 0, 50)); ?>...</p>
                        </div>
                    </div>
                    <div class="date"><?php echo $discussion['last_date']; ?></div>
                    <button class="btn-supprimer" onclick="supprimerMessage(<?php echo $discussion['pro_id']; ?>); return false;">🗑️</button>
                </div>
            <?php
                endforeach;
            else :
                echo '<p>Aucune discussion pour le moment.</p>';
            endif;
            ?>
        </div>

        <div id="tab-corbeille" class="tab-content" style="display: none;">
            <h3>Corbeille</h3>
            <?php
            $corbeille = pixmatch_get_client_discussions($current_user->ID, true);
            if ($corbeille) :
                foreach ($corbeille as $discussion) :
            ?>
                    <div class="discussion">
                        <div class="user">
                            <img src="<?php echo $discussion['pro_avatar']; ?>">
                            <div>
                                <strong><?php echo $discussion['pro_nom']; ?></strong>
                                <p><?php echo esc_html(substr($discussion['last_message'], 0, 50)); ?>...</p>
                            </div>
                        </div>
                        <div class="date"><?php echo $discussion['last_date']; ?></div>
                        <button class="btn-restaurer" onclick="restaurerDiscussion(<?php echo $discussion['pro_id']; ?>); return false;">↩️ Restaurer</button>
                    </div>
            <?php
                endforeach;
            else :
                echo '<p>Corbeille vide.</p>';
            endif;
            ?>
        </div>

        <div id="tab-devis" class="tab-content" style="display: none;">
            <h3>Devis reçus</h3>
            <p>Aucun devis pour le moment.</p>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
// Fonction pour afficher la date en français
function formatDateFR(date) {
    const jours = ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
    const mois = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
    return `${jours[date.getDay()]} ${date.getDate()} ${mois[date.getMonth()]}`;
}

// Initialisation de la date
const currentDate = new Date();
const dateTitle = document.getElementById('current-date');
const calendar = document.getElementById('calendar');
dateTitle.textContent = formatDateFR(currentDate);
calendar.valueAsDate = currentDate;

calendar.addEventListener('change', function() {
    const selectedDate = new Date(this.value);
    dateTitle.textContent = formatDateFR(selectedDate);
});

// Gestion des onglets
document.querySelectorAll('.menu-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.menu-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.querySelectorAll('.tab-content').forEach(tab => tab.style.display = 'none');
        document.getElementById('tab-' + this.dataset.tab).style.display = 'block';
    });
});

// ===== GESTION DES COMPÉTENCES =====
let competences = <?php echo json_encode($competences); ?>;

function afficherCompetences() {
    const container = document.getElementById('competences-container');
    if (!container) return;
    
    container.innerHTML = '';
    competences.forEach((comp, index) => {
        const div = document.createElement('div');
        div.style.marginBottom = '10px';
        div.style.display = 'flex';
        div.style.gap = '5px';
        div.innerHTML = `
            <input type="text" value="${comp}" style="flex: 1; padding: 8px;" data-index="${index}">
            <button type="button" onclick="supprimerCompetence(${index})" style="background: #ff4444; color: white; border: none; padding: 8px 12px; border-radius: 5px;">🗑️</button>
        `;
        container.appendChild(div);
    });
}

function supprimerCompetence(index) {
    competences.splice(index, 1);
    afficherCompetences();
}

// Gestion du profil
document.getElementById('edit-profile-btn').addEventListener('click', function(e) {
    e.preventDefault();
    const form = document.getElementById('edit-profile-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
    
    // Si on ouvre le formulaire, on affiche les compétences
    if (form.style.display === 'block') {
        // Ajouter le conteneur des compétences s'il n'existe pas
        if (!document.getElementById('competences-container')) {
            const section = document.createElement('div');
            section.id = 'competences-container';
            section.style.marginTop = '15px';
            document.querySelector('#edit-profile-form form').appendChild(section);
        }
        afficherCompetences();
    }
});

// Bouton pour ajouter une compétence
document.addEventListener('click', function(e) {
    if (e.target && e.target.id === 'add-competence') {
        competences.push('Nouvelle compétence');
        afficherCompetences();
    }
});

// Sauvegarde du formulaire
document.getElementById('profile-update-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Récupérer les compétences modifiées
    const inputs = document.querySelectorAll('#competences-container input');
    competences = Array.from(inputs).map(input => input.value);
    
    const prenom = document.getElementById('edit-prenom').value;
    const nom = document.getElementById('edit-nom').value;
    const entreprise = document.getElementById('edit-entreprise').value;
    const siret = document.getElementById('edit-siret').value;
    const email = document.getElementById('edit-email').value;

    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'update_profile_pro',
            prenom: prenom,
            nom: nom,
            entreprise: entreprise,
            siret: siret,
            email: email,
            competences: JSON.stringify(competences)
        })
    }).then(() => {
    // Mettre à jour l'affichage des compétences sans recharger
    const competencesDiv = document.querySelector('.competences-list');
    competencesDiv.innerHTML = '';
    competences.forEach(comp => {
        const span = document.createElement('span');
        span.className = 'competence-tag';
        span.textContent = comp;
        competencesDiv.appendChild(span);
    });
    
    // Fermer le formulaire
    document.getElementById('edit-profile-form').style.display = 'none';
});
});

// Upload avatar (inchangé)
document.getElementById('avatar-upload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('action', 'upload_profile_avatar');
        formData.append('avatar', file);
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.profile-img').src = data.data.url + '?' + Date.now();
            }
        });
    }
});

// Supprimer / Restaurer
function supprimerMessage(proId) {
    if (!confirm('Supprimer cette discussion ?')) return;
    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'supprimer_discussion', pro_id: proId })
    }).then(() => location.reload());
}

function restaurerDiscussion(proId) {
    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'restaurer_discussion', pro_id: proId })
    }).then(() => location.reload());
}
</script>

<?php wp_footer(); ?>
</body>
</html>

<?php
get_footer();
?>