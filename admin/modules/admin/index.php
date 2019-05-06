<?php 
$open = "admin";
require_once __DIR__."/../../autoload/autoload.php";

if(isset($_GET['page']))
{
    $p=$_GET['page'];
}
else
{
    $p=1;
}
$sql="SELECT product.*, category.name as namecate FROM product
LEFT JOIN category on category.id=product.category_id";
$product=$db->fetchJone('product',$sql,$p,2,true);
if(isset($product['page']))
{
 $sotrang=$product['page'];
 unset($product['page']);   
}
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<!-- Page Heading  NOi dung cua trang -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách danh mục
            <a href="add.php" class="btn btn-info"> Thêm mới </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Danh mục
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
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Thunbar</th>
                        <th>info</th>
                        <th> Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt=1;foreach($product as $item):?>
                    <tr>
                        <td><?php echo $stt ?></td>
                        <td><?php echo $item['name'] ?></td>
                        <td><?php echo $item['namecate'] ?></td>
                        <td> <img src="<?php echo uploads()?>product/<?php echo $item['thunbar'] ?>
                                " width=" 80px" height="80px"> </td>
                        <td>
                            <ul>
                                <li>so luong:<?php echo $item['number'] ?></li>
                                <li>Gia:<?php echo $item['price'] ?></li>
                            </ul>
                        </td>
                        <td>
                            <?php echo $item['created_at']?>
                        </td>
                        <td>
                            <?php echo $item['updated_at']?>
                        </td>
                        <td>
                            <a class=" btn btn-xs btn-info " href=" edit.php?id=<?php echo $item['id'] ?>"><i
                                    class="fa fa-edit"></i>
                                Sửa</a>
                            <a class="btn btn-xs btn-danger " href="delete.php?id=<?php echo $item['id'] ?>"><i
                                    class="fa fa-times"></i> Xóa</a>
                        </td>
                    </tr>
                    <?php $stt++;endforeach ?>
                </tbody>
            </table>
            <div class="pull-right">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for($i=1;$i<=$sotrang;$i++):?>
                        <?php
                           if(isset($_GET['page']))
                           {
                               $p=$_GET['page'];
                           }else
                           {
                               $p=1;
                           }
                        ?>
                        <li class="<?php echo ($i==$p)?'active':''?>">
                            <a href="?page=<?php echo $i;?>"><?php echo $i ?></a>
                        </li>
                        <?php endfor; ?>
                        <li>
                            <a href="" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <?php require_once __DIR__. "/../../layouts/footer.php"; ?>
