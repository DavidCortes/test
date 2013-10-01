<script src="http://localhost:8888/socket.io/socket.io.js"></script>
<script  type='text/javascript'  src="http://localhost/test.js"></script>
<script type="text/javascript"> 

var socket = io.connect('http://localhost:8888'); 
socket.on('connect', function() {
	var value ="<?php echo $_GET["account"]?>";
   // socket.emit('addme', value); 
});

</script> 

<?php 
$value = "abc";
$link = mysql_connect('localhost', 'root', 'root');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$connectSQL=mysqli_connect("localhost","root","root","radioMember");
// Check connection
if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

  header("Content-Type: text/html; charset=utf-8");
  session_start();
  $varAccountName = $_GET["account"];
  $password = $_GET["password"];
  if(isset($_GET["account"])) {
	 	$_SESSION["accountSession"] = $varAccountName;
		
	$result = mysqli_query($connectSQL,"SELECT * FROM personal  WHERE accountName='".$_GET["account"]."'");
	while($row = mysqli_fetch_array($result))
  {
	
  echo $row['accountName'] ."\n password:".$row['password'];
  	  $password = $row['password'];

  echo "<br />";
  }
  

  }
  else	{
  }
 
 if(isset($_SESSION["accountSession"])){

}
else{
}

if(isset($_GET["clean"])){
		unset($_SESSION["accountSession"]);
}
 

$thread_id = mysql_thread_id($connectSQL);
$cart = array(
  "orderID" => 12345,
  "accountName" => $varAccountName,
  "password"=>$password,
  "accountEmail" => "johnsmith@example.com",
  "connectStatus" => mysqli_connect_error(),
  "treadID" => $thread_id,
  "contents" => array(
    array(
      "productID" => 34,
      "productName" => "SuperWidget",
      "quantity" => 1
    ),
    array(
      "productID" => 56,
      "productName" => "WonderWidget",
      "quantity" => 3
    )
  ),
  "orderCompleted" => true
);

echo json_encode( $cart );

?>