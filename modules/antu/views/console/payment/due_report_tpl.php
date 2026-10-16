<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier Due Balance Report - Medical Shop</title>
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

        var reqst = null;
        $(document).ready(function () {
            $('#report_sub').click(function () {
                var btn = $(this);
                btn.html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled', true);
                
                reqst = $.post("<?= base_url() ?>console/payments/due_report/", $('form').serialize(), function (resp) {
                    $(".ajax_resp").html(resp);
                    btn.html('<i class="fa fa-search"></i> Generate Report').prop('disabled', false);
                }).fail(function() {
                    btn.html('<i class="fa fa-search"></i> Generate Report').prop('disabled', false);
                });
            });
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
            grid-template-columns: 1fr 1fr auto auto;
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
        .empty-placeholder {
            text-align: center;
            padding: 48px 24px;
            color: #94a3b8;
            background: #fff;
            border-radius: 12px;
            border: 1px dashed #cbd5e1;
        }
        .empty-placeholder i {
            font-size: 40px;
            margin-bottom: 12px;
            color: #cbd5e1;
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
        <!-- Top Title & Navigation -->
        <div class="report-header">
            <div class="report-title-area">
                <h2><i class="fa fa-truck text-primary"></i> Supplier Due Balance Report</h2>
                <p>Track cumulative purchase orders, supplier payments, and pending dues</p>
            </div>
            <div class="no-print" style="display: flex; gap: 10px;">
                <button type="button" onclick="window.print()" class="btn-top-back" style="background: #e0f2fe; color: #0369a1; border-color: #bae6fd;">
                    <i class="fa fa-print"></i> Print Report
                </button>
                <a href="<?= base_url() ?>console/payments" class="btn-top-back">
                    <i class="fa fa-arrow-left"></i> Back to Payments
                </a>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="filter-card no-print">
            <form method="post" onsubmit="return false">
                <div class="filter-grid">
                    <div>
                        <label class="form-label"><i class="fa fa-calendar-alt"></i> Start Date</label>
                        <input type="text" id="start" name="start" value="<?= !empty($start) ? $start : date('Y-m-d', strtotime('-1 month')) ?>" placeholder="YYYY-MM-DD" class="datepicker form-control-modern" autocomplete="off">
                    </div>
                    <div>
                        <label class="form-label"><i class="fa fa-calendar-check"></i> End Date</label>
                        <input type="text" id="end" name="end" value="<?= !empty($end) ? $end : date('Y-m-d') ?>" placeholder="YYYY-MM-DD" class="datepicker form-control-modern" autocomplete="off">
                    </div>
                    <div>
                        <button type="button" id="report_sub" class="ss-btn ss-btn-primary" style="height: 42px; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-search"></i> Generate Report
                        </button>
                    </div>
                    <div>
                        <button type="reset" class="ss-btn ss-btn-secondary" style="height: 42px; display: inline-flex; align-items: center; gap: 8px;" onclick="$('.ajax_resp').html('<div class=\'empty-placeholder\'><i class=\'fa fa-filter\'></i><p>Select date filters and click Generate Report</p></div>');">
                            <i class="fa fa-redo"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- AJAX Content Result Container -->
        <div class="ajax_resp">
            <div class="empty-placeholder">
                <i class="fa fa-filter"></i>
                <h4 style="margin: 0 0 6px 0; color: #475569; font-weight: 600;">No Report Generated Yet</h4>
                <p style="margin: 0;">Select your desired date range and click <strong>Generate Report</strong> to view supplier due records.</p>
            </div>
        </div>
    </div>
</body>
</html>