<?php

/**a
 * Provide a view for a section
 *
 * Enter text below to appear below the section title on the Settings page
 *
 * @link       https://renoon.com/partners/woocommerce-plugin
 * @since      1.0.0
 *
 * @package    renoon_tracking
 * @subpackage renoon_tracking/admin/partials
 */

?>
 <div class="renoon-tracking-note">
                            <h3><?php 
            echo  esc_html__( 'Instructions', 'renoon_tracking_pro' ) ;
            ?></h3>
                            <p><?php 
            echo  sprintf( wp_kses( __( 'Orders only count when they have been placed in the "Processing" state after the credit card has been charged', 'renoon_tracking_pro' ), array(
                'a' => array(
                'href'   => array(),
                'target' => array(),
            ),
            ) ), esc_url( 'https://renoon.com/partners/woocommerce-plugin' ) ) ;
            ?></p>
            <h3><?php 
            echo  esc_html__( 'Documentation', 'renoon_tracking_pro' ) ;
            ?></h3>
              <p><?php 
            echo  sprintf( wp_kses( __( '<a href="%s" target="_blank">Documenation</a>. Enjoy.', 'renoon_tracking_pro' ), array(
                'a' => array(
                'href'   => array(),
                'target' => array(),
            ),
            ) ), esc_url( 'https://renoon.com/partners/woocommerce-plugin' ) ) ;
            ?></p>

                        </div>