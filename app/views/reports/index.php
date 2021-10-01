<?php require APP_ROOT . '/views/inc/_top.php' ?>

<?php flash('msg'); ?>

<div class="mdc-layout-grid__inner mt-0 mb-5">
    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3">
        <h3 style="border: silver dotted;" class="text-center p-2">Report</h3>
    </div>
    
    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-5"></div>
    
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
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop">
        <div class="mdc-card mdc-card--outlined text-center pt-3 pb-2">
            <h4>
                <?php echo count($data); ?>
            </h4>
            <br>
            <p>
                Total Paid
            </p>
        </div>
    </div>
    
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop">
        <div class="mdc-card mdc-card--outlined text-center pt-3 pb-2">
            <h4>
                <?php echo count($opt['count_customer']); ?>
            </h4>
            <br>
            <p>
                Total Customer
            </p>
        </div>
    </div>
    
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop">
        <div class="mdc-card mdc-card--outlined text-center pt-3 pb-2">
            <h4>
                <?php echo count($opt['cout_product']); ?>
            </h4>
            <br>
            <p>
                Total Product
            </p>
        </div>
    </div>
    
    
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop">
        <div class="mdc-card mdc-card--outlined text-center pt-3 pb-2">
            <h4>
                <?php
                    $text = 0;
                    $thisMonth = Date('m');
                    
                    foreach($opt['prices'] as $key => $val){
                        if($val->month == $thisMonth) $text = $val->total_value;
                    }
                    
                    echo toCurrency($text, true);
                ?>
            </h4>
            <br>
            <p>
                Total Income (<?php echo $opt['month'][$thisMonth - 1]; ?>)
            </p>
        </div>
    </div>
</div>

<div class="mdc-layout-grid__inner mb-2">
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4 pl-4">
        <button class="mdc-button mdc-menu-button mdc-button--raised icon-button shaped-button secondary-filled-button dt-export">
            <i class="material-icons mdc-button__icon">file_download</i>
        </button>
        <h6 class="card-sub-title m-2">Export</h6>
    </div>
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2"></div>
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-1"></div>
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

<!--<div class="mdc-layout-grid__inner">-->
    <!--<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">-->
        <div class="mdc-card p-2">
            <div class="table-responsive mt-3 mb-3">
                <table class="table" id="table-report">
                    <thead>
                        <tr>
                            <th class="text-center">Customer name</th>
                            <th class="text-center">Product name</th>
                            <th class="text-center">transfer to</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Order date</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($data) >= 1 && $data[0]->id != null): ?>
                        
                        <?php foreach($data as $val) : ?>
                        <tr>
                            <td class="text-center"><?php echo ucwords($val->customer_name); ?></td>
                            <td class="text-center">
                            <?php echo strlen($val->product_name) > 30 ? ucwords(substr($val->product_name, 0, 25)) . '...' : ucwords($val->product_name); ?>
                            </td>
                            <td class="text-center"><?php echo strtoupper($val->vendor .' - '. $val->account_name .' - '. $val->account_number); ?></td>
                            <td class="text-center">
                                <span class="mdc-typography <?php echo $val->status == 'paid' ? 'mdc-theme--info' : 'mdc-theme--secondary'; ?>">
                                    <?php echo $val->status; ?>
                                </span>
                            </td>
                             <td class="text-center"><?php echo $val->qty; ?></td>
                            <td class="text-center"><?php echo $val->created_at ? helper_format_date($val->created_at, 'Y/m/d') : '-' ;?></td>
                            <td class="text-right"><?php echo toCurrency($val->total_price); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php else: ?>
                            <tr>
                                <td class="text-center" colspan="7">empty data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <!--</div>-->
<!--</div>-->

<script>
    var dTabel = $('#table-report').DataTable({
        dom: 'lrtip',
        "oLanguage": {
            "sSearch": "Filter Data" //Will appear on search form
        },
        fixedHeader: {
            header: true, //Table have header and footer
            footer: true
        },
        // autoFill: true,
        // responsive: true,
        buttons: [
            { 
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            }
        ]
    });
            
    //Search Datatable
    $('.dtb-search').keyup(function(){
        dTabel.search($(this).val()).draw();
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
        dTabel.button( '.buttons-csv' ).trigger();
    });

    $('.pickdate').each(function() {
        $(this).datepicker({
            format: 'mm/dd/yyyy',
            changeMonth: true,
            changeYear: true
        });
     });
    
    $('.pickdate').change(function() {
        dTabel.draw();
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
</script>

<?php require APP_ROOT . '/views/inc/_bottom.php' ?>