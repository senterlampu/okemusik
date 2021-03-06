<?php
/**
 * @version    $Id$
 * @package    IG Pagebuilder
 * @author     InnoGearsTeam <support@TI.com>
 * @copyright  Copyright (C) 2012 TI.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.TI.com
 * Technical Support:  Feedback - http://www.TI.com
 */
if ( ! class_exists( 'IG_Item_Pricing' ) ) {

	class IG_Item_Pricing extends IG_Pb_Shortcode_Child {

		public function __construct() {
			parent::__construct();
		}

		/**
		 * DEFINE configuration information of shortcode
		 */
		public function element_config() {
			$this->config['shortcode'] = strtolower( __CLASS__ );
			$this->config['exception'] = array(
				'data-modal-title' => esc_html__( 'Table Option', 'dashstore' )
			);
		}

		/**
		 * DEFINE setting options of shortcode
		 */
		public function element_items() {
			$this->items = array(
				'Notab' => array(
					array(
                        'name'    => esc_html__( 'Option Type', 'dashstore' ),
                        'id'      => 'option_type',
                        'type'    => 'select',
                        'std'     => 'text',
                        'options' => array(
							'text' => esc_html__( 'Text', 'dashstore' ),
							'check' => esc_html__( 'Text with Icon (yes/no)', 'dashstore' ),
							'rating' => esc_html__( 'Star Rating', 'dashstore' ),
						),
						'has_depend' => '1',
                    ),
                    array(
                        'name' 	  => esc_html__( 'Option Text',  'dashstore' ),
                        'desc'    => esc_html__( 'Enter some content for the banner text block', 'dashstore' ),
                        'id'      => 'option_text',
                        'type'    => 'editor',
                        'role'    => 'content',
                        'std'     => '',
                        'rows'    => 5,
                        'dependency' => array( 'option_type', '!=', 'rating' ),
                    ),
					array(
						'name'       => esc_html__( 'Choose Icon for this option', 'dashstore' ),
						'id'         => 'check_value',
						'type'       => 'radio',
						'std'        => 'no',
						'options'    => array( 'yes' => esc_html__( 'Yes',  'dashstore' ), 'no' => esc_html__( 'No',  'dashstore' ) ),
                        'dependency' => array( 'option_type', '=', 'check' ),
					),
					array(
                        'name'    => esc_html__( 'Star rating', 'dashstore' ),
                        'id'      => 'rating_value',
                        'type'    => 'select',
                        'std'     => '3',
                        'options' => array(
							'1' => esc_html__( '1 Star', 'dashstore' ),
							'2' => esc_html__( '2 Stars', 'dashstore' ),
							'3' => esc_html__( '3 Stars', 'dashstore' ),
							'4' => esc_html__( '4 Stars', 'dashstore' ),
							'5' => esc_html__( '5 Stars', 'dashstore' ),
						),
						'dependency' => array( 'option_type', '=', 'rating' ),
                    ),
				)
			);
		}

		/**
		 * DEFINE shortcode content
		 *
		 * @param type $atts
		 * @param type $content
		 */
		public function element_shortcode_full( $atts = null, $content = null ) {
			extract( shortcode_atts( $this->config['params'], $atts ) );

			$html_output = '<li>';

			switch ( $option_type ) {
				case 'text':
					$html_output .= $content;
				break;

				case 'check':
					$icon = '<i class="fa fa-times-circle no"></i>';
					if ($check_value === 'yes') {
						$icon = '<i class="fa fa-check-circle"></i>';
					}
					$html_output .= $icon.$content;
				break;

				case 'rating':
					$width = absint($rating_value*2);
					$html_output .= '<div class="star-rating"><span style="width:'.$width.'0%"></span></div>';
				break;
			}

			$html_output .= '</li><!--separate-->';

			return $html_output;
		}

	}

}
