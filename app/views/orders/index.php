<?php require APP_ROOT . '/views/inc/_top.php' ?>

<?php flash('msg_success'); ?>
<?php flash('msg_error'); ?>

<style>
    .wa-btn {
        cursor: pointer;
    }
</style>

<div class="mdc-layout-grid__inner mt-0 mb-5">
    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4">
        <h3 style="border: silver dotted;" class="text-center p-2">Orders</h3>
    </div>
    
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
        <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
            <div class="menu-button-container">
                <button class="mdc-button mdc-menu-button bg-white">
                    <i class="material-icons">filter_list</i>
                    Filter product
                </button>
                <div class="mdc-menu mdc-menu-surface p-2" tabindex="-1">
                    
                    <div class="mdc-layout-grid__inner">
                    <?php foreach($opt['products'] as $val) : ?>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4 bg-light p-2 pointer" onClick="toCheck(this);">
                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1">
                                <input type="checkbox" class="check-filter" value="<?php echo $val->name; ?>" />
                            </div>
                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-11">
                                <small><?php echo strlen($val->name) > 20 ? ucwords(substr($val->name, 0, 20)) . '...' : ucwords($val->name); ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
    
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
        <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
            <div class="menu-button-container">
                <button class="mdc-button mdc-menu-button bg-white">
                    <i class="material-icons">filter_list</i>
                    Filter date
                </button>
                <div class="mdc-menu mdc-menu-surface p-0" tabindex="-1">
                    
                    <div class="mdc-layout-grid__inner p-0">
                        
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 bg-light">
                            <div class="mdc-text-field mdc-text-field--outlined">
                                <small class="mt-3 mr-1"><i>from</i></small>
                                <input class="mdc-text-field__input pickdate date_range_filter">
                                <div class="mdc-line-ripple"></div>
                            </div>
                        </div>
                        
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
                            <div class="mdc-text-field mdc-text-field--outlined">
                                <small class="mt-3 mr-1"><i>to</i></small>
                                <input class="mdc-text-field__input pickdate date_range_filter2">
                                <div class="mdc-line-ripple"></div>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
            
        </div>
    </div>
    
</div>

<div class="mdc-layout-grid__inner mb-5">
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3">
        <div class="mdc-card mdc-card--outlined text-center pt-3 pb-2">
            <h4>
                <?php echo count($data);?>
            </h4>
            <br>
            <p>
                Total Order
            </p>
        </div>
    </div>
    
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3">
        <div class="mdc-card mdc-card--outlined text-center pt-3 pb-2">
            <h4>
                <?php
                $paid = 0;
                $unpaid = 0;
                foreach($data as $product){
                    if($product->status == 'paid'){
                        $paid++;
                    }else{
                        $unpaid++;
                    }
                };
                echo $paid;
                ?>
                
            </h4>
            <br>
            <p>
                Total Paid
            </p>
        </div>
    </div>
    
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3">
        <div class="mdc-card mdc-card--outlined text-center pt-3 pb-2">
            <h4>
                <?php echo count($data) > 0 ? round($paid/count($data)*100, 2) . '%' : 0 ; ?>
            </h4>
            <br>
            <p>
                Paid Ratio
            </p>
        </div>
    </div>
    
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3">
        <div class="mdc-card mdc-card--outlined text-center pt-3 pb-2">
            <h4>
                 <?php echo $unpaid; ?>
            </h4>
            <br>
            <p>
                Unpaid Order
            </p>
        </div>
    </div>
</div>

