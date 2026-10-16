<?php
// Upcoming Expire Sheet - Smart School UI Upgrade
?>
<div class="index-wrapper">
    <div class="ss-card">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-clock-o" style="color: var(--ss-warning);"></i> Upcoming Expiry Medicines
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <span class="ss-badge ss-badge-warning" style="font-size: 12px; padding: 5px 12px;">
                    <i class="fa fa-calendar"></i> Purchase Medicine Expiry Tracker
                </span>
            </div>
        </div>

        <div style="padding: 20px;">
            <form action="<?= base_url() ?>console/medicine_stock/expiring" id="searchform" role="form" method="post" onsubmit="return false">
                <div class="row-fluid" style="display: flex; gap: 12px; align-items: center; margin-bottom: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px; position: relative;">
                        <i class="fa fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--ss-text-muted);"></i>
                        <input type="text" name="medicine_name" id="medicine_name" value="<?= isset($medicine_name) ? htmlspecialchars($medicine_name) : '' ?>" required placeholder="Search upcoming expiring medicine..." class="form-control" style="width: 100%; padding-left: 38px; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px;" />
                    </div>
                    <div>
                        <button type="submit" id="search" class="btn ss-btn-primary" style="height: 40px; padding: 0 20px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-search"></i> Check Expiry
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 12px;">
                <table class="table ss-modern-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="width: 60px; text-align: center;">Sl No.</th>
                            <th>Medicine Name</th>
                            <th>Batch</th>
                            <th>Purchase Date</th>
                            <th style="text-align: center;">Strip Stock</th>
                            <th style="text-align: center;">Loose Stock</th>
                            <th>Manufacturer</th>
                            <th style="text-align: center;">Expiry Month</th>
                            <th style="text-align: center;">Expiry Year</th>
                            <th>Storage</th>
                        </tr>
                    </thead>
                    <tbody id="searchResult">
                    </tbody>
                    <tfoot class="tfoot">
                        <tr>
                            <td colspan="10" style="text-align: center; padding: 15px; background: #fafbfc;"></td>
                        </tr>
                    </tfoot>
                </table>
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
        return month[current_month] || current_month;
    }

    var pageCount = 1;

    function search() {
        if (pageCount == 1) {
            $('#searchResult').html("<tr><td colspan='10' style='text-align: center; padding: 25px; color: var(--ss-text-muted);'><i class='fa fa-spinner fa-spin fa-2x'></i><br><br>Searching Expiry Records...</td></tr>");
        }

        $.post($('#searchform').attr("action") + "?page=" + pageCount, $('#searchform').serialize(), function(resp) {
            if (resp.status == "found" && Object.keys(resp.result).length > 0) {
                if (pageCount == 1) {
                    $('#searchResult').html("");
                }

                $('tfoot').html("<tr><td colspan='10' style='text-align: center; padding: 12px;'><button class='btn ss-btn-secondary' onclick='search()' id='loadmore' style='border-radius: 9999px; padding: 6px 24px; font-weight: 600;'><i class='fa fa-refresh'></i> Load More</button></td></tr>");

                var counter = 1;
                if (pageCount == 1) {
                    counter = pageCount;
                } else {
                    var $getper = localStorage.getItem("previousCount");
                    counter = parseInt($getper) || 1;
                }

                $.each(resp.result, function(k, v) {
                    var medicine_id = btoa(v.medicine_id);
                    var tr_des = $("<tr/>");

                    var count_td = $("<td style='text-align: center; font-weight: 600; color: var(--ss-text-muted);'/>").append(counter);
                    $(tr_des).append(count_td);

                    var name_td = $("<td style='font-weight: 600;'/>").append(
                        "<a href='<?= console_url() ?>medicine_stock/fast_update/" + v.medicine_id + "' target='_blank' style='color: var(--ss-primary); text-decoration: none;'><i class='fa fa-external-link'></i> " + v.medicine_name + "</a>"
                    );
                    $(tr_des).append(name_td);

                    var batch_td = $("<td style='font-family: monospace; font-weight: 600; color: var(--ss-text-body);'/>").append(v.purchase_batch);
                    $(tr_des).append(batch_td);

                    var date_td = $("<td style='color: var(--ss-text-muted); font-size: 12px;'/>").append(v.purchase_date);
                    $(tr_des).append(date_td);

                    var left_strip_td = $("<td style='text-align: center; font-weight: 600;'/>").append(v.left_strip);
                    $(tr_des).append(left_strip_td);

                    var left_loose_td = $("<td style='text-align: center; font-weight: 600;'/>").append(v.left_loose);
                    $(tr_des).append(left_loose_td);

                    var manufacturer_td = $("<td style='color: var(--ss-text-body);'/>").append(v.medicine_manufacturer || "-");
                    $(tr_des).append(manufacturer_td);

                    var getmonth = myFunction(v.purchase_expire_month);
                    var month_td = $("<td style='text-align: center;'/>").append("<span class='ss-badge ss-badge-danger'>" + getmonth + "</span>");
                    $(tr_des).append(month_td);

                    var year_td = $("<td style='text-align: center; font-weight: 600;'/>").append("20" + v.purchase_expire_year);
                    $(tr_des).append(year_td);

                    var storage_td = $("<td style='color: var(--ss-text-muted); font-size: 12px;'/>").append(v.medicine_storage ? "<i class='fa fa-map-marker'></i> " + v.medicine_storage : "-");
                    $(tr_des).append(storage_td);

                    $('#searchResult').append(tr_des);
                    counter++;
                    localStorage.setItem("previousCount", counter);
                });
                pageCount = pageCount + 1;
            } else {
                $('#searchResult').show();
                if (pageCount == 1) {
                    $('#searchResult').html("<tr><td colspan='10' style='text-align: center; padding: 40px; color: var(--ss-text-muted);'><i class='fa fa-check-circle fa-2x' style='color: var(--ss-success); opacity: 0.7;'></i><p style='margin-top: 10px; font-weight: 600;'>No upcoming expiring medicines found</p></td></tr>");
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

        $(document).find('[name^="medicine_name"]').autocomplete({
            source: '/search.php?table=medicines&fieldToSearch=medicine_name',
            search: function(event, ui) {
                $('.medicine_chooser').find('input').not('[name^="medicine_name"]').val('');
            },
            minLength: 1,
            select: function(event, ui) {
                targetRow = $(this).parents('.medicine_chooser');
                $.each(ui.item.complete, function(populate_field, populate_value) {
                    $(targetRow).find('[name^="' + populate_field + '"').val(populate_value);
                });
                $('.rowadd').html('');
                $('#searchform').trigger(search());
            }
        });
    });
</script>