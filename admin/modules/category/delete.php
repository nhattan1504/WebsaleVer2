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
 $is_product=$db->fetchOne("product"," category_id=$id ");
 if( $is_product==NULL )
 {
     $num=$db->delete("category",$id);
     if($num > 0)
      {
       $_SESSION['success']="Xóa thành công";
      redirectAdmin("category");
      }
      else
      {
       $_SESSION['eror']="Xóa thất bại";
       redirectAdmin("category");
      }
 }
 else 
 {
    $_SESSION['eror']="Danh muc ton tai san pham k the xoa";
    redirectAdmin("category");
 }
 ?>
