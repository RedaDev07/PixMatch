<?php
// Inclure WordPress
require_once(dirname(__FILE__) . '/wp-load.php');

// Récupérer la recherche
$search = isset($_GET['s']) ? $_GET['s'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test recherche simple</title>
    <style>
        body { font-family: Arial; padding: 40px; max-width: 800px; margin: 0 auto; }
        .resultat { border: 1px solid #ccc; padding: 20px; margin: 20px 0; }
    </style>
</head>
<body>
    <h1>Recherche : <?php echo esc_html($search); ?></h1>

    <form method="get">
        <input type="text" name="s" value="<?php echo esc_attr($search); ?>">
        <button type="submit">Chercher</button>
    </form>

    <?php
    if (!empty($search)) {
        $query = new WP_Query('s=' . urlencode($search));

        echo '<p>Nombre de résultats : ' . $query->post_count . '</p>';

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="resultat">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                </div>
                <?php
            }
            wp_reset_postdata();
        } else {
            echo '<p>Aucun résultat</p>';
        }
    }
    ?>
</body>
</html>