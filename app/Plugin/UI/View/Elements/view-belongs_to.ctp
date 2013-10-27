<?
$fields = $this->Entity->entityFields($model);
$entity = $this->Entity->getModel($model);
?>
<div class="view belongs_to <?= Inflector::underscore($model) ?>">
	<div class="fields">
		<?
		foreach ($fields as $key => $type) {
			if (substr($key, -3) != "_id" && !in_array($key,array("id", "created", "modified", "Class") )) {
				print $this->Entity->field($key);
			}
		}
		?>
	</div>
	<? /*
	<div class="associations">
		<?
		foreach (array("belongsTo", "hasMany", "hasAndBelongsToMany", "hasOne") as $assoc) {
			?>
			<div class="<?= Inflector::underscore($assoc)?>">
				<?
				foreach ($entity->$assoc as $key => $values) {
					print $this->Entity->$assoc($key);
				}
				?>
			</div>
			<?
		}
		?>
	</div>
	*/ ?>
</div>
