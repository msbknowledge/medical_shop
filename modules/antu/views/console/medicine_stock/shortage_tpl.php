<?php
// Medicine Shortage Template - Smart School UI Upgrade
?>
<div class="index-wrapper">
    <div class="ss-card">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-exclamation-circle" style="color: var(--ss-warning);"></i> Medicine Shortage Alert
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <span class="ss-badge ss-badge-danger" style="font-size: 12px; padding: 5px 12px;">
                    <i class="fa fa-info-circle"></i> Low Stock Threshold: &lt; 3 Strips
                </span>
            </div>
        </div>

        <div style="padding: 20px;">
            <form action="<?= base_url() ?>console/medicine_stock/shortage" id="searchform" role="form" method="post" onsubmit="return false">
                <div class="row-fluid" style="display: flex; gap: 12px; align-items: center; margin-bottom: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px; position: relative;">
                        <i class="fa fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--ss-text-muted);"></i>
                        <input type="text" name="medicine_name" id="medicine_name" placeholder="Filter shortage medicines by name..." class="form-control" style="width: 100%; padding-left: 38px; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px;" />
                    </div>
                    <div>
                        <button type="submit" id="search" class="btn ss-btn-primary" style="height: 40px; padding: 0 20px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-search"></i> Search Shortage
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
                            <th style="text-align: center;">Stock Strips</th>
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
    var pageCount = 1;

    function search() {
        if (pageCount == 1) {
            $('#searchResult').html("<tr><td colspan='7' style='text-align: center; padding: 25px; color: var(--ss-text-muted);'><i class='fa fa-spinner fa-spin fa-2x'></i><br><br>Searching Shortage Medicines...</td></tr>");
        }

        $.post($('#searchform').attr("action") + "?page=" + pageCount, $('#searchform').serialize(), function(resp) {
            if (resp.status == "found") {
                $('#excelexport').removeAttr('disabled');

                if (pageCount == 1) {
                    $('#searchResult').html("");
                }

                if (Object.keys(resp.result).length < 100) {
                    $('tfoot').html("<tr><td colspan='7' style='text-align: center; padding: 12px; color: var(--ss-text-muted); font-size: 12px; font-weight: 600;'>No More Results Found</td></tr>");
                } else {
                    $('tfoot').html("<tr><td colspan='7' style='text-align: center; padding: 12px;'><button class='btn ss-btn-secondary' onclick='search()' id='loadmore' style='border-radius: 9999px; padding: 6px 24px; font-weight: 600;'><i class='fa fa-refresh'></i> Load More</button></td></tr>");
                }

                var counter = 1;
                if (pageCount == 1) {
                    counter = pageCount;
                } else {
                    var $getper = localStorage.getItem("previousCount");
                    counter = parseInt($getper) || 1;
                }

                $.each(resp.result, function(k, v) {
                    if (parseInt(v.left_strip) < 3) {
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

                        var stock_td = $('<td style="text-align: center;"/>').append("<span class='ss-badge ss-badge-danger'><i class='fa fa-warning'></i> " + v.left_strip + "</span>");
                        $(tr_des).append(stock_td);

                        var loose_td = $("<td style='text-align: center; font-weight: 600;'/>").append(v.left_loose);
                        $(tr_des).append(loose_td);

                        var storage_td = $("<td style='color: var(--ss-text-muted); font-size: 12px;'/>").append(v.medicine_storage ? "<i class='fa fa-map-marker'></i> " + v.medicine_storage : "-");
                        $(tr_des).append(storage_td);

                        $('#searchResult').append(tr_des);
                        counter++;
                        localStorage.setItem("previousCount", counter);
                    }
                });
                pageCount = pageCount + 1;
            } else {
                $('#searchResult').show();
                if (pageCount == 1) {
                    $('#searchResult').html("<tr><td colspan='7' style='text-align: center; padding: 40px; color: var(--ss-text-muted);'><i class='fa fa-check-circle fa-2x' style='color: var(--ss-success); opacity: 0.7;'></i><p style='margin-top: 10px; font-weight: 600; color: var(--ss-text-main);'>No Medicines in Shortage</p></td></tr>");
                }
                $('tfoot').html("");
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
