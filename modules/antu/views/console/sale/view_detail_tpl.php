<style>
    .ss-invoice-box {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid var(--ss-border, #e2e8f0);
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        margin-bottom: 24px;
    }
    .ss-invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding-bottom: 20px;
        border-bottom: 1.5px solid var(--ss-border, #e2e8f0);
        margin-bottom: 20px;
    }
    .ss-party-card {
        background: var(--ss-bg-soft, #f8fafc);
        border: 1px solid var(--ss-border, #e2e8f0);
        border-radius: 10px;
        padding: 14px 18px;
        flex: 1;
        margin: 0 8px;
    }
    .ss-party-card:first-child { margin-left: 0; }
    .ss-party-card:last-child { margin-right: 0; }
    .ss-summary-card {
        background: var(--ss-bg-soft, #f8fafc);
        border: 1px solid var(--ss-border, #e2e8f0);
        border-radius: 12px;
        padding: 18px;
        margin-top: 18px;
    }
</style>

<div class="ss-invoice-box">
    <div class="ss-invoice-header">
        <div>
            <span style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--ss-primary, #6366f1); background: rgba(99, 102, 241, 0.08); padding: 4px 10px; border-radius: 9999px;">Medical Store Invoice</span>
            <h2 style="font-size: 22px; font-weight: 800; color: var(--ss-text-main, #0f172a); margin: 8px 0 4px 0;">Invoice #<?= html_escape($data[0]['sale_invoice']) ?></h2>
            <div style="font-size: 13px; color: var(--ss-text-muted, #64748b);">
                <i class="fa fa-calendar-o"></i> Date: <?= date('d M, Y', strtotime($data[0]['sale_date'])) ?>
            </div>
        </div>
        <div style="display:flex; gap: 8px;">
            <a href="<?= console_url('sale/view_detail/' . base64_encode($data[0]['sale_invoice']) . '/print') ?>" target="_blank" class="btn btn-default" style="font-weight: 600; font-size: 13px; border-radius: 8px;">
                <i class="fa fa-print"></i> Print
            </a>
            <a href="<?= console_url('sale/downloadPdf/' . base64_encode($data[0]['sale_invoice'])) ?>" class="btn btn-primary ss-btn-primary" style="font-size: 13px;">
                <i class="fa fa-file-pdf-o"></i> PDF
            </a>
        </div>
    </div>

    <div style="display: flex; gap: 16px; margin-bottom: 24px; flex-wrap: wrap;">
        <div class="ss-party-card">
            <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--ss-text-muted, #64748b); margin-bottom: 4px;">Customer Details</div>
            <div style="font-size: 15px; font-weight: 700; color: var(--ss-text-main, #0f172a);"><?= html_escape($data[0]['customer_name']) ?></div>
            <div style="font-size: 13px; color: var(--ss-text-body, #334155); margin-top: 4px;"><?= html_escape($data[0]['customer_address']) ?></div>
            <div style="font-size: 12.5px; color: var(--ss-text-muted, #64748b); margin-top: 6px;">
                <i class="fa fa-phone"></i> Contact: <?= html_escape($data[0]['customer_contact']) ?> | GSTIN: <?= html_escape($data[0]['customer_gst']) ?>
            </div>
        </div>
        <div class="ss-party-card">
            <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--ss-text-muted, #64748b); margin-bottom: 4px;">Prescribing Doctor</div>
            <div style="font-size: 15px; font-weight: 700; color: var(--ss-text-main, #0f172a);">Dr. <?= html_escape($data[0]['doctor_name']) ?></div>
            <div style="font-size: 13px; color: var(--ss-text-body, #334155); margin-top: 4px;"><?= html_escape($data[0]['doctor_address']) ?></div>
        </div>
    </div>

    <?php
    $total = 0;
    $cgst = 0;
    $sgst = 0;
    ?>

    <h4 style="font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; color: var(--ss-text-muted, #64748b); margin-bottom: 10px;">
        <i class="fa fa-list"></i> Sold Items
    </h4>
    <div class="table-responsive" style="overflow-x: auto; margin-bottom: 18px;">
        <table class="table table-bordered table-striped ss-modern-table">
            <thead>
                <tr>
                    <th style="width: 36px; text-align: center;">#</th>
                    <th>Product Name & Mfg</th>
                    <th>HSN</th>
                    <th>Strip</th>
                    <th>Loose</th>
                    <th>Batch</th>
                    <th>Exp Date</th>
                    <th>MRP</th>
                    <th>Rate</th>
                    <th>Disc %</th>
                    <th>Taxable</th>
                    <th>CGST</th>
                    <th>SGST</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 0;
                foreach ($data as $k => $value) {
                    if ($value['sale_return'] == true) {
                        continue;
                    }
                    $counter++;
                    $cgst += $value['sale_cgst'];
                    $sgst += $value['sale_sgst'];
                    $total += $value['sale_total'];
                    ?>
                    <tr>
                        <td style="text-align: center;"><?= $counter ?></td>
                        <td>
                            <strong style="color: var(--ss-text-main, #0f172a);"><?= html_escape($value['medicine_name']) ?></strong>
                            <?php if (!empty($value['medicine_manufacturer'])): ?>
                                <br><small style="color: var(--ss-text-muted, #64748b);">Mfg: <?= html_escape($value['medicine_manufacturer']) ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?= html_escape($value['medicine_hsn']) ?></td>
                        <td><?= html_escape($value['sale_strip_quantity']) ?></td>
                        <td><?= html_escape($value['sale_loose_quantity']) ?></td>
                        <td><?= html_escape($value['sale_batch']) ?></td>
                        <td><?= html_escape($value['sale_expire_month']) ?>/<?= html_escape($value['sale_expire_year']) ?></td>
                        <td><?= html_escape($value['sale_new_mrp']) ?></td>
                        <td><?= html_escape($value['sale_rate']) ?></td>
                        <td><?= html_escape($value['sale_discount_percent']) ?>%</td>
                        <td><?= html_escape($value['sale_taxable']) ?></td>
                        <td><?= html_escape($value['sale_cgst']) ?></td>
                        <td><?= html_escape($value['sale_sgst']) ?></td>
                        <td style="text-align: right; font-weight: 700; color: var(--ss-primary, #6366f1);"><?= html_escape($value['sale_total']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Summary Calculation Block -->
    <div class="ss-summary-card">
        <?php 
            $saleTotalPayable = ($total + $data[0]['sale_total_previous_due']);
            $saleTotalDiscPayable = ($saleTotalPayable * $data[0]['sale_grand_discount'] / 100);
            $wordsVal = function_exists('converted_words') ? converted_words(round($total)) : '';
        ?>
        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
            <div style="flex: 1; min-width: 260px;">
                <div style="font-size: 13px; color: var(--ss-text-muted, #64748b); margin-bottom: 4px;">Amount in Words:</div>
                <div style="font-size: 14px; font-weight: 700; color: var(--ss-text-main, #0f172a);"><?= $wordsVal ?></div>
                <div style="margin-top: 12px; font-size: 12.5px; color: var(--ss-text-muted, #64748b);">
                    Payment Mode: <strong style="color: var(--ss-text-main, #0f172a);"><?= html_escape($data[0]['sale_paid_by']) ?></strong>
                    <?php if (!empty($data[0]['sale_note'])): ?>
                        | Note: <?= html_escape($data[0]['sale_note']) ?>
                    <?php endif; ?>
                </div>
            </div>
            <div style="min-width: 240px; font-size: 13.5px;">
                <div style="display:flex; justify-content:space-between; margin-bottom: 6px;">
                    <span style="color: var(--ss-text-muted, #64748b);">Taxable GST (CGST+SGST):</span>
                    <strong>Rs. <?= number_format($cgst + $sgst, 2) ?></strong>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom: 6px;">
                    <span style="color: var(--ss-text-muted, #64748b);">Previous Due:</span>
                    <span>Rs. <?= number_format($data[0]['sale_total_previous_due'], 2) ?></span>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom: 6px; padding-top: 6px; border-top: 1px solid var(--ss-border, #e2e8f0);">
                    <span style="font-weight: 700; color: var(--ss-text-main, #0f172a);">Net Payable:</span>
                    <strong style="color: var(--ss-primary, #6366f1); font-size: 15px;">Rs. <?= number_format($saleTotalPayable - $saleTotalDiscPayable, 2) ?></strong>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom: 6px;">
                    <span style="color: var(--ss-text-muted, #64748b);">Amount Paid:</span>
                    <span style="color: var(--ss-success, #10b981); font-weight: 700;">Rs. <?= number_format($data[0]['sale_total_paid'], 2) ?></span>
                </div>
                <div style="display:flex; justify-content:space-between; padding-top: 6px; border-top: 1.5px solid var(--ss-border, #e2e8f0);">
                    <span style="font-weight: 700; color: var(--ss-danger, #ef4444);">Current Due:</span>
                    <strong style="color: var(--ss-danger, #ef4444); font-size: 15px;">Rs. <?= number_format($data[0]['sale_total_previous_due'] - $data[0]['sale_total_paid'] + $total - $saleTotalDiscPayable, 2) ?></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (!function_exists('converted_words')) {
    function converted_words($fr){
        $number = $fr;
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'One', '2' => 'Two',
         '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
         '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
         '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
         '13' => 'Thirteen', '14' => 'Fourteen',
         '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
         '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
         '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
         '60' => 'Sixty', '70' => 'Seventy',
         '80' => 'Eighty', '90' => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
          $divider = ($i == 2) ? 10 : 100;
          $number = floor($no % $divider);
          $no = floor($no / $divider);
          $i += ($divider == 10) ? 1 : 2;
          if ($number) {
             $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
             $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
             $str [] = ($number < 21) ? $words[$number] .
                 " " . $digits[$counter] . $plural . " " . $hundred
                 :
                 $words[floor($number / 10) * 10]
                 . " " . $words[$number % 10] . " "
                 . $digits[$counter] . $plural . " " . $hundred;
          } else $str[] = null;
       }
       $str = array_reverse($str);
       $result = implode('', $str);
       $points = ($point) ?
         "." . $words[$point / 10] . " " . 
               $words[$point = $point % 10] : '';
       return($result . " Rupees Only");
    }
}
?>