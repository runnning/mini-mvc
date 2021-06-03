<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error):?>
            <div><?php echo $error?></div>
        <?php endforeach;?>
    </div>
<?php endif; ?>
<form action="" method="post" enctype="multipart/form-data">

    <?php if ($product['image']): ?>
        <img src="/<?php echo $product['image']?>" class="update-img">
    <?php endif;?>
    <div class="form-group">
        <label>Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $product['title'] ?>">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control"name="desc"> <?php echo $product['desc']?></textarea>
    </div>
    <div class="form-group">
        <label>Price</label>
        <input type="number" step=".01" class="form-control" name="price" value="<?php echo $product['price'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
