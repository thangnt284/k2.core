<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
if (!defined("ABSPATH")) {
    exit();
}
?>
<style>
    img.k2-img-images {
        width: 100%;
        height: auto;
    }
    .k2-img-item {
        margin: 17px 0px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        border: 3px solid rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    .k2-img-active {
        border: 3px solid #304ffe;
    }
</style>

<?php
foreach ($settings['values'] as $key => $layout) {
    ?>
    <div class="k2-img-item <?php echo (isset($value) && $value === $key) ? 'k2-img-active' : '' ?>"
         data-imglayout="<?php echo $key ?>">
        <img class="k2-img-images" src="<?php echo $layout ?>" alt="<?php echo $key ?>">
    </div>
    <?php
}
?>
<input type="hidden" class="wpb_vc_param_value wpb-textinput pp-img-val <?php echo $settings['param_name'] ?>"
       name="<?php echo $settings['param_name'] ?>" value="<?php echo isset($value) ? $value : '' ?>">
<script>
    (function ($) {
        $(document).on('click', '.k2-img-item', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _val = $(this).attr('data-imglayout');
            $('.k2-img-val').val(_val);
            $('.k2-img-item').removeClass('k2-img-active');
            _this.addClass('k2-img-active');
        });
    })(jQuery);
</script>