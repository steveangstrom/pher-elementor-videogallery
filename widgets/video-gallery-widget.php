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
					'dynamic'     => array(
						'active'     => true,
						'categories' => array(
							TagsModule::POST_META_CATEGORY,
							TagsModule::URL_CATEGORY,
						),
					),
					'condition'   => array(
						'type' => array( 'youtube', 'vimeo' ),
					),
				),
				array(
					'name'            => 'youtube_link_doc',
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf( __( '<b>Note:</b>Add the actual URL of the video and not the share URL.</br></br><b>Valid:</b>&nbsp;https://www.youtube.com/watch?v=HJRzUQMhJMQ</br><b>Invalid:</b>&nbsp;https://youtu.be/HJRzUQMhJMQ', 'uael' ) ),
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
			/*	array(
					'name'        => 'wistia_url',
					'label'       => __( 'Link & Thumbnail Text', 'uael' ),
					'description' => __( 'Go to your Wistia video, right click, "Copy Link & Thumbnail" and paste here.', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'dynamic'     => array(
						'active'     => true,
						'categories' => array(
							TagsModule::POST_META_CATEGORY,
							TagsModule::URL_CATEGORY,
						),
					),
					'condition'   => array(
						'type' => 'wistia',
					),
				),*/
				array(
					'name'        => 'title',
					'label'       => __( 'Caption', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => '',
					'label_block' => true,
					'dynamic'     => array(
						'active' => true,
					),
					'title'       => __( 'This title will be visible on hover.', 'uael' ),
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
					'type'              => 'youtube',
					'video_url'         => $youtube,
					'title'             => __( 'First Video', 'uael' ),
					'tags'              => 'YouTube',
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





		protected function render() {
				$settings = $this->get_settings_for_display();
				$html = wp_oembed_get( $settings['url'] );
				echo '<div class="oembed-elementor-widget">';
				echo ( $html ) ? $html : $settings['url'];
				echo '</div>';
			}
/*
	protected function render() {}

	protected function _content_template() {}*/

}