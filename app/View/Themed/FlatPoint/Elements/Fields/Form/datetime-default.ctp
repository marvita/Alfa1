<?php
$this->extend("/field-wrapper");

// adapt the field name on the entity path setting
$path = $this->Entity->currentPathField();
$fieldValue = $this->Entity->fieldValue($field);
$fieldLabel = $this->Entity->fieldLabel($field);
$fieldType = $this->Entity->fieldType($field);
$fieldConfig = $this->Entity->entityConfig(Entity::currentPathClass(), "Fields", $field);

$underscored = "input field_type_" . str_replace(".", "-", Inflector::underscore($fieldType)) . " field_".str_replace(".", "-", Inflector::underscore($field));

$pathfield = $path . ($path ? "." : "") . $field;

$format = $fieldType == 'date' ? "dd/mm/yy" : "dd/mm/yy HH:ii";

$options["div"] = false;
$options["label"] = false;
$options["class"] = "span10";
$options["type"] = "text";
$options["value"] = $fieldValue;
$options["placeholder"] = "aaaa-mm-dd";

$pickeropts = array(
    "format" => $format,
    'autoclose' => true,
    'todayBtn' => true,
    'minuteStep' => 10,
    'pickerPosition' => "bottom-left"
);
if (isset($fieldConfig["options"]["startDate"])) $pickeropts["startDate"] = $fieldConfig["options"]["startDate"];
if (isset($fieldConfig["options"]["endDate"])) $pickeropts["endDate"] = $fieldConfig["options"]["endDate"];
$wrapperClass = isset($fieldConfig["wrapperClass"]) ? $fieldConfig["wrapperClass"] : "";

$class = "$underscored $wrapperClass mode-$mode";

$this->assign("class", $class);
$this->assign("fieldLabel", $fieldLabel);
$this->assign("fieldValue", $fieldValue ? $fieldValue : "");
$this->assign("fieldType", $fieldType);

?>
<!-- <div class="span6 input-append date form_datetime2" data-date="<?= $fieldValue ?>">
    <?= $this->Form->input($pathfield, $options) ?>
    <span class="add-on"><i class="icon-calendar"></i></span>
</div> -->

<div class="span6 input-append date form_datetime2" data-date="<?= $fieldValue ?>">
    <?= $this->Form->input($pathfield, $options) ?>
    <!-- <label style="padding-left:4px;color:grey; font-style:italic"> yyyy-mm-dd</label> -->
</div>

<!--
<script>
$(document).ready(function() {
	$("#<?= $this->Entity->fieldID($field) ?>").parent().<?= $fieldType ?>picker(<?= json_encode($pickeropts) ?>);
});
</script>
-->


<script>
$(document).ready(function() {
    $("#<?= $this->Entity->fieldID($field) ?>").blur(function(event){
        // alert('test');
        
    var dtVal=$(this).val();
    
    if(ValidateDate(dtVal)) {
       
     }else{
       alert('Debe ingresar la fecha en el formato: aaaa-mm-dd');
       event.preventDefault();
     }        
              
    });
});

function ValidateDate(dtValue) {

  //var dtRegex = new RegExp(/^(0[1-9]|1[012]|[1-9])[- /.](0[1-9]|[12][0-9]|3[01]|[1-9])[- /.](19|20)\d\d$/);
  //var dtRegex = new RegExp(/^(\d{4})-(\d\d)-(\d\d)$/);

  // return dtRegex.test(dtValue);
  
  
    var currVal = dtValue;
    if(currVal == '')
        return false;
    
   // var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
   var rxDatePattern = /^(\d{4})(-)(\d{1,2})(-)(\d{1,2})$/; //Declare Regex
    var dtArray = currVal.match(rxDatePattern); // is format OK?
    
    if (dtArray == null) 
        return false;
        
    console.log(dtArray);
    //Checks for dd/mm/yyyy format.
    //Check for yyyy-mm-dd format
    dtMonth = dtArray[3];
    dtDay= dtArray[5];
    dtYear = dtArray[1];        
    
    if (dtMonth < 1 || dtMonth > 12) 
        return false;
    else if (dtDay < 1 || dtDay> 31) 
        return false;
    else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31) 
        return false;
    else if (dtMonth == 2) 
    {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay> 29 || (dtDay ==29 && !isleap)) 
                return false;
    }
    return true;

  
}

</script>
