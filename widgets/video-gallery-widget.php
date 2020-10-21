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
				/*	'dynamic'     => array(
						'active'     => true,
						'categories' => array(
							TagsModule::POST_META_CATEGORY,
							TagsModule::URL_CATEGORY,
						),
					),*/
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
			/*	array(
					'name'        => 'tags',
					'label'       => __( 'Categories', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => '',
					'label_block' => true,
					'dynamic'     => array(
						'active' => true,
					),
					'title'       => __( 'Add comma separated categories. These categories will be shown for filteration.', 'uael' ),
				),*/
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

echo '<pre>';
print_r ($url);
echo'</pre>';
/*echo '<pre>';
print_r ($item);
echo'</pre>';*/
$this->get_caption( $item );

						$video_url = $item['video_url'];

						if ( 'wistia' === $item['type'] ) {
							$wistia_id = $this->getStringBetween( $item['wistia_url'], 'wvideo=', '"' );
							$video_url = 'https://fast.wistia.net/embed/iframe/' . $wistia_id . '?videoFoam=true';
						}

						$this->add_render_attribute( 'grid-item' . $index, 'class', 'uael-video__gallery-item' );

						// Render filter / tags classes.
						if ( 'yes' === $settings['show_filter'] && 'grid' === $settings['layout'] ) {

						/*	if ( '' !== $item['tags'] ) {
								$tags = $this->get_tag_class( $item );
								$this->add_render_attribute( 'grid-item' . $index, 'class', array_keys( $tags ) );
							}*/
						}

						// Render video link attributes.
						$this->add_render_attribute(
							'video-grid-item' . $index,
							array(
								'class' => 'uael-vg__play',
							)
						);

						$this->add_render_attribute(
							'video-container-link' . $index,
							array(
								'class' => 'elementor-clickable uael-vg__play_full',
								'href'  => $video_url,
							)
						);

						if ( 'wistia' === $item['type'] ) {
							$this->add_render_attribute(
								'video-container-link' . $index,
								array(
									'data-type'      => 'iframe',
									'data-fitToView' => 'false',
									'data-autoSize'  => 'false',
								)
							);
						}

						if ( 'inline' !== $settings['click_action'] ) {

							$this->add_render_attribute( 'video-container-link' . $index, 'data-fancybox', 'uael-video-gallery-' . $this->get_id() );
						} else {

							if ( 'youtube' === $item['type'] ) {
								$vurl = 'https://www.youtube.com/embed/' . $url['video_id'] . '?autoplay=1&version=3&enablejsapi=1';
							} elseif ( 'vimeo' === $item['type'] ) {
								$vurl = 'https://player.vimeo.com/video/' . $url['video_id'] . '?autoplay=1&version=3&enablejsapi=1';
							} elseif ( 'wistia' === $item['type'] ) {
								$vurl = $video_url . '?&autoplay=1';
							}

							$this->add_render_attribute( 'video-container-link' . $index, 'data-url', $vurl );
						}

						?>
						<div <?php echo $this->get_render_attribute_string( 'grid-item' . $index ); ?>>

							<div class="uael-video__gallery-iframe" style="background-image:url('<?php echo $url['url']; ?>');">
								<a <?php echo $this->get_render_attribute_string( 'video-container-link' . $index ); ?>>
									<div class="uael-video__content-wrap">
										<div class="uael-video__content">

											<?php $this->get_caption( $item ); ?>

											<div <?php echo $this->get_render_attribute_string( 'video-grid-item' . $index ); ?>>
												<?php
												// $this->get_play_button();
												  ?>
											</div>

											<?php
											//$this->get_tag( $item );
											 ?>

										</div>
									</div>
								</a>
							</div>
							<div class="uael-vg__overlay"></div>
							<?php do_action( 'uael_video_gallery_after_video', $item, $settings ); ?>
						</div>
						<?php
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
/*
					$settings = $this->get_settings_for_display();

					if ( '' === $item['title'] ) {
						return;
					}

					if ( 'yes' !== $settings['show_caption'] ) {
						return;
					}*/
					?>

					<h4 class="uael-video__caption"><?php echo $item['title']; ?></h4>

					<?php
				}




					protected function render() {
							$settings = $this->get_settings_for_display();
							echo '<div class="oembed-elementor-widget">';
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