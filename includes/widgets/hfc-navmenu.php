<?php
namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class HFC_Nav_Menu_Widget extends Widget_Base {


	public function __construct($data = [], $args = null) {	
		parent::__construct($data, $args);	
		wp_register_style( 'hfc-navmenu-style', HEADER_FOOTER_COMPOSER_BASE_URL . 'public/css/hfc-navmenu.css', [ 'elementor-frontend', 'elementor-icons-fa-solid' ], HEADER_FOOTER_COMPOSER_VERSION, 'all' );				  	
		wp_register_script( 'hfc-navmenu-script', HEADER_FOOTER_COMPOSER_BASE_URL . 'public/js/hfc-navmenu.js', array( 'jquery' ), HEADER_FOOTER_COMPOSER_VERSION, true );		
	}
	
	public function get_style_depends() {
		return [ 'hfc-navmenu-style' ];
	}	
		
	public function get_script_depends() {
		return [ 'hfc-navmenu-script' ];
	}	

	public function get_name() {
		return 'hfc-nav-menu';
	}

	public function get_title() {
		return esc_html__( 'Nav Menu', 'header-footer-composer' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
        return [ 'hfc-elementor-widgets' ];
	}	
	
	/*
	*
	* Get all Available Menu in array.
	*/
	public function hfc_menu_array(){
	
			$hfc_menu_ed = wp_get_nav_menus();
			
			// Initate an empty array
			$menu_options = array();
			$menu_options['0'] = esc_attr__( 'Select a Menu', 'header-footer-composer' );
			
			if ( ! empty( $hfc_menu_ed ) ) {
				foreach ( $hfc_menu_ed as $menu ) {
						$menu_options[ $menu->term_id ] = $menu->name;    
				}
			}
			return $menu_options;
	}		

	protected function _register_controls() {
		$this->start_controls_section(
			'hfc_navmenu_section_tab', [
				'label' => esc_html__( 'Nav Menu', 'header-footer-composer' ),
			]
		);			
		

		$this->add_control(
			'hfc_nav_menu_ed',
			[
				'label' => __( 'Select Menu', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->hfc_menu_array(),
				'render_type ' => 'template',
			]
		);
		
		$this->add_control(
			'hfc_nav_menu_note',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<small>Please Go to the Dashboard >> Appereance >> Menus screen to manage your menus.', 'header-footer-composer' ),				
			]
		);					
		
		$this->add_control(
			'hfc_nav_menu_layout_label',
			[
				'label' => __( 'Menu Layout', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_align', [
				'label'			 => esc_html__( 'Alignment', 'header-footer-composer' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [
					'left'		 => [
						'title'	 => esc_html__( 'Left', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 => esc_html__( 'Center', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 => esc_html__( 'Right', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-right',
					],
				],
				'default'		 => '',
                'selectors' => [
                    '{{WRAPPER}} .hfc-navbar > ul.hfc-nav-menu-top' => 'text-align: {{VALUE}};',
                ],
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_layout',
			[
				'label' => __( 'Menu Layout', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'inline-block',
				'options' => [
					'inline-block'  => esc_html__( 'Horizontal', 'header-footer-composer' ),
					'block' => esc_html__( 'Vertical', 'header-footer-composer' ),
				],
                'selectors' => [
                    '{{WRAPPER}} .hfc-navbar > ul > li' => 'display: {{VALUE}};',
                 ],								
			]
		);			
		
		$this->add_control(
			'hfc_nav_menu_dropdown_icon',
			[
				'label' => __( 'Dropdown Icon', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '\f0d7',
				'options' => [
					'\f0d7'  => esc_html__( 'Classic', 'header-footer-composer' ),
					'\f078' => esc_html__( 'Chevron', 'header-footer-composer' ),
					'\f107' => esc_html__( 'Angle', 'header-footer-composer' ),					
					'\f067' => esc_html__( 'Plus', 'header-footer-composer' ),										
					'' => __( 'None', 'header-footer-composer' ),															
				],
                'selectors' => [
                    '{{WRAPPER}} .hfc-navbar > ul > li.menu-item-has-children > a:after' => 'content: "{{VALUE}}";',
                    '{{WRAPPER}} .hfc-navbar .submenu-button:after' => 'content: "{{VALUE}}";',					
                ],								
			]
		);						
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_align', [
				'label'			 =>esc_html__( 'Submenu Alignment', 'header-footer-composer' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 =>esc_html__( 'Center', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-right',
					],
				],
				'default'		 => '',
                'selectors' => [
                    '{{WRAPPER}} .hfc-navbar > ul li ul' => 'text-align: {{VALUE}};',
                ],
			]
		);						
		
		$this->add_control(
			'hfc_nav_menu_mobile_layout_label',
			[
				'label' => __( 'Mobile Menu Layout', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);				
		
		$this->add_control(
			'hfc_nav_menu_toggle_ed',
			[
				'label' => esc_html__( 'Enable Mobile Toggle', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'header-footer-composer' ),
				'label_off' => esc_html__( 'No', 'header-footer-composer' ),
				'return_value' => 'ed',
				'default' => 'ed',
				'prefix_class'	=> 'hfc-nav-mobile-toggle-'
			]
		);			
		
		$this->add_control(
			'hfc_nav_menu_mobile_overlay',
			[
				'label' => esc_html__( 'Enable Overlay Menu in Mobile', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'header-footer-composer' ),
				'label_off' => esc_html__( 'No', 'header-footer-composer' ),
				'return_value' => 'yes',
				'default' => 'no',
				'prefix_class'	=> 'hfc-nav-mobile-overlay-',
				'condition' => [				    
					'hfc_nav_menu_toggle_ed!' => '',
				],										
			]
		);		

		$this->end_controls_section();

		//Title Style Section
		$this->start_controls_section(
			'hfc_nav_menu_style', [
				'label'	 => esc_html__( 'Main Menu', 'header-footer-composer' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'hfc_nav_menu_bgcolor',
			[
				'label' => __( 'Navbar Background Color', 'header-footer-composer' ),				
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar, .hfc-nav-menu-top.open' => 'background-color: {{VALUE}}',
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => '',
                'tablet_default' => '#ffffff',
                'mobile_default' => '#ffffff',
			]
		);	
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hfc_nav_menu_typography',
				'label' => __( 'Typography', 'header-footer-composer' ),
				'selector' => '{{WRAPPER}} .hfc-navbar > ul > li > a',
			]
		);
		
		
		$this->add_control(
			'hfc_nav_menu_line_three',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);						
		
		$this->start_controls_tabs(
			'hfc_nav_menu_style_tabs'
		);		
		
		$this->start_controls_tab(
			'hfc_nav_menu_style_normal_tab',
			[
				'label' => __( 'Normal', 'header-footer-composer' ),
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_style_normal_color',
			[
				'label' => __( 'Link Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#191919',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_style_normal_bgcolor',
			[
				'label' => __( 'Link Background Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a' => 'background-color: {{VALUE}}',
				],
			]
		);				
		
		$this->end_controls_tab();		
		
		$this->start_controls_tab(
			'hfc_nav_menu_style_normal_tab_hover_tab',
			[
				'label' => __( 'Hover', 'header-footer-composer' ),
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_style_hover_color',
			[
				'label' => __( 'Hover Link Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a:hover' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_style_hover_bgcolor',
			[
				'label' => __( 'Hover Link Background Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);		
		$this->end_controls_tab();				
		
		$this->start_controls_tab(
			'hfc_nav_menu_style_normal_tab_active_tab',
			[
				'label' => __( 'Active', 'header-footer-composer' ),
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_style_active_color',
			[
				'label' => __( 'Active Link Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li.current-menu-item > a' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_style_active_bgcolor',
			[
				'label' => __( 'Active Link Background Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li.current-menu-item > a' => 'background-color: {{VALUE}}',
				],
			]
		);		
		
		$this->end_controls_tab();						
		
		$this->end_controls_tabs();
		
		$this->add_control(
			'hfc_nav_menu_line_four',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);		
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hfc_nav_menu_style_link_border',
				'label' => __( 'Border', 'header-footer-composer' ),
				'selector' => '{{WRAPPER}} .hfc-navbar ul.hfc-nav-menu-top li',
			]
		);        
		
		$this->add_responsive_control(
			'hfc_nav_menu_style_padding',
			[
				'label' => __( 'Padding', 'header-footer-composer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'hfc_nav_menu_style_margin',
			[
				'label' => __( 'Margin', 'header-footer-composer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);						

		$this->end_controls_section();
		
		//Dropdown Style
		$this->start_controls_section(
			'hfc_nav_menu_dropdown_style', [
				'label'	 => esc_html__( 'Dropdown', 'header-footer-composer' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);				
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_bgcolor',
			[
				'label' => __( 'Dropdown Background Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#191919',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul' => 'background-color: {{VALUE}}',
				],
			]
		);			
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hfc_nav_menu_dropdown_typography',
				'label' => __( 'Typography', 'header-footer-composer' ),
				'selector' => '{{WRAPPER}} .hfc-navbar ul ul li a',
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_line_eight',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);			
		
		$this->start_controls_tabs(
			'hfc_nav_menu_dropdown_style_tabs'
		);		
		
		$this->start_controls_tab(
			'hfc_nav_menu_dropdown_style_normal_tab',
			[
				'label' => __( 'Normal', 'header-footer-composer' ),
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_normal_color',
			[
				'label' => __( 'Link Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_normal_bgcolor',
			[
				'label' => __( 'Link Background Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#191919',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a' => 'background-color: {{VALUE}}',
				],
			]
		);				
		
		$this->end_controls_tab();		
		
		$this->start_controls_tab(
			'hfc_nav_menu_dropdown_style_normal_tab_hover_tab',
			[
				'label' => __( 'Hover', 'header-footer-composer' ),
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_hover_color',
			[
				'label' => __( 'Hover Link Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_hover_bgcolor',
			[
				'label' => __( 'Hover Link Background Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);		
		$this->end_controls_tab();				
		
		$this->start_controls_tab(
			'hfc_nav_menu_dropdown_style_normal_tab_active_tab',
			[
				'label' => __( 'Active', 'header-footer-composer' ),
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_active_color',
			[
				'label' => __( 'Active Link Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li.current-menu-item a' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_active_bgcolor',
			[
				'label' => __( 'Active Link Background Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li.current-menu-item a' => 'background-color: {{VALUE}}',
				],
			]
		);		
		
		$this->end_controls_tab();						
		
		$this->end_controls_tabs();		
		
		$this->add_control(
			'hfc_nav_menu_line_five',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);						

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hfc_nav_menu_dropdown_style_link_border',
				'label' => __( 'Border', 'header-footer-composer' ),
				'selector' => '{{WRAPPER}} .hfc-navbar ul li ul.sub-menu li',
			]
		);
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_link_border_radius',
			[
				'label' => __( 'Border Radius', 'header-footer-composer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_padding',
			[
				'label' => __( 'Padding', 'header-footer-composer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_margin',
			[
				'label' => __( 'Margin', 'header-footer-composer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);				
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),			
			[
				'name' => 'hfc_nav_menu_dropdown_style_box_shadow',                
				'label' => __( 'Box Shadow', 'header-footer-composer' ),
				'selector' => '{{WRAPPER}} .hfc-navbar ul li ul',
			]
		);        
				
		$this->end_controls_section();		
		
		//Toggle style
		$this->start_controls_section(
			'hfc_nav_menu_toggle_style', [
				'label'	 => esc_html__( 'Toggle Button', 'header-footer-composer' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);				
		
		$this->add_control(
			'hfc_nav_menu_toggle_style_normal_color',
			[
				'label' => __( 'Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} #hfc-menu-button-toggle .fas' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_toggle_style_normal_bgcolor',
			[
				'label' => __( 'Background Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#191919',				
				'selectors' => [
					'{{WRAPPER}} #hfc-menu-button-toggle .fas' => 'background-color: {{VALUE}}',
				],
			]
		);				
		
		
		$this->add_control(
			'hfc_nav_menu_line_seven',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);						
		
		$this->add_control(
			'hfc_nav_menu_toggle_style_size',
			[
				'label' => __( 'Size', 'header-footer-composer' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 22,
				],
				'selectors' => [
					'{{WRAPPER}} #hfc-menu-button-toggle .fas' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'hfc_nav_menu_toggle_style_align', [
				'label'			 => esc_html__( 'Alignment', 'header-footer-composer' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-left',
					],
					'none'	 => [
						'title'	 =>esc_html__( 'Center', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-right',
					],
				],
				'default'		 => 'none',
                'selectors' => [
                    '{{WRAPPER}} #hfc-menu-button-toggle .fas' => 'float: {{VALUE}};',
                ],
			]
		);			
		
		$this->add_control(
			'hfc_nav_menu_line_nine',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);					
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hfc_nav_menu_toggle_style_border',
				'label' => __( 'Toggle Border', 'header-footer-composer' ),
				'selector' => '{{WRAPPER}} #hfc-menu-button-toggle .fas',
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_toggle_style_border_radius',
			[
				'label' => __( 'Border Radius', 'header-footer-composer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} #hfc-menu-button-toggle .fas' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	
		
		$this->add_responsive_control(
			'hfc_nav_menu_toggle_style_padding',
			[
				'label' => __( 'Padding', 'header-footer-composer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'default'	=> ['top' => '10', 'right' => '10', 'bottom' => '10', 'left' => '10', 'isLinked' => true,],
				'selectors' => [
					'{{WRAPPER}} #hfc-menu-button-toggle .fas' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);										
		
		
		$this->end_controls_section();		
	      

	}

	protected function render() {
		$settings = $this->get_settings();
		$hfc_menu_id = $settings[ 'hfc_nav_menu_ed' ];	                
	?>		    
                
	        <nav id="hfc-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">            
                <div id="hfc-menu-button-toggle" class=""><i class="fas fa-bars"></i></div>
				<?php
                  wp_nav_menu(array(
                    'menu'	  => $hfc_menu_id,
                    'depth'   => 0,
                    'container_class' => 'hfc-navbar',
                    'menu_class' => 'hfc-nav-menu-top'
                    ));
                ?>
            </nav>                

	<?php		
	}

	protected function _content_template() {
		
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new HFC_Nav_Menu_Widget() );