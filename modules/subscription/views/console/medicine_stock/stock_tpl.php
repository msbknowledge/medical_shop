<?php
// Stock List Template - Smart School UI Upgrade
?>
<div class="index-wrapper">
    <div class="ss-card">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-cubes"></i> Medicine Stock List
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <div id="amount_re_box" style="display: flex; align-items: center; gap: 10px; background: rgba(99, 102, 241, 0.08); padding: 6px 14px; border-radius: 9999px; border: 1px solid rgba(99, 102, 241, 0.2);">
                    <span id="amount_re" style="font-size: 13px; font-weight: 700; color: var(--ss-primary);">Total Stock MRP: RS --</span>
                    <button id="amount_show" class="btn btn-xs ss-btn-primary" style="padding: 2px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px;">Calculate</button>
                    <span id="wait_message" style="display: none; font-size: 11.5px; color: var(--ss-warning); font-weight: 600;"><i class="fa fa-spinner fa-spin"></i> Calculating...</span>
                </div>
            </div>
        </div>

        <div style="padding: 20px;">
            <!-- Search Filter Bar -->
            <form action="<?= base_url() ?>console/medicine_stock/stock" id="searchform" role="form" method="post" onsubmit="return false">
                <div class="row-fluid" style="display: flex; gap: 12px; align-items: center; margin-bottom: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px; position: relative;">
                        <i class="fa fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--ss-text-muted);"></i>
                        <input type="text" name="medicine_name" id="medicine_name" placeholder="Search medicine by name..." class="form-control" style="width: 100%; padding-left: 38px; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px;" />
                    </div>
                    <div>
                        <button type="submit" id="search" class="btn ss-btn-primary" style="height: 40px; padding: 0 20px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-search"></i> Search Stock
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 12px;">
                <table class="table ss-modern-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="width: 70px; text-align: center;">Sl No.</th>
                            <th>Medicine Name</th>
                            <th>Manufacturer</th>
                            <th>Unit</th>
                            <th style="text-align: center;">Strip Stock</th>
                            <th style="text-align: center;">Loose Stock</th>
                            <th>Storage Location</th>
                        </tr>
                    </thead>
                    <tbody id="searchResult">
                    </tbody>
                    <tfoot class="tfoot">
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 15px; background: #fafbfc;"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var reqst = null;
    $(document).ready(function() {
        $('#amount_show').click(function() {
            $("#amount_show").hide();
            $("#wait_message").show();
            reqst = $.post("<?= base_url() ?>console/medicine_stock/current_stock/", function(resp) {
                var obj = JSON.parse(resp);
                if (obj.status == "success") {
                    $("#wait_message").hide();
                    var total_result = Math.round(obj.result);
                    $("#amount_re").html("Total Stock MRP: ₹ " + total_result + "/-");
                } else {
                    $("#wait_message").hide();
                    $("#amount_re").html("Stock MRP not found");
                }
            });
        });
    });

    var pageCount = 1;

    function search() {
        if (pageCount == 1) {
            $('#searchResult').html("<tr><td colspan='7' style='text-align: center; padding: 25px; color: var(--ss-text-muted);'><i class='fa fa-spinner fa-spin fa-2x'></i><br><br>Searching Results...</td></tr>");
        }

        $.post($('#searchform').attr("action") + "?page=" + pageCount, $('#searchform').serialize(), function(resp) {
            var objresp = JSON.parse(resp);

            if (objresp.status == "not found") {
                $('#searchResult').show();
                if (pageCount == 1) {
                    $('#searchResult').html("<tr><td colspan='7' style='text-align: center; padding: 40px; color: var(--ss-text-muted);'><i class='fa fa-info-circle fa-2x' style='color: var(--ss-text-muted); opacity: 0.5;'></i><p style='margin-top: 10px; font-weight: 600;'>No Result Found</p></td></tr>");
                }
                $('tfoot').html("");
            } else {
                if (objresp.status == "found") {
                    $('#excelexport').removeAttr('disabled');
                }

                if (pageCount == 1) {
                    $('#searchResult').html("");
                }

                if (objresp.result.length < 20) {
                    $('tfoot').html("<tr><td colspan='7' style='text-align: center; padding: 12px; color: var(--ss-text-muted); font-size: 12px; font-weight: 600;'>No More Results Found</td></tr>");
                } else {
                    $('tfoot').html("<tr><td colspan='7' style='text-align: center; padding: 12px;'><button class='btn ss-btn-secondary' onclick='search()' id='loadmore' style='border-radius: 9999px; padding: 6px 24px; font-weight: 600;'><i class='fa fa-refresh'></i> Load More</button></td></tr>");
                }

                var perpage = 50;
                var counter = 1;
                if (pageCount == 1) {
                    counter = pageCount;
                } else {
                    var count = (pageCount - 1) * perpage;
                    counter = count + 1;
                }

                $.each(objresp.result, function(k, v) {
                    var medicine_id = btoa(v.medicine_id);
                    var tr_des = $("<tr/>");

                    var count_td = $("<td style='text-align: center; font-weight: 600; color: var(--ss-text-muted);'/>").append(counter);
                    $(tr_des).append(count_td);

                    var name_td = $("<td style='font-weight: 600; color: var(--ss-text-main);'/>").append(v.medicine_name);
                    $(tr_des).append(name_td);

                    var manufacturer_td = $("<td style='color: var(--ss-text-body);'/>").append(v.medicine_manufacturer || "-");
                    $(tr_des).append(manufacturer_td);

                    var unit_td = $("<td/>").append("<span style='background: var(--ss-bg); padding: 3px 8px; border-radius: 6px; font-size: 11.5px; border: 1px solid var(--ss-border);'>" + (v.medicine_unit || "-") + "</span>");
                    $(tr_des).append(unit_td);

                    if (parseInt(v.left_strip) < 3) {
                        var stock_td = $('<td style="text-align: center;"/>').append("<span class='ss-badge ss-badge-danger'><i class='fa fa-exclamation-triangle'></i> " + v.left_strip + "</span>");
                        $(tr_des).append(stock_td);
                    } else {
                        var stock_td = $('<td style="text-align: center;"/>').append("<span class='ss-badge ss-badge-success'>" + v.left_strip + "</span>");
                        $(tr_des).append(stock_td);
                    }

                    var loose_td = $("<td style='text-align: center; font-weight: 600;'/>").append(v.left_loose);
                    $(tr_des).append(loose_td);

                    var storage_td = $("<td style='color: var(--ss-text-muted); font-size: 12px;'/>").append(v.medicine_storage ? "<i class='fa fa-map-marker'></i> " + v.medicine_storage : "-");
                    $(tr_des).append(storage_td);

                    $('#searchResult').append(tr_des);
                    counter++;
                });
                pageCount = pageCount + 1;
            }
        });
    }

    $(document).ready(function() {
        $("#searchform").submit(function() {
            pageCount = 1;
            search();
        });
        $('#searchform').trigger(search());
    });
</script>
