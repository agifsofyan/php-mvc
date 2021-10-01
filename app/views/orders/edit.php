<?php require APP_ROOT . '/views/inc/_top.php' ?>

<?php flash('msg_error'); ?>

<form action="<?php echo URL_ROOT; ?>/orders/edit/<?php echo $data->id; ?>" method="post">
   <div class="mdc-layout-grid__inner p-4 bg-white">
    
       <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field">
           <input
            name="hp" 
            type="text"
            class="mdc-text-field__input" 
            value="<?php echo $data->customer_hp; ?>"
            readonly
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Customer Whatsapp</label>
         </div>
      </div>

       <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field">
           <input
            name="name" 
            type="text" 
            class="mdc-text-field__input"
            value="<?php echo $data->customer_name; ?>"
            readonly
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Customer Name</label>
         </div>
      </div>
      
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field">
           <input
            name="product_id" 
            type="text" 
            class="mdc-text-field__input"
            value="<?php echo $data->product_name; ?>"
            readonly
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Product Name</label>
         </div>
      </div>
      
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field">
           <input
            name="qty" 
            type="text" 
            class="mdc-text-field__input"
            value="<?php echo $data->qty; ?>"
            readonly
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Quantity</label>
         </div>
      </div>
      
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field">
           <input
            name="unique_number" 
            type="text" 
            class="mdc-text-field__input"
            value="<?php echo $data->unique_number; ?>"
            readonly
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Unique Number</label>
         </div>
      </div>
      
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
         <div class="mdc-text-field">
           <input
            name="total_price" 
            type="text" 
            class="mdc-text-field__input"
            value="Rp <?php echo toCurrency($data->total_price, false, true); ?>"
            readonly
          />
           <div class="mdc-line-ripple"></div>
           <label for="text-field-hero-input" class="mdc-floating-label">Total Price</label>
         </div>
      </div>

      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
        <div class="mdc-select w-100 <?php echo !empty($opt['error']) ? 'mdc-select--invalid' : ''; ?>" data-mdc-auto-init="MDCSelect">
          <input type="hidden" name="payment_id" value="<?php echo $data->payment_id; ?>">
          <i class="mdc-select__dropdown-icon"></i>
          <div class="mdc-select__selected-text"></div>
          <div class="mdc-select__menu mdc-menu-surface">
            <ul class="mdc-list">
              <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
              </li>

              <?php foreach($opt['payment'] as $val) : ?>
                <li class="mdc-list-item" data-value="<?php echo $val->id; ?>">
                <?php echo strtoupper($val->vendor) . ' - ' . strtoupper($val->account_name) .' - '. strtoupper($val->account_number) ; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <span class="mdc-floating-label">Choose the payment</span>
          <div class="mdc-line-ripple"></div>
          <small class="text-danger pt-1"><?php echo !empty($opt['error']) ? $opt['error'] : ''; ?></small>
        </div>
      </div>
      
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop pt-3">
         <div class="mdc-switch mdc-switch--info" data-mdc-auto-init="MDCSwitch">
            <div class="mdc-switch__track"></div>
            <p for="text-field-hero-input" class="mdc-floating-label mt-2 mb-2" id="labelSwitch">Status : <?php echo $data->status; ?></p>
            <div class="mdc-switch__thumb-underlay">
               <div class="mdc-switch__thumb">
                  <input 
                      type="checkbox" 
                      name="status" 
                      id="inputSwitch" 
                      class="mdc-switch__native-control" 
                      role="switch" 
                      value="<?php echo $data->status; ?>"
                      onchange="toggleSwitch(this, 'Status : Unpaid', 'Status : Paid')"
                      <?php echo $data->status === 'paid' ? "checked" : ""; ?> 
                  />
               </div>
            </div>
         </div>
      </div>

       <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 p-0">
           <div class="mdc-card p-0">
               <button type="submit" class="mdc-button mdc-button--raised icon-button filled-button--success btn-action">
                     <i class="material-icons mdc-button__icon">save</i>
                 </button>
           </div>
       </div>
   </div>
</form>

<small class="text-primary mt-4">* Only update status</small>

<?php require APP_ROOT . '/views/inc/_bottom.php' ?>
