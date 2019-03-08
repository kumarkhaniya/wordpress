<?php
function ml_comment_content_to_html( $content ) {
	return str_replace( "n", "<br>", $content );
}

function ml_get_avatar_url( $uid_or_email, $size ) {
	preg_match( "/src='(.*?)'/i", get_avatar( $uid_or_email, $size ), $matches );

	return $matches[1];
}

/**
* Render comments tree
*
* @param WP_Comment $comment
*/
function ml_render_iphone_comment( $comment ) {
	// Do not show anonymous and very short comments
	if (empty($comment->comment_author) && empty($comment->comment_author_email) && (3 >= strlen($comment->comment_content))) {
		return;
	}
	?>
	<article class="comment ml_comment">
		<?php
		$uid_or_email = $comment->user_id != 0 ? $comment->user_id : $comment->comment_author_email;
		$link         = ml_get_avatar_url( $uid_or_email, 50 );

		echo '<img src="' . $link . '" class="avatar avatar-50 photo">';
		?>
		<div class="comment_body">
			<?php echo '<strong>' . $comment->comment_author . '</strong>: ' . nl2br( $comment->comment_content ); ?>
			<div
				class="comment_meta"><?php echo human_time_diff( strtotime( $comment->comment_date_gmt ), time() ); ?></div>
		</div>
		<?php
		$children = $comment->get_children(array(
			'status'  => "approve",
			'order'   => 'ASC',
			'hierarchical' => 'threaded'
		));
		if ($children) {
			foreach($children as $child) {
				ml_render_iphone_comment($child);
			}
		}
		?>
	</article>
	<?php
}

?>