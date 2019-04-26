
<?php
require_once  '../../config.php';
$db=config::getConnexion();
  
    $req1= $db->query("SELECT COUNT(*) as nb1 FROM troupe WHERE id=id  " );
    $nb1 = $req1->fetch();

    $req2= $db->query("SELECT COUNT(*) as nb2 FROM chanteur WHERE id=id " );
    $nb2 = $req2->fetch();



$dataPoints = array(
  array("label"=> 'nombre des troupes musicales', "y"=> intval($nb1['nb1'])),
  array("label"=> 'nombre des chanteurs', "y"=> intval($nb2['nb2'])),

);
  
?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  exportEnabled: true,
  theme: "light1", // "light1", "light2", "dark1", "dark2"
  title:{
    text: "Statistique des Commandes "
  },
  data: [{
    type: "column", //change type to bar, line, area, pie, etc
    //indexLabel: "{y}", //Shows y value on all Data Points
    indexLabelFontColor: "#5A5757",
    indexLabelPlacement: "outside",   
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>

<div class="agile-grids"> 
<div id="chartContainer" style="height: 370px; width: 83%; margin-left: 20px" align="center"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>
<script>
    $(document).ready(function() {
       var navoffeset=$(".header-main").offset().top;
       $(window).scroll(function(){
        var scrollpos=$(window).scrollTop(); 
        if(scrollpos >=navoffeset){
          $(".header-main").addClass("fixed");
        }else{
          $(".header-main").removeClass("fixed");
        }
       });
       
    });
</script>
