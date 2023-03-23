<?php
/*Template Name: Homepgae Debug*/
get_header();
?>

                        <div id="main" class="site-main page__top-shadow visible">
    <div id="home-hero">
        <style>
            #home-hero
            {
                background: url('/wp-content/uploads/2022/10/AdobeStock_329285691_Fotoeventis-1.jpg') center;
                background-size: cover;
            }
                        @media all and (max-width:575px)
            {
                #home-hero
                {
background: url('/wp-content/uploads/2022/10/home-mobile-hero.jpg') center;
                background-size: cover;
                }
            }
                    </style>
        <div class="container-fluid">
            <h1>
                Deutschlands führendes Such- und Bewertungsportal für Hundeschulen            </h1>
            <p>
                Finde die passende Hundeschule:            </p>
            <form action="/hundeschule/" method="get">
                <input type="text" value="" name="s" placeholder="Name, Ort, Postleitzahl?" />
                <button type="submit">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.7188 16.8086L13.0078 12.0977C14.0391 10.8086 14.5664 9.29688 14.5898 7.5625C14.543 5.5 13.8281 3.77734 12.4453 2.39453C11.0625 1.01172 9.33984 0.296875 7.27734 0.25C5.21484 0.296875 3.49219 1.01172 2.10938 2.39453C0.75 3.77734 0.046875 5.5 0 7.5625C0.046875 9.625 0.761719 11.3477 2.14453 12.7305C3.50391 14.1133 5.21484 14.8281 7.27734 14.875C9.03516 14.8516 10.5469 14.3242 11.8125 13.293L16.5234 18.0039C16.7344 18.168 16.9453 18.25 17.1562 18.25C17.3906 18.25 17.5898 18.168 17.7539 18.0039C18.082 17.6055 18.0703 17.207 17.7188 16.8086ZM1.6875 7.5625C1.73438 5.96875 2.28516 4.64453 3.33984 3.58984C4.39453 2.53516 5.71875 1.98437 7.3125 1.9375C8.90625 1.98437 10.2305 2.53516 11.2852 3.58984C12.3398 4.64453 12.8906 5.96875 12.9375 7.5625C12.8906 9.15625 12.3398 10.4805 11.2852 11.5352C10.2305 12.5898 8.90625 13.1406 7.3125 13.1875C5.71875 13.1406 4.39453 12.5898 3.33984 11.5352C2.28516 10.4805 1.73438 9.15625 1.6875 7.5625Z" fill="white"/>
