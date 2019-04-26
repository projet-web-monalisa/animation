<?php
require_once "../../entities/PromotionGastronomie.php";
require_once "../../core/PromotionAnimationC.php";
require_once "../../core/PromotionDecorC.php";
require_once "../../core/PromotionGastroC.php";
require_once "../../core/PackC.php";
require_once "../connexion.php";
$c = new connexion();
$conn = $c->cnx;
$crud = new PromotionGastroC();
$gastros = $crud->afficherTousGastro($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (is_uploaded_file($_FILES['image']["tmp_name"])) {
        $temp = explode(".", $_FILES["image"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        move_uploaded_file($_FILES["image"]["tmp_name"],'../../uploads/'. $newfilename);
    }
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $gastro = $_POST['gastro'];
    $value = $_POST['value'];
    $promotionA = new PromotionGastro($gastro, $value, $date_debut, $date_fin, $newfilename);
    $crud = new PromotionGastroC();
    $crud->ajoutPromotion($promotionA, $conn);
    header("Location: showAllPromotionGastroAdmin.php");
    exit;
}
?>
<?php include_once 'header.php'  ?>
<h3><i class="fa fa-angle-right"></i>Ajouter Promotion pour la Gastronomie </h3>
<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <form id="main" class="form-horizontal"  method="post"  enctype="multipart/form-data" novalidate="">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="gastro">Grastonimies</label>
                    <div class="input-group col-sm-5">
                        <select id="gastro" class="form-control" name="gastro">
                            <?php foreach ($gastros as $a){ ?>
                                <option value="<?php echo $a['id']?>"><?php echo $a['nom']?></option>
                             <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-5 messages"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="date_debut">Date Debut</label>
                    <div class="col-sm-5 input-group">
                        <input id="date_debut" name="date_debut" class="form-control" type="date" placeholder="YYYY-MM-DD" >
                    </div>
                    <div class="col-sm-5 messages"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="date_fin">Date Fin</label>
                    <div class="col-sm-5 input-group">
                        <input id="date_fin" name="date_fin" class="form-control" type="date" placeholder="YYYY-MM-DD" >
                    </div>
                    <div class="col-sm-5 messages"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="value">Value</label>
                    <div class="col-sm-5 input-group">
                        <input id="value" class="form-control" data-validation="length alphanumeric" data-validation-length="min1" type="number" placeholder="Value" name="value">
                    </div>
                    <div class="col-sm-5 messages"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Image Upload</label>
                    <div class="col-sm-5 input-group">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" name="image" required data-validation="mime size" data-validation-allowing="jpg, png, gif" data-validation-max-size="2M" class="default" />
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-md-5">
                        <button type="submit" class="btn btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /form-panel -->
    </div>
    <!-- /col-lg-12 -->
</div>
<?php include_once  'footer.php'?>