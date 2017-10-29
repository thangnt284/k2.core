<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
echo '<pre>';
var_dump($settings);
var_dump($value);
echo '</pre>';
if (!defined("ABSPATH")) {
    exit();
}
?>
<style>
    img.pp-img-images {
        width: 100%;
        height: auto;
    }
    .pp-img-item {
        margin: 17px 0px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        border: 3px solid rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    .pp-img-active {
        border: 3px solid #304ffe;
    }
</style>

<?php
die();
foreach ($settings['values'] as $key => $layout) {
    ?>
    <div class="pp-img-item <?php echo (isset($value) && $value === $key) ? 'pp-img-active' : '' ?>"
         data-imglayout="<?php echo $key ?>">
        <img class="pp-img-images" src="<?php echo $layout ?>" alt="<?php echo $key ?>">
    </div>
    <?php
}
?>
<input type="hidden" class="wpb_vc_param_value wpb-textinput pp-img-val <?php echo $settings['param_name'] ?>"
       name="<?php echo $settings['param_name'] ?>" value="<?php echo isset($value) ? $value : '' ?>">
<script>
    (function ($) {
        $(document).on('click', '.pp-img-item', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _val = $(this).attr('data-imglayout');
            $('.pp_search_layout').val(_val);
            $('.pp-img-item').removeClass('pp-img-active');
            _this.addClass('pp-img-active');
        });
    })(jQuery);
</script>