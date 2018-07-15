<?php

/**
 * Class GenesisAccessibleThemeSupport
 */
class GenesisAccessibleThemeSupport {

	/**
	 * Array of Genesis accessibility features added by the theme.
	 *
	 * @var array
	 */
	protected $supports;

	/**
	 * Get the theme accessibility settings.
	 * @since 1.3.0
	 *
	 * @return array
	 */
	public function get_theme_support() {
		if ( isset( $this->supports ) ) {
			return $this->supports;
		}
		$theme_support  = get_theme_support( 'genesis-accessibility' );
		$this->supports = $theme_support ? $theme_support[0] : array();

		return $this->supports;
	}
}
