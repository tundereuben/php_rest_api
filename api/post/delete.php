<?php
  // Headers
  header('Access-Control-Allow-Origin: * ');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instatiate DB & Connect
  $databse = new Database();
  $db = $databse->Connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $post->id = $data->id;

  // Delete post
  if($post->delete()) {
    echo json_encode(
      array('message' => 'Post Deleteed')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Deleteed')
    );
  }