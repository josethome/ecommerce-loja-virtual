<?php
// http://codex.wordpress.org/Function_Reference/wp_editor
// https://codex.wordpress.org/Plugin_API/Filter_Reference/the_content
// http://codex.wordpress.org/Validating_Sanitizing_and_Escaping_User_Data
if ( isset($_POST['footerize']) && check_admin_referer('update-footerize-plugin-options') ) {

	if ( current_user_can('administrator') ) {

	    if ( !empty($_POST['footerize']) ) {
	
			// Pre content text
			$pre_content = wp_kses_post( $_POST['footerize_pre_content'] );
	
			// Where to display pre content
			( isset($_POST['footerize_pre_content_pages']) && $_POST['footerize_pre_content_pages'] == 'show' ) ?
				$pre_content_pages = true :
				$pre_content_pages = false;
	
			( isset($_POST['footerize_pre_content_posts']) && $_POST['footerize_pre_content_posts'] == 'show' ) ?
				$pre_content_posts = true :
				$pre_content_posts = false;
	
			$pre_content_posts_exclude = sanitize_text_field( $_POST['footerize_exclude_from_pre'] );
			$pre_content_posts_exclude = preg_replace('/[;\ ]/i',',',$pre_content_posts_exclude);
			$pre_content_posts_exclude = explode(',', $pre_content_posts_exclude);
			$save_pre_content_posts_exclude = '';
			for ( $i=0;$i<count($pre_content_posts_exclude);++$i ) :
				$the_val = $pre_content_posts_exclude[$i];
				if ( !empty($the_val) && intval($the_val) )
					$save_pre_content_posts_exclude .= $pre_content_posts_exclude[$i].',';
			endfor;
			$save_pre_content_posts_exclude = rtrim($save_pre_content_posts_exclude,',');
	
			update_option('footerize_pre_content', $pre_content);
			update_option('footerize_pre_content_pages', $pre_content_pages);
			update_option('footerize_pre_content_posts', $pre_content_posts);
			update_option('footerize_exclude_from_pre', $save_pre_content_posts_exclude);
	
			// Pos content text
			$pos_content = wp_kses_post( $_POST['footerize_pos_content'] );
	
			// Where to display pos content
			( isset($_POST['footerize_pos_content_pages']) && $_POST['footerize_pos_content_pages'] == 'show' ) ?
				$pos_content_pages = true :
				$pos_content_pages = false;
	
			( isset($_POST['footerize_pos_content_posts']) && $_POST['footerize_pos_content_posts'] == 'show' ) ?
				$pos_content_posts = true :
				$pos_content_posts = false;
	
			$pos_content_posts_exclude = sanitize_text_field( $_POST['footerize_exclude_from_pos'] );
			$pos_content_posts_exclude = preg_replace('/[;\ ]/i',',',$pos_content_posts_exclude);
			$pos_content_posts_exclude = explode(',', $pos_content_posts_exclude);
			$save_pos_content_posts_exclude = '';
			for ( $i=0;$i<count($pos_content_posts_exclude);++$i ) :
				$the_val = $pos_content_posts_exclude[$i];
				if ( !empty($the_val) && intval($the_val) )
					$save_pos_content_posts_exclude .= $pos_content_posts_exclude[$i].',';
			endfor;
			$save_pos_content_posts_exclude = rtrim($save_pos_content_posts_exclude,',');
	
			update_option('footerize_pos_content', $pos_content);
			update_option('footerize_pos_content_pages', $pos_content_pages);
			update_option('footerize_pos_content_posts', $pos_content_posts);
			update_option('footerize_exclude_from_pos', $save_pos_content_posts_exclude);

			// Shortcode content
			$shortcode_content = wp_kses_post( $_POST['footerize_shortcode_content'] );
			update_option('footerize_shortcode_content', $shortcode_content);

	        ?>
	        <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
	            <p>
	                <strong>Configurações salvas.</strong>
	            </p>
	            <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dispensar este aviso.</span></button>
	        </div>
	        <?php
	
	    }

	} else {

		?>
		<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
            <p>
                <strong>Você não tem permissão para editar estas informações.</strong>
            </p>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dispensar este aviso.</span></button>
        </div>
        <?php

	}

}

$editor_height = 200;
?>

