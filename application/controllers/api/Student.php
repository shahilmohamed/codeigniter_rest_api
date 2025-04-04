<?php

require APPPATH.'libraries/REST_Controller.php';

class Student extends REST_Controller{


  public function __construct()
  {
    parent::__construct();
    $this->load->library(array("form_validation"));
    $this->load->model(array("api/student_model"));
  }

  public function index_get()
  {
    $students = $this->student_model->get_student();
    print_r("hello");

    if (count($students)>0) {
      $this->response(array(
        "status"=>1,
        "message"=>"student found",
        "data"=>$students
      ),REST_Controller::HTTP_OK);
    }
    else {
      $this->response(array(
        "status"=>0,
        "message"=>"no student found",
        "data"=>$students
      ),REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function index_post()
  {
    $data = json_decode(file_get_contents("php://input"));

    // $name =isset($data->name) ? $data->name: "";
    // $email =isset($data->email) ? $data->email: "";
    // $mobile =isset($data->mobile) ? $data->mobile: "";
    // $course =isset($data->course) ? $data->course: "";

    // print_r($this->input->post());
    $name = $this->input->post("name");
    $email = $this->input->post("email");
    $mobile = $this->input->post("mobile");
    $course = $this->input->post("course");

    $this->form_validation->set_rules("name","Name","required");
    $this->form_validation->set_rules("email","Email","required");
    $this->form_validation->set_rules("mobile","Mobile","required");
    $this->form_validation->set_rules("course","Course","required");

    if($this->form_validation->run()===FALSE)
    {
      $this->response(array("status"=>0,"message"=>"All fields are required"),REST_Controller::HTTP_NOT_FOUND);
    }
    else 
    {
      $student = array(
        "name"=>$name,
        "email"=>$email,
        "mobile"=>$mobile,
        "course"=>$course
      );
      if($this->student_model->insert_student($student))
      {
        $this->response(array(
          "status"=>1,
          "message"=>"Student created"
        ),REST_Controller::HTTP_OK);
      }
      else
      {
        $this->response(array(
          "status"=>0,
          "message"=>"Student is not created"
        ),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }
    
    }

    
    

  }

  public function index_put()
  {
    echo "in put method";
  }

  public function index_delete()
  {
    echo "in delete method";
  }

}

 ?>
