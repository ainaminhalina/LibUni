<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require 'vendor/autoload.php'; // '../vendor/autoload.php';
require 'db.php';

$app = new \Slim\App;

$app->get('/getAllBook', function (Request $request, Response $response, array $args) {
	class Book
{
	public $ID = "";
	public $title = "";
	public $author = "";
	public $about = "";
}

$data = array();


try{
	$db = new db();
	$db = $db->connect();
	
	$stmt = $db->query("SELECT * FROM book");
	while ($row = $stmt->fetch()){
		//create an object/instance user of class Book
		$book = new Book();
		//populate the data/properties of object book
	$book->ID = $row['ID'];
	$book->title = $row['title'];
	$book->author = $row['author'];
	$book->about = $row['about'];
	array_push($data,$book);
	}
}catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
}

echo json_encode($data);
});

// API POST
$app->post('/insertBook', function (Request $request, Response $response, array $args) {
    $title = $_POST["title"]; //php terima post 
    $author = $_POST["author"];
    $about = $_POST["about"];
    
    try {
        $sql = "INSERT INTO book (title,author,about) VALUES (:title,:author,:about)";
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':author', $author);
        $stmt->bindValue(':about', $about);
        $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;
    
        $data = array(
            "status" => "success",
            "rowcount" =>$count
        );
        echo json_encode($data);// array nak tukar jadi json ,,echo cout
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

// API POST login
$app->post('/login', function (Request $request, Response $response, array $args) {
    $username = $_POST["username"]; //php terima post 
    $password = $_POST["password"];
    
    try {
        $sql = "SELECT * FROM user WHERE username = :username and password = :password";
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $db = null;
    
        echo json_encode($user);// array nak tukar jadi json ,,echo cout
    } catch (PDOException $e) {
        echo json_encode(array());
    }
});

// API POST register
$app->post('/register', function (Request $request, Response $response, array $args) {
    //php terima post 
    $name = $_POST["name"];
    $username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$type = $_POST["type"];
	
    
    try {
        $sql = "INSERT INTO user (name,username,email,password,type) VALUES (:name,:username,:email,:password,:type)";
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':username', $username);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);
		$stmt->bindValue(':type', $type);
        $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;
    
        $data = array(
            "status" => "success",
            "rowcount" =>$count
        );
        echo json_encode($data);// array nak tukar jadi json ,,echo cout
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail",
			"rowcount" => 0
        );
        echo json_encode($data);
    }
});

// API POST rent book
$app->post('/rentBook', function (Request $request, Response $response, array $args) {
    $book_id = $_POST["book_id"]; //php terima post 
    $user_id = $_POST["user_id"];
    $rent_date = $_POST["rent_date"];
	$return_date = $_POST["return_date"];
    
    try {
        $sql = "INSERT INTO book_rental (book_id,user_id,rent_date,return_date) VALUES (:book_id,:user_id,:rent_date,:return_date)";
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':book_id', $book_id);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':rent_date', $rent_date);
		$stmt->bindValue(':return_date', $return_date);
        $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;
    
        $data = array(
            "status" => "success",
            "rowcount" =>$count
        );
        echo json_encode($data);// array nak tukar jadi json ,,echo cout
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail",
			"rowcount" => 0
        );
        echo json_encode($data);
    }
});

//API GET bookRent by user id
$app->get('/getbookRent/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $sql = "SELECT book_rental.*,book.* FROM book_rental left join book on book_rental.book_id = book.ID WHERE book_rental.user_id = $id"; //gabung 2 table

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $book = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($book);
    } catch (PDOException $e) {
 
        echo json_encode(array());
    }

});

//API GET book id
$app->get('/getBook/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $sql = "SELECT * FROM book WHERE ID = $id";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $book = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($book);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});

//API GET user id
$app->get('/getUser/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $sql = "SELECT * FROM user WHERE Id = $id";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});


//API DELETE
$app->delete('/deleteBook/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $sql = "DELETE FROM book WHERE ID = $id";
    
    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
    
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
    
        $db = null;
        $data = array(
            "rowAffected" => $count,
            "status" => "success"
        );
        echo json_encode($data);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

// API UPDATE
$app->put('/updateBook', function (Request $request, Response $response, array $args) {
		$putParams = $request->getParsedBody();
		$id = $putParams['id'];
		$title = $putParams['title'];
		$author = $putParams['author'];
		$about = $putParams['about'];


    try {
        $sql = "UPDATE book SET title = :title, author = :author, about = :about WHERE ID = :id";
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array("title" => "$title","author" => "$author","about" => "$about","id" => "$id"));
        $count = $stmt->rowCount();
        $db = null;

        $data = array(
            "status" => "success",
            "rowcount" =>$count
        );
        echo json_encode($data);// array nak tukar jadi json ,,echo cout
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

// API UPDATE profile
$app->put('/updateUser', function (Request $request, Response $response, array $args) {
		$putParams = $request->getParsedBody();
		$Id = $putParams['Id'];
		$name = $putParams['name'];
		$username = $putParams['username'];
		$email = $putParams['email'];
		$password = $putParams['password'];
		$type = $putParams['type'];


    try {
        $sql = "UPDATE user SET name = :name, username = :username, email = :email, password = :password, type = :type WHERE Id = :Id";
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
		$stmt->bindParam("name", $name);
		$stmt->bindParam("username", $username);
		$stmt->bindParam("email", $email);
		$stmt->bindParam("password", $password);
		$stmt->bindParam("type", $type);
		$stmt->bindParam("Id", $Id);
		$stmt->execute();
        $count = $stmt->rowCount();
        $db = null;

        $data = array(
            "status" => "success",
            "rowcount" =>$count
        );
        echo json_encode($data);// array nak tukar jadi json ,,echo cout
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});
$app->run();
