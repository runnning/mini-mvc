<?php
/**
 *User:ywn
 *Date:2021/5/29
 *Time:21:20
 */

namespace app;


use app\models\Product;
use PDO;

class Database
{
    public \PDO $pdo;
    public static Database $db;
    public function __construct(){
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=product_crud', 'root', 'root');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db=$this;
    }

    public function getProducts($search=''): array
    {
        if ($search) {
            $statement = $this->pdo->prepare('select * from products where title like :title order by create_time desc');
            $statement->bindValue(':title', "%$search%");
        } else {
            $statement = $this->pdo->prepare('select * from products order by create_time desc');
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createProduct(Product $product){
        $statement = $this->pdo->prepare("insert into products (title,`desc`,image,price,create_time) values(:title,:desc,:image,:price,:create_time)");
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':desc', $product->desc);
        $statement->bindValue(':image', $product->imagePath);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':create_time', date('Y-m-d H:i:s'));
        $statement->execute();
    }
    public function getProductByID($id){
        $statement = $this->pdo->prepare('select * from products where id= :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function updateProduct(Product $product){
        $statement = $this->pdo->prepare("update products set title=:title,`desc`=:desc,image=:image,price=:price
        where id=:id");
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':desc', $product->desc);
        $statement->bindValue(':image', $product->imagePath);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':id', $product->id);
        $statement->execute();
    }
    public function deleteProduct($id){
        $statement=$this->pdo->prepare('delete from products where id=:id');
        $statement->bindValue(':id',$id);
        $statement->execute();
    }
}