</svg>
                </button>
            </form>
        </div>
    </div>
    <div class="raw-html ">
                
            
            
            
            
            
            
            
			<script type="text/javascript">
	
				jQuery(document).ready(function($) { 		
				
					var map_id = 'map40501';
					
					if(typeof _CSPM_DONE === 'undefined' || _CSPM_DONE[map_id] === true) 
						return;
					
					_CSPM_DONE[map_id] = false;
					_CSPM_MAP_RESIZED[map_id] = 0;
					
					/**
					 * Start displaying the Progress Bar loader */
					 
					if(typeof NProgress !== 'undefined'){
						
						NProgress.configure({
						  parent: 'div#codespacing_progress_map_div_'+map_id,
						  showSpinner: true
						});				
						
						NProgress.start();
						
					}
					
					/**
					 * @map_layout, Will contain the layout type of the current map.
					 * This variable was first initialized in "progress_map.js"!
					 * @since 2.8 */
										
					map_layout[map_id] = 'fit-in-map';
					
					/**
					 * @cspm_infoboxes, Will store the created marker infoboxes in the viewport of the map.
					 * This will prevent creating the same infobox multiple times! */
					 
					cspm_infoboxes[map_id] = []; //@since 3.9
					
					/**
					 * @cspm_marker_popups, Will store the created marker popups in the viewport of the map.
					 * This will prevent creating the same popup multiple times! */
					 
					cspm_marker_popups[map_id] = []; //@since 4.0
									
					/**
					 * @post_ids_and_categories, Will store the markers categories in order to use with faceted search and to define the marker icon */
					 
					post_ids_and_categories[map_id] = {}; 
					
					/** 
					 * @post_lat_lng_coords, Will store the markers coordinates in order to use them when rewriting the map & the carousel */
					 
					post_lat_lng_coords[map_id] = {}; 
					
					/**
					 * @post_ids_and_child_status, Will store the markers and their child status in order to use when rewriting the carousel */
					 
					post_ids_and_child_status[map_id] = {}; 
					
					/**
					 * @json_markers_data, Will store the markers objects */
					 
					var json_markers_data = [];					
					
					var false_latLngs = []; // Contains the IDs of all posts with false latLng | @since 3.6
					var false_ground_overlays = []; // Contains the names of all images with wrong coordinates | @since 3.6

					/**
					 * init plugin map */
					 
					var plugin_map_placeholder = 'div#codespacing_progress_map_div_'+map_id;
					var plugin_map = $(plugin_map_placeholder);
					
					/**
					 * Load Map options */
					 
											var map_options = cspm_load_map_options('map40501', false, null, 7);
										
					/**
					 * Activate the new google map visual */
					 
					google.maps.visualRefresh = true;				

					/**
					 * The initial map style */
					 
					var initial_map_style = "ROADMAP";
					
					/**
					 * Enhance the map option with the map type id of the style */
					 
																
						/**
						 * The initial style */
						 
						var map_type_id = cspm_initial_map_style(initial_map_style, false);
						var map_options = $.extend({}, map_options, map_type_id);
						
									

					 var light_map = true; 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"46825","post_categories":"","coordinates":{"lat":"47.9512016","lng":"12.3237089"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-hoeslwang\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('46825'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"46445","post_categories":"","coordinates":{"lat":"49.6813069","lng":"8.2268874"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/i-am-unartig\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('46445'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"46313","post_categories":"","coordinates":{"lat":"51.4524307","lng":"7.4563625"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-raeuberhunde\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('46313'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"46295","post_categories":"","coordinates":{"lat":"49.8576781","lng":"8.5501985"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dog-team-nothnagel\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('46295'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"46053","post_categories":"","coordinates":{"lat":"49.2137893","lng":"7.0156762"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mein-held-bellt\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('46053'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"46081","post_categories":"","coordinates":{"lat":"47.8465143","lng":"12.1663754"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/petricks-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('46081'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45923","post_categories":"","coordinates":{"lat":"52.5305749","lng":"13.7608357"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/coachmydog-de\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45923'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45837","post_categories":"","coordinates":{"lat":"48.249191","lng":"12.983849"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/meine-hunde-schule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45837'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45569","post_categories":"","coordinates":{"lat":"48.4281534","lng":"8.0194856"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/sannes-hundeschule-kinzig-pfoten\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45569'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45421","post_categories":"","coordinates":{"lat":"51.3325444","lng":"12.3948962"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundetraining-ulf-merkel\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45421'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45355","post_categories":"","coordinates":{"lat":"50.1709464","lng":"11.6900304"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/bossdogs-hundeschule-assistenzhunde-therapiebegleithunde-hundesportgeraete\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45355'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45235","post_categories":"","coordinates":{"lat":"48.8533008","lng":"8.5918773"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mensch-und-hund-im-dialog\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45235'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45205","post_categories":"","coordinates":{"lat":"49.2366975","lng":"12.6312079"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-pfotenglueck-von-der-regentalaue\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45205'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45129","post_categories":"","coordinates":{"lat":"52.7630721","lng":"13.6622651"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/rudelherz-coaching-und-training-fuer-menschen-mit-hund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45129'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45069","post_categories":"","coordinates":{"lat":"51.4497666","lng":"7.7444531"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/heimathund-gmbh\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45069'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45053","post_categories":"","coordinates":{"lat":"52.38789","lng":"9.718259900000021"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/paw-school-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45053'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45047","post_categories":"","coordinates":{"lat":"50.6052238","lng":"7.142172"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dogpoint-bonn-rhein-sieg\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45047'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44999","post_categories":"","coordinates":{"lat":"51.1732878","lng":"6.6830902"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/alternative-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44999'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"45001","post_categories":"","coordinates":{"lat":"53.1739406","lng":"9.6686896"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/susanne-pauly\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('45001'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44977","post_categories":"","coordinates":{"lat":"53.0323359","lng":"9.1567097"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/lucky-teams-gluecklich-mit-hund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44977'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44747","post_categories":"","coordinates":{"lat":"49.4712945","lng":"6.6770521"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-merzig-wadern\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44747'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44827","post_categories":"","coordinates":{"lat":"50.5921","lng":"8.42049"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-spuernasen-asslar-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44827'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44839","post_categories":"","coordinates":{"lat":"49.8804024","lng":"8.6176563"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundetraining-miriam-daum\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44839'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44831","post_categories":"","coordinates":{"lat":"51.1215928","lng":"9.2231808"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/artgerecht-mobile-hundeausbildung\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44831'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44843","post_categories":"","coordinates":{"lat":"49.9943716","lng":"10.8532748"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hund-handwerk-mdw-gmbh\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44843'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44863","post_categories":"","coordinates":{"lat":"52.4886715","lng":"13.362318"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundesophie\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44863'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44857","post_categories":"","coordinates":{"lat":"48.7604677","lng":"13.4349328"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/elis-kleine-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44857'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44845","post_categories":"","coordinates":{"lat":"50.5921676","lng":"8.4199488"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-spuernasen-asslar\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44845'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44815","post_categories":"","coordinates":{"lat":"50.1412103","lng":"8.7027452"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-wullewatz-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44815'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44271","post_categories":"","coordinates":{"lat":"49.38839813958341","lng":"7.090413269410712"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/click-paws\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44271'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44197","post_categories":"","coordinates":{"lat":"52.59321208615422","lng":"13.45574394066332"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/gassi-schule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44197'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44213","post_categories":"","coordinates":{"lat":"50.745905199461426","lng":"12.644003784788058"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mobile-hundeschule-herzhandpfote\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44213'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44201","post_categories":"","coordinates":{"lat":"53.546621323490655","lng":"13.088669969525537"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeloeper\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44201'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44229","post_categories":"","coordinates":{"lat":"51.64861467805244","lng":"6.983214198307341"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/pottschnauzen-training-fuer-menschen-mit-hund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44229'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44225","post_categories":"","coordinates":{"lat":"49.933821","lng":"8.7391156"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-maulhelden-juergen-maul\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44225'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43989","post_categories":"","coordinates":{"lat":"50.1870132","lng":"8.6393172"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundetherapiezentrum-frankfurt\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43989'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44083","post_categories":"","coordinates":{"lat":"53.6006884","lng":"9.5322379"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/altlaender-hunde\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44083'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44079","post_categories":"","coordinates":{"lat":"51.6240015","lng":"6.4823353"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/feldburgshof-hundezentrum-xanten\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44079'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44067","post_categories":"","coordinates":{"lat":"49.2602629","lng":"8.8719411"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundelaune\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44067'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44167","post_categories":"","coordinates":{"lat":"50.0911842","lng":"8.1059067"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hund-mensch-teamtraining\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44167'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44159","post_categories":"","coordinates":{"lat":"51.344715","lng":"6.5561528"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/canidus-hundetraining-riko-sparenberg\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44159'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"44151","post_categories":"","coordinates":{"lat":"53.5729409","lng":"9.9597441"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeservice-hamburg\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('44151'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43933","post_categories":"","coordinates":{"lat":"52.2594017","lng":"8.0127887"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hst-osnabrueck\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43933'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43955","post_categories":"","coordinates":{"lat":"46.975033","lng":"31.994583"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/viva\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43955'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43957","post_categories":"","coordinates":{"lat":"48.7035607","lng":"9.5859147"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/wolfs-instinkte-deine-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43957'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43909","post_categories":"","coordinates":{"lat":"50.3802107","lng":"7.109103399999981"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mit-hunden-leben_dus\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43909'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43905","post_categories":"","coordinates":{"lat":"51.1916289","lng":"6.8185957"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mit-hunden-leben-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43905'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43891","post_categories":"","coordinates":{"lat":"48.7408836","lng":"9.1769905"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/frohe-hunde\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43891'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43892","post_categories":"","coordinates":{"lat":"52.3152214","lng":"7.9699152"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/die-flexible-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43892'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43837","post_categories":"","coordinates":{"lat":"50.4488968","lng":"8.0450178"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-hadamar\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43837'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43834","post_categories":"","coordinates":{"lat":"51.0524201","lng":"13.8053736"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/snoots-hundeschule-hundefotografie\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43834'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43838","post_categories":"","coordinates":{"lat":"52.6485038","lng":"7.9862558"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundetraining-denise-heimann\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43838'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43687","post_categories":"","coordinates":{"lat":"50.0911842","lng":"8.1059067"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mensch-hund-teamarbeit\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43687'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43675","post_categories":"","coordinates":{"lat":"49.43105","lng":"6.7548"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mobile-hundeschule-annika-scholer\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43675'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43589","post_categories":"","coordinates":{"lat":"53.0921319","lng":"8.5072032"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/schoones-hundezentrum\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43589'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43583","post_categories":"","coordinates":{"lat":"48.1124537","lng":"10.977182"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-melanie-eder-hund-artig\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43583'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43573","post_categories":"","coordinates":{"lat":"53.327868","lng":"10.4573113"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/luenepfoten-inh-turia-lunk\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43573'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43565","post_categories":"","coordinates":{"lat":"53.5506924","lng":"10.248742"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundefreundeclub-e-v\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43565'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43559","post_categories":"","coordinates":{"lat":"51.3341519","lng":"7.4287702"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-bravedog\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43559'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43547","post_categories":"","coordinates":{"lat":"49.68691","lng":"8.59483"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dogsangel\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43547'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43539","post_categories":"","coordinates":{"lat":"51.4910698","lng":"7.5494155"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/lucky-dogs-dortmund-tierpsychologische-beratung\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43539'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43537","post_categories":"","coordinates":{"lat":"53.5906482","lng":"10.5976376"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/die-hundemarke-hundeschule-im-herzogtum-lauenburg\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43537'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43543","post_categories":"","coordinates":{"lat":"48.2641358","lng":"11.445279"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/lingua-canis\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43543'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43525","post_categories":"","coordinates":{"lat":"54.002334","lng":"10.5178857"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/a-p-o-r-t-bildungszentrum-fuer-menschen-mit-hund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43525'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43519","post_categories":"","coordinates":{"lat":"51.4045264","lng":"9.1120241"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/die-hundeerklaerer\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43519'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43515","post_categories":"","coordinates":{"lat":"51.2078195","lng":"9.06935"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-edersee\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43515'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43449","post_categories":"","coordinates":{"lat":"51.3197439","lng":"9.4550971"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/kiwi-die-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43449'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43437","post_categories":"","coordinates":{"lat":"49.9467343","lng":"11.527591"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/harmonic-dogs-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43437'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43435","post_categories":"","coordinates":{"lat":"48.7178647","lng":"9.320808"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/carmen-richter-hundecoach\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43435'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43431","post_categories":"","coordinates":{"lat":"48.1093362","lng":"11.5701073"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/sirius-hundeschule-muenchen\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43431'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43453","post_categories":"","coordinates":{"lat":"52.8798632","lng":"13.010754"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundewelt-greuter\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43453'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43479","post_categories":"","coordinates":{"lat":"50.733118","lng":"8.8145138"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundetypen-hundetraining-und-verhaltensberatung\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43479'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43483","post_categories":"","coordinates":{"lat":"52.1323521","lng":"7.7326635"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dogschool-muensterland\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43483'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43399","post_categories":"","coordinates":{"lat":"53.5432291","lng":"13.3004332"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/albrecht-mobiler-hundetrainer-3\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43399'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43405","post_categories":"","coordinates":{"lat":"53.37554160000001","lng":"13.5406103"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/vierbeiner-academy\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43405'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43415","post_categories":"","coordinates":{"lat":"55.9575834","lng":"92.379982"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/tschitschaloff\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43415'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43371","post_categories":"","coordinates":{"lat":"49.7188208","lng":"6.5731594"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/tierisch-stark-gemeinsam-fuer-mensch-und-hund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43371'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43351","post_categories":"","coordinates":{"lat":"47.8087708","lng":"10.2893454"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/beim-michl\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43351'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43353","post_categories":"","coordinates":{"lat":"50.8120518","lng":"7.1481474"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/sechs-beine-eine-leine\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43353'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43263","post_categories":"","coordinates":{"lat":"52.1453697","lng":"10.3093227"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/alltags-und-familienhund-coaching-fuer-mensch-und-hund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43263'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43271","post_categories":"","coordinates":{"lat":"48.3764009","lng":"10.8784229"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundetrainer-augsburg-strehdog-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43271'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43291","post_categories":"","coordinates":{"lat":"50.1310074","lng":"8.8906646"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/evandor-hundetraining\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43291'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43289","post_categories":"","coordinates":{"lat":"48.3644992","lng":"11.9925896"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-emma-balu\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43289'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43297","post_categories":"","coordinates":{"lat":"50.6745881","lng":"12.665216"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundepsychologie-eileen-witt\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43297'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43301","post_categories":"","coordinates":{"lat":"50.86066","lng":"8.557520000000068"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundetreff-wolfsbrueder\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43301'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43321","post_categories":"","coordinates":{"lat":"48.1947453","lng":"11.3701227"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/der-hundemann\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43321'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43325","post_categories":"","coordinates":{"lat":"51.9493273","lng":"8.6249924"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/sandra-goots-hundetraining\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43325'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43327","post_categories":"","coordinates":{"lat":"54.2465571","lng":"10.2731753"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/team-ideal\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43327'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43257","post_categories":"","coordinates":{"lat":"50.7684728","lng":"7.2728593"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/meine-welt-der-jagdhunde\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43257'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43243","post_categories":"","coordinates":{"lat":"51.2300398","lng":"7.2250204"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/bg-hundetraining\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43243'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43235","post_categories":"","coordinates":{"lat":"49.4309969","lng":"7.1546294"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/sofawoelfe-st-wendel\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43235'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43205","post_categories":"","coordinates":{"lat":"49.8877694","lng":"11.4478052"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-frankenwoelfe-in-ansbach-gunzenhausen\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43205'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43207","post_categories":"","coordinates":{"lat":"50.1763277","lng":"9.1477918"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/freischnauze-hundetraining-halterberatung\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43207'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43179","post_categories":"","coordinates":{"lat":"49.4429071","lng":"11.0947553"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-bindungssache\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43179'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43119","post_categories":"","coordinates":{"lat":"52.6193993","lng":"13.4850021"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-sofawolf\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43119'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43117","post_categories":"","coordinates":{"lat":"47.5923147","lng":"11.1860066"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hunde-impressionen-training\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43117'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43047","post_categories":"","coordinates":{"lat":"48.21155","lng":"10.5526376"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-schwabenwolf\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43047'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43091","post_categories":"","coordinates":{"lat":"48.4388953","lng":"7.946702999999999"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/the-dogworker-christian-schindler\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43091'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43085","post_categories":"","coordinates":{"lat":"51.4985333","lng":"7.9015201"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/tier-resort-diana-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43085'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43033","post_categories":"","coordinates":{"lat":"51.9488223","lng":"10.4703608"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/der-tut-was-goslar-harz\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43033'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43025","post_categories":"","coordinates":{"lat":"54.28176149999999","lng":"10.5699641"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mobiler-hundetrainer\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43025'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"43015","post_categories":"","coordinates":{"lat":"51.6644872","lng":"6.8166023"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/die-hundeschulmacher\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('43015'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42985","post_categories":"","coordinates":{"lat":"48.1577987","lng":"11.8106518"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-hilmer\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42985'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42987","post_categories":"","coordinates":{"lat":"52.2955156","lng":"8.9051674"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/krafthund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42987'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42991","post_categories":"","coordinates":{"lat":"47.64022809999999","lng":"7.7312735"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-wiesental\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42991'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42977","post_categories":"","coordinates":{"lat":"54.7119","lng":"8.5293899"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/appelt-menschhund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42977'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42963","post_categories":"","coordinates":{"lat":"50.2018742","lng":"9.9602954"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/peaceful-dogs\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42963'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42951","post_categories":"","coordinates":{"lat":"51.64051329999999","lng":"7.668542599999999"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dogcoach-klietz\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42951'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42947","post_categories":"","coordinates":{"lat":"48.2116109","lng":"9.0275695"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundezentrum-zollernalbkreis\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42947'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42921","post_categories":"","coordinates":{"lat":"51.9921312","lng":"10.2708185"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/ausbildungszentrum-von-david-fishman-spezialist-fuer-hundeerziehung\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42921'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42923","post_categories":"","coordinates":{"lat":"50.5575908","lng":"6.9013722"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-pfotenjunkies\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42923'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42931","post_categories":"","coordinates":{"lat":"50.0824612","lng":"8.439079399999999"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-imhoff\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42931'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42879","post_categories":"","coordinates":{"lat":"49.42465439999999","lng":"11.0260617"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dogs-training-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42879'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42883","post_categories":"","coordinates":{"lat":"51.32987","lng":"12.31744"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/pawtience-hundeerziehung\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42883'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42885","post_categories":"","coordinates":{"lat":"52.5109806","lng":"13.3798818"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-goldkind\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42885'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42881","post_categories":"","coordinates":{"lat":"50.8900239","lng":"10.0136025"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-waldhessen-2-0-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42881'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42869","post_categories":"","coordinates":{"lat":"47.8575589","lng":"12.1346076"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/der-begleithund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42869'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42867","post_categories":"","coordinates":{"lat":"54.4966031","lng":"8.9204154"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hund-hudnehalterschule-landwoelfe\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42867'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42857","post_categories":"","coordinates":{"lat":"53.55707","lng":"9.92954"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/rebeccas-hundetraining-gassi-service-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42857'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42849","post_categories":"","coordinates":{"lat":"48.3921612","lng":"12.59804"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/teamwalk-hundetrainer\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42849'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42815","post_categories":"","coordinates":{"lat":"53.55707","lng":"9.92954"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/rebeccas-hundetraining-gassi-service\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42815'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42817","post_categories":"","coordinates":{"lat":"48.6105566","lng":"8.7627097"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/jogis-hundeschule-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42817'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42819","post_categories":"","coordinates":{"lat":"51.0416235","lng":"9.8594189"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/moellers-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42819'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42757","post_categories":"","coordinates":{"lat":"54.15515","lng":"10.9860499"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-groemitz-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42757'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42755","post_categories":"","coordinates":{"lat":"54.02435","lng":"10.75807"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-kellenhusen-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42755'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42759","post_categories":"","coordinates":{"lat":"49.8814934","lng":"8.2003579"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeerzieherin-rhein-main\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42759'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42763","post_categories":"","coordinates":{"lat":"50.5955221","lng":"7.626761699999999"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/searching-dogs\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42763'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42723","post_categories":"","coordinates":{"lat":"52.4847011","lng":"13.3424101"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/pfotenkompass\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42723'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42713","post_categories":"","coordinates":{"lat":"51.98248","lng":"7.54991"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-laika\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42713'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42707","post_categories":"","coordinates":{"lat":"49.4627452","lng":"11.1334447"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/kluge-hunde\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42707'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42705","post_categories":"","coordinates":{"lat":"51.34586410000001","lng":"12.3205176"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/labcols-inside-leipzig\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42705'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42653","post_categories":"","coordinates":{"lat":"48.7181298","lng":"9.3854334"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-fatima-takruri\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42653'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42637","post_categories":"","coordinates":{"lat":"50.0548188","lng":"7.889078399999999"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/kyno-logische-schule-de\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42637'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42635","post_categories":"","coordinates":{"lat":"51.0821","lng":"9.33403"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/allaboutdogs-hundeschule-wabern\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42635'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42625","post_categories":"","coordinates":{"lat":"50.67458329999999","lng":"8.0491359"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/gute-hunde-schule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42625'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42611","post_categories":"","coordinates":{"lat":"48.3448875","lng":"12.1301588"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundezentrum-vilstal\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42611'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42591","post_categories":"","coordinates":{"lat":"48.99169999999999","lng":"9.190285399999999"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/tierkommunikation-und-mehr\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42591'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42589","post_categories":"","coordinates":{"lat":"48.99169999999999","lng":"9.190285399999999"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/ig-hundefreunde\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42589'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42593","post_categories":"","coordinates":{"lat":"51.35708409999999","lng":"7.220260499999999"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mobiles-hundetraining-silke-hesper\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42593'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":42569,"post_categories":"","coordinates":{"lat":"51.989102","lng":"8.62004920000004"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-teutopfoten-bielefeld\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42569'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42555","post_categories":"","coordinates":{"lat":"51.4915611","lng":"8.443694700000037"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mika-hundetraining\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42555'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42473","post_categories":"","coordinates":{"lat":"48.42485","lng":"10.884590000000003"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/sirius-hundetraining\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42473'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42475","post_categories":"","coordinates":{"lat":"51.20111","lng":"6.89372000000003"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hunde-achten-vertrauensvolles-hundetraining-tellington-ttouch\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42475'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42461","post_categories":"","coordinates":{"lat":"48.3842668","lng":"10.747751200000039"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/freude-mit-4-pfoten\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42461'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42457","post_categories":"","coordinates":{"lat":"53.2527392","lng":"10.397789200000034"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hunde-erleben-nord-menschhund-schule-lueneburg\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42457'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42445","post_categories":"","coordinates":{"lat":"52.35446","lng":"9.755930000000035"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-pfotenglueck-hannover\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42445'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42413","post_categories":"","coordinates":{"lat":"48.3233809","lng":"11.19385090000003"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/babsis-bazischui\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42413'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42421","post_categories":"","coordinates":{"lat":"50.36297","lng":"8.735760000000028"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/how-to-dog-coaching-fuer-dich-und-deinen-hund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42421'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42313","post_categories":"","coordinates":{"lat":"52.28779","lng":"8.010099999999966"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dogg-nroll\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42313'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42209","post_categories":"","coordinates":{"lat":"52.29364","lng":"10.576380100000051"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mensch-zu-hund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42209'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42197","post_categories":"","coordinates":{"lat":"52.22281220000001","lng":"13.420872799999984"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/martin-ruetter-dogs-potsdam-zossen\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42197'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42155","post_categories":"","coordinates":{"lat":"48.1182428","lng":"12.544874199999981"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/die-mobile-hundeschule-3\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42155'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42151","post_categories":"","coordinates":{"lat":"48.3550461","lng":"8.974480299999982"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/der-dogscoach\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42151'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42139","post_categories":"","coordinates":{"lat":"50.8900239","lng":"10.013602499999934"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-waldhessen-2-0\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42139'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42157","post_categories":"","coordinates":{"lat":"51.1414904","lng":"6.455995199999961"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mantrailing-moenchengladbach\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42157'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42135","post_categories":"","coordinates":{"lat":"48.01423430000001","lng":"10.208852500000035"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundgerecht-tierwir-im-allgaeu-sachverstaendige\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42135'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42129","post_categories":"","coordinates":{"lat":"49.48813999999999","lng":"10.716139999999996"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dogs-activity-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42129'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42123","post_categories":"","coordinates":{"lat":"52.4912614","lng":"13.42674390000002"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-wegbegleiter\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42123'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42111","post_categories":"","coordinates":{"lat":"49.4286358","lng":"8.648407399999996"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-julie-bonnie\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42111'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42077","post_categories":"","coordinates":{"lat":"51.3200343","lng":"6.6253672999999935"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeverhaltensberatung-krefeld\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42077'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42075","post_categories":"","coordinates":{"lat":"51.1181286","lng":"6.980995699999994"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-einfach-huendisch\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42075'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42059","post_categories":"","coordinates":{"lat":"50.82439","lng":"7.745300000000043"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hunde-naturell-akademie\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42059'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42039","post_categories":"","coordinates":{"lat":"49.1393723","lng":"7.308980099999985"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/verhaltenstraining-fuer-hunde-andrea-fromm\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42039'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42023","post_categories":"","coordinates":{"lat":"48.67792","lng":"12.210370000000012"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/einhundert-krumawukl\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42023'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42025","post_categories":"","coordinates":{"lat":"51.4669505","lng":"7.060025699999983"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-findeklee\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42025'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"42005","post_categories":"","coordinates":{"lat":"51.3456647","lng":"6.3027038"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundezentrum-nettetal\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('42005'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41963","post_categories":"","coordinates":{"lat":"51.2552384","lng":"6.969175800000016"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/projekthunde-deutschland\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41963'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41975","post_categories":"","coordinates":{"lat":"50.8253086","lng":"6.2516974999999775"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/euregio-hundezentrum-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41975'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41971","post_categories":"","coordinates":{"lat":"49.61987999999999","lng":"10.812890000000039"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/allround-hundeschule-pilsberger\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41971'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41949","post_categories":"","coordinates":{"lat":"53.0807167","lng":"8.847178799999938"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/bremer-stadthund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41949'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41951","post_categories":"","coordinates":{"lat":"48.8662249","lng":"9.033679200000051"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/nachbars-lumpi\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41951'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41935","post_categories":"","coordinates":{"lat":"51.2031942","lng":"6.57522670000003"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/michael-kronenberg-hundetrainer-verhaltensberater\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41935'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41891","post_categories":"","coordinates":{"lat":"54.17326980000001","lng":"13.210254500000019"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/reez\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41891'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41893","post_categories":"","coordinates":{"lat":"52.73877","lng":"13.65800999999999"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundepension-und-training\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41893'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41899","post_categories":"","coordinates":{"lat":"50.62820079999999","lng":"13.107734199999982"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-heiko-scharf\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41899'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41895","post_categories":"","coordinates":{"lat":"51.774","lng":"11.442750100000012"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-ich-und-du\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41895'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41889","post_categories":"","coordinates":{"lat":"52.29135220000001","lng":"10.556598500000064"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/wilson-hundeschule-und-hundepension\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41889'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41837","post_categories":"","coordinates":{"lat":"50.9768996","lng":"14.281595400000015"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/herzenstoelen\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41837'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41849","post_categories":"","coordinates":{"lat":"49.4979228","lng":"8.540510400000016"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dogconcept-mannheim\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41849'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41821","post_categories":"","coordinates":{"lat":"47.8296418","lng":"9.25613199999998"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/lake-dog-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41821'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41691","post_categories":"","coordinates":{"lat":"50.6701321","lng":"7.51446999999996"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/du-und-dein-hund-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41691'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41755","post_categories":"","coordinates":{"lat":"53.2584595","lng":"11.315846400000055"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-stiller-2\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41755'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41757","post_categories":"","coordinates":{"lat":"49.5435498","lng":"6.891639599999962"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/familien-und-sporthunde-hochwald-e-v\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41757'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41771","post_categories":"","coordinates":{"lat":"48.6189829","lng":"9.454755200000022"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dreamteam-die-mobile-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41771'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41767","post_categories":"","coordinates":{"lat":"47.9927508","lng":"11.457702599999948"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-stubenwoelfe\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41767'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41759","post_categories":"","coordinates":{"lat":"51.059724","lng":"6.197233900000015"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/gaby-leiteritz-hundetrainerin-und-verhaltenstherapeutin\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41759'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41739","post_categories":"","coordinates":{"lat":"50.07165999999999","lng":"7.488799999999969"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundetrainer-vor-ort\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41739'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41693","post_categories":"","coordinates":{"lat":"51.4267412","lng":"7.431763199999978"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/gisela-heuer-hundepsychologin-und-verhaltenstherapeutin\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41693'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41669","post_categories":"","coordinates":{"lat":"52.1300196","lng":"11.673386899999969"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundetherapie-magdeburg\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41669'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41661","post_categories":"","coordinates":{"lat":"52.64225","lng":"13.320220000000063"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-teamspirit-zentrum-fuer-mensch-und-hund\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41661'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41653","post_categories":"","coordinates":{"lat":"54.0816873","lng":"12.128935500000011"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-ostseepfoten\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41653'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41517","post_categories":"","coordinates":{"lat":"49.3315315","lng":"7.257640199999969"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/lucky-dog-center\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41517'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41531","post_categories":"","coordinates":{"lat":"53.6756283","lng":"9.910348200000044"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/hundeschule-diana\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41531'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41533","post_categories":"","coordinates":{"lat":"52.55369","lng":"13.339339999999993"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/grossstadt-gebell\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41533'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41545","post_categories":"","coordinates":{"lat":"51.5842707","lng":"7.524388199999976"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/andreas-stieb-hundeschule-ams\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41545'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41543","post_categories":"","coordinates":{"lat":"48.24824","lng":"11.445320000000038"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/pfotenchaoten-training-fuer-hund-und-katze\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41543'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"41519","post_categories":"","coordinates":{"lat":"50.4285113","lng":"10.91336309999997"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/meli-hundeschule\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('41519'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"26491","post_categories":"","coordinates":{"lat":"51.2708567","lng":"13.298189399999956"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/dogs-n-joy-mantrailing\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('26491'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"26487","post_categories":"","coordinates":{"lat":"53.95334","lng":"9.734190000000012"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/stoerhund-hundetraining\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('26487'); 							
								/**
								 * Create the pin object.
								 * Validate latLng | @since 3.6 */
														 
								var marker_object = cspm_new_pin_object(map_id, {"post_id":"26467","post_categories":"","coordinates":{"lat":"49.7760379","lng":"6.545793300000014"},"icon":{"url":"https:\/\/hundeschulen.derhund.de\/wp-content\/plugins\/codespacing-progress-map\/img\/svg\/marker.svg","size":"30x32"},"is_child":"no","media":{"format":"standard","gallery":[],"image":[],"audio":"","embed":{"title":"","type":"","thumb":"","provider":"","html":""},"link":"https:\/\/hundeschulen.derhund.de\/hundeschule\/mobile-hundeschule-laura-klink\/"}});
								if(marker_object) 
									json_markers_data.push(marker_object);
								else false_latLngs.push('26467'); 
					var show_infobox = 'true';
					var infobox_type = 'cspm_type3';
					var infobox_display_event = 'onclick';
					var useragent = navigator.userAgent;
					var infobox_loaded = false;
					var clustering_method = false;
					var remove_infobox_on_mouseout = 'false';
					var use_marker_popups = 'no'; //@since 4.0
					var marker_popups_loaded = false; //@since 4.0
											
					/**
					 * [@polyline_values] - will store an Object of all available Polylines	
					 * [@polygon_values] - will store an Object of all available Polygons					 				 					 
					 * @since 2.7 */
					 
					var polyline_values = [];
					var polygon_values = [];
					
					/**
					 * [@kml_values] - will store an Object of all available KML layers	
					 * @since 3.0 */
					
					var kml_values = [];
					
					/**
					 * [@ground_overlays_values] - will store an Object of all available Ground overlays (Images)
					 * @since 3.5 */
					
					var ground_overlays_values = [];
					
					
					/**
					 * Build the map */

					plugin_map.gmap3({		
						map:{
							options: map_options,							
							onces: {
								tilesloaded: function(map){

									var carousel_output = []; 

									plugin_map.gmap3({ 										
										marker:{
											values: json_markers_data,
											callback: function(markers){
												
																								
																								
												/**
												 * [@markers_latlngs] Contains all marker latLngs
												 * @since 3.3 */
												 
												var markers_latlngs = [];
												
												/**
												 * Build the carousel items */
													
												for(var i = 0; i < markers.length; i++){	
													
													var post_id = markers[i].post_id;
													var is_child = markers[i].is_child;
													var marker_position = markers[i].position;

													markers_latlngs.push(marker_position); //@since 3.3
													
													if(!light_map){
														
																												
															/**
															 * Convert the LatLng object to array */
															 
															var lat = marker_position.lat();
															var lng = marker_position.lng();											
															
															carousel_output.push(
																cspm_carousel_item_HTML({
																	map_id: map_id,
																	post_id: post_id,
																	is_child: is_child,
																	index: (i+1),
																	latLng: lat+'_'+lng,
																})
															);							
															
															if(i == markers.length-1)
																$('ul#cspm_carousel_'+map_id).append(carousel_output.join(''));	

																																				
														
														if(i == markers.length-1)
															cspm_init_carousel(null, map_id);
													
													}

												}	
												
																								
																									
													if((typeof NProgress !== 'undefined' && NProgress.done()) || typeof NProgress === 'undefined'){
														
														setTimeout(function(){
															
															 
																var show_user_marker = true; 
																														
																														
															cspm_geolocate(plugin_map, map_id, show_user_marker, '/wp-content/plugins/codespacing-progress-map/img/svg/user_marker.svg', '32x32', 0, 10, false);															
															
														}, 1000);
														
													}
												
														
																										
											},											
											events:{
												mouseover: function(marker, event, elements){
													
													/**
													 * Show a message to the user to inform them that ...
													 * ... they can open the the post media modal if they ...
													 * ... click on the marker.
													 *
													 * @since 3.5 */

													if(typeof marker.media !== 'undefined' && marker.media.format != 'standard' && marker.media.format != '')
														cspm_open_media_message(marker.media, map_id);

													/**
													 * Display the single infobox */

													if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onhover'){
														cspm_draw_single_infobox(plugin_map, map_id, marker, {"type":"cspm_type3","display_event":"onclick","link_target":"new_window","remove_on_mouseout":"false"}).done(function(){
															cspm_connect_carousel_and_infobox();														
														});
													}
													
																										
														/**
														 * Apply the style for the active item in the carousel */
														 
														if(!light_map){	
															
															var post_id = marker.post_id;
															var is_child = marker.is_child;	
															var i = $('li.cspm_carousel_item[data-map-id='+map_id+'][data-post-id='+post_id+'][data-is-child="'+is_child+'"]').attr('data-index');
															
															cspm_call_carousel_item($('ul#cspm_carousel_'+map_id).data('jcarousel'), i);
															cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id, map_id);
														
														}
													
																										
												},	
												mouseout: function(marker, event, elements){
													
													var post_id = marker.post_id;
													
													/**
													 * Hide the post media message
													 * @since 3.5 */

													if(typeof marker.media !== 'undefined' && marker.media.format != 'standard' && marker.media.format != '')
														cspm_close_media_message(map_id);
													
												},
												click: function(marker, event, elements){
																																
													var latLng = marker.position;											
 
													/**
													 * Center the map on that marker */
													
													map.panTo(latLng);

													/**
													 * Display the single infobox */

													if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onclick'){
														cspm_draw_single_infobox(plugin_map, map_id, marker, {"type":"cspm_type3","display_event":"onclick","link_target":"new_window","remove_on_mouseout":"false"}).done(function(){
															cspm_connect_carousel_and_infobox();														
														});
													}
													
																			
													
														/**
														 * Apply the style for the active item in the carousel */
														 
														if(!light_map){	
															
															var post_id = marker.post_id;
															var is_child = marker.is_child;
															var i = $('li.cspm_carousel_item[data-map-id='+map_id+'][data-post-id='+post_id+'][data-is-child="'+is_child+'"]').attr('data-index');

															cspm_call_carousel_item($('ul#cspm_carousel_'+map_id).data('jcarousel'), i);
															cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id, map_id);
														
														}
													
																										
																										
																						
													
													/**
													 * Open the post/location media modal
													 * @since 3.5 */

													if(typeof marker.media !== 'undefined' && marker.media.format != 'standard' && marker.media.format != '')
														cspm_open_media_modal(marker.media, map_id);

												}
											}
										},
										
									});									
									
																			clustering_method = true;
										var clusterer = cspm_clustering(plugin_map, map_id, light_map); 
										$('div.search_form_btn[data-map-id='+map_id+']').show(); 
																											 
																			$('div.cspm_geotarget_container[data-map-id='+map_id+']').show();									
																		
																	 
																		
																	 
																		 
																		
									/**
									 * Draw on the map */
									 
									if(json_markers_data.length > 0){
									
										/**
										 * Draw infoboxes (onload event) */
										 
										if(infobox_display_event == 'onload' && show_infobox == 'true'){			
											if(clustering_method == true){
												google.maps.event.addListenerOnce(clusterer, 'clusteringend', function(cluster){																	
													setTimeout(function(){
														cspm_draw_multiple_infoboxes(plugin_map, map_id, {"type":"cspm_type3","display_event":"onclick","link_target":"new_window","remove_on_mouseout":"false"}).done(function(){
															cspm_connect_carousel_and_infobox();														
														});
														infobox_loaded = true;														
													}, 500);																
												});	
											}else{
												setTimeout(function(){
													cspm_draw_multiple_infoboxes(plugin_map, map_id, {"type":"cspm_type3","display_event":"onclick","link_target":"new_window","remove_on_mouseout":"false"}).done(function(){
														cspm_connect_carousel_and_infobox();														
													});											
													infobox_loaded = true;
												}, 500);
											}
										}else infobox_loaded = true;
									
										/**
										 * Draw Marker popups
										 * @since 4.0 */
										 
										if(use_marker_popups == 'yes'){			
											if(clustering_method == true){
												google.maps.event.addListenerOnce(clusterer, 'clusteringend', function(cluster){																	
													setTimeout(function(){
														cspm_draw_multiple_popups(plugin_map, map_id, {"placement":"right","bgColor":"#ffffff","color":"#000000","fontSize":"14px","fontWeight":"bold"});													
														marker_popups_loaded = true;
													}, 500);																
												});	
											}else{
												setTimeout(function(){
													cspm_draw_multiple_popups(plugin_map, map_id, {"placement":"right","bgColor":"#ffffff","color":"#000000","fontSize":"14px","fontWeight":"bold"});													
													marker_popups_loaded = true;
												}, 500);
											}
										}
																	
									}									

																		
									/**
									 * End the Progress Bar Loader */
									 	
									if(typeof NProgress !== 'undefined')
										NProgress.done();
									
								}
								
							},
							events:{
								idle: function(){
									
									/**
									 * re-display infoboxes after search/filter request */
									 
									if(infobox_loaded && !cspm_is_panorama_active(plugin_map)){
										setTimeout(function(){
											if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onload'){								
												cspm_draw_multiple_infoboxes(plugin_map, map_id, {"type":"cspm_type3","display_event":"onclick","link_target":"new_window","remove_on_mouseout":"false"}).done(function(){
													cspm_connect_carousel_and_infobox();														
												});
												infobox_loaded = true;	
											}
										}, 200);
									}
									
									/**
									 * Marker popups
									 * @since 4.0 */
																		
									if(use_marker_popups == 'yes' && marker_popups_loaded){
										setTimeout(function(){
											cspm_draw_multiple_popups(plugin_map, map_id, {"placement":"right","bgColor":"#ffffff","color":"#000000","fontSize":"14px","fontWeight":"bold"});													
										}, 200);
									}
									
									/**
									 * Set Marker labels visibility
									 * Note: This will prevent an issue where marker labels stay visible when markers are not in the viewport of the map!
									 * @since 4.0 */
									
									cspm_set_marker_labels_visibility(plugin_map, map_id);
									
								},
								bounds_changed: function(){
									setTimeout(function() {
										$('div[class^=cluster_posts_widget]').removeClass('flipInX');
										$('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');
										$('div[class^=cluster_posts_widget]').attr('data-cluster-id', ''); //@since 3.5
										setTimeout(function() {
											if(typeof $('div.cluster_posts_widget_'+map_id).mCustomScrollbar === 'function'){
												$('div.cluster_posts_widget_'+map_id).mCustomScrollbar("destroy");
											}
										}, 500);
									}, 500);
								},
							}
						},					
												
																		
												
												
													
												
												 
												 						
					});		
					
					var mapObject = plugin_map.gmap3('get');
					
					/** 
					 * Rotating 45° imagery support
					 * @since 3.3 */
					 
					if(typeof setTilt === 'function')
						mapObject.setTilt(45);
					
					/**
					 * Hide/Show UI Controls depending on the streetview visibility */

					if(typeof mapObject.getStreetView === 'function'){
												
						var streetView = mapObject.getStreetView();
					
						google.maps.event.addListener(streetView, "visible_changed", function(){
							
							if(this.getVisible()){
								
																 
																 
																	$('div.search_form_btn[data-map-id='+map_id+']').hide();
									$('div.search_form_container_'+map_id).hide();									
																 
																								 
																	$('div.cspm_geotarget_container[data-map-id='+map_id+']').hide();
																
																 
																
																	
																									
									
																 
							}else{
								 
																 
																 
																	$('div.search_form_btn[data-map-id='+map_id+']').show();
																 
																 
																	$('div.cspm_geotarget_container[data-map-id='+map_id+']').show();
																
																 
																
																	
																									
									
								
							}
								
						});
						
					}
					 		
										
										
											
						cspm_fitIn_map(map_id);
						$(window).resize(function(){ cspm_fitIn_map(map_id); }); 					 
											
						/**
						 * Store the window width */
						
						var windowWidth = $(window).width();
	
						$(window).resize(function(){
							
							/**
							 * Check window width has actually changed and it's not just iOS triggering a resize event on scroll */
							 
							if ($(window).width() != windowWidth) {
					
								/**
								 * Update the window width for next time */
								 
								windowWidth = $(window).width();
			
								setTimeout(function(){
									
									var latLng = cspm_validate_latLng('48.21389 ', ' 10.961239999999975');							
								
									if(!latLng)
										return;
										
									var map = plugin_map.gmap3("get");	
									
									if(typeof map.panTo === 'function')
										map.panTo(latLng);
									
									if(typeof map.setCenter === 'function')
										map.setCenter(latLng);
										
								}, 500);
								
							}
							
						});

					 
					 
										
						
						$(plugin_map_placeholder+':visible').livequery(function(){
							if(_CSPM_MAP_RESIZED[map_id] <= 1){ /* 0 is for the first time loading, 1 is when the user clicks the map tab */
								cspm_center_map_at_point(plugin_map, 'map40501', 48.21389 ,  10.961239999999975, 'resize');
								_CSPM_MAP_RESIZED[map_id]++;
							}
							cspm_zoom_in_and_out(plugin_map);
						});

										 
													
						var input = document.getElementById('cspm_address_'+map_id);
						var autocomplete = new google.maps.places.Autocomplete(input); 

													autocomplete.setComponentRestrictions({'country': ["DE"]}); 
					_CSPM_DONE[map_id] = true;
	
				});
			
			</script> 
			
			<div class="codespacing_progress_map_area" data-map-id="map40501" data-show-infobox="true" data-infobox-display-event="onclick"  style="width:100%;"><input type="hidden" name="cspm_map_page_id_map40501" id="cspm_map_page_id_map40501" value="95" /><div class="cspm_map_red_msg_widget cspm_border_shadow cspm_border_radius" data-map-id="map40501"></div><div class="cspm_map_green_msg_widget cspm_border_shadow cspm_border_radius" data-map-id="map40501"></div><div class="cspm_map_orange_msg_widget cspm_border_shadow cspm_border_radius" data-map-id="map40501"></div><div class="cspm_map_blue_msg_widget cspm_border_shadow cspm_border_radius" data-map-id="map40501"></div><div class="cspm_map_help_msg_widget cspm_border_shadow cspm_border_radius" data-map-id="map40501"></div><div id="pulsating_holder" class="map40501_pulsating"><div class="dot cspm_border_hex"></div></div><div class="cluster_posts_widget_map40501 cspm_border_shadow cspm_border_radius"><div class="cspm_infobox_spinner cspm_border_top_after_hex"></div></div><div class="cspm_geotarget_container" data-map-id="map40501" style="top:10px"><div class="cspm_geotarget_btn cspm_map_btn cspm_border_shadow cspm_border_radius" data-map-id="map40501" title="Show your position"><img class="cspm_svg cspm_svg_colored" src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" data-lazy-src="/wp-content/plugins/codespacing-progress-map/img/svg/geoloc.svg" /><noscript><img class="cspm_svg cspm_svg_colored" src="/wp-content/plugins/codespacing-progress-map/img/svg/geoloc.svg" /></noscript></div></div><div class="search_form_btn cspm_map_btn cspm_top_btn cspm_expand_map_btn cspm_border_shadow cspm_border_radius" id="map40501" data-map-id="map40501" style="left:60px" title="Search"><img class="cspm_svg cspm_svg_colored" src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="Search" title="Search" data-lazy-src="/wp-content/plugins/codespacing-progress-map/img/svg/loup.svg" /><noscript><img class="cspm_svg cspm_svg_colored" src="/wp-content/plugins/codespacing-progress-map/img/svg/loup.svg" alt="Search" title="Search" /></noscript></div><div class="search_form_container_map40501 cspm_top_element cspm_border_shadow cspm_border_radius" style="left:60px; "><form action="" method="post" class="search_form" id="search_form_map40501" onsubmit="return false;"><div class="cspm_search_form_row"><div class="cspm_search_input_text_container input cspm_border_shadow cspm_border_radius"><input type="text" name="cspm_address" id="cspm_address_map40501" value="" placeholder="Straße, PLZ oder Ort eingeben" title="Straße, PLZ oder Ort eingeben" /></div><div class="cspm_geotarget_search_btn cspm_map_btn cspm_border_shadow cspm_border_radius" data-map-id="map40501" data-latLng="" title="Your position"><img class="cspm_svg cspm_svg_colored" src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" data-lazy-src="/wp-content/plugins/codespacing-progress-map/img/svg/geoloc.svg" /><noscript><img class="cspm_svg cspm_svg_colored" src="/wp-content/plugins/codespacing-progress-map/img/svg/geoloc.svg" /></noscript></div><div style="clear:both;"></div></div><div class="cspm_expand_search_area"><div class="cspm_search_label_container"><img class="cspm_svg cspm_svg_colored" src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" data-lazy-src="/wp-content/plugins/codespacing-progress-map/img/svg/radius.svg" /><noscript><img class="cspm_svg cspm_svg_colored" src="/wp-content/plugins/codespacing-progress-map/img/svg/radius.svg" /></noscript><label class="cspm_txt_hex">Erweitere das Suchgebiet</label></div><div class="cspm_search_slider_container"><input type="text" name="cspm_distance" class="cspm_sf_slider_range" data-map-id="map40501" data-min="3" data-max="50" data-postfix=" Km" data-keyboard="true" data-keyboard-step="0.1" /><input type="hidden" name="cspm_distance_unit" value="metric" /><input type="hidden" name="cspm_decimals_distance" value="" /></div></div><div class="cspm_search_btns_container"><div class="cspm_submit_search_form_map40501 cspm_bg_hex_hover cspm_border_shadow cspm_border_radius" data-map-id="map40501" data-show-carousel="no" data-ext="">Suche<img class="cspm_svg cspm_svg_white" src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" data-lazy-src="/wp-content/plugins/codespacing-progress-map/img/svg/search-loup.svg" /><noscript><img class="cspm_svg cspm_svg_white" src="/wp-content/plugins/codespacing-progress-map/img/svg/search-loup.svg" /></noscript></div><div class="cspm_reset_search_form_map40501 cspm_border_shadow cspm_border_radius" data-map-id="map40501" data-show-carousel="no" data-ext=""><img class="cspm_svg" src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" data-lazy-src="/wp-content/plugins/codespacing-progress-map/img/svg/refresh-circular-arrow.svg" /><noscript><img class="cspm_svg" src="/wp-content/plugins/codespacing-progress-map/img/svg/refresh-circular-arrow.svg" /></noscript></div><div style="clear:both"></div></div></form></div><div id="codespacing_progress_map_div_map40501" class="gmap3" style="width:100%; height:100%"></div></div>        </div>    <div id="home-slider-area" class=" " >
        <div class="container-fluid">
                            <div id="b1">
                    <ins data-revive-zoneid="587" data-revive-id="1d5b67a2884d3da9bbfc0c94c11ce164"></ins>                </div>
                                        <h2>
                    Zuletzt bewertete Hundeschulen                </h2>
                <div class="home-slider  schools-slider">
                                            <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">5 Sterne</em></p>
<span class="post_title">Mobile Hundeschule Hinterland GbR</span><div class="the-review">
<p>Haben den Schnuffelkurs der MobilenHundeschule Hinterland besucht. Hat wirklich Spaß gemacht und habenneiniges gelernt!</p>
</div>
<p></p>
<div>Caro Rokitzki 19.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/koeditz/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">5 Sterne</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Immer wieder gerne, wir fühlen uns sehr gut aufgehoben und verstanden, Fiete und ich freuen uns auf jede Stunde. Der Pfotentreff mit Diana ist immer wieder eine Bereicherung für uns beide.</p>
</div>
<p></p>
<div>Anke Möller 19.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">5 Sterne</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Wir besuchen den Pfotentreff Olfen und sind glücklich, dass wir uns diese Hundeschule ausgesucht haben. Wir konnten im Welpenkurs schon viel lernen und machen im Junghundekurs nun weiter. Einfach ein Spitzen-Team.</p>
</div>
<p></p>
<div>Sarah mit Kiyoko 17.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">5 Sterne</em></p>
<span class="post_title">Doghouse - Mobiles HundeCenter</span><div class="the-review">
<p>Wir haben lange nach einer guten Hundetrainerin gesucht und sind aufgrund einer Empfehlung auf Jenny und ihr Doghouse gestoßen. Sie war uns vom ersten Moment an sympathisch, ist sehr kompetent und weiß genau, was sie tut. Sie erklärt die Welt aus der Sicht der Hunde, konnte uns damit in vielen Dingen die Augen öffnen und uns super vermitteln, wie wir mit unseren Hunden kommunizieren sollen und müssen, um bestmöglich an unser Ziel zu kommen.</p>
<p>Bereits nach den ersten Trainingseinheiten konnten wir gemeinsam große Fortschritte erzielen und können sie auch jetzt noch jederzeit um Hilfe bitten.</p>
<p>Wir können sie nur wärmstens weiterempfehlen und immer wieder vielen Dank für die riesengroße Hilfe sagen.</p>
<p>Viele Grüße,
Franzi &amp; Patrick</p>
</div>
<p></p>
<div>Franzi Frühauf 16.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/doghouse-mobiles-hundecenter/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Der Welpenkurs war schon wirklich gut.Gute Organisation und kleine Gruppen,wo wirklich ein Auge auf jedes Hund-/Mensch- Team geworfen wird.Wir machen weiter&#8230;Großes Lob!</p>
</div>
<p></p>
<div>Marcel F. 16.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Ich bin in der Hundeschule Pfotentreff sehr zufrieden. Unser Hund hat jetzt schon so viel gelernt.Wir werden bestimmt noch viele weitere Kurse dort besuchen. Aber jetzt erstmal ab in den Junghundekurs!Herzlichen Dank!</p>
</div>
<p></p>
<div>Sarah F. 16.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Wir haben den Welpen-Kurs besucht und uns wurde richtig gut geholfen und erklärt. Wir fühlen uns beim Pfotentreff Olfen gut verstanden und haben direkt weitere Kurse belegt.</p>
</div>
<p></p>
<div>Jana Müller-Simdorn 15.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">SYSDOG Hundeschule</span><div class="the-review">
<p>Grandiose Hundeschule!
Mit Herz und Verstand.
Ihr geht an die Wurzel des Verstehens für das Umsetzen der Erziehung.
5 Sterne!!
Team Irmi mit Josie</p>
</div>
<p></p>
<div>Irmi und Josie 11.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/hundeschulungszentrum-sysdog/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em>
</p>
<div>Gitta Herold 11.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/hundeschule-jacobs-teamtraining-hund-mensch/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Pfotentreff Olfen &#8211; wir haben den Welpenkurs besucht und konnten wirklich viel lernen. Es hat uns soviel Spaß gemacht, dass wir mit dem Junghundekurs weiter machen.</p>
</div>
<p></p>
<div>Lea Störmann 07.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Hundeschule Jacobs -Teamtraining Hund & Mensch</span><div class="the-review">
<p>Ich gehe seit 2 Jahren regelmäßig zu der Hundeschule Jacobs und empfehle sie auch allen Freunden ! Alle Mitarbeiter, egal ob Trainer oder die Damen aus dem Büro, sind unfassbar freundlich ! Die Hundeschule hat immer ein offenes Ohr und sind auch offen für neue Themen ! Ich habe mich einmal an die Hundeschule gewendet, da ich mit meinem Rüden große Unsicherheiten innerhalb der Stadt hatte und ob es dazu nicht mal ein Seminar o.ä  geben könnte. Eine Woche später wurde ein neuer Kurs eröffnet „Stadttraining“. Ich bin einfach super dankbar diese Hundeschule an meiner Seite zu haben ! :)</p>
</div>
<p></p>
<div>Annika Breil 07.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/hundeschule-jacobs-teamtraining-hund-mensch/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Hundeschule Canidus - Riko Sparenberg</span><div class="the-review">
<p>Super zufrieden! Die Hundeschule Canidus arbeitet mit Sinn und Verstand. ich würde immer wieder hingehen.</p>
</div>
<p></p>
<div>Chatarina Trab 06.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/canidus-hundetraining-riko-sparenberg/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                        </div>
                    </div>
    </div>
        <div id="home-banners-below">
        <div class="container-fluid">
            <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                        <!-- Revive Adserver Asynchronous JS Tag - Generated with Revive Adserver v5.4.0 -->

<ins data-revive-zoneid="753" data-revive-id="1d5b67a2884d3da9bbfc0c94c11ce164"></ins>

<script async src="//adserver.forum-media.eu/www/delivery/asyncjs.php"></script>                    </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                        <ins data-revive-zoneid="755" data-revive-id="1d5b67a2884d3da9bbfc0c94c11ce164"></ins>                    </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                        <ins data-revive-zoneid="757" data-revive-id="1d5b67a2884d3da9bbfc0c94c11ce164"></ins>                    </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                        <ins data-revive-zoneid="759" data-revive-id="1d5b67a2884d3da9bbfc0c94c11ce164"></ins>                    </div>
                                </div>
        </div>
    </div>
        <div id="home-slider-area" class="white-arrows white-title" style="background: url('/wp-content/uploads/2022/10/image-33-2.jpg')!important;background-size:cover!important;">
        <div class="container-fluid">
                                        <h2>
                    Bestbewertete Hundeschulen                </h2>
                <div class="home-slider sort-by-rating schools-slider">
                                            <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">5 Sterne</em></p>
<span class="post_title">Mobile Hundeschule Hinterland GbR</span><div class="the-review">
<p>Haben den Schnuffelkurs der MobilenHundeschule Hinterland besucht. Hat wirklich Spaß gemacht und habenneiniges gelernt!</p>
</div>
<p></p>
<div>Caro Rokitzki 19.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/koeditz/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">5 Sterne</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Immer wieder gerne, wir fühlen uns sehr gut aufgehoben und verstanden, Fiete und ich freuen uns auf jede Stunde. Der Pfotentreff mit Diana ist immer wieder eine Bereicherung für uns beide.</p>
</div>
<p></p>
<div>Anke Möller 19.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">5 Sterne</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Wir besuchen den Pfotentreff Olfen und sind glücklich, dass wir uns diese Hundeschule ausgesucht haben. Wir konnten im Welpenkurs schon viel lernen und machen im Junghundekurs nun weiter. Einfach ein Spitzen-Team.</p>
</div>
<p></p>
<div>Sarah mit Kiyoko 17.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">5 Sterne</em></p>
<span class="post_title">Doghouse - Mobiles HundeCenter</span><div class="the-review">
<p>Wir haben lange nach einer guten Hundetrainerin gesucht und sind aufgrund einer Empfehlung auf Jenny und ihr Doghouse gestoßen. Sie war uns vom ersten Moment an sympathisch, ist sehr kompetent und weiß genau, was sie tut. Sie erklärt die Welt aus der Sicht der Hunde, konnte uns damit in vielen Dingen die Augen öffnen und uns super vermitteln, wie wir mit unseren Hunden kommunizieren sollen und müssen, um bestmöglich an unser Ziel zu kommen.</p>
<p>Bereits nach den ersten Trainingseinheiten konnten wir gemeinsam große Fortschritte erzielen und können sie auch jetzt noch jederzeit um Hilfe bitten.</p>
<p>Wir können sie nur wärmstens weiterempfehlen und immer wieder vielen Dank für die riesengroße Hilfe sagen.</p>
<p>Viele Grüße,
Franzi &amp; Patrick</p>
</div>
<p></p>
<div>Franzi Frühauf 16.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/doghouse-mobiles-hundecenter/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Der Welpenkurs war schon wirklich gut.Gute Organisation und kleine Gruppen,wo wirklich ein Auge auf jedes Hund-/Mensch- Team geworfen wird.Wir machen weiter&#8230;Großes Lob!</p>
</div>
<p></p>
<div>Marcel F. 16.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Ich bin in der Hundeschule Pfotentreff sehr zufrieden. Unser Hund hat jetzt schon so viel gelernt.Wir werden bestimmt noch viele weitere Kurse dort besuchen. Aber jetzt erstmal ab in den Junghundekurs!Herzlichen Dank!</p>
</div>
<p></p>
<div>Sarah F. 16.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Wir haben den Welpen-Kurs besucht und uns wurde richtig gut geholfen und erklärt. Wir fühlen uns beim Pfotentreff Olfen gut verstanden und haben direkt weitere Kurse belegt.</p>
</div>
<p></p>
<div>Jana Müller-Simdorn 15.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">SYSDOG Hundeschule</span><div class="the-review">
<p>Grandiose Hundeschule!
Mit Herz und Verstand.
Ihr geht an die Wurzel des Verstehens für das Umsetzen der Erziehung.
5 Sterne!!
Team Irmi mit Josie</p>
</div>
<p></p>
<div>Irmi und Josie 11.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/hundeschulungszentrum-sysdog/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em>
</p>
<div>Gitta Herold 11.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/hundeschule-jacobs-teamtraining-hund-mensch/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Pfotentreff Olfen</span><div class="the-review">
<p>Pfotentreff Olfen &#8211; wir haben den Welpenkurs besucht und konnten wirklich viel lernen. Es hat uns soviel Spaß gemacht, dass wir mit dem Junghundekurs weiter machen.</p>
</div>
<p></p>
<div>Lea Störmann 07.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/pfotentreff-olfen/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Hundeschule Jacobs -Teamtraining Hund & Mensch</span><div class="the-review">
<p>Ich gehe seit 2 Jahren regelmäßig zu der Hundeschule Jacobs und empfehle sie auch allen Freunden ! Alle Mitarbeiter, egal ob Trainer oder die Damen aus dem Büro, sind unfassbar freundlich ! Die Hundeschule hat immer ein offenes Ohr und sind auch offen für neue Themen ! Ich habe mich einmal an die Hundeschule gewendet, da ich mit meinem Rüden große Unsicherheiten innerhalb der Stadt hatte und ob es dazu nicht mal ein Seminar o.ä  geben könnte. Eine Woche später wurde ein neuer Kurs eröffnet „Stadttraining“. Ich bin einfach super dankbar diese Hundeschule an meiner Seite zu haben ! :)</p>
</div>
<p></p>
<div>Annika Breil 07.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/hundeschule-jacobs-teamtraining-hund-mensch/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                                <div class="sort-it-now">
                                                            <div>
                                    <div class="one-school one-review">
                                        
<div class="commentEntry"><em class="the-number-of-the-stars">Ja</em></p>
<span class="post_title">Hundeschule Canidus - Riko Sparenberg</span><div class="the-review">
<p>Super zufrieden! Die Hundeschule Canidus arbeitet mit Sinn und Verstand. ich würde immer wieder hingehen.</p>
</div>
<p></p>
<div>Chatarina Trab 06.11.2022</div>
</div>
<p><span class="moreDetails"><p><a rel="nofollow"  href="/hundeschule/canidus-hundetraining-riko-sparenberg/">» Zur Hundeschule</a></p>
</span>                                        
                                    </div>
                                </div>
                                                        </div>
                                        </div>
                    </div>
    </div>
    <div id="register-your-dog">
    <div class="container-fluid">
        <h3>
            Jetzt deine Hundeschule eintragen und groß rauskommen!        </h3>
        <p>
            Hol dir dein Partner-Siegel als Premium-Hundeschule,  profitiere von einer Top-Platzierung in der Suche und umfangreicher Premium-Präsentation auf deiner Eintragseite u.v.m.        </p>
        <p>
            <a href="/jetzt-anmelden/">
                Jetzt als Hundeschule registrieren            </a>
        </p>
    </div>
</div>    <div id="home-slider-area" class="white-arrows white-title" style="background: url('/wp-content/uploads/2022/10/image-33-3.jpg')!important;background-size:cover!important;">
        <div class="container-fluid">
                                        <h2>
                    Top Hundeschulen 2022                </h2>
                <div class="home-slider  schools-slider">
                                            <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/the-dogworker-christian-schindler/">
                        The Dogworker Christian Schindler                    </a>
                </p>
                <p class="os-address">
                    Hebelstraße 5                    <br />77656 Offenburg                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/the-dogworker-christian-schindler/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/verhaltenstraining-fuer-hunde-andrea-fromm/">
                        Verhaltenstraining für Hunde - Andrea Fromm                    </a>
                </p>
                <p class="os-address">
                    Bitscher Str. 8                    <br />66996 Fischbach bei Dahn                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/verhaltenstraining-fuer-hunde-andrea-fromm/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/omegas-sandra-muecke/">
                        OMEGAS® Sandra Beyer                    </a>
                </p>
                <p class="os-address">
                    Scharrler Straße 8                    <br />29640 Schneverdingen                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/omegas-sandra-muecke/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/kimba-therapeutisches-hundetraining/">
                        KIMBA - therapeutisches Hundetraining                    </a>
                </p>
                <p class="os-address">
                    Brunnenstraße 6A                    <br />63589 Linsengericht                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/kimba-therapeutisches-hundetraining/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/hundeschule-jacobs-teamtraining-hund-mensch/">
                        Hundeschule Jacobs -Teamtraining Hund & Mensch                    </a>
                </p>
                <p class="os-address">
                    Falkenweg 20                    <br />53757 Sankt Augustin                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/hundeschule-jacobs-teamtraining-hund-mensch/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/hundeschulungszentrum-sysdog/">
                        SYSDOG Hundeschule                    </a>
                </p>
                <p class="os-address">
                    Im Knöckel 22 (Büro)                    <br />96138 Burgebrach                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/hundeschulungszentrum-sysdog/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/hundeschule-gessner/">
                        Hundeschule Gessner                    </a>
                </p>
                <p class="os-address">
                    Prozessionsweg                    <br />45711 Datteln                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/hundeschule-gessner/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/hundeerziehung-training-ausbildung-dittmann/">
                        HETADittmann                    </a>
                </p>
                <p class="os-address">
                    Unter den Ulmen 26                    <br />15366 Neuenhagen bei Berlin                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/hundeerziehung-training-ausbildung-dittmann/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/sonja-bauer-hundetraining-und-beratung/">
                        Sonja Bauer Hundetraining und Beratung, Ausbildung Therapie- und Pädagogik Begleithundeteams &amp; tiergestütztes systemisches Coaching                    </a>
                </p>
                <p class="os-address">
                    Offenbacher Straße 143                    <br />63263 Neu-Isenburg                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/sonja-bauer-hundetraining-und-beratung/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/koeditz/">
                        Mobile Hundeschule Hinterland GbR                    </a>
                </p>
                <p class="os-address">
                    Hüttenstraße 4                    <br />35216 Biedenkopf-Ludwigshütte                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/koeditz/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/hundeservice-4-pfoten/">
                        HUNDESERVICE 4 Pfoten                    </a>
                </p>
                <p class="os-address">
                    Strümpfelbachweg 11                    <br />71566 Althütte                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/hundeservice-4-pfoten/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                                        <div class="badge-premium">
                        Premium
                    </div>
                
                <p class="one-school-name">
                    <a href="/hundeschule/pfotentreff-olfen/">
                        Pfotentreff Olfen                    </a>
                </p>
                <p class="os-address">
                    Recheder Mühlenweg 18                    <br />59399 Olfen                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/pfotentreff-olfen/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                    
                <p class="one-school-name">
                    <a href="/hundeschule/coachmydog-de/">
                        coachmydog.de                    </a>
                </p>
                <p class="os-address">
                    Ahornstr. 30b                    <br />15370 Fredersdorf-Vogelsdorf                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/coachmydog-de/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                    
                <p class="one-school-name">
                    <a href="/hundeschule/hundeschule-pfotenglueck-von-der-regentalaue/">
                        Hundeschule Pfotenglück von der Regentalaue                    </a>
                </p>
                <p class="os-address">
                    Richard-Wagner-Str. 2c                    <br />93413 Cham                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/hundeschule-pfotenglueck-von-der-regentalaue/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                    
                <p class="one-school-name">
                    <a href="/hundeschule/artgerecht-mobile-hundeausbildung/">
                        ArtGerecht mobile Hundeausbildung                    </a>
                </p>
                <p class="os-address">
                    Bürabergstrasse                    <br />34560 Fritzlar                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/artgerecht-mobile-hundeausbildung/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                                <div class="sort-it-now">
                                <div>
        <div class="one-school">
            <div>
                                    <div class="top10">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_2110_1110)">
<path d="M26.4346 0.298129C28.3529 -0.216156 30.4409 -0.0824422 32.354 0.791844C33.5112 1.32156 34.7558 1.58384 36.0003 1.58384C37.2449 1.58384 38.4895 1.32156 39.6466 0.791844C41.5598 -0.0824422 43.6529 -0.216156 45.566 0.298129C47.4843 0.812415 49.2278 1.96956 50.4466 3.68213C51.1872 4.71584 52.1283 5.56956 53.2083 6.19184C54.2832 6.81413 55.4969 7.20499 56.7621 7.32842C58.8552 7.52899 60.7323 8.45984 62.1363 9.86384C63.5403 11.2678 64.4712 13.145 64.6718 15.2381C64.7952 16.5033 65.1861 17.7118 65.8083 18.7918C66.4306 19.8667 67.2792 20.813 68.318 21.5536C70.0306 22.7776 71.1929 24.5158 71.702 26.4341C72.2163 28.3524 72.0826 30.4404 71.2083 32.3536C70.6786 33.5107 70.4163 34.7553 70.4163 35.9998C70.4163 37.2444 70.6786 38.489 71.2083 39.6461C72.0826 41.5593 72.2163 43.6524 71.702 45.5656C71.1878 47.4787 70.0306 49.2273 68.318 50.4461C67.2843 51.1867 66.4306 52.1278 65.8083 53.2078C65.1861 54.2827 64.7952 55.4964 64.6718 56.7616C64.4712 58.8547 63.5403 60.7318 62.1363 62.1358C60.7323 63.5398 58.8552 64.4707 56.7621 64.6713C55.4969 64.7947 54.2883 65.1856 53.2083 65.8078C52.1335 66.4301 51.1872 67.2787 50.4466 68.3176C49.2226 70.0301 47.4843 71.1924 45.566 71.7016C43.6478 72.2158 41.5598 72.0821 39.6466 71.2078C38.4895 70.6781 37.2449 70.4158 36.0003 70.4158C34.7558 70.4158 33.5112 70.6781 32.354 71.2078C30.4409 72.0821 28.3478 72.2158 26.4346 71.7016C24.5163 71.1873 22.7729 70.0301 21.554 68.3176C20.8135 67.2838 19.8723 66.4301 18.7923 65.8078C17.7175 65.1856 16.5038 64.7947 15.2386 64.6713C13.1455 64.4707 11.2683 63.5398 9.86433 62.1358C8.46033 60.7318 7.52948 58.8547 7.3289 56.7616C7.20548 55.4964 6.81462 54.2878 6.19233 53.2078C5.57005 52.133 4.72148 51.1867 3.68262 50.4461C1.97005 49.2221 0.80776 47.4838 0.298618 45.5656C-0.210525 43.6473 -0.0819539 41.5593 0.792332 39.6461C1.32205 38.489 1.58433 37.2444 1.58433 35.9998C1.58433 34.7553 1.32205 33.5107 0.792332 32.3536C-0.0819539 30.4404 -0.215668 28.3473 0.298618 26.4341C0.812903 24.5158 1.97005 22.7724 3.68262 21.5536C4.71633 20.813 5.57005 19.8718 6.19233 18.7918C6.81462 17.717 7.20548 16.5033 7.3289 15.2381C7.52948 13.145 8.46033 11.2678 9.86433 9.86384C11.2683 8.45984 13.1455 7.52899 15.2386 7.32842C16.5038 7.20499 17.7123 6.81413 18.7923 6.19184C19.8672 5.56956 20.8135 4.72099 21.554 3.68213C22.7729 1.9747 24.5163 0.812415 26.4346 0.298129Z" fill="#E3000B"/>
<path d="M44.4063 4.62883L44.4062 4.62879C42.7679 4.18839 40.9756 4.30289 39.3373 5.05157L44.4063 4.62883ZM44.4063 4.62883C46.0497 5.06942 47.5424 6.06038 48.5859 7.52663L48.5864 7.52729M44.4063 4.62883L48.5864 7.52729M48.5864 7.52729C49.2634 8.47221 50.1243 9.25338 51.113 9.82308C52.097 10.3927 53.2072 10.75 54.3638 10.8628L54.3642 10.8629M48.5864 7.52729L54.3642 10.8629M54.3642 10.8629C56.1566 11.0346 57.7641 11.8316 58.9667 13.0342C60.1694 14.2369 60.9664 15.8443 61.1381 17.6367L61.1381 17.6372M54.3642 10.8629L61.1381 17.6372M61.1381 17.6372C61.251 18.7942 61.6085 19.8998 62.1779 20.888L62.1782 20.8884M61.1381 17.6372L62.1782 20.8884M62.1782 20.8884C62.7472 21.8714 63.5234 22.7371 64.4739 23.4147L62.1782 20.8884ZM62.4007 51.2404C61.8496 52.1924 61.5034 53.2673 61.3941 54.3878M62.4007 51.2404C62.9518 50.2839 63.7079 49.4504 64.6234 48.7945C66.1402 47.715 67.165 46.1663 67.6205 44.472C68.076 42.7776 67.9576 40.9238 67.1833 39.2294M62.4007 51.2404L62.1782 51.1116C62.1781 51.1116 62.1781 51.1117 62.178 51.1118C62.178 51.1119 62.1779 51.112 62.1779 51.112L62.4007 51.2404ZM61.3941 54.3878L67.1833 39.2294M61.3941 54.3878C61.2164 56.2416 60.392 57.9041 59.1485 59.1476C57.9051 60.391 56.2426 61.2155 54.3888 61.3931L61.3941 54.3878ZM67.1833 39.2294L66.9494 39.3362C66.9494 39.3363 66.9494 39.3363 66.9494 39.3364L67.1833 39.2294ZM9.82393 20.8882C9.25423 21.8768 8.47311 22.7376 7.52826 23.4146L7.52761 23.415C6.06135 24.4586 5.0704 25.9512 4.62981 27.5946L4.62976 27.5948C4.18937 29.2331 4.30386 31.0253 5.05251 32.6636L9.82393 20.8882ZM9.82393 20.8882C10.3936 19.9042 10.751 18.7938 10.8638 17.6372L10.8638 17.6367C11.0356 15.8443 11.8326 14.2369 13.0352 13.0342C14.2379 11.8316 15.8453 11.0346 17.6377 10.8629L17.6381 10.8628C18.7952 10.7499 19.9008 10.3924 20.8889 9.82309L20.8894 9.82282C21.8725 9.25368 22.7382 8.47739 23.4159 7.5268C24.4597 6.06465 25.9526 5.06932 27.5956 4.62883C29.2386 4.18836 31.0263 4.3029 32.6646 5.05153C33.7237 5.53639 34.8626 5.77631 36.001 5.77631C37.1393 5.77631 38.2781 5.53642 39.3372 5.0516L9.82393 20.8882ZM66.9494 32.6636C66.9494 32.6637 66.9494 32.6637 66.9494 32.6638L67.1833 32.7706L66.9494 32.6636ZM5.05258 39.3362C5.53739 38.2771 5.77728 37.1383 5.77728 36C5.77728 34.8616 5.53738 33.7228 5.05254 32.6637L5.05258 39.3362ZM4.8187 39.2294L5.05251 39.3364L4.8187 39.2294ZM7.52803 48.5853C7.52794 48.5852 7.52786 48.5851 7.52777 48.5851L7.37851 48.7945L7.52803 48.5853ZM20.8894 62.1772C20.8892 62.1771 20.8891 62.177 20.8889 62.1769L20.7606 62.3997L20.8894 62.1772ZM32.6647 66.9484C32.6647 66.9484 32.6646 66.9484 32.6646 66.9485L32.7716 67.1823L32.6647 66.9484ZM39.2303 67.1823L39.3374 66.9485C39.3373 66.9484 39.3373 66.9484 39.3372 66.9484L39.2303 67.1823ZM48.5862 64.4729C48.5862 64.473 48.5861 64.4731 48.5861 64.4732L48.7954 64.6225L48.5862 64.4729Z" stroke="white" stroke-width="0.514286"/>
<path d="M15.2445 42.2285H12.7517V32.5465H9.55917V30.4718H18.437V32.5465H15.2445V42.2285ZM28.2236 37.7172C28.2236 38.4678 28.1217 39.1325 27.918 39.7115C27.7197 40.2905 27.4275 40.781 27.0415 41.1831C26.6608 41.5798 26.1998 41.88 25.6583 42.0838C25.1222 42.2875 24.5164 42.3893 23.8409 42.3893C23.2083 42.3893 22.6267 42.2875 22.0959 42.0838C21.5706 41.88 21.1122 41.5798 20.7208 41.1831C20.3348 40.781 20.0346 40.2905 19.8202 39.7115C19.6111 39.1325 19.5066 38.4678 19.5066 37.7172C19.5066 36.7201 19.6835 35.8757 20.0373 35.1841C20.3911 34.4926 20.8951 33.9672 21.5491 33.608C22.2032 33.2488 22.9832 33.0692 23.8892 33.0692C24.7309 33.0692 25.4761 33.2488 26.1247 33.608C26.7788 33.9672 27.2908 34.4926 27.6607 35.1841C28.036 35.8757 28.2236 36.7201 28.2236 37.7172ZM22.0075 37.7172C22.0075 38.3069 22.0718 38.8028 22.2005 39.2049C22.3291 39.607 22.5302 39.9099 22.8036 40.1136C23.077 40.3173 23.4335 40.4192 23.8731 40.4192C24.3074 40.4192 24.6585 40.3173 24.9266 40.1136C25.2 39.9099 25.3983 39.607 25.5216 39.2049C25.6503 38.8028 25.7146 38.3069 25.7146 37.7172C25.7146 37.1221 25.6503 36.6289 25.5216 36.2376C25.3983 35.8409 25.2 35.5433 24.9266 35.345C24.6531 35.1466 24.2966 35.0474 23.857 35.0474C23.2083 35.0474 22.7366 35.2699 22.4417 35.7149C22.1522 36.1598 22.0075 36.8273 22.0075 37.7172ZM35.2519 33.0692C36.2651 33.0692 37.0827 33.4632 37.7046 34.2513C38.3318 35.0394 38.6454 36.1947 38.6454 37.7172C38.6454 38.7358 38.498 39.5936 38.2031 40.2905C37.9083 40.9821 37.5008 41.5048 36.9808 41.8586C36.4608 42.2124 35.8631 42.3893 35.1876 42.3893C34.7533 42.3893 34.3807 42.3357 34.0698 42.2285C33.7588 42.1159 33.4935 41.9739 33.2737 41.8023C33.0539 41.6254 32.8636 41.4378 32.7027 41.2394H32.5741C32.617 41.4538 32.6491 41.6736 32.6706 41.8988C32.692 42.124 32.7027 42.3438 32.7027 42.5582V46.185H30.2501V33.2381H32.2444L32.5901 34.4041H32.7027C32.8636 34.1629 33.0592 33.9404 33.2898 33.7366C33.5203 33.5329 33.7964 33.3721 34.118 33.2542C34.4451 33.1309 34.823 33.0692 35.2519 33.0692ZM34.4638 35.0313C34.0349 35.0313 33.6945 35.1198 33.4425 35.2967C33.1906 35.4736 33.0056 35.739 32.8877 36.0928C32.7751 36.4466 32.7134 36.8943 32.7027 37.4358V37.7011C32.7027 38.2801 32.7563 38.7707 32.8636 39.1727C32.9761 39.5748 33.1611 39.8804 33.4184 40.0895C33.6811 40.2985 34.0403 40.4031 34.496 40.4031C34.8713 40.4031 35.1795 40.2985 35.4208 40.0895C35.662 39.8804 35.8416 39.5748 35.9596 39.1727C36.0829 38.7653 36.1445 38.2694 36.1445 37.685C36.1445 36.8058 36.0078 36.1438 35.7344 35.6988C35.461 35.2538 35.0375 35.0313 34.4638 35.0313ZM50.4665 42.2285H47.9817V35.4254C47.9817 35.2377 47.9843 35.0072 47.9897 34.7338C47.9951 34.455 48.0031 34.1709 48.0138 33.8814C48.0245 33.5865 48.0353 33.3212 48.046 33.0853C47.987 33.155 47.8664 33.2756 47.6841 33.4472C47.5072 33.6133 47.341 33.7635 47.1855 33.8975L45.8346 34.9831L44.6364 33.4874L48.4239 30.4718H50.4665V42.2285ZM61.9016 36.3501C61.9016 37.2991 61.8265 38.1461 61.6764 38.8913C61.5317 39.6365 61.2958 40.2691 60.9687 40.7891C60.6471 41.3091 60.2236 41.7058 59.6982 41.9792C59.1728 42.2526 58.5348 42.3893 57.7843 42.3893C56.8408 42.3893 56.0661 42.1508 55.4603 41.6736C54.8545 41.1912 54.4068 40.4996 54.1174 39.5989C53.8279 38.6929 53.6831 37.61 53.6831 36.3501C53.6831 35.0796 53.8145 33.994 54.0771 33.0933C54.3452 32.1873 54.7794 31.4931 55.3799 31.0106C55.9803 30.5281 56.7818 30.2868 57.7843 30.2868C58.7225 30.2868 59.4945 30.5281 60.1003 31.0106C60.7114 31.4877 61.1644 32.1793 61.4593 33.0853C61.7541 33.9859 61.9016 35.0742 61.9016 36.3501ZM56.1519 36.3501C56.1519 37.2454 56.2001 37.9933 56.2966 38.5937C56.3985 39.1888 56.5673 39.6365 56.8032 39.9367C57.0391 40.2369 57.3661 40.387 57.7843 40.387C58.1971 40.387 58.5214 40.2396 58.7573 39.9447C58.9986 39.6445 59.1701 39.1969 59.272 38.6018C59.3738 38.0013 59.4248 37.2508 59.4248 36.3501C59.4248 35.4549 59.3738 34.707 59.272 34.1066C59.1701 33.5061 58.9986 33.0558 58.7573 32.7556C58.5214 32.45 58.1971 32.2972 57.7843 32.2972C57.3661 32.2972 57.0391 32.45 56.8032 32.7556C56.5673 33.0558 56.3985 33.5061 56.2966 34.1066C56.2001 34.707 56.1519 35.4549 56.1519 36.3501Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_2110_1110">
<rect width="72" height="72" fill="white"/>
</clipPath>
</defs>
</svg>
                    </div>
                                    
                <p class="one-school-name">
                    <a href="/hundeschule/dogs-gate-2/">
                        dogs-gate                    </a>
                </p>
                <p class="os-address">
                    Guhlsdorf 16                    <br />16928 Groß Pankow                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="/hundeschule/dogs-gate-2/">
                        Zur Hundeschule
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/>
</svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

                            </div>
                                        </div>
                    </div>
    </div>
    <div id="der-hund-club">
    <div class="container-fluid">
                    <p class="der-hund-club-logo">
                        <picture><source data-lazy-srcset="/wp-content/webp-express/webp-images/uploads/2022/10/der-hund-club.png.webp" type="image/webp"><img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="" class="img-fluid webpexpress-processed" data-lazy-src="/wp-content/uploads/2022/10/der-hund-club.png"><noscript><img loading="lazy" src="/wp-content/uploads/2022/10/der-hund-club.png" alt="" class="img-fluid webpexpress-processed"></noscript></picture>
                    </p>
                            <p class="der-hund-title">
                Werde jetzt Mitglied im DER HUND Club  und profitiere u. a. von:            </p>
                            <p class="der-hund-features">
                                    <span>
                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.75 0.465698C15.0625 0.819865 15.0625 1.16361 14.75 1.49695L6.5 9.74695C6.16667 10.0594 5.82292 10.0594 5.46875 9.74695L1.21875 5.49695C0.927083 5.16361 0.927083 4.81986 1.21875 4.4657C1.57292 4.17403 1.92708 4.17403 2.28125 4.4657L6 8.18445L13.7188 0.465698C14.0729 0.174032 14.4167 0.174032 14.75 0.465698Z" fill="#E3000B"/>
</svg>
                        Regelmäßige Webtalks                    </span>
                                        <span>
                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.75 0.465698C15.0625 0.819865 15.0625 1.16361 14.75 1.49695L6.5 9.74695C6.16667 10.0594 5.82292 10.0594 5.46875 9.74695L1.21875 5.49695C0.927083 5.16361 0.927083 4.81986 1.21875 4.4657C1.57292 4.17403 1.92708 4.17403 2.28125 4.4657L6 8.18445L13.7188 0.465698C14.0729 0.174032 14.4167 0.174032 14.75 0.465698Z" fill="#E3000B"/>
</svg>
                        Tolle Angebote und Rabatte                    </span>
                                        <span>
                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.75 0.465698C15.0625 0.819865 15.0625 1.16361 14.75 1.49695L6.5 9.74695C6.16667 10.0594 5.82292 10.0594 5.46875 9.74695L1.21875 5.49695C0.927083 5.16361 0.927083 4.81986 1.21875 4.4657C1.57292 4.17403 1.92708 4.17403 2.28125 4.4657L6 8.18445L13.7188 0.465698C14.0729 0.174032 14.4167 0.174032 14.75 0.465698Z" fill="#E3000B"/>
</svg>
                        Videos und Tutorials                    </span>
                                </p>
                            <p>
                <a href="/jetzt-anmelden" class="the-button">
                    Jetzt DER HUND Club Mitglied werden                </a>
            </p>
         

                    <div id="home-blog">
                <div class="row">
                                            <div class="col-sm-6 col-md-4">
                                <div class="single-blog-post">

                    <div class="sb-picture">
                <a href="/hundeschulen-blog/auswahl-richtigen-hundeschule-und-ausstattung/">
                    <picture><source data-lazy-srcset="/wp-content/webp-express/webp-images/uploads/2022/08/hundeschule-hundeerziehung-Kopie.jpg.webp 1440w, /wp-content/webp-express/webp-images/uploads/2022/08/hundeschule-hundeerziehung-Kopie-600x400.jpg.webp 600w, /wp-content/webp-express/webp-images/uploads/2022/08/hundeschule-hundeerziehung-Kopie-300x200.jpg.webp 300w, /wp-content/webp-express/webp-images/uploads/2022/08/hundeschule-hundeerziehung-Kopie-1024x683.jpg.webp 1024w, /wp-content/webp-express/webp-images/uploads/2022/08/hundeschule-hundeerziehung-Kopie-768x512.jpg.webp 768w, /wp-content/webp-express/webp-images/uploads/2022/08/hundeschule-hundeerziehung-Kopie-120x80.jpg.webp 120w, /wp-content/webp-express/webp-images/uploads/2022/08/hundeschule-hundeerziehung-Kopie-150x100.jpg.webp 150w, /wp-content/webp-express/webp-images/uploads/2022/08/hundeschule-hundeerziehung-Kopie-500x333.jpg.webp 500w, /wp-content/webp-express/webp-images/uploads/2022/08/hundeschule-hundeerziehung-Kopie-225x150.jpg.webp 225w, /wp-content/webp-express/webp-images/uploads/2022/08/hundeschule-hundeerziehung-Kopie-180x120.jpg.webp 180w" sizes="(max-width: 558px) 100vw, 558px" type="image/webp"><img width="558" height="372" src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20558%20372'%3E%3C/svg%3E" class="attachment-post-thumbnail size-post-thumbnail wp-post-image webpexpress-processed" alt="" decoding="async" data-lazy-srcset="/wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie.jpg 1440w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-600x400.jpg 600w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-300x200.jpg 300w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-1024x683.jpg 1024w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-768x512.jpg 768w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-120x80.jpg 120w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-150x100.jpg 150w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-500x333.jpg 500w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-225x150.jpg 225w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-180x120.jpg 180w" data-lazy-sizes="(max-width: 558px) 100vw, 558px" data-lazy-src="/wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie.jpg"><noscript><img width="558" height="372" src="/wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image webpexpress-processed" alt="" decoding="async" loading="lazy" srcset="/wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie.jpg 1440w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-600x400.jpg 600w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-300x200.jpg 300w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-1024x683.jpg 1024w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-768x512.jpg 768w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-120x80.jpg 120w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-150x100.jpg 150w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-500x333.jpg 500w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-225x150.jpg 225w, /wp-content/uploads/2022/08/hundeschule-hundeerziehung-Kopie-180x120.jpg 180w" sizes="(max-width: 558px) 100vw, 558px"></noscript></picture>                </a>
            </div>
                <div class="sb-content">
            <p class="sb-title">
                <a href="/hundeschulen-blog/auswahl-richtigen-hundeschule-und-ausstattung/">
                    Auswahl der richtigen Hundeschule und Ausstattung                </a>
            </p>
            <p class="sb-excerpt">
                Wenn es um das Thema Hundeerziehung, Futter und Zubehör geht sind damit oft starke Emotionen verbunden. Warum du deinen eigenen Weg finden musst, es jedoch wichtige und objektiv richtige Grundpfeiler gibt, wollen wir dir mit diesem Beitrag zeigen.            </p>
            <p class="sb-more">
                <a href="/hundeschulen-blog/auswahl-richtigen-hundeschule-und-ausstattung/">
                    Weiterlesen
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.21484 1.03516L7.21875 6.28516C7.34635 6.41276 7.41016 6.55859 7.41016 6.72266C7.41016 6.88672 7.34635 7.04167 7.21875 7.1875L2.21484 12.4102C1.92318 12.6654 1.61328 12.6745 1.28516 12.4375C1.02995 12.1276 1.02995 11.8177 1.28516 11.5078L5.87891 6.69531L1.28516 1.96484C1.02995 1.63672 1.02995 1.32682 1.28516 1.03516C1.61328 0.779948 1.92318 0.779948 2.21484 1.03516Z" fill="#E3000B"/>
</svg>
                </a>
            </p>
        </div>
        <div class="sb-meta">
            Susanne Steiger            <span>&bull;</span>
            30 Aug, 2022        </div>
    </div>
                          
                        </div>
                                            <div class="col-sm-6 col-md-4">
                                <div class="single-blog-post">

                    <div class="sb-picture">
                <a href="/hundeschulen-blog/online-trainingstage-2022/">
                    <picture><source data-lazy-srcset="/wp-content/webp-express/webp-images/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen.jpg.webp 750w, /wp-content/webp-express/webp-images/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-600x400.jpg.webp 600w, /wp-content/webp-express/webp-images/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-300x200.jpg.webp 300w, /wp-content/webp-express/webp-images/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-120x80.jpg.webp 120w, /wp-content/webp-express/webp-images/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-150x100.jpg.webp 150w, /wp-content/webp-express/webp-images/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-500x333.jpg.webp 500w, /wp-content/webp-express/webp-images/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-225x150.jpg.webp 225w, /wp-content/webp-express/webp-images/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-180x120.jpg.webp 180w" sizes="(max-width: 558px) 100vw, 558px" type="image/webp"><img width="558" height="372" src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20558%20372'%3E%3C/svg%3E" class="attachment-post-thumbnail size-post-thumbnail wp-post-image webpexpress-processed" alt="" decoding="async" data-lazy-srcset="/wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen.jpg 750w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-600x400.jpg 600w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-300x200.jpg 300w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-120x80.jpg 120w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-150x100.jpg 150w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-500x333.jpg 500w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-225x150.jpg 225w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-180x120.jpg 180w" data-lazy-sizes="(max-width: 558px) 100vw, 558px" data-lazy-src="/wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen.jpg"><noscript><img width="558" height="372" src="/wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image webpexpress-processed" alt="" decoding="async" loading="lazy" srcset="/wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen.jpg 750w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-600x400.jpg 600w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-300x200.jpg 300w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-120x80.jpg 120w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-150x100.jpg 150w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-500x333.jpg 500w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-225x150.jpg 225w, /wp-content/uploads/2022/03/Online-Trainingstage-Die-Hundeschulen-180x120.jpg 180w" sizes="(max-width: 558px) 100vw, 558px"></noscript></picture>                </a>
            </div>
                <div class="sb-content">
            <p class="sb-title">
                <a href="/hundeschulen-blog/online-trainingstage-2022/">
                    22 Webinare bei der HUND                </a>
            </p>
            <p class="sb-excerpt">
                22 Webinare an einem Wochenende - und alles rund um deinen Hund! Training und Wissen, Tipps von experten und ein Livetalk waren bei den DERHUND Online-Trainingstagen geboten. schau alles nach in deiner Online Hundeschule beim DER HUND Club!            </p>
            <p class="sb-more">
                <a href="/hundeschulen-blog/online-trainingstage-2022/">
                    Weiterlesen
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.21484 1.03516L7.21875 6.28516C7.34635 6.41276 7.41016 6.55859 7.41016 6.72266C7.41016 6.88672 7.34635 7.04167 7.21875 7.1875L2.21484 12.4102C1.92318 12.6654 1.61328 12.6745 1.28516 12.4375C1.02995 12.1276 1.02995 11.8177 1.28516 11.5078L5.87891 6.69531L1.28516 1.96484C1.02995 1.63672 1.02995 1.32682 1.28516 1.03516C1.61328 0.779948 1.92318 0.779948 2.21484 1.03516Z" fill="#E3000B"/>
</svg>
                </a>
            </p>
        </div>
        <div class="sb-meta">
            Lena Schwarz            <span>&bull;</span>
            28 Jun, 2022        </div>
    </div>
                          
                        </div>
                                            <div class="col-sm-6 col-md-4">
                                <div class="single-blog-post">

                    <div class="sb-picture">
                <a href="/hundeschulen-blog/folgen-von-stress/">
                    <picture><source data-lazy-srcset="/wp-content/webp-express/webp-images/uploads/2022/05/Hund-alleine.jpg.webp 300w, /wp-content/webp-express/webp-images/uploads/2022/05/Hund-alleine-120x80.jpg.webp 120w, /wp-content/webp-express/webp-images/uploads/2022/05/Hund-alleine-150x100.jpg.webp 150w, /wp-content/webp-express/webp-images/uploads/2022/05/Hund-alleine-225x150.jpg.webp 225w, /wp-content/webp-express/webp-images/uploads/2022/05/Hund-alleine-180x120.jpg.webp 180w" sizes="(max-width: 300px) 100vw, 300px" type="image/webp"><img width="300" height="200" src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20200'%3E%3C/svg%3E" class="attachment-post-thumbnail size-post-thumbnail wp-post-image webpexpress-processed" alt="" decoding="async" data-lazy-srcset="/wp-content/uploads/2022/05/Hund-alleine.jpg 300w, /wp-content/uploads/2022/05/Hund-alleine-120x80.jpg 120w, /wp-content/uploads/2022/05/Hund-alleine-150x100.jpg 150w, /wp-content/uploads/2022/05/Hund-alleine-225x150.jpg 225w, /wp-content/uploads/2022/05/Hund-alleine-180x120.jpg 180w" data-lazy-sizes="(max-width: 300px) 100vw, 300px" data-lazy-src="/wp-content/uploads/2022/05/Hund-alleine.jpg"><noscript><img width="300" height="200" src="/wp-content/uploads/2022/05/Hund-alleine.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image webpexpress-processed" alt="" decoding="async" loading="lazy" srcset="/wp-content/uploads/2022/05/Hund-alleine.jpg 300w, /wp-content/uploads/2022/05/Hund-alleine-120x80.jpg 120w, /wp-content/uploads/2022/05/Hund-alleine-150x100.jpg 150w, /wp-content/uploads/2022/05/Hund-alleine-225x150.jpg 225w, /wp-content/uploads/2022/05/Hund-alleine-180x120.jpg 180w" sizes="(max-width: 300px) 100vw, 300px"></noscript></picture>                </a>
            </div>
                <div class="sb-content">
            <p class="sb-title">
                <a href="/hundeschulen-blog/folgen-von-stress/">
                    Die Folgen von zu viel Stress                </a>
            </p>
            <p class="sb-excerpt">
                Zu viel Stress kann bei Hunden eine (Mit-)Ursache von körperlichen sowie psychischen Probleme sein und zu Verhaltensauffälligkeiten führen.            </p>
            <p class="sb-more">
                <a href="/hundeschulen-blog/folgen-von-stress/">
                    Weiterlesen
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.21484 1.03516L7.21875 6.28516C7.34635 6.41276 7.41016 6.55859 7.41016 6.72266C7.41016 6.88672 7.34635 7.04167 7.21875 7.1875L2.21484 12.4102C1.92318 12.6654 1.61328 12.6745 1.28516 12.4375C1.02995 12.1276 1.02995 11.8177 1.28516 11.5078L5.87891 6.69531L1.28516 1.96484C1.02995 1.63672 1.02995 1.32682 1.28516 1.03516C1.61328 0.779948 1.92318 0.779948 2.21484 1.03516Z" fill="#E3000B"/>
</svg>
                </a>
            </p>
        </div>
        <div class="sb-meta">
            Lena Schwarz            <span>&bull;</span>
            31 May, 2022        </div>
    </div>
                          
                        </div>
                                    </div>
            </div>
        
    </div>
</div>
		</div><!-- #main -->
		<div id="lazy-loading-point"></div>

<?php
get_footer();