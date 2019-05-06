<?php 
$open = "category";
require_once __DIR__."/../../autoload\autoload.php";
 $id=intval(getInput('id'));
 $EditCategory=$db->fetchID("category",$id);
 if(empty($EditCategory))
 {
     $_SESSION['error']="Dữ liệu k tồn tại";
     redirectAdmin("category");
 }
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $data=
    [
        "name" =>postInput('name'),
        "slug" => to_slug(postInput("name"))
    ];
    $error=[];
    if(postInput('name')=='')
    {
        $error['name']="MOI BAN NHAP DAY DU THONG TIN";
    }

    if(empty($error))
    {
        if($EditCategory['name']!=$data['name'])
        {
            $isset=$db->fetchOne("category","name=' ".$data['name']."' ");
        }
        if(count($isset)>0)
        {
            $_SESSION['error']="Tên danh mục đã tồn tại";
        }
        else
        {
            $id_update= $db->update("category",$data,array("id"=>$id));
             if($id_update>0)
            {
            $_SESSION['success']="Cập nhật thành công";
            redirectAdmin("category");
            }
            else
            {
            $_SESSION['eror']="Dữ liệu không đổi";
            redirectAdmin("category");
            }
        }
    }
    else
    {
        $id_update= $db->update("category",$data,array("id"=>$id));
        if($id_update>0)
        {
            $_SESSION['success']="Cập nhật thành công";
            redirectAdmin("category");
        }
        else
        {
            $_SESSION['eror']="Dữ liệu không đổi";
            redirectAdmin("category");
        }
    }
}
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<!-- Page Heading  NOi dung cua trang -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Thêm mới danh mục
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
            </li>
            <li>
                <i></i> <a href="index.html">Danh mục</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Thêm mới
            </li>
        </ol>
        <div class="clearfix"></div>
        <!-- hiển thị thông báo lỗi -->
        <?php require_once __DIR__."/../../../partials/nofications.php";
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" action="" method="POST">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="Ten danh muc" name="name"
                        value="<?php echo  $EditCategory['name'] ?>">
                    <?php
            if(isset($error['name'])):?>
                    <p class="text-danger"><?php echo $error['name']?> </p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"> Lưu </button>
                </div>
            </div>
        </form>

    </div>
</div>
<!-- /.row -->
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>
