<?php
/**
 * Plugin Name:       MSI para El Buen Fin
 * Description:       Plugin para mostrar el precio a 3,6,12 Meses sin Intereses en la pagina individual de productos de WooCommerce. Antes de añadir al carrito.
 * Version:           1.0
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            Manuel Ramirez Coronel
 * Author URI:        https://github.com/racmanuel
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text-domain:       msi_buen_fin
 */

/** Prevent Data Leaks */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Include CSS file for MSI
 */
function msi_buen_fin_scripts()
{
    wp_register_style('msi-wc', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_style('msi-wc');
}

add_action('wp_enqueue_scripts', 'msi_buen_fin_scripts');


/**
 * MSI Windsor
 */
function msi_buen_fin_show_msi()
{
    $product = wc_get_product(get_the_ID());

    //Get the Price
    $original_price = $product->get_price();

    //3 MSI
    $MSI3 = $original_price / 3;
    $MSIR3 = round($MSI3, 2);

    //6 MSI
    $MSI6 = $original_price / 6;
    $MSIR6 = round($MSI6, 2);

    //6 MSI
    $MSI12 = $original_price / 12;
    $MSIR12 = round($MSI12, 2);

    // Get the Image
    $image = plugin_dir_url(__FILE__) . 'assets/img/logo_buen_fin_banner_princ.png';
    //Print the Result
    echo "
    <div class='row' id='msi-woocommerce'>
        <div class='column'>
            <div class='row'>
                <img src='{$image}' class='img-msi-woocommerce'></img>
                <h2 class='title-msi-woocommerce'>¡Aprovecha los precios del Buen Fin + MSI!</h2>
            </div>
            <div class='row'>
               <div class='column msi-woocommerce'>
                    <span>
                        <strong>$ {$MSIR3} MXN </strong> a <strong>3 MSI</strong>.
                    </span>
               </div>
               <div class='column msi-woocommerce'>
                    <span>
                        <strong>$ {$MSIR6} MXN </strong> a <strong>6 MSI</strong>.
                    </span>
               </div>
               <div class='column msi-woocommerce'>
                    <span>
                        <strong>$ {$MSIR12} MXN  </strong>a <strong>12 MSI</strong>.
                    </span>
               </div>
            </div>
            <div class='row'>
                    <span class='conditions-msi-woocommerce'>* Promocion valida solo con tarjetas de crédito y bancos participantes del 1 al 16 de noviembre de 2021.</span>
            </div>
        </div>
    </div>";
}
add_action('woocommerce_before_add_to_cart_form', 'msi_buen_fin_show_msi');

