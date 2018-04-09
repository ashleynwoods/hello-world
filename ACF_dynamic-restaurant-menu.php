<?php /* Template Name: Menu */
get_header();
?>
	<div id="headerBackground">
	</div>
	
	<div class="container" id="menuBody">
		<?php if( have_rows('menu') ): ?>

			<ul id="menuSelection">

			<?php while( have_rows('menu') ): the_row(); 

				// Dynamic Menu
				$menu_section = get_sub_field('section_name');
				// for id's and GET request
				$menu_id = str_replace(' ', '_', $menu_section);
				?>
				
				<li><a class="menuToggle" id="<?php echo $menu_id; ?>" href="?menu=<?php echo $menu_id; ?>"><?php echo $menu_section; ?></a></li>

			<?php endwhile; ?>
			<li><a class="menuToggle" id="Specials" href="?menu=Specials">Specials</a></li>
			</ul>
			
		<?php endif; ?>
		
		<script>
		  
		function activeClass($item){
			var menuItem = document.getElementById($item); 
			menuItem.classList.add('activeMenu');
		}
		
		function firstItem(){
			var menuItem = document.querySelector('.menuToggle');
			menuItem.classList.add('activeMenu');
		}
						
		</script>
		
		<?php
		if(isset($_GET['menu']))
		{
			$menuSelected=$_GET['menu'];
			$menuTitle = str_replace('_', ' ', $menuSelected);
			
			?> <script>activeClass("<?php echo $menuSelected ?>");</script> <?php
			
			//display menu entrees
			// check if the repeater field has rows of data
			if( have_rows('menu') ):

				// loop through the rows of data
				while ( have_rows('menu') ) : the_row();
				$menu_section = get_sub_field("section_name");
				
				if($menu_section == $menuTitle)
				{
				$menu_info = get_sub_field("menu_info");
			?>
		
				<div id="lunchTitle">
				<h1 class="centerHeading"><?php echo $menuTitle; ?></h1>
				<p class="centerHeading" id="lunchTimes"><?php echo $menu_info ?></p>
				</div>
			
					<div class="container">
						<div class="row evenChild">
							<?php 

							// loop through rows (sub repeater)
							while( have_rows('menu_items') ): the_row();
							$menu_entree = get_sub_field("entree");
							$menu_description = get_sub_field("entree_description");
							$menu_price = get_sub_field("entree_price");
								
							?>
							<!-- INSERT MAIN MENU ITEMS -->				
								<div class="half">
									<div class="menuItem">
										<h3><?php echo $menu_entree ?></h3>
										<div class="menuInfo">
											<p class="bottomLine"><?php echo $menu_description; ?></p>
											<?php if ($menu_price): ?>
											<p class="price">$<?php echo $menu_price ?></p>
                                            <?php endif; ?>
											
										</div>
									</div>
								</div>
										
						<?php endwhile; ?>
						</div> <!-- END MENU ROW -->
					</div> <!-- END MENU CONTAINER -->
					
				
			<?php
						// loop through rows (sub repeater)
							while( have_rows('sub_menu') ): the_row();
							
							$sub_menu_name = get_sub_field("sub-menu_name");
								
			?>	
							<h2 class="centerHeading"><?php echo $sub_menu_name; ?></h2>
							
							<div class="container">
								<div class="row evenChild">
									
									<?php
									// loop through rows (sub repeater)
									while( have_rows('sub-menu_items') ): the_row();
									$sub_menu_entree = get_sub_field("entree_name");
									$sub_menu_description = get_sub_field("entree_description");
									$sub_menu_price = get_sub_field("entree_price");
									?>	
									
									<!-- INSERT SUB-MENU ITEMS -->
									<div class="half">
										<div class="menuItem">
											<h3><?php echo $sub_menu_entree ?></h3>
											<div class="menuInfo">
											<p class="bottomLine"><?php echo $sub_menu_description; ?></p>
											<?php if ($sub_menu_price): ?>
											<p class="price">$<?php echo $sub_menu_price ?></p>
                                            <?php endif; ?>
											</div>
										</div>
									</div>
																	
									<?php endwhile; ?>
								</div> <!-- END MENU ROW -->
							</div> <!-- END MENU CONTAINER -->
										
							<?php endwhile; ?>
					
				<?php 
				} //end if menu_section == $menuTitle
				endwhile;
				
			endif;
			
			if($menuSelected == "Specials")
			{
				specialsMenu();
			}
		
		}
		
		//if none of the menu items have been clicked
		else
		{
			//display the first item's menu
			?> <script>firstItem();</script> <?php
			if (have_rows('menu'))
			{
			  while (have_rows('menu')) {
				the_row();
				$menu_section = get_sub_field('section_name');
				$menu_info = get_sub_field("menu_info");
			?>
				<div id="lunchTitle">
				<h1 class="centerHeading"><?php echo $menu_section; ?></h1>
				<p class="centerHeading" id="lunchTimes"><?php echo $menu_info; ?></p>
				</div>
				
				<div class="container">
				<div class="row evenChild">
			<?php
	
				// loop through rows (sub repeater)
				while( have_rows('menu_items') ): the_row();
				$menu_entree = get_sub_field("entree");
				$menu_description = get_sub_field("entree_description");
				$menu_price = get_sub_field("entree_price");
								
			?>
				<!-- INSERT MAIN MENU ITEMS -->				
					<div class="half">
						<div class="menuItem">
							<h3><?php echo $menu_entree ?></h3>
							<div class="menuInfo">
								<p class="bottomLine"><?php echo $menu_description; ?></p>
								<p class="price">$<?php echo $menu_price ?></p>
							</div>
						</div>
					</div>
								
						<?php endwhile; ?>
						</div> <!-- END MENU ROW -->
					</div> <!-- END MENU CONTAINER -->
					
			<?php
						// loop through rows (sub repeater)
							while( have_rows('sub_menu') ): the_row();
							
							$sub_menu_name = get_sub_field("sub-menu_name");
								
			?>	
							<h2 class="centerHeading"><?php echo $sub_menu_name; ?></h2>
							
							<div class="container">
								<div class="row evenChild">
									
									<?php
									// loop through rows (sub repeater)
									while( have_rows('sub-menu_items') ): the_row();
									$sub_menu_entree = get_sub_field("entree_name");
									$sub_menu_description = get_sub_field("entree_description");
									$sub_menu_price = get_sub_field("entree_price");
									?>	
									
									<!-- INSERT SUB-MENU ITEMS -->
									<div class="half">
										<div class="menuItem">
											<h3><?php echo $sub_menu_entree ?></h3>
											<div class="menuInfo">
											<p class="bottomLine"><?php echo $sub_menu_description; ?></p>
											<p class="price">$<?php echo $sub_menu_price ?></p>
											</div>
										</div>
									</div>
																	
									<?php endwhile; ?>
								</div> <!-- END MENU ROW -->
							</div> <!-- END MENU CONTAINER -->
										
							<?php endwhile; ?>
				<?php
					// exit loop after first image
					break;
				}
			}
		}
		
		?>
			
		<?php function specialsMenu(){ ?>
	
			<div class="container">		
			<div class="row" id="specials">
				<?php
					// check if the repeater field has rows of data
					if( have_rows('specials') ):

						// loop through the rows of data
						while ( have_rows('specials') ) : the_row();
						$image = get_sub_field("image");
						$dayOfTheWeek = get_sub_field("day_of_the_week");
						$specialTitle = get_sub_field("special_title");
						$specialDescription = get_sub_field("special_description");
						$price = get_sub_field("price");
				?>
						<div class="diplayTable specialWrapper">
							<div class="displayCell specialImage">
								<p style="background-image:url('<?php echo $image ?>');background-repeat:no-repeat;background-size:cover; width:140px; height:140px;border:1px solid #ccc;"></p>
							</div>
							<div class="displayCell" style="padding:10px;"></div>
							<div class="displayCell specialDesc">
							<div>
								<p class="specialDay"><?php echo $dayOfTheWeek ?></p>
								<h3 class="specialTitle"><?php echo $specialTitle ?></h3>
								<div class="specialDetails"><?php echo $specialDescription ?></div>
							</div>
							</div>
							<div class="displayCell specialPrice">
								<p>$<?php echo $price ?></p>
							</div>
						</div>
						
						
				<?
						endwhile;
			
					else :

						echo "</div></div><p class='textcenter' style='padding:20px;'>There are no Specials at this time. Check back later!</p>";

					endif;
		
				?>
			</div>
			</div>

		<?php } ?>
		
	</div> <!-- END CONTENT WRAPPER -->
	
<?php get_footer(); ?>
