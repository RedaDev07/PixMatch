<?php
/**
 * Template Name: Compte Client
 */

get_header();

// Récupérer les infos de l'utilisateur connecté
$current_user = wp_get_current_user();
$prenom = get_user_meta($current_user->ID, 'first_name', true);
$nom = get_user_meta($current_user->ID, 'last_name', true);
// Récupérer l'avatar personnalisé s'il existe
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
<title>Mon Compte</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
<?php echo file_get_contents(get_template_directory() . '/assets/css/compte-client.css'); ?>
</style>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<h1 class="title">Mon Compte</h1>

<!-- PROFILE HEADER -->
<div class="profile-header">
    <img src="<?php echo esc_url($avatar ?: $default_avatar); ?>" class="profile-img">
    <div class="edit-avatar" style="margin-top: 10px;">
    <label for="avatar-upload" style="background: #9fa6d0; padding: 6px 12px; border-radius: 20px; cursor: pointer; font-size: 13px;">
        <i class="fa-solid fa-camera"></i> Changer la photo
    </label>
    <input type="file" id="avatar-upload" accept="image/*" style="display: none;">
</div>

    <div class="profile-name">
        <h2><?php echo esc_html($prenom ?: 'Prénom'); ?></h2>
        <h2><?php echo esc_html($nom ?: 'Nom'); ?></h2>
    </div>

    <div class="edit">
    <a href="#" id="edit-profile-btn">Modifier le profil</a>
</div>
</div>

<!-- FORMULAIRE DE MODIFICATION (CACHÉ PAR DÉFAUT) -->
<div id="edit-profile-form" style="display: none; background: #f9f9f9; padding: 20px; border-radius: 10px; margin: 20px 80px;">
    <h3>Modifier mes informations</h3>
    <form id="profile-update-form">
        <div style="margin-bottom: 15px;">
            <label>Prénom :</label>
            <input type="text" id="edit-prenom" value="<?php echo esc_attr($prenom); ?>" style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <div style="margin-bottom: 15px;">
            <label>Nom :</label>
            <input type="text" id="edit-nom" value="<?php echo esc_attr($nom); ?>" style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <button type="submit" style="background: #000; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Enregistrer</button>
    </form>
</div>

<div class="container">

   <!-- LEFT COLUMN -->
<div class="left">
    <div class="menu">
        <button class="menu-btn active" data-tab="messagerie">
            <i class="fa-solid fa-envelope"></i> Messagerie
        </button>
        <button class="menu-btn" data-tab="favoris">
            <i class="fa-solid fa-star"></i> Favoris
        </button>
        <button class="menu-btn" data-tab="corbeille">
            <i class="fa-solid fa-trash"></i> Corbeille
        </button>
        <button class="menu-btn" data-tab="devis">
            <i class="fa-solid fa-file"></i> Devis
        </button>
    </div>

    <!-- CALENDAR (optionnel) -->
    <div class="calendar">
        <p class="date-title" id="current-date"></p>
        <input type="date" id="calendar">
    </div>
</div>

    <!-- RIGHT COLUMN -->
<div class="right">
    <div id="tab-messagerie" class="tab-content active">
    <h3>Messagerie</h3>
    <?php
        
   // Récupérer les discussions du client (non supprimées)
$discussions = pixmatch_get_client_discussions($current_user->ID, false);

    
    if (empty($discussions)) {
        echo '<p>Aucune discussion pour le moment.</p>';
    } else {
        foreach ($discussions as $discussion) :
    ?>
        <div class="discussion" 
             data-pro-id="<?php echo $discussion['pro_id']; ?>" 
             data-pro-nom="<?php echo esc_attr($discussion['pro_nom']); ?>">
            <div class="user">
                <img src="<?php echo $discussion['pro_avatar']; ?>">
                <div>
                    <strong><?php echo $discussion['pro_nom']; ?></strong>
                    <p><?php echo esc_html(substr($discussion['last_message'], 0, 50)) . '...'; ?></p>
                </div>
            </div>
            <div class="date"><?php echo $discussion['last_date']; ?></div>
            <div class="type">
                <strong>Type de demande</strong>
                <p>Demande de devis</p>
            </div>
            <button class="btn-supprimer" onclick="supprimerMessage(<?php echo $discussion['pro_id']; ?>); return false;">🗑️</button>
        </div>
    <?php 
        endforeach;
    }
    ?>
</div>

    <div id="tab-favoris" class="tab-content" style="display: none;">
    <h3>Mes favoris</h3>
    <?php
    $favoris = get_user_meta(get_current_user_id(), 'favoris', true) ?: [];
    if ($favoris) :
        foreach ($favoris as $pro_id) :
            $pro = get_userdata($pro_id);
            if ($pro) :
                // Récupérer l'avatar du photographe
                $avatar = get_avatar_url($pro_id, ['size' => 60]);
                if (!$avatar) {
                    $avatar = get_template_directory_uri() . '/assets/images/default-avatar.jpg';
                }
    ?>
                <div class="favori-card">
                    <img src="<?php echo esc_url($avatar); ?>" class="favori-avatar" alt="Photo">
                    <div class="favori-info">
                        <strong class="favori-nom"><?php echo $pro->display_name; ?></strong>
                        <a href="<?php echo home_url('/page-type-fiche-pro?pro_id=' . $pro_id); ?>" class="favori-lien">Voir le profil →</a>
                    </div>
                </div>
    <?php
            endif;
        endforeach;
    else :
        echo '<p class="no-favoris">Aucun favori pour le moment.</p>';
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
        <div class="discussion" data-pro-id="<?php echo $discussion['pro_id']; ?>">
            <div class="user">
                <img src="<?php echo $discussion['pro_avatar']; ?>">
                <div>
                    <strong><?php echo $discussion['pro_nom']; ?></strong>
                    <p><?php echo esc_html(substr($discussion['last_message'], 0, 50)) . '...'; ?></p>
                </div>
            </div>
            <div class="date"><?php echo $discussion['last_date']; ?></div>
            <div class="type">
                <strong>Type de demande</strong>
                <p>Demande de devis</p>
            </div>
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
        <?php
        // Récupérer les devis (table devis à créer)
        ?>
        <p>Aucun devis pour le moment.</p>
    </div>