<div class="mdc-layout-grid__inner mb-2">
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3 pl-5">
        <form
            id="form-delete"
            action="<?php echo URL_ROOT; ?>/orders/deletes" 
            method="post">
            <button type="button" id="btn-delete" class="mdc-button mdc-menu-button mdc-button--raised icon-button shaped-button filled-button--secondary" disabled>
                <i class="material-icons mdc-button__icon">remove_circle_outline</i>
            </button>
        </form>
        <h6 class="card-sub-title m-2">Delete</h6>
    </div>
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2">
        <a href="<?php echo URL_ROOT; ?>/orders/add" class="mdc-button mdc-menu-button mdc-button--raised icon-button shaped-button secondary-filled-button">
            <i class="material-icons mdc-button__icon">add</i>
        </a>
        <h6 class="card-sub-title m-2">Add new</h6>
    </div>
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2">
        <button class="mdc-button mdc-menu-button mdc-button--raised icon-button shaped-button secondary-filled-button dt-export">
            <i class="material-icons mdc-button__icon">file_download</i>
        </button>
        <h6 class="card-sub-title m-2">Export</h6>
    </div>
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-5">
        <div style="background: white" class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon search-text-field d-none d-md-flex">
            <i class="material-icons mdc-text-field__icon">search</i>
            <input class="mdc-text-field__input dtb-search">
            <div class="mdc-notched-outline">
                <div class="mdc-notched-outline__leading"></div>
                <div class="mdc-notched-outline__notch">
                    <label for="text-field-hero-input" class="mdc-floating-label">Search..</label>
                </div>
                <div class="mdc-notched-outline__trailing"></div>
            </div>
        </div>
    </div>
</div>

<div class="mdc-card p-2">
    <div class="table-responsive mt-3 mb-3">
        <table class="table tabel-data">
            <thead>
                <tr>
                    <th class="text-left">
                        <input type="checkbox" id="check-all" />
                    </th>
                    <th class="text-center">Customer Name</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Paid at</th>
                    <th class="text-center">Order date</th>
                    <th class="text-center">Follow Up</th>
                    <th class="text-right">#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $val) : ?>
                <tr>
                    <td class="text-left">
                        <input type="checkbox" class="check-item" value="<?php echo $val->id; ?>" />
                    </td>
                    <td class="text-center"><?php echo ucwords($val->customer_name); ?></td>
                    <td class="text-center">
                    <?php echo strlen($val->product_name) > 30 ? ucwords(substr($val->product_name, 0, 25)) . '...' : ucwords($val->product_name); ?>
                    </td>
                    <td class="text-center">
                        <span class="mdc-typography <?php echo $val->status == 'paid' ? 'mdc-theme--info' : 'mdc-theme--secondary'; ?>">
                            <?php echo $val->status; ?>
                        </span>
                    </td>
                    <td class="text-center"><?php echo $val->paid_at ? helper_format_date($val->paid_at, 'Y/m/d') : '-';?></td>
                    <td class="text-center"><?php echo helper_format_date($val->created_at, 'Y/m/d');?></td>
                    
                    <td class="text-center">
                        <span
                            class="wa-btn"
                            dialog-target="dialog-content"
                            dialog-title="Follow up to <?php echo $val->customer_name .' - '. $val->customer_number; ?>"
                            dialog-receiver="<?php echo $val->customer_number; ?>"
                            data-product="<?php echo ucwords($val->product_name) ?>"
                            data-name="<?php echo ucwords($val->customer_name) ?>"
                            data-price="Rp <?php echo toCurrency($val->total_price, false, true);  ?>"
                            onclick="toggleModal(this);"
                        >
                            <img src="<?php echo URL_ROOT; ?>/assets/images/icons/whatsapp_24.png" onmouseover="hover(this);" onmouseout="unhover(this);" />
                        </span>
                    </td>
                    <td class="text-right">
                        <a href="<?php echo URL_ROOT; ?>/orders/edit/<?php echo $val->id; ?>" class="mdc-button mdc-button--raised icon-button filled-button--success btn-action p-2">
                            <i class="material-icons mdc-button__icon">mode_edit</i>
                        </a>
                    </td>
                </tr>
                
                
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="dialog" id="dialog-content">
    <?php require APP_ROOT . '/views/orders/followup_template.php' ?>
    <button id="send-wa" class="mdc-button mdc-button--raised filled-button--success btn-action fl-left" disabled>send whatsapp now</button>
    <button class="mdc-button mdc-button--raised filled-button--dark btn-action fl-right">cancel</button>
