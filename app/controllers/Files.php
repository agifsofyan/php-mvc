<?php


    class Files extends Controller
    {
        public function __construct()
        {
          $this->service = $this->model('Product');
        }

        public function form() {
            $this->view('files/form-upload');
        }

        public function upload(){
            $url = false;
              // If upload button is clicked ...
              if (isset($_POST['upload'])) {
             
                $filename = $_FILES["uploadfile"]["name"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];
                $path = "/assets/images/uploads/".$filename;
                $dir = PUBLIC_DIR . $path;

                move_uploaded_file($tempname, $dir);
                
                $url = URL_ROOT . $path;
            }
            
            return $url;
        }

        public function singleupload(){
            if (isset($_POST['upload']['name'])) {
             
                $file = $_FILES["upload"]["tmp_name"];
                $file_name = $_FILES["upload"]["name"];
                $file_name_array = explode(".", $file_name);
                $extention = end($file_name_array);
                $new_image_name = rand() . '.' . $extention;

                $url = PUBLIC_DIR . "/assets/images/uploads/" . $new_image_name;

                chmod(PUBLIC_DIR . "/assets/images/uploads/", 0777);

                $alowed_extention = array('jpg', 'png', 'giff');

                if(in_array($extention, $alowed_extention)){
                    move_uploaded_file($file, $url);
                    $function_number = $_GET['CKEditorFuncNum'];

                    echo "<script>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$new_image_name');</script>";
                }

                // move_uploaded_file($tempname, $dir);
                
                // $url = URL_ROOT . $path;
            }
        }

        public function ckfinder(){
            $this->view('files/ckfinder');
        }
    }
