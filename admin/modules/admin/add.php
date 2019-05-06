<?php 
$open = "admin";
require_once __DIR__."/../../autoload\autoload.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $data=
    [
        "name" =>postInput('name'),
        "email" => postInput(postInput("email")),
        "adress"=>postInput("adress"),
        "number"=>postInput("number"),
        "price"=>postInput("price"),
        "content"=>postInput("content")
    ];
    $error=[];
     if(postInput('name')=='')
    {
        $error['name']="MOI BAN NHAP DAY DU THONG TIN";
    }
     if(postInput('category_id')=='')
    {
        $error['category_id']="MOI BAN CHON TEN DANH MUC";
    }
     if(postInput('price')=='')
    {
        $error['price']="MOI BAN NHAP GIA TIEN";
    }
     if(postInput('content')=='')
    {
        $error['content']="MOI BAN NHAP NOI DUNG";
    }
    if(postInput('number')=='')
    {
        $error['number']="MOI BAN NHAP so luong";
    }
    if(!isset($_FILES['thunbar']))
    {
        $error['thunbar']="Ban vui long chon hinh anh";
    }
    if(empty($error))
    {
        if(isset($_FILES['thunbar']))
        {
            $file_name=$_FILES['thunbar']['name'];
            $file_tmp=$_FILES['thunbar']['tmp_name'];
            $file_type=$_FILES['thunbar']['type'];
            $file_erro=$_FILES['thunbar']['error'];
            
            if($file_erro==0)
            {
                $part= ROOT."product/";
                $data['thunbar']=$file_name;
            }
        }
        $id_insert= $db->insert("product",$data);
        if($id_insert>0)
        {
              move_uploaded_file($file_tmp,$part.$file_name);
             $_SESSION['success']="Thêm thành công";
             redirectAdmin("product");
        }
          else
        {
            $_SESSION['error']="Thêm thất bại";
        }
    }
}
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<!-- Page Heading  NOi dung cua trang -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Thêm mới sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i></i> <a href="index.php">Sản phẩm</a>
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
        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Tên </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="Ho va ten" name="name">
                    <?php
                    if(isset($error['name'])):?>
                    <p class="text-danger"> <?php echo $error['name']?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">address </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="00000000" name="adress">
                    <?php
                    if(isset($error['adress'])):?>
                    <p class="text-danger"> <?php echo $error['adress']?> </p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">phone </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputName" placeholder="10 %" name="phone" value="0">
                     <?php
                    if(isset($error['phone'])):?>
                    <p class="text-danger"> <?php echo $error['phone']?> </p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">email </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="00000000" name="email">
                    <?php
                    if(isset($error['email'])):?>
                    <p class="text-danger"> <?php echo $error['email']?> </p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Password </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputName" name="password" >
                     <?php
                    if(isset($error['password'])):?>
                    <p class="text-danger"> <?php echo $error['password']?> </p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">ConfirmPassword </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputName"  name="re_password" >
                     <?php
                    if(isset($error['re_password'])):?>
                    <p class="text-danger"> <?php echo $error['re_password']?> </p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Avatar</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="inputName" placeholder="" name="avatar">
                    <?php
                    if(isset($error['avatar'])):?>
                    <p class="text-danger"> <?php echo $error['avatar']?> </p>
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
