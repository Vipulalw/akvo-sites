<?php

/* Template Name: Project update Page */

?>

<?php get_header(); ?>

<?php get_template_part('template-part', 'head'); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<?php
$iPage = (get_query_var('paged')) ? get_query_var('paged') : 1;

$aProjectArgs = array(
	'post_type' => 'project_update',
	'post_status' => 'publish',
	'posts_per_page' => '12',	
	'paged' => $iPage	
);

$oProject = new WP_Query( $aProjectArgs );
if ( $oProject->have_posts() ) :
?>


<div class="row cDivProjectUpdatePage">
	<?php
	
	$iPostCount = 0;
	while ( $oProject->have_posts() ) : $oProject->the_post(); //echo fmod($iPostCount, 3); ?>
	<div class="col-md-4 <?php if( fmod($iPostCount, 3) < 2) : echo 'cMarginRight30'; endif; ?>">		
		<div class="cDivProject">
			<div class="cDivLatestProjectImg">
<!--				<div class="cDivLatestProjectRibbon"></div>								-->
				<?php 
				$sAttachmentLink = get_post_meta($post->ID, 'enclosure', true);
				if($sAttachmentLink!='') {
//					$sImgSrc = get_template_directory_uri().'/lib/thumb.php?src='.$sAttachmentLink.'&w=288&h=191&zc=1&q=100';
					$sImgSrc = get_template_directory_uri().'/lib/thumb.php?src='.$sAttachmentLink.'&w=748&zc=1&q=100';
				}
				//get the project Id to read more link (link to akvo.org site)
				$sReadMoreLink = "http://washmali.akvoapp.org/en/project/";
				$oProjectId = $wpdb->get_results("SELECT project_id,update_id FROM " . $wpdb->prefix . "project_update_log WHERE post_id = ".$post->ID);
				foreach ($oProjectId as $iId){
					$iProjectId = $iId->project_id;
					$iUpdateId = $iId->update_id;
				}
				$sReadMoreLink = $sReadMoreLink.$iProjectId.'/update/'.$iUpdateId;
				if(!@getimagesize($sImgSrc))$sImgSrc='';
				if($sImgSrc==''){
					$sImgSrc = get_stylesheet_directory_uri().'/images/placeholder.jpg';
				} ?>
				<img class="img-responsive" src="<?php echo $sImgSrc; ?>" />				
			</div>
			<div class="cDivLatestProjectTextContainer">
				<div class="cDivLatestProjectTitle">
					 <?php the_title(); ?>
				</div>
				<div class="cDivLatestProjectLaunchDate">
					<?php echo get_the_date(); ?>
				</div>
				<div class="cDivSeparator"></div>
				<div class="cDivLatestProjectText">
					<?php $sLatestProjectText = get_the_content(); 
					echo mb_strimwidth($sLatestProjectText, 0, 100, '...');  ?>
				</div>
				<div class="cDivSliderReadMoreBtn"><a href="<?php echo $sReadMoreLink; ?>" class="btn btn-default cAReadMoreBtn">Savoir plus</a></div>
			</div>
		</div>
	</div>
	<?php 	
	$iPostCount++;	
	endwhile; 
	?>
	<br style="clear:both;" />
	<div class="pagination">
		<?php 
		previous_posts_link( '<< Newer Entries&nbsp;&nbsp;&nbsp;' ); 
		next_posts_link( 'Older Entries >>', $oProject->max_num_pages );
		?>
    </div>
</div>
<?php endif; ?>
<?php get_footer(); ?>        

