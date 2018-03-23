<?php
/**
Plugin Name:  Bootstrap Button Widget
Plugin URI:   http://stevensteinwand.com
Description:  A widget for custom links
Version:      1
Author:       Steven Stein
Author URI:   https://stevensteinwand.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
Domain Path:  /languages
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Adds Bsb_Widget widget.
 */
class Bsb_Widget extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'bsb_widget', // Base ID
            esc_html__('Bootstrap Button Widget', 'text_domain'), // Name
            array('description' => esc_html__('A widget for custom link buttons', 'text_domain'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        if (!empty($instance['link'])) {
            echo "<a href=". apply_filters('widget_title', $instance['link']) ." class=\" "  . $instance['class'] ." \" >" . $instance['text'] . "</a>";
        }
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('', 'text_domain');
        $link = !empty($instance['link']) ? $instance['link'] : esc_html__('URL', 'text_domain');
        $class = !empty($instance['class']) ? $instance['class'] : esc_html__('Classes', 'text_domain');
        $text = !empty($instance['text']) ? $instance['text'] : esc_html__('Text', 'text_domain');
        ?>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php esc_attr_e('URL:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text"
                   value="<?php echo esc_attr($link); ?>">
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('class')); ?>"><?php esc_attr_e('Classes:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('class')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('class')); ?>" type="text"
                   value="<?php echo esc_attr($class); ?>">
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_attr_e('Text:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('text')); ?>" type="text"
                   value="<?php echo esc_attr($text); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['link'] = (!empty($new_instance['link'])) ? strip_tags($new_instance['link']) : '';
        $instance['class'] = (!empty($new_instance['class'])) ? strip_tags($new_instance['class']) : '';
        $instance['text'] = (!empty($new_instance['text'])) ? strip_tags($new_instance['text']) : '';

        return $instance;
    }

} // class Bsb_Widget

// register Foo_Widget widget
function register_bsb_widget()
{
    register_widget('Bsb_Widget');
}

add_action('widgets_init', 'register_bsb_widget');

?>