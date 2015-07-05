<?php
/**
 * Layout Customizer Control
 *
 * @since  3.0.0
 * @access public
 */
class Tamatebako_Customize_Layout extends WP_Customize_Control {

	/* Type */
	public $type = 'radio';

	/* Default Section */
	public $section = 'layout';

	/* Default Section */
	//public $choices = $this->tamatebako_layouts();

	/**
	 * Layout Choices
	 */
	public function tamatebako_layouts() {

		/* Get theme layout args. */
		$layouts_args = tamatebako_layouts_args();
		$layouts = tamatebako_layouts();

		/* Add default layout info in layout name */
		$layouts[tamatebako_layout_default()]['name'] = $layouts[tamatebako_layout_default()]['name'] . ' (' . tamatebako_string( 'default' ) . ')';

		/*  Layout choices*/
		$layouts_choices = array();
		foreach( $layouts as $layout => $layout_data ){

			/* If theme using layout thumbnail */
			if( true == $layouts_args['thumbnail'] ){
				$layouts_choices[$layout] = '<img src="' . esc_url( $layout_data['thumbnail'] ) . '" class="layout-thumbnail" title="' . esc_attr( $layout_data['name'] ) . '">' . '<span class="layout-name">' . $layout_data['name'] . '</span>';
			}
			/* No thumbnail, use as regular radio button. */
			else{
				$layouts_choices[$layout] = $layout_data['name'];
			}
		}
		return $layouts_choices;
	}

	/**
	 * Render Content
	 */
	public function render_content() {

		/* Do not render if there's no layout. */
		$layouts = $this->tamatebako_layouts();
		if ( empty( $layouts ) ){
			return;
		}

		$name = '_customize-radio-' . $this->id;

		$layouts_args = tamatebako_layouts_args();
		if( false == $layouts_args['thumbnail'] ){
			echo '<div class="customize-theme-layouts-wrap">';
		}
		else{
			echo '<div class="customize-theme-layouts-wrap theme-layouts-thumbnail-wrap">';
		}

		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
		if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description ; ?></span>
		<?php endif;

		foreach ( $layouts as $layout => $layout_data ){
			$class = "";
			if( tamatebako_layout_default() == $layout ){
				$class .= " layout-default";
			}
			if( tamatebako_current_layout() == $layout ){
				$class .= " layout-selected";
			}
			?>
			<label class="theme-layout-label<?php echo esc_attr( $class );?>">
				<input class="theme-layout-input" type="radio" value="<?php echo esc_attr( $layout ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $layout ); ?> />
				<?php echo $layout_data; ?><br/>
			</label>
			<?php
		}

		echo '</div>';
	}
}
