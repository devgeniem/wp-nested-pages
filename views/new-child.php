<?php 
	$post_type_object = get_post_type_object( 'page' );
	$can_publish = current_user_can( $post_type_object->cap->publish_posts );
?>
<form method="get" action="">
	<div class="form-interior">
	<h3><strong><?php _e('Add Child Page'); ?></strong><span class="parent_name"></span></h3>

	<div class="np-quickedit-error" style="clear:both;display:none;"></div>
	
	<div class="fields">
	
	<div class="left">

		<div class="new-page-titles">
			<div class="form-control">
				<label><?php _e( 'Title' ); ?></label>
				<input type="text" name="post_title[]" class="np_title" placeholder="<?php _e('Page Title', 'nestedpages'); ?>" value="" />
			</div>
		</div>

		<a href="#" class="add-new-child-row button-primary" style="clear:both;"><?php _e('+', 'nestedpages'); ?></a>
	</div><!-- .left -->


	<div class="right">
		
		<div class="form-control">
			<label><?php _e( 'Status' ); ?></label>
			<select name="_status" class="np_status">
			<?php if ( $can_publish ) : ?>
				<option value="publish"><?php _e( 'Published' ); ?></option>
			<?php endif; ?>
				<option value="draft"><?php _e( 'Draft' ); ?></option>
			</select>
		</div>

		<?php 
		/*
		* Authors Dropdown
		*/
		$authors_dropdown = '';
		if ( is_super_admin() || current_user_can( $post_type_object->cap->edit_others_posts ) ) :
			$users_opt = array(
				'hide_if_only_one_author' => false,
				'who' => 'authors',
				'name' => 'post_author',
				'id' => 'post_author',
				'class'=> 'authors',
				'multi' => 1,
				'echo' => 0
			);

			if ( $authors = wp_dropdown_users( $users_opt ) ) :
				$authors_dropdown  = '<div class="form-control np_author"><label>' . __( 'Author' ) . '</label>';
				$authors_dropdown .= $authors;
				$authors_dropdown .= '</div>';
			endif;
			echo $authors_dropdown;
		endif;
		?>

	</div><!-- .right -->

	</div><!-- .fields -->

	</div><!-- .form-interior -->


	<div class="buttons">
		<input type="hidden" name="parent_id" class="page_parent_id" />
		<a accesskey="c" href="#inline-edit" class="button-secondary alignleft np-cancel-newchild">
			<?php _e( 'Cancel' ); ?>
		</a>
		<a accesskey="s" href="#inline-edit" class="button-primary np-save-newchild alignright">
			<?php _e( 'Add Page' ); ?>
		</a>
		<span class="np-qe-loading"></span>
	</div>
</form>
