	<!-- filter section -->

					<div>
						<h5>Categories</h5>
						<?php
							$statement = $db->query('SELECT * FROM category');
							$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
							for($i=0; $i<count($categories) ; $i++){
						?>
							<div class="checkbox">
							  <label>
							    <input 	type="checkbox"
							    		name="category<?php echo $i; ?>"
							    		value="<?php echo $categories[$i]['pk_id']; ?>"
							    		<?php if(!count($_POST) || isset($_POST['category'.$i])){ echo "checked"; } ?>>
							    	<?php echo $categories[$i]['name']; ?>
							  </label>
							</div>
						<?php }; ?>
						<p class="pull-right pointer" onclick="selectallornone(this)"><a><u>select all/none</u></a></p>
						<div class="clearfix"></div>
					</div>

					<div style="display:none;">
						<h5>Statuses</h5>
						<?php
							$statement = $db->query('SELECT * FROM status');
							$statuses = $statement->fetchAll(PDO::FETCH_ASSOC);
							for($i=0; $i<count($statuses) ; $i++){
						?>
							<div class="checkbox">
							  <label>
							    <input 	type="checkbox"
							    		name="status<?php echo $i; ?>"
							    		value="<?php echo $statuses[$i]['pk_id']; ?>"
							    		<?php if(!count($_POST) || isset($_POST['status'.$i])){ echo "checked"; } ?>>
							    	<?php echo $statuses[$i]['name']; ?>
							  </label>
							</div>
						<?php }; ?>
						<p class="pull-right pointer" onclick="selectallornone(this)"><a><u>select all/none</u></a></p>
						<div class="clearfix"></div>
					</div>

				  <button type="submit" class="btn btn-default pull-right">Submit</button>
				</form>

			</div>
