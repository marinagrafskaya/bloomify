<?php
session_start();
include '../assets/connect/db.php';
$input = file_get_contents('php://input');
$input = json_decode($input);
$order = $input->order;
$sum = $input->sum;
$address = $input->address;
$id_user = $_SESSION["user"]["id"];
$number_orders = mt_rand(100, 999);



// if ($address != "") {
//     $sql = "INSERT INTO `orders`(`user_id`, `number_orders`, `date`, `sum`, `status`, `delivery`, `address`) VALUES ('$id_user','$number_orders', NOW(),'$sum', 1, 'Доставка','$address');";
// } else {
//     $sql = "INSERT INTO `orders`(`user_id`, `number_orders`, `date`, `sum`, `status`) VALUES ('$id_user','$number_orders', NOW(),'$sum', 1);";
// }
// $result = $db->query($sql);
// $sql = "SELECT * FROM `orders` ORDER BY id_order DESC LIMIT 1";
// $result2 = $db->query($sql);
// $result2 = $result2->fetchAll();
// foreach ($result2 as $row) {
//     $orders_id = $row["id_order"];
//     foreach ($order as $row) {
//         $idproduct = $row->id;
//         $quantity = $row->quantity;
//         $sql = "INSERT INTO `orders_products`(`id_order`, `id_product`, `quantity`) VALUES ('$orders_id','$idproduct','$quantity');";
//         $result3 = $db->query($sql);
//     }
// }
// echo json_encode("1");


interface MethodOfObtaining
{
    public function getmethod(): string;
}

class Pickup implements MethodOfObtaining
{
    public function getmethod(): string
    {
        return "Самовывоз";
    }
}

class Delivery implements MethodOfObtaining
{
    protected $adress;

    public function setadress($adress)
    {
        $this->adress = $adress;
    }

    public function getmethod(): string
    {
        return "Доставка";
    }
}


class Order
{
    public array $ordersproducts = [];
    public float $sum;
    public int $id_user;
    public int $number_orders;
    public string $address;
    protected $methodOfObtaining;

    public function __construct($ordersproducts, $sum, $id_user, $address, $number_orders)
    {
        $this->ordersproducts = $ordersproducts;
        $this->sum = $sum;
        $this->id_user = $id_user;
        $this->number_orders = $number_orders;
        $method = ($address == '') ? new Pickup() : new Delivery();
        $this->address = ($address) ? $address : "г. Москва ул. Уличная, д. 2";
        $this->setmethodOfObtaining($method);
    }

    public function setmethodOfObtaining(MethodOfObtaining $methodOfObtaining)
    {
        $this->methodOfObtaining = $methodOfObtaining;
    }


    public function addOrder($db)
    {
        $method = $this->methodOfObtaining->getmethod();
        $sql = "INSERT INTO `orders`(`user_id`, `number_orders`, `date`, `sum`, `status`, `delivery`, `address`) VALUES ('$this->id_user','$this->number_orders', NOW(),'$this->sum', 1, '$method' ,'$this->address');";
        $db->query($sql);
        $sql = "SELECT * FROM `orders` ORDER BY id_order DESC LIMIT 1";
        $result2 = $db->query($sql);
        $result2 = $result2->fetchAll();
        foreach ($result2 as $row) {
            $orders_id = $row["id_order"];
            foreach ($this->ordersproducts as $row) {
                $idproduct = $row->id;
                $quantity = $row->quantity;
                $sql = "INSERT INTO `orders_products`(`id_order`, `id_product`, `quantity`) VALUES ('$orders_id','$idproduct','$quantity');";
                $db->query($sql);
            }
        }
        echo json_encode("1");
    }

}





$neworder = new NewOrder($order, $sum, $id_user, $address, $number_orders);
$neworder->addOrder($db);