</div>

<script>
    function hover(element) {
        element.setAttribute('src', '<?php echo URL_ROOT; ?>/assets/images/icons/whatsapp_black_24.png');
    }
      
    function unhover(element) {
        element.setAttribute('src', '<?php echo URL_ROOT; ?>/assets/images/icons/whatsapp_24.png');
    }

    function toggleModal(e) {
        let targetID = $(e).attr('dialog-target');
        
        
        $(".dialog").dialog({
            autoOpen: false,
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
            },
            title: $(e).attr('dialog-title'),
            focus: true,
            modal: true,
            show: 'fade',
            hide: 'fade',
            width: 550,
            height: 350,
        });
        
        let box = $("#dialog-content");
        box.dialog("open");
        var boxInput = box.find('textarea');
        let waNumber = $(e).attr('dialog-receiver');

        let productName = $(e).data('product');
        let customerName = $(e).data('name');
        let orderPrice = $(e).data('price');
	let payments = <?php echo json_encode($opt['payments']); ?>;
	let paymentText = payments.map(el => {
	const tXt = 
`
`+el.vendor+`
No. Rek: `+el.account_number+`
Atas Nama: `+el.account_name+`
`;
		return tXt;
	}).join('');

        let sendClose = box.find('button#send-wa');
        let closeBtn = box.find('button');
    var message = 
