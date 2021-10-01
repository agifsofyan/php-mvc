<?php
    session_start();
   
    // Flash message helper
    // Example flash('register_success','You are now registered!')
    // Display in View - <php echo flash('register_success'); >
    //function flash($name = '', $message = '', $class = 'snackbar-success')
    //{
    //    if(!empty($name) && !empty($message)){
    //        if ( isset($_SESSION[$name]) && !empty($_SESSION[$name]) ) {
    //            unset( $_SESSION[$name] );
    //        }else{
    //            $_SESSION[$name] = $message;
    //            $icon = $class == 'snackbar-success' ? 'check_circle' : 'error';
    //            
    //            echo '<div id="snackbar">
    //            <i class="material-icons '.$class.'">'.$icon.'</i> 
    //            <span>'.$_SESSION[$name].'</span>
    //            </div>';
    //            
    //            unset($_SESSION[$name]);
    //        }    
    //    }
    //}
    
    function flash($name = '', $message = '', $class = 'snackbar-success')
    {
        $icon = $class == 'snackbar-success' ? 'check_circle' : 'error';
        
        if (! empty($name) ) {
            if (! empty($message) && empty($_SESSION['username']) ) {
                if ( !empty($_SESSION[$name]) ) {
                   unset( $_SESSION[$name] );
                }
                if (! empty($_SESSION[$name. '_class']) ) {
                   unset( $_SESSION[$name. '_class'] );
                }
                $_SESSION[$name] = $message;
                $_SESSION[$name. '_class'] = $class;
            } elseif ( empty($mesage) && !empty($_SESSION[$name]) ) {
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
                //echo '<div class="'.$class.'" id="msg-flash" role="alert">' . $_SESSION[$name] . '
                //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                //         <span aria-hidden="true">&times;</span></button>
                //     </div>';
                     
                echo '<div id="snackbar">
                        <i class="material-icons '.$class.'">'.$icon.'</i> 
                        <span>'.$_SESSION[$name].'</span>
                    </div>';
                
                unset($_SESSION[$name]);
                unset($_SESSION[$name.'_class']);
            }
        }
    }


    function isLoggedIn(){
      if ( isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_role'])) {
          return true;
      } else {
          return false;
      }
    }

    function superRole(){
      $role = isset($_SESSION['user_role']) ? strtolower($_SESSION['user_role']) : '';
      $super_role = array_map( 'strtolower', SUPER_USER );
      $role_check = in_array($role, $super_role);

      return $role_check;
    }