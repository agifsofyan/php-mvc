<?php require APP_ROOT . '/views/inc/_top.php' ?>

<?php flash('msg_error'); ?>
<?php flash('msg_success'); ?>

<div class="mdc-layout-grid__inner mt-0 mb-5">
    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4">
        <h3 style="border: silver dotted;" class="text-center p-2">User</h3>
    </div>
    
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4"></div>
    
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

<div class="mdc-layout-grid__inner mb-2">
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3 pl-4">
        <form
            id="form-delete"
            action="<?php echo URL_ROOT; ?>/users/deletes" 
            method="post">
            <button type="button" id="btn-delete" class="mdc-button mdc-menu-button mdc-button--raised icon-button shaped-button filled-button--secondary" disabled>
                <i class="material-icons mdc-button__icon">remove_circle_outline</i>
            </button>
        </form>
        <h6 class="card-sub-title m-2">Delete</h6>
    </div>
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3">
        <a href="<?php echo URL_ROOT; ?>/users/add" class="mdc-button mdc-menu-button mdc-button--raised icon-button shaped-button secondary-filled-button">
            <i class="material-icons mdc-button__icon">add</i>
        </a>
        <h6 class="card-sub-title m-2">Add new</h6>
    </div>
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

<div class="mdc-card p-2">
    <div class="table-responsive mt-3 mb-3">
        <table class="table tabel-data">
            <thead>
                <tr>
                    <th class="text-left">
                        <input type="checkbox" id="check-all" />
                    </th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Role (level)</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Last Login</th>
                    <th class="text-center">Created At</th>
                    <th class="text-right">#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $val) : ?>
                <tr>
                    <td class="text-left">
                        <input type="checkbox" class="check-item" value="<?php echo $val->id; ?>" />
                    </td>
                    <td class="text-center"><?php echo ucwords($val->username); ?></td>
                    <td><?php echo ucwords($val->role); ?></td>
                    <td class="text-center">
                        <span class="mdc-typography <?php echo $val->is_active ? 'mdc-theme--info' : 'mdc-theme--secondary'; ?>">
                            <?php echo $val->is_active ? 'Active' : 'Inactive'; ?>        
                        </span>
                    </td>
                    <td class="text-center"><?php echo $val->last_login ? helper_format_date($val->last_login, 'Y/m/d') : '-'; ?></td>
                    <td class="text-center"><?php echo $val->create_at ? helper_format_date($val->create_at, 'Y/m/d') : '-'; ?></td>
                    <td class="text-right">
                        <a href="<?php echo URL_ROOT; ?>/users/edit/<?php echo $val->id; ?>" class="mdc-button mdc-button--raised icon-button filled-button--success btn-action p-2">
                            <i class="material-icons mdc-button__icon">mode_edit</i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
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
                messageTop: 'User Data',
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