`Selamat! Kak *`+customerName+`* Berhasil Ikutan Kelas *`+productName+`* 
Perkenalkan saya CS Laruno ☺️🤝

Selamat! Anda masih bisa dapat harga promo minggu ini untuk pendaftaran di Laruno 😎 
Produk Pesanan : *`+productName+`*
Harga Promo Bulan Ini : *`+orderPrice+`*

Segera Lakukan Pembayaran *`+orderPrice+`*, ke salah satu rekening dibawah ini:
`+paymentText+`
Terimakasih,
Salam Dahsyat!`;

        let boxText = boxInput.text(message);
        // console.log('message: ', message);
            
        if (boxText.length == 0) {
            sendClose.prop('disabled', true);
        }else{
            sendClose.prop('disabled', false);
        }

        closeBtn.click(() => $(".dialog").dialog("close"));
        sendClose.click(function(){
	    //waNumber = '+6287771837545';

	    if(waNumber.charAt(0) == '0' || waNumber.charAt(0) == 0){
		waNumber = waNumber.replace(waNumber.charAt(0), "+62");
	    }

	    if(waNumber.charAt(0) == '8' || waNumber.charAt(0) == 8){
	    	waNumber = '+62'+waNumber;
	    }
		//%0D%0A

	    //let url = 'https://wa.me/'+waNumber+'?text='+encodeURIComponent(message);
	    //let url = 'whatsapp://send?phone='+waNumber+'&text='+ encodeURIComponent(message);
	    let url = 'https://api.whatsapp.com/send?phone='+waNumber+'&text='+encodeURIComponent(message);
            
            window.open(url, '_blank');
        });
    }

    //Datatable
    var oTable = $('.tabel-data').DataTable({
        dom: 'lrtip',
        "oLanguage": {
            "sSearch": "Filter Data" //Will appear on search form
        },
        fixedHeader: {
            header: true, //Table have header and footer
            footer: true
        },
        // responsive: true,
        buttons: [
            { 
                extend: 'excel',
                messageTop: 'Order Data',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5 ]
                }
            }
        ]
    });
            
    //Search Datatable
    $('.dtb-search').keyup(function(){
        oTable.search($(this).val()).draw();
    });
    
    $(".check-filter").click(function(){
        renderCheckFilter();
    });
    
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('.date_range_filter').val();
            var max = $('.date_range_filter2').val();
            var createdAt = data[5];

            if (
            (min == "" || max == "") ||
            (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
            ) {
                return true;
            }
         
            return false;
        }
    );
    
    $(".dt-export").on("click", function() {
        oTable.button( '.buttons-excel' ).trigger();
    });

    $('.pickdate').each(function() {
        $(this).datepicker({
            format: 'mm/dd/yyyy',
            changeMonth: true,
            changeYear: true
        });
     });
    
    $('.pickdate').change(function() {
        oTable.draw();
    });

    //Delete event
    $(".check-item").click(function(){
        var checkValue = $(this).val();

        console.log(checkValue);
        
        var option_id = [];
        $('.check-item:checked').each(function(i) {
            option_id[i] = $(this).val();       
        });

        if (option_id.length === 0){
            $("#btn-delete").prop("disabled", true)
            $("#check-all").prop("checked", false)
        }else{
            $("#btn-delete").prop("disabled", false)    
        }
    });

    // Checkbox delete
    $("#check-all").click(function(){
        if($(this).is(":checked")){
            $(".check-item").prop("checked", true);
        }else{
            $(".check-item").prop("checked", false);
        }
        
        var option_id = [];
        $('.check-item:checked').each(function(i) {
            option_id[i] = $(this).val();
        });

        if (option_id.length === 0){
            $("#btn-delete").prop("disabled", true)
        }else{
            $("#btn-delete").prop("disabled", false)        
        }
    });

    function renderCheckFilter() {
        var filtCheck = [];
        $('.check-filter:checked').each(function(i) {
            filtCheck[i] = $(this).val();
        });
        
        oTable.search(filtCheck.join('|'), true, false).draw();
    }

    function toCheck(e) {
            
        let xCheck = $(e).find('input.check-filter')
        console.log('xCheck', xCheck);
        
        if(xCheck.is(": checked")){
            xCheck.prop("checked", false);
        }else{
            xCheck.prop("checked", true);
        }
        
        renderCheckFilter();
    }

    function confirmDialog(message, form) {
        $('<div></div>').appendTo('body')
        .html('<div><h6>' + message + '?</h6></div>')
        .dialog({
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
            },
            modal: true,
            focus: true,
            title: 'Delete Confirm',
            zIndex: 10000,
            autoOpen: true,
            width: 'auto',
            resizable: false,
            
            buttons: [
                {
                    text: "Yes",
                    "class": 'mdc-button mdc-button--raised filled-button--secondary btn-action fl-left',
                    click: function() {                     
                        form.submit();
                    }
                },
                {
                    text: "No",
                    "class": 'mdc-button mdc-button--raised filled-button--dark btn-action fl-right',
                    click: function() {
                        $(this).dialog("close"); 
                    }
                }
            ]
        });
    };

    $("#btn-delete").click(function(){
        let checkList = $(".check-item").val();
        
        var form = $("#form-delete");
        var option_id = [];
        $('.check-item:checked').each(function(i) {
            option_id[i] = $(this).val();
            var input = $("<input>")
                   .attr("type", "hidden")
                   .attr("name", "IDS[]").val($(this).val());
            form.append(input);
        });
        
        if (option_id.length === 0) {
            alert("please select atleast one");
        }else{
            confirmDialog('Are you sure delete ?', form);
        }
    });

    function toCheck(e) {
        console.log(e);
        let xCheck = $(e).find('input.check-filter')
        
        if(xCheck.is(":checked")){
            xCheck.prop("checked", false);
        }else{
            xCheck.prop("checked", true);
        }
        
        renderCheckFilter();
    }
    
    function renderCheckFilter() {
        var filtCheck = [];
        $('.check-filter:checked').each(function(i) {
            filtCheck[i] = $(this).val();
        });
        
        oTable.search(filtCheck.join('|'), true, false).draw();
    }
</script>

<?php require APP_ROOT . '/views/inc/_bottom.php' ?>
