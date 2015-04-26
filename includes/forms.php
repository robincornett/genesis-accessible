<?php
/** forms.php
*	Description: Adds label and id to the search forms
*	Author: Rian Rietveld
*	Plugin URI: http://genesis-accessible.org/
*	License: GPLv2 or later
*/

//* Replace the search form, function adds a real label and an id for the search input field
//* Based on the genesis_search_form with Genesis 2.0.2, keeps the filters

add_filter( 'get_search_form', 'wpaccgen_get_search_form_uniqueid', 20 );

/**
 * Replace the default search form with a Genesis-specific accessible form.
 *
 * The exact output depends on whether the child theme supports HTML5 or not.
 *
 * Applies the `genesis_search_text`, `genesis_search_button_text`, `genesis_search_form_label` and
 * `genesis_search_form` filters.
 *
 * @since 0.2.0
 *
 * @uses genesis_html5() Check for HTML5 support.
 *
 * @return string HTML markup.
 */
function wpaccgen_get_search_form_uniqueid() {

	$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis' ) . '&#x02026;' );

	$button_text = apply_filters( 'genesis_search_button_text', esc_attr__( 'Search', 'genesis' ) );

	$onfocus = "if ('" . esc_js( $search_text ) . "' === this.value) {this.value = '';}";
	$onblur  = "if ('' === this.value) {this.value = '" . esc_js( $search_text ) . "';}";

	//* Generate ramdom id for the search field (n case there are more than one search form on the page)
	$form_id = uniqid( 'searchform-' );

	//* Empty label, by default. Filterable.
	$label = apply_filters( 'genesis_search_form_label', '' );
	if ( '' == $label )  {
		$label = apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis' ) );
	}

	$value_or_placeholder = ( get_search_query() == '' ) ? 'placeholder' : 'value';

	if ( genesis_html5() ) {

		$form  = sprintf( '<form %s>', genesis_attr( 'search-form' ) );

		$form .= sprintf(
				'<meta itemprop="target" content="%s"/><label for="%s">%s</label><input itemprop="query-input" type="search" name="s" id="%s" %s="%s" /><input type="submit" value="%s" /></form>',
				home_url( '/?s={s}' ),
				esc_attr( $form_id ),
				esc_html( $label ),
				esc_attr( $form_id ),
				$value_or_placeholder,
				esc_attr( $search_text ),
				esc_attr( $button_text )
		);

	} else {
		$form = sprintf( '<form method="get" class="searchform search-form" action="%s" role="search" >%s<input type="text" value="%s" name="s" id="%s" class="s search-input" onfocus="%s" onblur="%s" /><input type="submit" class="searchsubmit search-submit" value="%s" /></form>', home_url( '/' ), $label, $id, esc_attr( $search_text ), esc_attr( $onfocus ), esc_attr( $onblur ), esc_attr( $button_text ) );
	}

	return apply_filters( 'genesis_search_form', $form, $search_text, $button_text, $label );

}