</div>
</div>
<!-- POPUP MESSAGERIE -->
<div id="message-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <div class="popup-header">
            <h3 id="popup-user">Brun Nicolas</h3>
            <span class="close-popup">&times;</span>
        </div>
        <div class="popup-messages" id="popup-messages">
            <!-- Les messages apparaîtront ici -->
            <div class="message received">
                <strong>Brun Nicolas :</strong>
                <p>Bonjour, j’aurais besoin de vos services pour un mariage.</p>
                <span class="message-date">15.01.2026 14:30</span>
            </div>
            <div class="message sent">
                <strong>Vous :</strong>
                <p>Avec plaisir ! Pouvez-vous me donner plus de détails ?</p>
                <span class="message-date">15.01.2026 14:35</span>
            </div>
        </div>
        <div class="popup-reply">
            <textarea id="reply-message" placeholder="Écrire un message..."></textarea>
            <button id="send-reply">Envoyer</button>
        </div>
    </div>
</div>
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
        // Retirer la classe active de tous les boutons
        document.querySelectorAll('.menu-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        // Cacher tous les contenus
        document.querySelectorAll('.tab-content').forEach(tab => tab.style.display = 'none');

        // Afficher le bon onglet
        const tabId = this.dataset.tab;
        document.getElementById('tab-' + tabId).style.display = 'block';
    });
});
function restaurerDiscussion(proId) {
    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'restaurer_discussion',
            pro_id: proId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
// ===== GESTION DU PROFIL =====

// Afficher/masquer le formulaire de modification
document.getElementById('edit-profile-btn').addEventListener('click', function(e) {
    e.preventDefault();
    const form = document.getElementById('edit-profile-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
});

// Sauvegarder les modifications du profil
document.getElementById('profile-update-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const prenom = document.getElementById('edit-prenom').value;
    const nom = document.getElementById('edit-nom').value;

    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'update_profile_info',
            prenom: prenom,
            nom: nom
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
});

// Upload de la photo de profil
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
            } else {
                alert('Erreur lors de l\'upload');
            }
        });
    }
});
function supprimerMessage(proId) {
    if (!confirm('Supprimer cette discussion ?')) return;

    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'supprimer_discussion',
            pro_id: proId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
// ===== GESTION DU POPUP MESSAGERIE =====
const popup = document.getElementById('message-popup');
const popupUser = document.getElementById('popup-user');
const closePopup = document.querySelector('.close-popup');
const messagesDiv = document.getElementById('popup-messages');

// Ouvrir le popup et charger les messages
document.querySelectorAll('.discussion').forEach(discussion => {
    discussion.addEventListener('click', function() {
        const proId = this.getAttribute('data-pro-id');
        const proNom = this.getAttribute('data-pro-nom');
        
        popupUser.textContent = proNom;
        popup.setAttribute('data-current-pro', proId);
        
        // Charger les messages
        fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_messages&pro_id=' + proId)
            .then(response => response.json())
            .then(messages => {
                messagesDiv.innerHTML = '';
                
                messages.forEach(msg => {
                    const msgDiv = document.createElement('div');
                    msgDiv.className = msg.sender === 'client' ? 'message sent' : 'message received';
                    msgDiv.innerHTML = `
                        <strong>${msg.sender_name} :</strong>
                        <p>${msg.message}</p>
                        <span class="message-date">${msg.date}</span>
                    `;
                    messagesDiv.appendChild(msgDiv);
                });
                
                popup.style.display = 'block';
                document.body.style.overflow = 'hidden';
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            });
    });
});

// Fermer le popup
closePopup.addEventListener('click', function() {
    popup.style.display = 'none';
    document.body.style.overflow = '';
});

// Fermer en cliquant en dehors
window.addEventListener('click', function(e) {
    if (e.target === popup) {
        popup.style.display = 'none';
        document.body.style.overflow = '';
    }
});

// Envoyer un message
document.getElementById('send-reply').addEventListener('click', function() {
    const message = document.getElementById('reply-message').value;
    const proId = popup.getAttribute('data-current-pro');
    
    if (message.trim() !== '' && proId) {
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'send_message',
                pro_id: proId,
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Recharger les messages
                document.querySelector('.discussion[data-pro-id="' + proId + '"]').click();
                document.getElementById('reply-message').value = '';
            }
        });
    }
});
</script>

<?php wp_footer(); ?>
</body>
</html>

<?php
get_footer();
?>