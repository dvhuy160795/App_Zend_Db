<?php
include('Db/Table.php');
// kết nôi đến csdl
class Manager{
    public function connectDb(){
        return $db = Zend_Db::factory('Pdo_Mysql', array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => '1',
            'dbname'   => 'ViewTV'
        ));
    }
    public function insertData($connect){
        $insert =array('user_id'=>10,
          'user_name'=>'huyvan',
          'user_pass'=>'vanhuy',
          'user_phone'=>'0123456789',
          'user_address'=>'ha noi',
          'user_email'=>'dvhuy160795@gmail.com',
          'created'=>'2017/10/11',
          'user_age' =>'10');
        $connect->insert('user',$insert);
    }
    public function showAll($connect){
        // $select = 'SELECT * FROM user WHERE user_name = ?';
        // $result = $connect->fetchAll($select,"huyvan");
        $select= $connect->select()->from('user')->order('id DESC')->limit(1);// lấy danh sách user sắp xếp theo thứ tự giảm dần và trả về 3 bản ghi đầu tiên

        $result=$connect->fetchAll($select);
        print_r($result);
        
    }
    public function updateData($connect,$table,$data,$where){
        $connect->update($table,$data,$where);
    }
    public function deleteData($connect,$table,$where){
        $connect->delete($table,$where);
    }
}

$manager=new Manager();
$con=$manager->connectDb();
//Thêm dữ liệu vào bảng
$manager->insertData($con);
//cập nhật bảng
$data=['user_name'=>'dao van huy'];
$where="id='23'";
$manager->updateData($con,'user',$data,$where);
//hiển thị dữ liệu
$manager->showAll($con);
//Xóa 1 record
$manager->deleteData($con,'user','id=23');