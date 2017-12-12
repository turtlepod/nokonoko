<?php
/**
 * Customizer Radio Image Control
 *
 * @since 3.2.0
 * @extends WP_Customize_Control
**/
class Tamatebako_Customize_Radio_Image extends WP_Customize_Control {

	/**
	 * Control Type
	 *
	 * @since 3.2.0
	 * @var string $type control type.
	 */
	public $type = 'tamatebako-radio-image';

	/**
	 * Enqueue Scripts
	 *
	 * @since 3.2.0
	 */
	public function enqueue() {
		global $tamatebako;

		$file = trailingslashit( get_template_directory_uri() ) . $tamatebako->dir . '/customizer/assets/';

		/* CSS */
		wp_enqueue_style( "tamatebako-customizer-radio-image", $file . 'radio-image.css', array(), tamatebako_theme_version(), 'all' );

		/* JS */
		wp_enqueue_script( "tamatebako-customizer-radio-image", $file . 'radio-image.js', array( 'jquery', 'customize-controls' ), tamatebako_theme_version(), true );
	}

	/**
	 * Render Content
	 *
	 * @since 3.2.0
	 */
	public function render_content() {
		/* if no choices, bail. */
		if ( empty( $this->choices ) ) {
			return;
		}

		$value = $this->value();
		$choices = $this->choices;
		?>

		<?php if ( !empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; // add label if needed. ?>

		<?php if ( !empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; // add desc if needed. ?>

		<?php foreach ( $choices as $option => $data ) : ?>

			<label class="tmb-radio-image-item <?php echo esc_attr( $value === $option ? 'item-selected' : '' ); ?>" style="width:<?php echo esc_attr( $data['width'] );?>">
				<input type="radio" value="<?php echo esc_attr( $option ); ?>" name="<?php echo esc_attr( '_customize-radio-image-' . $this->id );?>" <?php $this->link(); checked( $value, $option ); ?> />
				<img src="<?php echo esc_url( $data['image'] ); ?>">
			</label>

		<?php endforeach; ?>

		<?php
	}
}
