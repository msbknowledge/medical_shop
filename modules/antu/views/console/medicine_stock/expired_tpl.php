<div class="index-wrapper">
    <div class="row-fluid sortable search_box ui-sortable">
        <div class="box span12 ss-card">
            <div class="box-header well ss-card-header" data-original-title="">
                <h2><i class="fa fa-calendar-times-o" style="color:var(--ss-danger, #ef4444);"></i> <span>Expired Medicine Sheet</span></h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content ss-card-body">
                <div class="display_print">
                    <div style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.15); border-radius: 10px; padding: 10px 16px; margin-bottom: 16px; display:flex; align-items:center; gap:8px;">
                        <i class="fa fa-info-circle" style="color: var(--ss-danger, #ef4444); font-size: 16px;"></i>
                        <span style="font-size: 13px; color: var(--ss-danger, #ef4444); font-weight: 600;">Shows purchase medicines that have passed their expiration date.</span>
                    </div>

                    <form action="<?= base_url() ?>console/medicine_stock/expired" id="searchform" role="form" method="post" onsubmit="return false" style="margin-bottom: 20px;">
                        <div style="display: flex; gap: 12px; align-items: flex-end; max-width: 500px;">
                            <div style="flex: 1;">
                                <label for="medicine_name" style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--ss-text-muted, #64748b); margin-bottom: 6px; display: block;">Medicine Name</label>
                                <input type="text" name="medicine_name" id="medicine_name" placeholder="Search medicine name..." class="form-control" style="width: 100%; border: 1px solid var(--ss-border, #cbd5e1); border-radius: 8px; padding: 8px 12px; font-size: 13.5px;" />
                            </div>
                            <div>
                                <button type="submit" id="search" class="btn btn-primary ss-btn-primary" style="padding: 8px 18px; font-weight: 700;">
                                    <i class="fa fa-search"></i> SEARCH
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive" style="margin: 0px; overflow-x: auto;">
                    <table class="table table-bordered table-striped table-condensed ss-modern-table css-serial">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Sl No.</th>
                                <th>Medicine Name</th>
                                <th>Batch</th>
                                <th>Purchase Date</th>
                                <th>Stock Strip</th>
                                <th>Stock Loose</th>
                                <th>Manufacturer</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Storage</th>
                            </tr>
                        </thead>
                        <tbody id="searchResult">
                        </tbody>
                        <tfoot class="tfoot">
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div> 

<script>
    function myFunction(current_month) {
        var month = new Array();
        month[1] = "January";
        month[2] = "February";
        month[3] = "March";
        month[4] = "April";
        month[5] = "May";
        month[6] = "June";
        month[7] = "July";
        month[8] = "August";
        month[9] = "September";
        month[10] = "October";
        month[11] = "November";
        month[12] = "December";
        return month[current_month];
    }

    var pageCount = 1;

    function search() {
        if (pageCount == 1) {
            $('#searchResult').html("<tr><td colspan=10 style='text-align:center; padding:20px; color:var(--ss-text-muted);'><i class='fa fa-spinner fa-spin'></i> Searching Results...</td></tr>");
            $('#searchResult').show();
        }

        $.post($('#searchform').attr("action") + "?page=" + pageCount, $('#searchform').serialize(), function(resp) {
            if (resp.status == "found") {
                if (Object.keys(resp.result).length > 0) {
                    if (pageCount == 1) {
                        $('#searchResult').html("");
                    }
                    $('tfoot').html("<tr><td colspan=10 style='text-align:center; padding:12px;'><button class='btn btn-default' onclick='search()' id='loadmore' style='border-radius:8px; font-weight:600;'><i class='fa fa-arrow-down'></i> Load More</button></td></tr>");
                    
                    if (pageCount == 1) {
                        var counter = pageCount;
                    } else {
                        var getper = localStorage.getItem("previousCount");
                        var counter = parseInt(getper);
                    }

                    $.each(resp.result, function(k, v) {
                        var tr_des = $("<tr/>");
                        tr_des.append($("<td/>").text(counter));
                        tr_des.append($("<td/>").html("<a href='<?= console_url(); ?>medicine_stock/fast_update/" + v.medicine_id + "' target='_blank' style='font-weight:700; color:var(--ss-primary);'>" + v.medicine_name + "</a>"));
                        tr_des.append($("<td/>").text(v.purchase_batch));
                        tr_des.append($("<td/>").text(v.purchase_date));
                        tr_des.append($("<td/>").text(v.left_strip));
                        tr_des.append($("<td/>").text(v.left_loose));
                        tr_des.append($("<td/>").text(v.medicine_manufacturer));
                        tr_des.append($("<td/>").text(myFunction(v.purchase_expire_month)));
                        tr_des.append($("<td/>").text("20" + v.purchase_expire_year));
                        tr_des.append($("<td/>").text(v.medicine_storage));

                        $('#searchResult').append(tr_des);
                        counter++;
                        localStorage.setItem("previousCount", counter);
                    });
                    pageCount = pageCount + 1;
                } else {
                    pageCount = pageCount + 1;
                    search();
                }
            } else {
                $('#searchResult').html("<tr><td colspan=10 style='text-align:center; padding:24px; color:var(--ss-text-muted);'><i class='fa fa-check-circle' style='color:var(--ss-success); font-size:20px; display:block; margin-bottom:6px;'></i> No expired medicines found.</td></tr>");
                $('tfoot').html("");
            }
        }, 'json');
    }

    $(document).ready(function() {
        $("#searchform").submit(function() {
            pageCount = 1;
            search();
        });
        search();
    });
</script>