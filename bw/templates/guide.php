<div id="bwg" class="bwg">

    <?php do_action( 'bwg_header' ); ?>

    <div class="bwg-content">

        <div class="bwg-tabs">

            <span id="bwg-message-codes" class="bwg-message"><?php esc_html_e( 'Please activate the required plugins in order to use all the features of the theme', 'yago' ); ?></span>

            <ol class="bwg-tabs-list">
                <?php $class_active = true; ?>
                <?php foreach( Bw_guide::$support as $support => $opt ): ?>
                    <?php if( Bw_guide::is_support( $support ) ): ?>
                        <?php $class_arr = array(); ?>
                        <?php if( isset( $opt['dummy'] ) and $opt['dummy'] == true ) { $class_arr[] = 'bwg-dummy'; } ?>
                        <?php if( $class_active ) { $class_arr[] = 'bwg-active'; } ?>
                        <li class="<?php echo implode( ' ', $class_arr ); ?>" data-hash="<?php echo esc_attr( $support ); ?>"><?php if( isset( $opt['label'] ) ) { echo esc_attr( $opt['label'] ); } ?></li>
                        <?php $class_active = false; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

            </ol>

            <ul class="bwg-tabs-content">

                <?php $class_active = true; ?>
                <?php foreach( Bw_guide::$support as $support => $opt ): ?>
                    <?php if( Bw_guide::is_support( $support ) ): ?>
                        <?php if( isset( $opt['dummy'] ) and $opt['dummy'] == true ) { continue; } ?>
                        <li <?php echo $class_active ? 'class="bwg-active"' : ''; ?>>
                            <?php do_action( 'bwg_support_' . $support ); ?>
                        </li>
                        <?php $class_active = false; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</div>
