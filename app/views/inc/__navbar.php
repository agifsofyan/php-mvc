<!-- NAVBAR -->
<header class="mdc-top-app-bar" style="border-bottom: 1px silver solid">
    <div class="mdc-top-app-bar__row">
        <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
            <span class="mdc-top-app-bar__title"><?php echo SITE_NAME; ?></span>
        </div>
        <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
            <div class="menu-button-container menu-profile d-none d-md-block">
                <button class="mdc-button mdc-menu-button">
                    <span class="d-flex align-items-center">
                        <!--<span class="figure">-->
                        <!--    <img src="<?php echo URL_ROOT; ?>/assets/images/faces/face1.jpg" alt="user" class="user">-->
                        <!--</span>-->
                        
                        <?php if( isset($_SESSION['user_name'])) : ?>
                            Hai, &nbsp; <span class="user-name"><?php echo $_SESSION['user_name'] ?></span>
                        <?php endif; ?>
                    </span>
                    <span class="material-icons">expand_more</span>
                </button>
                <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                    <ul class="mdc-list stretch-card" role="menu" aria-hidden="true" aria-orientation="vertical">
                        <li class="mdc-list-item" role="menuitem">
                            <div class="item-thumbnail item-thumbnail-icon-only">
                                <i class="mdi mdi-account-edit-outline text-primary"></i>
                            </div>
                            <div class="item-content d-flex align-items-start flex-column justify-content-center">
                                <a href="<?php echo isset($_SESSION['user_id']) ? URL_ROOT .'/users/changepassword' : '#' ?>">
                                    <h6 class="item-subject font-weight-normal">Change Password</h6>
                                </a>
                            </div>
                        </li>
                        <li class="mdc-list-item" role="menuitem">
                            <div class="item-thumbnail item-thumbnail-icon-only">
                                <i class="mdi mdi-settings-outline text-primary"></i>
                            </div>
                            <div class="item-content d-flex align-items-start flex-column justify-content-center" onclick="logout()">
                                <h6 class="item-subject font-weight-normal">Logout</h6>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- NAVBAR -->