<div class="wrap">

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<div id="post-body-content" style="position: relative;">

				<form method="post" action="<?php $PHP_SELF; ?>">
					<input type="hidden" name="footerize" value="1">
					<?php wp_nonce_field('update-footerize-plugin-options'); ?>

					<h1>Opções globais do <b>Footerize</b></h1>

					<br>

					<div class="postbox  hide-if-js" style="display: block;">
						<button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Discussion</span><span class="toggle-indicator" aria-hidden="true"></span></button>
						<h2 class="hndle"><span>Pré-conteúdo</span></h2>
						<div class="inside">
							<input name="advanced_view" type="hidden" value="1">
							<p class="meta-options">
								<p>
					        		Este texto será exibido <b>antes</b> do conteúdo da página.
					        	</p>
								<label for="footerize_pre_content_pages" class="selectit"><input <?php if ( get_option('footerize_pre_content_pages') == true ) echo 'checked="checked"'; ?> name="footerize_pre_content_pages" id="footerize_pre_content_pages" type="checkbox" value="show"> Exibir em todas as páginas</label><br>
								<label for="footerize_pre_content_posts" class="selectit"><input <?php if ( get_option('footerize_pre_content_posts') == true ) echo 'checked="checked"'; ?> name="footerize_pre_content_posts" id="footerize_pre_content_posts" type="checkbox" value="show"> Exibir em todos os posts</label>

								<br>

								<p>
					        		Não exibir quando o ID do post/página for:<br>
					        		<input type="text" name="footerize_exclude_from_pre" value="<?php echo esc_html( get_option('footerize_exclude_from_pre') ); ?>" class="regular-text" placeholder="Separe os IDs por vírgula">
					        		<p class="description">
					        			Insira apenas o ID dos posts/páginas que não deverão exibir o pré-conteúdo.<br>
					        			Separe os IDs por vírgula.
					        		</p>
					        	</p>

					        	<br>
			
								<?php
								$editor_id = 'pre-conteudo';
								wp_editor( get_option('footerize_pre_content') , $editor_id, array('editor_height' => $editor_height, 'textarea_name' => 'footerize_pre_content') );
								?>
							</p>
						</div>
					</div>
		
					<div class="postbox  hide-if-js" style="display: block;">
						<button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Discussion</span><span class="toggle-indicator" aria-hidden="true"></span></button>
						<h2 class="hndle"><span>Pós-conteúdo</span></h2>
						<div class="inside">
							<input name="advanced_view" type="hidden" value="1">
							<p class="meta-options">
								<p>
					        		Este texto será exibido <b>após</b> o conteúdo da página.
					        	</p>
								<label for="footerize_pos_content_pages" class="selectit"><input <?php if ( get_option('footerize_pos_content_pages') == true ) echo 'checked="checked"'; ?> name="footerize_pos_content_pages" id="footerize_pos_content_pages" type="checkbox" value="show"> Exibir em todas as páginas</label><br>
								<label for="footerize_pos_content_posts" class="selectit"><input <?php if ( get_option('footerize_pos_content_posts') == true ) echo 'checked="checked"'; ?> name="footerize_pos_content_posts" id="footerize_pos_content_posts" type="checkbox" value="show"> Exibir em todos os posts</label>

								<br>

								<p>
					        		Não exibir quando o ID do post/página for:<br>
					        		<input type="text" name="footerize_exclude_from_pos" value="<?php echo esc_html( get_option('footerize_exclude_from_pos') ); ?>" class="regular-text" placeholder="Separe os IDs por vírgula">
					        		<p class="description">
					        			Insira apenas o ID dos posts/páginas que não deverão exibir o pós-conteúdo.<br>
					        			Separe os IDs por vírgula.
					        		</p>
					        	</p>

					        	<br>

								<?php
								$editor_id = 'pos-conteudo';
								wp_editor( get_option('footerize_pos_content') , $editor_id, array('editor_height' => $editor_height, 'textarea_name' => 'footerize_pos_content') );
								?>
							</p>
						</div>
					</div>
					
					<div class="postbox  hide-if-js" style="display: block;">
						<button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Discussion</span><span class="toggle-indicator" aria-hidden="true"></span></button>
						<h2 class="hndle"><span>Shortcode</span></h2>
						<div class="inside">
							<input name="advanced_view" type="hidden" value="1">
							<p class="meta-options">
								<p>
					        		Sempre que você inserir o shortcode <b>[footerize]</b> em qualquer lugar das suas páginas e/ou posts, ele será automaticamente substituído pelo conteúdo abaixo.
					        	</p>

					        	<br>

								<?php
								$editor_id = 'shortcode';
								wp_editor( get_option('footerize_shortcode_content') , $editor_id, array('editor_height' => $editor_height, 'textarea_name' => 'footerize_shortcode_content') );
								?>
							</p>
						</div>
					</div>

					<p>
						Desenvolvido por Lucas Moreira.<br>
						Acesse meu blog: <a href="http://webemfoco.com.br/" target="_blank">http://webemfoco.com.br/</a>.
					</p>

					<div id="postbox-container-1" class="postbox-container">
						<div id="side-sortables" class="meta-box-sortables ui-sortable" style="position: fixed; top: 178px;">
							<div id="submitdiv" class="postbox">
								<button type="button" class="handlediv button-link" aria-expanded="true">
									<span class="screen-reader-text">Toggle panel: Publish</span>
									<span class="toggle-indicator" aria-hidden="true"></span>
								</button>
								<h2 class="hndle ui-sortable-handle">
									<span>Publicar</span>
								</h2>
								<div class="inside">
									<div class="submitbox" id="submitpost">
										<div id="major-publishing-actions">
											<div id="publishing-action">
												<span class="spinner"></span>
												<input name="save" type="submit" class="button button-primary button-large" id="publish" value="Salvar">
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


				</form>


		    </div><!-- /#post-body-content -->

		</div><!-- /#postbody -->

	</div><!-- /#poststuff -->

</div><!-- /.wrap -->