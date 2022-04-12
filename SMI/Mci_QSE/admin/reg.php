
<?php
$i=19;
while($i<41){
	?>

													&lt;div class="form-group has-error" id="PA<?php echo $i; ?>" style="display:none"&gt;<br>
															&lt;label class="control-label col-md-3"&gt;&lt;b&gt;Ecart mineur <?php echo $i; ?> :&lt;/b&gt;&lt;/label&gt;&lt;a href="#PA<?php echo $i; ?>" onclick="toggle_visibility('PA<?php echo $i+1; ?>','vide<?php echo $i+1; ?>'),toggle_visibility2('icplus<?php echo $i; ?>','icminus<?php echo $i; ?>'),cleartext('text<?php echo $i+1; ?>');"&gt;<br>
																&lt;i class="fa fa-plus" id="icplus<?php echo $i; ?>" style="visibility:visible"&gt;&lt;/i&gt;<br>
																&lt;i class="fa fa-minus" id="icminus<?php echo $i; ?>" style="visibility:hidden"&gt;&lt;/i&gt;<br>
																&lt;/a&gt;<br>
													&lt;div class="col-md-6"&gt;<br>
														&lt;textarea id="text<?php echo $i; ?>" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"&gt;&lt;/textarea&gt;<br>
															&lt;span class="help-block"&gt;<br>
													<br>		
													<br>		
													&lt;/div&gt;<br>														
													&lt;/div&gt;<br>
											
													&lt;div class="form-group has-error" id="vide<?php echo $i; ?>" style="display:none"&gt;
													<br>																	
													&lt;/div&gt;<br>
													

 <?php

$i++;
}													
?>