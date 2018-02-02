<?php
/**
 * Custom Fonts: Custom Control.
 * Slightly modified radio option.
 *
 * @since 3.2.0
 * @author GenbuMedia
**/

/**
 * Tamatebako Custom Fonts Customize
 *
 * @since 3.2.0
 * @author GenbuMedia
 * @extends WP_Customize_Control
 */
class Tamatebako_Custom_Fonts_Customize extends WP_Customize_Control {

	/**
	 * Render Content
	 *
	 * @since 3.2.0
	 */
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}

		$name = '_customize-radio-' . $this->id;
		?>

		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description ; ?></span>
		<?php endif; ?>

		<?php foreach ( $this->choices as $value => $label ) : ?>
			<label>
				<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
				<span style="font-size:20px;line-height:35px;font-family:<?php echo esc_attr( tamatebako_get_font_family( $value ) );?>;"><?php echo esc_html( $label ); ?></span><br/>
			</label>
		<?php endforeach; ?>

		<?php
	}
}
