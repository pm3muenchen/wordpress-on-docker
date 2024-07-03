<?php
/*
 * Elementor Events Addon for Elementor Events Manager List Widget
 * Author & Copyright: NicheAddon
*/
namespace Elementor;

if (!isset(get_option( 'eafe_prow_settings' )['naeafe_pro_events_list'])) { // enable & disable

if ( is_plugin_active( 'events-manager/events-manager.php' ) ) {

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	class Event_Elementor_Addon_EventsManagerList extends Widget_Base{

		/**
		 * Retrieve the widget name.
		*/
		public function get_name(){
			return 'naevents_em_list';
		}

		/**
		 * Retrieve the widget title.
		*/
		public function get_title(){
			return esc_html__( 'Events List', 'events-addon-for-elementor' );
		}

		/**
		 * Retrieve the widget icon.
		*/
		public function get_icon() {
			return 'eicon-archive-posts';
		}

		/**
		 * Retrieve the list of categories the widget belongs to.
		*/
		public function get_categories() {
			return ['naevents-em-category'];
		}

		/**
		 * Register Events Addon for Elementor Events Manager List widget controls.
		 * Adds different input fields to allow the user to change and customize the widget settings.
		*/
		protected function register_controls(){

			$events = get_posts( 'post_type="event"&numberposts=-1' );
	    $EventID = array();
	    if ( $events ) {
	      foreach ( $events as $event ) {
	        $EventID[ $event->ID ] = $event->post_title;
	      }
	    } else {
	      $EventID[ __( 'No ID\'s found', 'events-addon-for-elementor' ) ] = 0;
	    }

			$this->start_controls_section(
				'section_event',
				[
					'label' => esc_html__( 'Events List Options', 'events-addon-for-elementor' ),
				]
			);
			$this->add_control(
				'event_limit',
				[
					'label' => esc_html__( 'Limit', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 100,
					'step' => 1,
					'default' => 4,
					'description' => esc_html__( 'Enter the number of items to show.', 'events-addon-for-elementor' ),
				]
			);
			$this->add_control(
				'event_offset',
				[
					'label' => esc_html__( 'Offset', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 100,
					'step' => 1,
					'default' => '',
					'description' => esc_html__( 'For example, if you have ten results, if you set this to 5, only the last 5 results will be returned. A limit higher than 0 is required for offsets to work.', 'events-addon-for-elementor' ),
				]
			);
			$this->add_control(
				'event_scope',
				[
					'label' => __( 'Scope', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'all' 			 => esc_html__( 'All', 'events-addon-for-elementor' ),
						'future' 		 => esc_html__( 'Future', 'events-addon-for-elementor' ),
						'past' 			 => esc_html__( 'Past', 'events-addon-for-elementor' ),
						'today' 		 => esc_html__( 'Today', 'events-addon-for-elementor' ),
						'tomorrow' 	 => esc_html__( 'Tomorrow', 'events-addon-for-elementor' ),
						'month' 		 => esc_html__( 'Month', 'events-addon-for-elementor' ),
						'next-month' => esc_html__( 'Next Month', 'events-addon-for-elementor' ),
						'1-months' 	 => esc_html__( '1 Months', 'events-addon-for-elementor' ),
						'2-months' 	 => esc_html__( '2 Months', 'events-addon-for-elementor' ),
						'3-months' 	 => esc_html__( '3 Months', 'events-addon-for-elementor' ),
						'6-months' 	 => esc_html__( '6 Months', 'events-addon-for-elementor' ),
						'12-months'  => esc_html__( '12 Months', 'events-addon-for-elementor' ),
					],
					'default' => 'all',
				]
			);
			$this->add_control(
				'event_order',
				[
					'label' => __( 'Order', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'ASC' => esc_html__( 'Asending', 'events-addon-for-elementor' ),
						'DESC' => esc_html__( 'Desending', 'events-addon-for-elementor' ),
					],
					'default' => 'ASC',
				]
			);
			$this->add_control(
				'event_orderby',
				[
					'label' => __( 'Order By', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => esc_html__( 'None', 'events-addon-for-elementor' ),
						'event_name' => esc_html__( 'Event Name', 'events-addon-for-elementor' ),
						'location_name' => esc_html__( 'Location Name', 'events-addon-for-elementor' ),
						'event_name, location_name' => esc_html__( 'Event Name and Location Name', 'events-addon-for-elementor' ),
						'location_name, event_name' => esc_html__( 'Location Name and Event Name', 'events-addon-for-elementor' ),
					],
					'default' => 'event_name',
				]
			);
			$this->add_control(
				'event_category',
				[
					'label' => __( 'Certain Categories?', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT2,
					'default' => [],
					'options' => NAEEP_Controls_Helper_Output::get_terms_names( 'event-categories'),
					'multiple' => true,
				]
			);
			$this->add_control(
				'event_category_hide',
				[
					'label' => esc_html__( 'Hide Selected Categories?', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'events-addon-for-elementor' ),
					'label_off' => esc_html__( 'No', 'events-addon-for-elementor' ),
					'return_value' => 'true',
				]
			);
			$this->add_control(
				'event_tag',
				[
					'label' => __( 'Certain Tags?', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT2,
					'default' => [],
					'options' => NAEEP_Controls_Helper_Output::get_terms_names( 'event-tags'),
					'multiple' => true,
				]
			);
			$this->add_control(
				'event_tag_hide',
				[
					'label' => esc_html__( 'Hide Selected Tags?', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'events-addon-for-elementor' ),
					'label_off' => esc_html__( 'No', 'events-addon-for-elementor' ),
					'return_value' => 'true',
				]
			);
			$this->add_control(
				'event_id',
				[
					'label' => __( 'Certain Event\'s?', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT2,
					'default' => [],
					'options' => $EventID,
					'multiple' => true,
				]
			);
			$this->add_control(
				'event_year',
				[
					'label' => esc_html__( 'Year', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 2019,
					'max' => 3000,
					'step' => 1,
					'default' => '',
					'description' => esc_html__( 'Enter the month of items to show.', 'events-addon-for-elementor' ),
					'description' => __( 'If set to a year <b>(e.g. 2019)</b> only events that start or end during this year will be returned', 'events-addon-for-elementor'),
				]
			);
			$this->add_control(
				'event_month',
				[
					'label' => esc_html__( 'Month', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 12,
					'step' => 1,
					'default' => '',
					'description' => esc_html__( 'Enter the month of items to show.', 'events-addon-for-elementor' ),
					'condition' => [
						'event_year!' => '',
					],
				]
			);
			$this->add_control(
				'event_countries',
				[
					'label' => __( 'Countries', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none' => 'None',
						'AF' => 'Afghanistan',
						'AL' => 'Albania',
						'DZ' => 'Algeria',
						'AS' => 'American Samoa',
						'AD' => 'Andorra',
						'AO' => 'Angola',
						'AQ' => 'Antarctica',
						'AG' => 'Antigua and Barbuda',
						'AR' => 'Argentina',
						'AM' => 'Armenia',
						'AW' => 'Aruba',
						'AU' => 'Australia',
						'AT' => 'Austria',
						'AZ' => 'Azerbaijan',
						'BS' => 'Bahamas',
						'BH' => 'Bahrain',
						'BD' => 'Bangladesh',
						'BB' => 'Barbados',
						'BY' => 'Belarus',
						'BE' => 'Belgium',
						'BZ' => 'Belize',
						'BM' => 'Bermuda',
						'BJ' => 'Benin',
						'BT' => 'Bhutan',
						'BO' => 'Bolivia',
						'BA' => 'Bosnia and Herzegovina',
						'BW' => 'Botswana',
						'BR' => 'Brazil',
						'VG' => 'British Virgin Islands',
						'BN' => 'Brunei',
						'BG' => 'Bulgaria',
						'BF' => 'Burkina Faso',
						'BI' => 'Burundi',
						'CI' => 'C&ocirc;te D\'Ivoire',
						'KH' => 'Cambodia',
						'CM' => 'Cameroon',
						'CA' => 'Canada',
						'CV' => 'Cape Verde',
						'KY' => 'Cayman Islands',
						'CF' => 'Central African Republic',
						'TD' => 'Chad',
						'CL' => 'Chile',
						'CN' => 'China',
						'CO' => 'Colombia',
						'KM' => 'Comoros',
						'CR' => 'Costa Rica',
						'HR' => 'Croatia',
						'CU' => 'Cuba',
						'CY' => 'Cyprus',
						'CZ' => 'Czech Republic',
						'KP' => 'Democratic People\'s Republic of Korea',
						'CD' => 'Democratic Republic of the Congo',
						'DK' => 'Denmark',
						'DJ' => 'Djibouti',
						'DM' => 'Dominica',
						'DO' => 'Dominican Republic',
						'EC' => 'Ecuador',
						'EG' => 'Egypt',
						'SV' => 'El Salvador',
						'XE' => 'England',
						'GQ' => 'Equatorial Guinea',
						'ER' => 'Eritrea',
						'EE' => 'Estonia',
						'ET' => 'Ethiopia',
						'FJ' => 'Fiji',
						'FI' => 'Finland',
						'FR' => 'France',
						'PF' => 'French Polynesia',
						'GA' => 'Gabon',
						'GM' => 'Gambia',
						'GE' => 'Georgia',
						'DE' => 'Germany',
						'GH' => 'Ghana',
						'GR' => 'Greece',
						'GL' => 'Greenland',
						'GD' => 'Grenada',
						'GP' =>'Guadeloupe',
						'GU' => 'Guam',
						'GT' => 'Guatemala',
						'GN' => 'Guinea',
						'GW' => 'Guinea Bissau',
						'GY' => 'Guyana',
						'HT' => 'Haiti',
						'HN' => 'Honduras',
						'HK' => 'Hong Kong',
						'HU' => 'Hungary',
						'IS' => 'Iceland',
						'IN' => 'India',
						'ID' => 'Indonesia',
						'IR' => 'Iran',
						'IQ' => 'Iraq',
						'IE' => 'Ireland',
						'IL' => 'Israel',
						'IT' => 'Italy',
						'JE' => 'Jersey',
						'JM' => 'Jamaica',
						'JP' => 'Japan',
						'JO' => 'Jordan',
						'KZ' => 'Kazakhstan',
						'KE' => 'Kenya',
						'KI' => 'Kiribati',
						'KV' => 'Kosovo',
						'KW' => 'Kuwait',
						'KG' => 'Kyrgyzstan',
						'LA' => 'Laos',
						'LV' => 'Latvia',
						'LB' => 'Lebanon',
						'LS' => 'Lesotho',
						'LR' => 'Liberia',
						'LY' => 'Libya',
						'LI' => 'Liechtenstein',
						'LT' => 'Lithuania',
						'LU' => 'Luxembourg',
						'MO' => 'Macao',
						'MK' => 'Macedonia',
						'MG' => 'Madagascar',
						'MW' => 'Malawi',
						'MY' => 'Malaysia',
						'MV' => 'Maldives',
						'ML' => 'Mali',
						'MT' => 'Malta',
						'MH' => 'Marshall Islands',
						'MQ' => 'Mauritania',
						'MU' => 'Mauritius',
						'MR' => 'Mauritania',
						'MX' => 'Mexico',
						'FM' => 'Micronesia',
						'MD' => 'Moldova',
						'MC' => 'Monaco',
						'MN' => 'Mongolia',
						'ME' => 'Montenegro',
						'MA' => 'Morocco',
						'MZ' => 'Mozambique',
						'MM' => 'Myanmar(Burma)',
						'NA' => 'Namibia',
						'NR' => 'Nauru',
						'NP' => 'Nepal',
						'NL' => 'Netherlands',
						'AN' => 'Netherlands Antilles',
						'NC' => 'New Caledonia',
						'NZ' => 'New Zealand',
						'NI' => 'Nicaragua',
						'NE' => 'Niger',
						'NG' => 'Nigeria',
						'XI' => 'Northern Ireland',
						'MP' => 'Northern Mariana Islands',
						'NO' => 'Norway',
						'OM' => 'Oman',
						'PK' => 'Pakistan',
						'PW' => 'Palau',
						'PS' => 'Palestine',
						'PA' => 'Panama',
						'PG' => 'Papua New Guinea',
						'PY' => 'Paraguay',
						'PE' => 'Peru',
						'PH' => 'Philippines',
						'PL' => 'Poland',
						'PT' => 'Portugal',
						'PR' => 'Puerto Rico',
						'QA' => 'Qatar',
						'CG' => 'Republic of the Congo',
						'RN' => 'Réunion',
						'RO' => 'Romania',
						'RU' => 'Russia',
						'RW' => 'Rwanda',
						'ST' => 'S&agrave;o Tom&eacute; And Pr&iacute;ncipe',
						'KN' => 'Saint Kitts and Nevis',
						'LC' => 'Saint Lucia',
						'VC' => 'Saint Vincent and the Grenadines',
						'WS' => 'Samoa',
						'SM' => 'San Marino',
						'SA' => 'Saudi Arabia',
						'XS' => 'Scotland',
						'SN' => 'Senegal',
						'RS' => 'Serbia',
						'SC' => 'Seychelles',
						'SL' => 'Sierra Leone',
						'SG' => 'Singapore',
						'SK' => 'Slovakia',
						'SI' => 'Slovenia',
						'SB' => 'Solomon Islands',
						'SO' => 'Somalia',
						'ZA' => 'South Africa',
						'KR' => 'South Korea',
						'ES' => 'Spain',
						'LK' => 'Sri Lanka',
						'SD' => 'Sudan',
						'SR' => 'Suriname',
						'SZ' => 'Swaziland',
						'SE' => 'Sweden',
						'CH' => 'Switzerland',
						'SY' => 'Syria',
						'TW' => 'Taiwan',
						'TJ' => 'Tajikistan',
						'TZ' => 'Tanzania',
						'TH' => 'Thailand',
						'TL' => 'Timor-Leste',
						'TG' => 'Togo',
						'TO' => 'Tonga',
						'TT' => 'Trinidad and Tobago',
						'TN' => 'Tunisia',
						'TR' => 'Turkey',
						'TM' => 'Turkmenistan',
						'TV' => 'Tuvalu',
						'VI' => 'US Virgin Islands',
						'UG' => 'Uganda',
						'UA' => 'Ukraine',
						'AE' => 'United Arab Emirates',
						'GB' => 'United Kingdom',
						'US' => 'United States',
						'UY' => 'Uruguay',
						'UZ' => 'Uzbekistan',
						'VU' => 'Vanuatu',
						'VA' => 'Vatican',
						'VE' => 'Venezuela',
						'VN' => 'Vietnam',
						'XW' => 'Wales',
						'YE' => 'Yemen',
						'ZM' => 'Zambia',
						'ZW' => 'Zimbabwe',
					],
					'default' => 'none',
				]
			);
			$this->add_control(
				'event_bookings',
				[
					'label' => esc_html__( 'Only Events With Booking?', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'events-addon-for-elementor' ),
					'label_off' => esc_html__( 'No', 'events-addon-for-elementor' ),
					'return_value' => 'true',
				]
			);
			$this->add_control(
				'event_pagination',
				[
					'label' => esc_html__( 'Events Pagination?', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'events-addon-for-elementor' ),
					'label_off' => esc_html__( 'No', 'events-addon-for-elementor' ),
					'return_value' => 'true',
				]
			);
			$this->end_controls_section();// end: Section

			// Table
			$this->start_controls_section(
				'table_style',
				[
					'label' => esc_html__( 'Table', 'events-addon-for-elementor' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'table_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .naeep-em-list table' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'table_border',
					'label' => esc_html__( 'Border', 'events-addon-for-elementor' ),
					'selector' => '{{WRAPPER}} .naeep-em-list table td, {{WRAPPER}} .naeep-em-list table thead:first-child tr:first-child th',
				]
			);
			$this->add_control(
				'odd_options',
				[
					'label' => __( 'Odd Row', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'frontend_available' => true,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'odd_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .naeep-em-list table tbody>tr:nth-child(odd)>td' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'odd_color',
				[
					'label' => esc_html__( 'Color', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .naeep-em-list table tbody>tr:nth-child(odd)>td' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'even_options',
				[
					'label' => __( 'Even Row', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'frontend_available' => true,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'even_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .naeep-em-list table tbody>tr:nth-child(even)>td' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'even_color',
				[
					'label' => esc_html__( 'Color', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .naeep-em-list table tbody>tr:nth-child(even)>td' => 'color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();// end: Section

			// Head
			$this->start_controls_section(
				'sectn_style',
				[
					'label' => esc_html__( 'Table Head', 'events-addon-for-elementor' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'secn_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .naeep-em-list table thead tr' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'secn_border',
					'label' => esc_html__( 'Border', 'events-addon-for-elementor' ),
					'selector' => '{{WRAPPER}} .naeep-em-list table thead tr, {{WRAPPER}} .naeep-em-list table thead:first-child tr:first-child th',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'secn_box_shadow',
					'label' => esc_html__( 'Section Box Shadow', 'events-addon-for-elementor' ),
					'selector' => '{{WRAPPER}} .naeep-em-list table thead tr',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Typography', 'events-addon-for-elementor' ),
					'name' => 'sastable_head_typography',
					'selector' => '{{WRAPPER}} .naeep-em-list table thead th',
				]
			);
			$this->add_control(
				'sastable_head_color',
				[
					'label' => esc_html__( 'Color', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .naeep-em-list table thead th' => 'color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();// end: Section

			// Text
			$this->start_controls_section(
				'section_text_style',
				[
					'label' => esc_html__( 'Text', 'events-addon-for-elementor' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'label' => esc_html__( 'Typography', 'events-addon-for-elementor' ),
						'name' => 'text_typography',
						'selector' => '{{WRAPPER}} .naeep-em-list table td',
					]
				);
				$this->add_control(
					'text_color',
					[
						'label' => esc_html__( 'Color', 'events-addon-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .naeep-em-list table td' => 'color: {{VALUE}};',
						],
					]
				);
			$this->end_controls_section();// end: Section

			// Link
			$this->start_controls_section(
				'section_link_style',
				[
					'label' => esc_html__( 'Link', 'events-addon-for-elementor' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Typography', 'events-addon-for-elementor' ),
					'name' => 'link_typography',
					'selector' => '{{WRAPPER}} .naeep-em-list table td a',
				]
			);
			$this->start_controls_tabs( 'link_style' );
				$this->start_controls_tab(
					'link_normal',
					[
						'label' => esc_html__( 'Normal', 'events-addon-for-elementor' ),
					]
				);
				$this->add_control(
					'link_color',
					[
						'label' => esc_html__( 'Color', 'events-addon-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .naeep-em-list table td a' => 'color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();  // end:Normal tab
				$this->start_controls_tab(
					'link_hover',
					[
						'label' => esc_html__( 'Hover', 'events-addon-for-elementor' ),
					]
				);
				$this->add_control(
					'link_hover_color',
					[
						'label' => esc_html__( 'Color', 'events-addon-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .naeep-em-list table td a:hover' => 'color: {{VALUE}};',
						],
					]
				);
				$this->end_controls_tab();  // end:Hover tab
			$this->end_controls_tabs(); // end tabs
			$this->end_controls_section();// end: Section

			// Pagination
			$this->start_controls_section(
				'section_pagi_style',
				[
					'label' => esc_html__( 'Pagination', 'events-addon-for-elementor' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'event_pagination' => 'true',
					],
				]
			);
			$this->add_responsive_control(
				'pagi_min_width',
				[
					'label' => esc_html__( 'Size', 'events-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 35,
							'max' => 500,
							'step' => 1,
						],
					],
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .em-pagination a, {{WRAPPER}} .em-pagination span' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'pagi_typography',
					'selector' => '{{WRAPPER}} .em-pagination a, {{WRAPPER}} .em-pagination span',
				]
			);
			$this->start_controls_tabs( 'pagi_style' );
				$this->start_controls_tab(
					'pagi_normal',
					[
						'label' => esc_html__( 'Normal', 'events-addon-for-elementor' ),
					]
				);
				$this->add_control(
					'pagi_color',
					[
						'label' => esc_html__( 'Color', 'events-addon-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .em-pagination a' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'pagi_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'events-addon-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .em-pagination a' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'pagi_border',
						'label' => esc_html__( 'Border', 'events-addon-for-elementor' ),
						'selector' => '{{WRAPPER}} .em-pagination a',
					]
				);
				$this->end_controls_tab();  // end:Normal tab

				$this->start_controls_tab(
					'pagi_hover',
					[
						'label' => esc_html__( 'Hover', 'events-addon-for-elementor' ),
					]
				);
				$this->add_control(
					'pagi_hover_color',
					[
						'label' => esc_html__( 'Color', 'events-addon-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .em-pagination a:hover' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'pagi_bg_hover_color',
					[
						'label' => esc_html__( 'Background Color', 'events-addon-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .em-pagination a:hover' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'pagi_hover_border',
						'label' => esc_html__( 'Border', 'events-addon-for-elementor' ),
						'selector' => '{{WRAPPER}} .em-pagination a:hover',
					]
				);
				$this->end_controls_tab();  // end:Hover tab
				$this->start_controls_tab(
					'pagi_active',
					[
						'label' => esc_html__( 'Active', 'events-addon-for-elementor' ),
					]
				);
				$this->add_control(
					'pagi_active_color',
					[
						'label' => esc_html__( 'Color', 'events-addon-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .em-pagination span.current' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'pagi_bg_active_color',
					[
						'label' => esc_html__( 'Background Color', 'events-addon-for-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .em-pagination span.current' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'pagi_active_border',
						'label' => esc_html__( 'Border', 'events-addon-for-elementor' ),
						'selector' => '{{WRAPPER}} .em-pagination span.current',
					]
				);
				$this->end_controls_tab();  // end:Active tab
			$this->end_controls_tabs(); // end tabs

			$this->end_controls_section();// end: Section

		}

		/**
		 * Render Events Manager List widget output on the frontend.
		 * Written in PHP and used to generate the final HTML.
		*/
		protected function render() {
			$settings = $this->get_settings_for_display();
			$event_limit 			= !empty( $settings['event_limit'] ) ? $settings['event_limit'] : '';
			$event_offset 		= !empty( $settings['event_offset'] ) ? $settings['event_offset'] : '';
			$event_scope 			= !empty( $settings['event_scope'] ) ? $settings['event_scope'] : '';
			$event_order 			= !empty( $settings['event_order'] ) ? $settings['event_order'] : '';
			$event_orderby 		= !empty( $settings['event_orderby'] ) ? $settings['event_orderby'] : '';
			$event_category 	= !empty( $settings['event_category'] ) ? $settings['event_category'] : '';
			$event_category_hide 	= !empty( $settings['event_category_hide'] ) ? $settings['event_category_hide'] : '';
			$event_tag 				= !empty( $settings['event_tag'] ) ? $settings['event_tag'] : '';
			$event_tag_hide 	= !empty( $settings['event_tag_hide'] ) ? $settings['event_tag_hide'] : '';
			$event_id 			  = !empty( $settings['event_id'] ) ? $settings['event_id'] : '';
			$event_year 			= !empty( $settings['event_year'] ) ? $settings['event_year'] : '';
			$event_month 			= !empty( $settings['event_month'] ) ? $settings['event_month'] : '';
			$event_countries 	= !empty( $settings['event_countries'] ) ? $settings['event_countries'] : '';
			$event_bookings 	= !empty( $settings['event_bookings'] ) ? $settings['event_bookings'] : '';
			$event_pagination = !empty( $settings['event_pagination'] ) ? $settings['event_pagination'] : '';

			$category_hide = $event_category_hide ? '-' : '';
			$tag_hide = $event_tag_hide ? '-' : '';

			$event_bookings = $event_bookings ? '1' : '';
			$event_pagination = $event_pagination ? '1' : '';

			$limit = $event_limit ? ' limit="'.$event_limit.'"' : '';
			$offset = $event_offset ? ' offset="'.$event_offset.'"' : '';
			$scope = $event_scope ? ' scope="'.$event_scope.'"' : '';
			$order = $event_order ? ' order="'.$event_order.'"' : '';
			$orderby = $event_orderby ? ' orderby="'.$event_orderby.'"' : '';
			$category = $event_category ? ' category="'.$category_hide.implode(', '.$category_hide, $event_category).'"' : '';
			$tag = $event_tag ? ' tag="'.$tag_hide.implode(', '.$tag_hide, $event_tag).'"' : '';
			$show_id = $event_id ? ' post_id="'.implode(',', $event_id).'"' : '';
			$year = $event_year ? ' year="'.$event_year.'"' : '';
			$month = $event_month ? ' month="'.$event_month.'"' : '';
			$countries = $event_countries ? ' country="'.$event_countries.'"' : '';
			$bookings = $event_bookings ? ' bookings="'.$event_bookings.'"' : '';
			$pagination = $event_pagination ? ' pagination="'.$event_pagination.'"' : '';

			if ($event_countries !== 'none') {
				$countries = $countries;
			} else {
				$countries = '';
			}

	  	$output = '<div class="naeep-em-list">'.do_shortcode( '[events_list' . $limit . $offset . $scope . $order . $orderby . $category . $tag . $show_id . $year . $month . $countries . $bookings . $pagination . ']' ).'</div>';

		  echo $output;

		}

	}
	Plugin::instance()->widgets_manager->register_widget_type( new Event_Elementor_Addon_EventsManagerList() );
}

} // enable & disable