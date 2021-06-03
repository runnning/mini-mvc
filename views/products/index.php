<h1>Product List</h1>
<p>
    <a type="button" href="/products/create" class="btn btn-success">add</a>
</p>
<form>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="search products" name="search" value="<?php echo $search ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">search</button>
        </div>
    </div>
</form>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">img</th>
        <th scope="col">title</th>
        <th scope="col">price</th>
        <th scope="col">create_time</th>
        <th scope="col">action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $index=>$product):?>
        <tr>
            <th scope="row"><?php echo $index+1 ?></th>
            <td>
                <?php if ($product['image']): ?>
                <img src="/<?php echo $product['image'] ?>" class="thumb_img">
                <?php endif; ?>
            </td>
            <td><?php echo $product['title']?></td>
            <td><?php echo $product['price']?></td>
            <td><?php echo $product['create_time']?></td>
            <td>
                <a type="button" class="btn btn-outline-primary" href="/products/update?id=<?php echo $product['id'] ?>">edit</a>
                <form style="display: inline-block" method="post" action="/products/delete">
                    <input type="hidden" value="<?php echo $product['id'] ?>" name="id">
                    <button type="submit"  class="btn btn-outline-danger">delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>