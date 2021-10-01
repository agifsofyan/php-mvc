<!-- SIDEBAR -->
<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
    <div class="mdc-drawer__header">
        <a href="<?php echo URL_ROOT; ?>" class="brand-logo">
            <img src="<?php echo URL_ROOT; ?>/assets/images/logo/logo-font-transparent.png" width="190" alt="logo">
        </a>
    </div>
    <div class="mdc-drawer__content">
        <div class="mdc-list-group">
            <nav class="mdc-list mdc-drawer-menu">
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?php echo URL_ROOT; ?>">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                        Dashboard
                    </a>
                </div>

                <!-- Products -->
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="product-menu">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">store</i>
                        Products
                        <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                    </a>

                    <div class="mdc-expansion-panel" id="product-menu">
                        <nav class="mdc-list mdc-drawer-submenu">
                            <div class="mdc-list-item mdc-drawer-item">
                                <a class="mdc-drawer-link" href="<?php echo URL_ROOT; ?>/products">
                                    List
                                </a>
                            </div>
                            <div class="mdc-list-item mdc-drawer-item">
                                <a class="mdc-drawer-link" href="<?php echo URL_ROOT; ?>/products/add">
                                    Add
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
                
                <!-- Payments -->
                <!--<div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?php echo URL_ROOT; ?>/payments">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">payment</i>
                        Payments
                    </a>
                </div>-->
                
                <!-- Orders -->
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?php echo URL_ROOT; ?>/orders">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">monetization_on</i>
                        Orders
                    </a>
                </div>
                
                <!-- reports -->
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?php echo URL_ROOT; ?>/reports">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">report</i>
                        Reports
                    </a>
                </div>
                
                <!-- Settings -->
                <div class="mdc-list-item mdc-drawer-item <?php echo superRole() ? '' : 'no-display'; ?>">
                    <a class="mdc-drawer-link" href="<?php echo URL_ROOT; ?>/users">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">settings</i>
                        Settings
                    </a>
                </div>
                
             </nav>
        </div>
        <div class="profile-actions">
            <!--<a href="javascript:;">Settings</a>-->
            <span class="divider"></span>
            <a style="cursor: pointer;" onclick="logout()">Logout</a>
        </div>
     </div>
</aside>
<!-- SIDEBAR -->
