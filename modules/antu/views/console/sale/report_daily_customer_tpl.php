<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Payment & Statement Record - Medical Shop</title>
    <link rel="shortcut icon" href="<?= base_url() ?>uploads/fab.png">
    
    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <!-- Smart School UI CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/smart_school_ui.css">
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function () {
            $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
        });

        function fetchCustomerReport() {
            $('#loading_spinner').show();
            $.post("", {
                customer_name: $('.customer_name').val(),
                start: $('#start_date').val(),
                end: $('#end_date').val(),
                key: 'ajax_resp'
            }, function (resp) {
                $(".ajax_resp").html(resp);
                $('#loading_spinner').hide();
            }).fail(function() {
                $('#loading_spinner').hide();
            });
        }

        $(document).ready(function () {
            var timer;
            $('#start_date, #end_date').on("change", function () {
                fetchCustomerReport();
            });

            $('.customer_name').on("keyup", function () {
                clearTimeout(timer);
                timer = setTimeout(fetchCustomerReport, 300);
            });

            // Initial fetch
            fetchCustomerReport();
        });
    </script>
    <style>
        body {
            background-color: var(--ss-bg, #f4f6f9);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            padding: 24px;
        }
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            background: #fff;
            padding: 20px 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
        }
        .report-title-area h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .report-title-area h2 i {
            color: var(--ss-primary, #6366f1);
        }
        .report-title-area p {
            margin: 4px 0 0 0;
            color: #64748b;
            font-size: 13px;
        }
        .btn-top-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            background: #f1f5f9;
            color: #334155;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s;
            border: 1px solid #cbd5e1;
        }
        .btn-top-back:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
        .filter-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            margin-bottom: 24px;
        }
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)) auto;
            gap: 16px;
            align-items: flex-end;
        }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }
        .form-control-modern {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            transition: all 0.2s;
            box-sizing: border-box;
            outline: none;
        }
        .form-control-modern:focus {
            border-color: var(--ss-primary, #6366f1);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        @media print {
            body {
                background: #fff !important;
                padding: 0 !important;
            }
            .report-header .btn-top-back,
            .filter-card,
            .no-print {
                display: none !important;
            }
            .report-header {
                box-shadow: none !important;
                border: none !important;
                border-bottom: 2px solid #000 !important;
                border-radius: 0 !important;
                padding: 10px 0 !important;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Header -->
        <div class="report-header">
            <div class="report-title-area">
                <h2><i class="fa fa-user-tag text-primary"></i> Customer Ledger & Statement</h2>
                <p>Detailed debit/credit ledger, invoice charges, payments, and running balance</p>
            </div>
            <div class="no-print" style="display: flex; gap: 10px;">
                <button type="button" onclick="window.print()" class="btn-top-back" style="background: #e0f2fe; color: #0369a1; border-color: #bae6fd;">
                    <i class="fa fa-print"></i> Print Statement
                </button>
                <a href="<?= base_url() ?>console/sale" class="btn-top-back">
                    <i class="fa fa-arrow-left"></i> Back to Sales
                </a>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="filter-card no-print">
            <form method="post" onsubmit="return false">
                <div class="filter-grid">
                    <div>
                        <label class="form-label"><i class="fa fa-user"></i> Customer Name</label>
                        <input type="text" name="customer_name" placeholder="Type customer name..." class="customer_name form-control-modern" autocomplete="off">
                    </div>
                    <div>
                        <label class="form-label"><i class="fa fa-calendar-alt"></i> Start Date</label>
                        <input type="text" id="start_date" name="start" value="<?= !empty($start) ? $start : date('Y-m-d', strtotime('-1 month')) ?>" placeholder="YYYY-MM-DD" class="datepicker form-control-modern" autocomplete="off">
                    </div>
                    <div>
                        <label class="form-label"><i class="fa fa-calendar-check"></i> End Date</label>
                        <input type="text" id="end_date" name="end" value="<?= !empty($end) ? $end : date('Y-m-d') ?>" placeholder="YYYY-MM-DD" class="datepicker form-control-modern" autocomplete="off">
                    </div>
                    <div>
                        <button type="button" onclick="fetchCustomerReport()" class="ss-btn ss-btn-primary" style="height: 42px; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-search"></i> Apply Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Spinner -->
        <div id="loading_spinner" style="display: none; text-align: center; padding: 24px;">
            <i class="fa fa-circle-notch fa-spin" style="font-size: 32px; color: var(--ss-primary, #6366f1);"></i>
            <div style="margin-top: 10px; font-size: 14px; font-weight: 600; color: #475569;">Loading customer transactions...</div>
        </div>

        <!-- AJAX Container -->
        <div class="ajax_resp"></div>
    </div>
</body>
</html>