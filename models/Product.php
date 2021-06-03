<?php
/**
 *User:ywn
 *Date:2021/5/30
 *Time:18:31
 */

namespace app\models;


use app\Database;
use app\helpers\StringHelper\UntilHelper;

class Product
{
    public ?int $id=null;
    public ?string $title=null;
    public ?string $desc=null;
    public ?float $price=null;
    public ?string $imagePath=null;
    public ?array $imageFile=null;
    public function load($data){
        $this->id=$data['id']??null;
        $this->title=$data['title'];
        $this->desc=$data['desc']??'';
        $this->price=$data['price'];
        $this->imageFile=$data['imageFile']??null;
        $this->imagePath=$data['imagePath']??null;
    }
    public function save(): array
    {
        $errors=[];
        if (!$this->title){
            $errors[]='title is required';
        }
        if (!$this->price){
            $errors[]='price is required';
        }
        if (!is_dir(__DIR__.'/../public/images')) {
            mkdir(__DIR__.'/../public/images');
        }
        if (empty($errors)) {
            if ($this->imageFile && $this->imageFile['tmp_name']) {
                if ($this->imagePath) {
                    unlink(__DIR__.'/../public/'.$this->imagePath);
                }
                $this->imagePath = 'images/' . UntilHelper::randomString(8) . '/' . $this->imageFile['name'];
                mkdir(dirname(__DIR__.'/../public/'.$this->imagePath));
                move_uploaded_file($this->imageFile['tmp_name'], __DIR__.'/../public/'.$this->imagePath);
            }
            $db=Database::$db;
            if ($this->id){
               $db->updateProduct($this);
            }else{
                $db->createProduct($this);
            }
        }
        return $errors;
    }
}