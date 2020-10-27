<?php
// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Repeater;
use Elementor\Widget_Button;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Control_Media;
use Elementor\Modules\DynamicTags\Module as TagsModule;


class Elementor_VideoGallery_Widget extends \Elementor\Widget_Base {
	public function get_name() {return 'mallyvids';}
	public function get_title() {return __( 'Mally Vids', 'plugin-name' );}
	public function get_icon() {return 'fa fa-film';}
	public function get_categories() {	return [ 'general' ];}
	protected function _register_controls() {

$this->start_controls_section(
	'section_gallery',
	array(
		'label' => __( 'Gallery', 'elementor-videogallery-extension' ),
	)
);

	$vimeo = apply_filters( 'uael_video_gallery_vimeo_link', 'https://vimeo.com/274860274' );

	$youtube = apply_filters( 'uael_video_gallery_youtube_link', 'https://www.youtube.com/watch?v=HJRzUQMhJMQ' );

	$wistia = apply_filters( 'uael_video_gallery_wistia_link', '<p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2"><img src="https://embedwistia-a.akamaihd.net/deliveries/53eec5fa72737e60aa36731b57b607a7c0636f52.webp?image_play_button_size=2x&amp;image_crop_resized=960x540&amp;image_play_button=1&amp;image_play_button_color=54bbffe0" width="400" height="225" style="width: 400px; height: 225px;"></a></p><p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2">Video Placeholder - Brainstorm Force - pratikc</a></p>' );

	$this->add_control(
		'gallery_items',
		array(
			'label'       => '',
			'type'        => Controls_Manager::REPEATER,
			'show_label'  => true,
			'fields'      => array(
				array(
					'name'    => 'type',
					'label'   => __( 'Video Type', 'uael' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'vimeo',
					'options' => array(
						'vimeo'   => __( 'Vimeo Video', 'uael' ),
						'youtube' => __( 'YouTube Video', 'uael' ),
						/*'wistia'  => __( 'Wistia Video', 'uael' ),*/
					),
				),
				array(
					'name'        => 'video_url',
					'label'       => __( 'Video URL', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'condition'   => array(
						'type' => array( 'youtube', 'vimeo' ),
					),
				),
				array(
					'name'            => 'youtube_link_doc',
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'content_classes' => 'uael-editor-doc',
					'condition'       => array(
						'type' => 'youtube',
					),
					'separator'       => 'none',
				),
				array(
					'name'            => 'vimeo_link_doc',
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
				//	'raw'             => sprintf( __( '<b>Note:</b>Add the actual URL of the video <b>Valid:</b>&nbsp;https://vimeo.com/274860274<b>', 'uael' ) ),
					'content_classes' => 'uael-editor-doc',
					'condition'       => array(
						'type' => 'vimeo',
					),
					'separator'       => 'none',
				),

				array(
					'name'        => 'title',
					'label'       => __( 'Title', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => '',
					'label_block' => true,
				//	'dynamic'     => array(	'active' => true,	),
					'title'       => __( 'This title will be visible on hover.', 'uael' ),
				),
				array(
					'name'        => 'client',
					'label'       => __( 'Client', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => '',
					'label_block' => true,
				//	'dynamic'     => array(	'active' => true,	),
					'title'       => __( 'This client text will be visible on hover.', 'uael' ),
				),
				array(
					'name'        => 'production_company',
					'label'       => __( 'Production Company', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => '',
					'label_block' => true,
				//	'dynamic'     => array(	'active' => true,		),
					'title'       => __( 'This text will be visible on hover.', 'uael' ),
				),
				array(
					'name'        => 'role',
					'label'       => __( 'Role', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => '',
					'label_block' => true,
			//		'dynamic'     => array(	'active' => true,	),
					'title'       => __( 'This text will be visible on hover.', 'uael' ),
				),
				array(
					'name'        => 'notes',
					'label'       => __( 'Notes', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => '',
					'label_block' => true,
					'title'       => __( 'This text will be visible on hover.', 'uael' ),
				),

				array(
					'name'      => 'yt_thumbnail_size',
					'label'     => __( 'Thumbnail Size', 'uael' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => array(
						'maxresdefault' => __( 'Maximum Resolution', 'uael' ),
						'hqdefault'     => __( 'High Quality', 'uael' ),
						'mqdefault'     => __( 'Medium Quality', 'uael' ),
						'sddefault'     => __( 'Standard Quality', 'uael' ),
					),
					'default'   => 'hqdefault',
					'condition' => array(
						'type' => 'youtube',
					),
				),
				array(
					'name'         => 'custom_placeholder',
					'label'        => __( 'Custom Thumbnail', 'uael' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'label_on'     => __( 'Yes', 'uael' ),
					'label_off'    => __( 'No', 'uael' ),
					'return_value' => 'yes',
				),
				array(
					'name'        => 'placeholder_image',
					'label'       => __( 'Select Image', 'uael' ),
					'type'        => Controls_Manager::MEDIA,
					'default'     => array(
						'url' => Utils::get_placeholder_image_src(),
					),
					'description' => __( 'This image will act as a placeholder image for the video.', 'uael' ),
					'dynamic'     => array(
						'active' => true,
					),
					'condition'   => array(
						'custom_placeholder' => 'yes',
					),
				),
			),
			'default'     => array(
				array(
					'type'              => 'vimeo',
					'video_url'         => $youtube,
					'title'             => __( 'First Video', 'uael' ),
					'tags'              => 'Vimeo',
					'placeholder_image' => '',
				),
				array(
					'type'              => 'vimeo',
					'video_url'         => $vimeo,
					'title'             => __( 'Second Video', 'uael' ),
					'tags'              => 'Vimeo',
					'placeholder_image' => '',
				),
				array(
					'type'              => 'vimeo',
					'wistia_url'        => $wistia,
					'title'             => __( 'Third Video', 'uael' ),
					'tags'              => 'Vimeo',
					'placeholder_image' => '',
				),
				array(
					'type'              => 'vimeo',
					'video_url'         => $youtube,
					'title'             => __( 'Fourth Video', 'uael' ),
					'tags'              => 'Vimeo',
					'placeholder_image' => '',
				),
				array(
					'type'              => 'vimeo',
					'video_url'         => $vimeo,
					'title'             => __( 'Fifth Video', 'uael' ),
					'tags'              => 'Vimeo',
					'placeholder_image' => '',
				),
				array(
					'type'              => 'vimeo',
					'wistia_url'        => $wistia,
					'title'             => __( 'Sixth Video', 'uael' ),
					'tags'              => 'Vimeo',
					'placeholder_image' => '',
				),
			),
			'title_field' => '{{{ title }}}',
		)
	);

	$this->end_controls_section();


	/* Style Tab */
	$this->start_controls_section(
		'style_section',
		[
			'label' => __( 'Style', 'plugin-name' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

	/********  EACH VIDEO TITLE TYPOGRAPHY ******/
	$this->add_control(
		'title_color',
		[
			'label' => __( 'Title Color', 'elementor' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} h4.pher_vg_titles' => 'color: {{VALUE}};',
			],

		]
	);
	$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} h4.pher_vg_titles',
				]
			);

	/********  EACH VIDEO CAPTION TYPOGRAPHY ******/

	$this->add_control(
		'text_color',
		[
			'label' => __( 'Text Color', 'elementor' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '#fefefe',
			'selectors' => [
				'{{WRAPPER}} .pher_vg_captions' => 'color: {{VALUE}};',
			],

		]
	);

	$this->add_control(
		'aspect_ratio',
		[
			'label' => __( 'Aspect Ratio', 'elementor' ),
			'type' => Controls_Manager::SELECT,
			'options' => [
				'169' => '16:9',
				'219' => '21:9',
				'43' => '4:3',
				'32' => '3:2',
				'11' => '1:1',
				'916' => '9:16',
			],
			'default' => '169',
			'prefix_class' => 'elementor-aspect-ratio-',
			'frontend_available' => true,
		]
	);


	$this->add_responsive_control(
		'columns',
		[
			'label' => __( 'Columns', 'elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => '0',
			'options' => [
				'0' => 'Auto',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
			],
			'prefix_class' => 'elementor-grid%s-',
		]
	);

	$this->end_controls_section();

}



/********* RENDER COMPONENTS ****************/


			public function get_placeholder_image( $item ) {

				$url       = '';
				$vid_id    = '';
				$video_url = '';

				if ( 'wistia' === $item['type'] ) {
					$video_url = $item['wistia_url'];
				} else {
					$video_url = $item['video_url'];
				}

				if ( 'youtube' === $item['type'] ) {
					if ( preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches ) ) {
						$vid_id = $matches[1];
					}
				} elseif ( 'vimeo' === $item['type'] ) {
					$vid_id = preg_replace( '/[^\/]+[^0-9]|(\/)/', '', rtrim( $video_url, '/' ) );
				} elseif ( 'wistia' === $item['type'] ) {
					$vid_id = $this->getStringBetween( $video_url, 'wvideo=', '"' );
				}

				if ( 'yes' === $item['custom_placeholder'] ) {
					$url = $item['placeholder_image']['url'];
				} else {

					if ( 'youtube' === $item['type'] ) {
						$url = 'https://i.ytimg.com/vi/' . $vid_id . '/' . apply_filters( 'uael_vg_youtube_image_quality', $item['yt_thumbnail_size'] ) . '.jpg';
					} elseif ( 'vimeo' === $item['type'] ) {
						if ( '' !== $vid_id && 0 !== $vid_id ) {
							$vimeo = unserialize( file_get_contents( "https://vimeo.com/api/v2/video/$vid_id.php" ) );
							$url = $vimeo[0]['thumbnail_large'];
						}
					} elseif ( 'wistia' === $item['type'] ) {
						$url = 'https://embedwistia-a.akamaihd.net/deliveries/' . $this->getStringBetween( $video_url, 'deliveries/', '?' );
					}
				}

				return array(
					'url'      => $url,
					'video_id' => $vid_id,
				);

			}

			/**
			 * Returns Video URL.
			 *
			 * @param string $url Video URL.
			 * @param string $from From compare string.
			 * @param string $to To compare string.
			 * @since 1.17.0
			 * @access protected
			 */
			protected function getStringBetween( $url, $from, $to ) {
				$sub = substr( $url, strpos( $url, $from ) + strlen( $from ), strlen( $url ) );
				$id  = substr( $sub, 0, strpos( $sub, $to ) );

				return $id;
			}


				/**
				 * Render Gallery Data.
				 *
				 * @since 1.5.0
				 * @access public
				 */
				public function render_gallery_inner_data() {

					$settings    = $this->get_settings_for_display();
					$new_gallery = array();
					$gallery     = $settings['gallery_items'];
					$vurl        = '';

					$new_gallery = $gallery;

					foreach ( $new_gallery as $index => $item ) {

							$url = $this->get_placeholder_image( $item );

						 /* render teh background image - currently testing just rendering it = move to use video.php*/
						/*	echo '<pre>';
							print_r ($url);
							echo'</pre>';

							echo '<div class="elementor-custom-embed-play" role="button"><i class="eicon-play" aria-hidden="true"></i><span class="elementor-screen-only">';
							echo __( 'Play Video', 'elementor' );
							echo '</span></div>';*/

/*
							echo '<pre>';
							print_r ($item);
							echo'</pre>';

*/

							$video_url = $item['video_url'];

							if ( 'youtube' === $item['type'] ) {
								if ( preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches ) ) {
									$vid_id = $matches[1];
								}
							} elseif ( 'vimeo' === $item['type'] ) {
								$vid_id = preg_replace( '/[^\/]+[^0-9]|(\/)/', '', rtrim( $video_url, '/' ) );
							}

							//echo 'video ID = '.$vid_id;

							//$this->add_render_attribute( 'grid-item' . $index, 'class', 'uael-video__gallery-item' );

						// Render video link attributes.
					/*	$this->add_render_attribute(
							'video-grid-item' . $index,
							array(
								'class' => 'uael-vg__play',
							)
						);*/

					/*	$this->add_render_attribute(
							'video-container-link' . $index,
							array(
								'class' => 'elementor-clickable uael-vg__play_full',
								'href'  => $video_url,
							)
						);*/

					//	$this->add_render_attribute( 'video-container-link' . $index, 'data-fancybox', 'uael-video-gallery-' . $this->get_id() );


						$this->add_render_attribute(
							'video-container-link',
							[
								'id' => 'custom-widget-id',
								'class' => [ 'video-container-link','otherclass', $settings['custom_class'] ],
								'role' => $settings['role'],
								'aria-label' => $settings['name'],
							]
						);
						/* 'ight box add atts */
					//	$embed_params = $this->get_embed_params();
						//$embed_options = $this->get_embed_options();
					//	$lightbox_url = Embed::get_embed_url( $video_url, $embed_params, $embed_options );


						$vurl = 'https://player.vimeo.com/video/' .$vid_id . '?autoplay=1&version=3&enablejsapi=1';
						$lightbox_options ='';
						$lightbox_options = [
							'type' => 'video',
							'videoType' =>$item['type'],
							'url' => $vurl ,
						/*	'modalOptions' => [
								'id' => 'elementor-lightbox-' .$vid_id,
								'videoAspectRatio' => $settings['aspect_ratio'],
							],*/
						];

	//echo ('Video encoded '.$vurl.' Aand the vid id is '.$vid_id.'  this is the JSON ...: <br>'.wp_json_encode( $lightbox_options ).'<br>');

						$this->add_render_attribute( 'video-container-link video-'.$vid_id, [
							'data-elementor-open-lightbox' => 'yes',
							'data-elementor-lightbox' => wp_json_encode($lightbox_options),
						] );

						?>

						<div <?php echo $this->get_render_attribute_string('video-container-link video-'.$vid_id);?> >
							<div class="pher_videogallery-item" style="background-image:url('<?php echo $url['url']; ?>');">
								<a href="#" class="pher_videogallery__content-wrap">
										<div class="pher_videogallery__content">
											<?php $this->render_playbutton();  ?>
											<?php $this->get_caption( $item ); ?>
										</div>
								</a>
							</div>
							<div class="pher_videogallery__overlay"></div>
						</div>
						<?php

					//	echo $this->get_render_attribute_string('video-container-link video-'.$vid_id);

					}

				}

				/**
				 * Returns the Caption HTML.
				 *
				 * @param Array $item Current video array.
				 * @since 1.5.0
				 * @access public
				 */
				public function get_caption( $item ) {
				//echo'<h4>'. $item['title'].'</h4>';
					echo '<div class="pher_vg_captions"><h4 class="pher_vg_titles">'. $item['title'].'</h4>';
					//echo 'CLIENT: '.$item['client'].'<br>';
					$this->render_credit($item['client'],'credit');
					$this->render_credit($item['role'],'role');
					$this->render_credit($item['production_company'],'production company');
					$this->render_credit($item['notes'],'notes');
					echo '</div>';
				}



/* RENDER */
				public function render_credit($credit,$label){
					echo $label.': '.$credit.'<br>';
				}


				public function render_playbutton(){
						?>
						<div class="pher_videogallery-play" role="button">
							<i class="eicon-play" aria-hidden="true"></i>
							<span class="elementor-screen-only"><?php echo __( 'Play Video', 'elementor' ); ?></span>
						</div>
					<?php
				}

					protected function render() {
							$settings = $this->get_settings_for_display();

							echo '<div class="videogallery-elementor-widget">';
							//echo $settings['url'];
						/*	echo '<pre>';
							 print_r ($settings['gallery_items']);
							 echo '</pre>';*/
							$this->render_gallery_inner_data();
							echo '</div>';

						}


/*
	protected function _content_template() {}*/

}