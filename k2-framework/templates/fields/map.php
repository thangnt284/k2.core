<div class="form-group">
    <div class="pac-card" id="pac-card">
        <div>
            <div id="type-selector" class="pac-controls">
                <input type="radio" name="type" id="changetype-all" checked="checked">
                <label for="changetype-all"><?php esc_html_e( 'All', 'fsflex' ); ?></label>

                <input type="radio" name="type" id="changetype-establishment">
                <label for="changetype-establishment"><?php esc_html_e( 'Establishments', 'fsflex' ); ?></label>

                <input type="radio" name="type" id="changetype-address">
                <label for="changetype-address"><?php esc_html_e( 'Addresses', 'fsflex' ); ?></label>

                <input type="radio" name="type" id="changetype-geocode">
                <label for="changetype-geocode"><?php esc_html_e( 'Geocodes', 'fsflex' ); ?></label>
            </div>
            <div id="strict-bounds-selector" class="pac-controls">
                <input type="checkbox" id="use-strict-bounds" value="">
                <label for="use-strict-bounds"><?php esc_html_e( 'Strict Bounds', 'fsflex' ); ?></label>
            </div>
        </div>
        <div id="pac-container">
            <input id="pac-input" type="text" name="<?php echo isset( $name ) ? $name : ''; ?>[address]"
                   placeholder="<?php esc_html_e( 'Enter a location', 'fsflex' ); ?>"
                   value="<?php echo isset( $value['address'] ) ? $value['address'] : ''; ?>">
        </div>
    </div>
    <div class=" clearfix row">
        <div class=""></div>
    </div>
    <div id="fs_map" style="width: 100%; height: 500px;"></div>
    <input class="hidden" id="fs_map_position" name="<?php echo isset( $name ) ? $name : ''; ?>[position]"
           value="<?php echo isset( $value['position'] ) ? $value['position'] : ''; ?>">
</div>