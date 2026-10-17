<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($store_name) ?> - Licensed Pharmacy & Genuine Healthcare Store</title>
    <meta name="description" content="<?= htmlspecialchars($store_name) ?> - Licensed chemist and druggist in <?= htmlspecialchars($store_address) ?>. Over 17,900+ genuine medicines, cold-chain insulin storage, computerized GST billing, and doorstep delivery. Drug License: <?= htmlspecialchars($store_dl) ?>.">
    <meta name="keywords" content="pharmacy, medical store, genuine medicines, chemist, druggist, prescription refill, insulin, midnapore pharmacy, paschim medinipur, medicine delivery">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>img/simplebillingsfav.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/custom/jquery.min.js"></script>

    <style>
        :root {
            --med-primary: #0d9488;
            --med-primary-dark: #0f766e;
            --med-primary-light: #ccfbf1;
            --med-secondary: #0284c7;
            --med-secondary-light: #e0f2fe;
            --med-accent: #10b981;
            --med-danger: #ef4444;
            --med-amber: #f59e0b;
            --med-indigo: #6366f1;
            --med-slate-900: #0f172a;
            --med-slate-800: #1e293b;
            --med-slate-700: #334155;
            --med-slate-600: #475569;
            --med-slate-500: #64748b;
            --med-slate-200: #e2e8f0;
            --med-slate-100: #f1f5f9;
            --med-slate-50: #f8fafc;
            --med-white: #ffffff;
            --med-shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --med-shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.08), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --med-shadow-lg: 0 10px 25px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
            --med-shadow-xl: 0 20px 35px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            --med-radius-lg: 14px;
            --med-radius-md: 10px;
            --med-radius-sm: 6px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: var(--med-slate-800);
            background-color: #fdfdfd;
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.2s ease;
        }

        /* Top Emergency & Regulatory Strip */
        .top-emergency-strip {
            background: linear-gradient(90deg, #0f172a 0%, #1e293b 100%);
            color: #cbd5e1;
            font-size: 12.5px;
            padding: 7px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .top-strip-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .top-strip-left,
        .top-strip-right {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .top-strip-badge {
            background: rgba(13, 148, 136, 0.25);
            color: #2dd4bf;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 11px;
            border: 1px solid rgba(45, 212, 191, 0.3);
        }

        /* Navigation Header */
        .site-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--med-slate-200);
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
        }

        .header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
        }

        .brand-logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--med-primary) 0%, var(--med-secondary) 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 4px 14px rgba(13, 148, 136, 0.35);
        }

        .brand-name-text {
            font-size: 20px;
            font-weight: 800;
            color: var(--med-slate-900);
            letter-spacing: -0.5px;
            line-height: 1.15;
        }

        .brand-subtext {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--med-primary-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header-nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
        }

        .header-nav-menu a {
            font-size: 14px;
            font-weight: 600;
            color: var(--med-slate-700);
            position: relative;
            padding: 6px 0;
        }

        .header-nav-menu a:hover {
            color: var(--med-primary);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-portal-login {
            background: #ffffff;
            color: var(--med-slate-800);
            border: 1.5px solid var(--med-slate-200);
            padding: 8px 16px;
            border-radius: var(--med-radius-md);
            font-size: 13.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
        }

        .btn-portal-login:hover {
            border-color: var(--med-primary);
            color: var(--med-primary);
            box-shadow: var(--med-shadow-sm);
        }

        .btn-whatsapp-order {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            border: none;
            padding: 9px 18px;
            border-radius: var(--med-radius-md);
            font-size: 13.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
            transition: all 0.2s;
        }

        .btn-whatsapp-order:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.4);
            color: #ffffff;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            background: radial-gradient(circle at 10% 20%, rgba(13, 148, 136, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(2, 132, 199, 0.08) 0%, transparent 45%),
                linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
            padding: 60px 0 70px 0;
            overflow: hidden;
            border-bottom: 1px solid var(--med-slate-200);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.25fr 0.95fr;
            gap: 40px;
            align-items: center;
        }

        .hero-badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: rgba(13, 148, 136, 0.1);
            color: var(--med-primary-dark);
            border-radius: 9999px;
            font-size: 12.5px;
            font-weight: 700;
            margin-bottom: 18px;
            border: 1px solid rgba(13, 148, 136, 0.25);
        }

        .hero-title {
            font-size: 42px;
            font-weight: 800;
            color: var(--med-slate-900);
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 16px;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--med-primary) 0%, var(--med-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 16.5px;
            color: var(--med-slate-600);
            margin-bottom: 28px;
            max-width: 580px;
            line-height: 1.65;
        }

        .hero-buttons-row {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 35px;
        }

        .btn-primary-hero {
            background: linear-gradient(135deg, var(--med-primary) 0%, var(--med-primary-dark) 100%);
            color: #ffffff;
            padding: 13px 26px;
            border-radius: var(--med-radius-md);
            font-size: 15px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            box-shadow: 0 4px 16px rgba(13, 148, 136, 0.35);
            transition: all 0.2s;
        }

        .btn-primary-hero:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 148, 136, 0.45);
            color: #ffffff;
        }

        .btn-secondary-hero {
            background: #ffffff;
            color: var(--med-slate-700);
            border: 1.5px solid var(--med-slate-200);
            padding: 12px 22px;
            border-radius: var(--med-radius-md);
            font-size: 15px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: var(--med-shadow-sm);
            transition: all 0.2s;
        }

        .btn-secondary-hero:hover {
            border-color: var(--med-secondary);
            color: var(--med-secondary);
            transform: translateY(-2px);
        }

        .hero-metrics-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            padding-top: 24px;
            border-top: 1px solid var(--med-slate-200);
        }

        .metric-item-num {
            font-size: 24px;
            font-weight: 800;
            color: var(--med-slate-900);
            line-height: 1.1;
        }

        .metric-item-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--med-slate-500);
            margin-top: 3px;
        }

        /* Hero Right Dispensing Card */
        .hero-card-box {
            background: #ffffff;
            border: 1px solid var(--med-slate-200);
            border-radius: 20px;
            padding: 28px;
            box-shadow: var(--med-shadow-xl);
            position: relative;
        }

        .dispensing-status-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 16px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--med-slate-100);
        }

        .pharmacist-badge {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pulse-indicator {
            width: 10px;
            height: 10px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(16, 185, 129, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .hero-features-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 24px;
        }

        .hero-feature-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 14px;
            border-radius: 10px;
            background: var(--med-slate-50);
            border: 1px solid var(--med-slate-200);
        }

        .feature-icon-circle {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .hero-rx-upload-mini {
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.05) 0%, rgba(2, 132, 199, 0.05) 100%);
            border: 1.5px dashed var(--med-primary);
            border-radius: 12px;
            padding: 18px;
            text-align: center;
        }

        /* Search Console Section */
        .search-console-section {
            padding: 40px 0;
            background: #ffffff;
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }

        .search-console-wrapper {
            background: #ffffff;
            border: 1px solid var(--med-slate-200);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--med-shadow-lg);
        }

        .search-input-box {
            position: relative;
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .search-input-box i.search-icon {
            position: absolute;
            left: 18px;
            font-size: 18px;
            color: var(--med-slate-400);
        }

        .medicine-search-field {
            width: 100%;
            height: 52px;
            padding: 12px 130px 12px 50px;
            border: 2px solid var(--med-slate-200);
            border-radius: var(--med-radius-md);
            font-size: 15px;
            color: var(--med-slate-800);
            background: var(--med-slate-50);
            transition: all 0.2s;
            outline: none;
        }

        .medicine-search-field:focus {
            border-color: var(--med-primary);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.12);
        }

        .search-action-btn {
            position: absolute;
            right: 8px;
            height: 38px;
            background: var(--med-primary);
            color: #ffffff;
            border: none;
            padding: 0 18px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13.5px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .search-action-btn:hover {
            background: var(--med-primary-dark);
        }

        .search-category-pills {
            display: flex;
            align-items: center;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
        }

        .category-pill {
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 12.5px;
            font-weight: 600;
            background: var(--med-slate-100);
            color: var(--med-slate-700);
            cursor: pointer;
            border: 1px solid transparent;
            white-space: nowrap;
            transition: all 0.2s;
        }

        .category-pill:hover,
        .category-pill.active {
            background: var(--med-primary-light);
            color: var(--med-primary-dark);
            border-color: rgba(13, 148, 136, 0.3);
        }

        /* Live Search Results Container */
        .live-search-results {
            margin-top: 18px;
            display: none;
            border-top: 1px solid var(--med-slate-100);
            padding-top: 16px;
        }

        .results-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .med-result-card {
            background: var(--med-slate-50);
            border: 1px solid var(--med-slate-200);
            border-radius: 10px;
            padding: 12px 14px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Categories Section */
        .section-padding {
            padding: 70px 0;
        }

        .section-header-center {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 45px auto;
        }

        .section-badge {
            display: inline-block;
            font-size: 11.5px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--med-primary);
            background: var(--med-primary-light);
            padding: 4px 12px;
            border-radius: 9999px;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 32px;
            font-weight: 800;
            color: var(--med-slate-900);
            letter-spacing: -0.5px;
            margin-bottom: 12px;
        }

        .section-subtitle {
            font-size: 15px;
            color: var(--med-slate-600);
            line-height: 1.6;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .category-box-card {
            background: #ffffff;
            border: 1px solid var(--med-slate-200);
            border-radius: var(--med-radius-lg);
            padding: 24px;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            box-shadow: var(--med-shadow-sm);
        }

        .category-box-card:hover {
            transform: translateY(-4px);
            border-color: var(--med-primary);
            box-shadow: var(--med-shadow-lg);
        }

        .category-box-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .category-box-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--med-slate-900);
            margin-bottom: 6px;
        }

        .category-box-desc {
            font-size: 13px;
            color: var(--med-slate-600);
            margin-bottom: 14px;
            line-height: 1.5;
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .service-feature-card {
            background: #ffffff;
            border: 1px solid var(--med-slate-200);
            border-radius: var(--med-radius-lg);
            padding: 28px;
            box-shadow: var(--med-shadow-sm);
            transition: all 0.25s ease;
        }

        .service-feature-card:hover {
            transform: translateY(-4px);
            border-color: var(--med-secondary);
            box-shadow: var(--med-shadow-lg);
        }

        .service-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 18px;
        }

        /* Upload Prescription Section */
        .rx-upload-section {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            padding: 70px 0;
            border-radius: 24px;
            margin: 40px 0;
            position: relative;
            overflow: hidden;
        }

        .rx-upload-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .rx-form-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            padding: 30px;
        }

        .rx-input {
            width: 100%;
            height: 46px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #ffffff;
            padding: 10px 14px;
            font-size: 14px;
            margin-bottom: 14px;
            outline: none;
            transition: all 0.2s;
        }

        .rx-input:focus {
            border-color: #2dd4bf;
            background: rgba(255, 255, 255, 0.12);
        }

        .rx-textarea {
            width: 100%;
            height: 80px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #ffffff;
            padding: 10px 14px;
            font-size: 14px;
            margin-bottom: 16px;
            outline: none;
            resize: none;
        }

        /* Doctors Grid */
        .doctors-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .doctor-card {
            background: #ffffff;
            border: 1px solid var(--med-slate-200);
            border-radius: var(--med-radius-md);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: var(--med-shadow-sm);
        }

        .doctor-avatar-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: rgba(13, 148, 136, 0.1);
            color: var(--med-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        /* Regulatory Transparency Box */
        .regulatory-banner {
            background: var(--med-slate-50);
            border: 1px solid var(--med-slate-200);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 40px;
        }

        /* Site Footer */
        .site-footer {
            background: #090d16;
            color: #94a3b8;
            padding: 60px 0 30px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.25fr;
            gap: 40px;
            margin-bottom: 50px;
        }

        .footer-heading {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-links-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-links-list a {
            font-size: 13.5px;
            color: #94a3b8;
        }

        .footer-links-list a:hover {
            color: #2dd4bf;
        }

        .footer-bottom-strip {
            padding-top: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12.5px;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 991px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .rx-upload-grid {
                grid-template-columns: 1fr;
            }

            .doctors-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .results-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .header-nav-menu {
                display: none;
            }

            .categories-grid {
                grid-template-columns: 1fr;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .hero-metrics-strip {
                grid-template-columns: repeat(2, 1fr);
            }

            .doctors-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .results-grid {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

    <!-- 1. Top Emergency Strip & License Authority -->
    <div class="top-emergency-strip">
        <div class="container">
            <div class="top-strip-flex">
                <div class="top-strip-left">
                    <span><i class="fa fa-shield" style="color: #2dd4bf; margin-right: 4px;"></i> Drug License: <strong><?= htmlspecialchars($store_dl) ?></strong></span>
                    <span><i class="fa fa-certificate" style="color: #fbc02d; margin-right: 4px;"></i> BCDA Member: <strong><?= htmlspecialchars($store_bcda) ?></strong></span>
                    <span class="top-strip-badge"><i class="fa fa-clock-o"></i> Open Today: 7:30 AM - 11:00 PM</span>
                </div>
                <div class="top-strip-right">
                    <span><i class="fa fa-phone" style="color: #38bdf8; margin-right: 4px;"></i> Helpline: <a href="tel:<?= preg_replace('/[^0-9]/', '', explode('/', $store_mobile)[0]) ?>"><?= htmlspecialchars($store_mobile) ?></a></span>
                    <span><i class="fa fa-map-marker" style="color: #f87171; margin-right: 4px;"></i> <?= htmlspecialchars($store_address) ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Sticky Brand Navbar -->
    <header class="site-header">
        <div class="container">
            <div class="header-flex">
                <a href="<?= base_url(); ?>" class="brand-logo-wrap">
                    <div class="brand-icon-box">
                        <i class="fa fa-plus-square"></i>
                    </div>
                    <div>
                        <div class="brand-name-text"><?= htmlspecialchars($store_name) ?></div>
                        <div class="brand-subtext"><i class="fa fa-check-circle"></i> Licensed Chemist & Druggist</div>
                    </div>
                </a>

                <ul class="header-nav-menu">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#search-medicine">Find Medicine</a></li>
                    <li><a href="#categories">Departments</a></li>
                    <li><a href="#services">Healthcare Services</a></li>
                    <li><a href="#prescription-order">Upload Rx</a></li>
                    <li><a href="#doctors">Consulting Doctors</a></li>
                    <li><a href="#contact">Store Hours</a></li>
                </ul>

                <div class="header-actions">
                    <a href="https://wa.me/919382509991?text=Hello%20<?= urlencode($store_name) ?>%2C%20I%20would%20like%20to%20order%20medicines" target="_blank" class="btn-whatsapp-order">
                        <i class="fa fa-whatsapp" style="font-size: 16px;"></i> WhatsApp Order
                    </a>
                    <a href="<?= console_url('user/login') ?>" class="btn-portal-login" title="Authorized Pharmacist & Admin Login">
                        <i class="fa fa-lock" style="color: var(--med-primary);"></i> Portal Login
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- 3. Hero Section -->
    <section class="hero-section" id="hero">
        <div class="container">
            <div class="hero-grid">
                <!-- Left Hero Information -->
                <div>
                    <div class="hero-badge-tag">
                        <i class="fa fa-heartbeat" style="color: #e11d48;"></i> Trusted Community Healthcare Partner
                    </div>
                    <h1 class="hero-title">
                        Your Trusted Local Pharmacy & <span>Genuine Healthcare</span> Partner
                    </h1>
                    <p class="hero-desc">
                        Dispensing over 17,900+ verified prescription drugs, cold-chain insulins, pediatric syrups, and healthcare equipment with certified pharmacist care in Manikpur, Midnapore.
                    </p>

                    <div class="hero-buttons-row">
                        <a href="#prescription-order" class="btn-primary-hero">
                            <i class="fa fa-file-text-o"></i> Upload Prescription
                        </a>
                        <a href="#search-medicine" class="btn-secondary-hero">
                            <i class="fa fa-search"></i> Search 17,900+ Medicines
                        </a>
                        <a href="tel:<?= preg_replace('/[^0-9]/', '', explode('/', $store_mobile)[0]) ?>" class="btn-secondary-hero">
                            <i class="fa fa-phone" style="color: var(--med-primary);"></i> Call Store
                        </a>
                    </div>

                    <div class="hero-metrics-strip">
                        <div>
                            <div class="metric-item-num"><?= number_format($medicine_count) ?>+</div>
                            <div class="metric-item-label">Medicines In Stock</div>
                        </div>
                        <div>
                            <div class="metric-item-num"><?= number_format($bills_count) ?>+</div>
                            <div class="metric-item-label">Prescriptions Dispensed</div>
                        </div>
                        <div>
                            <div class="metric-item-num"><?= number_format($customer_count) ?>+</div>
                            <div class="metric-item-label">Families Served</div>
                        </div>
                        <div>
                            <div class="metric-item-num"><?= number_format($doctor_count) ?>+</div>
                            <div class="metric-item-label">Doctors Network</div>
                        </div>
                    </div>
                </div>

                <!-- Right Hero Dispensing Card -->
                <div>
                    <div class="hero-card-box">
                        <div class="dispensing-status-bar">
                            <div class="pharmacist-badge">
                                <div class="pulse-indicator"></div>
                                <div>
                                    <strong style="color: var(--med-slate-900); font-size: 13.5px;">Registered Pharmacist On Duty</strong>
                                    <div style="font-size: 11px; color: var(--med-slate-500);">Counter Ready for Dispensing & Dosage Advice</div>
                                </div>
                            </div>
                            <span class="top-strip-badge" style="background: rgba(16, 185, 129, 0.15); color: #059669; border-color: rgba(16, 185, 129, 0.3);">Verified</span>
                        </div>

                        <div class="hero-features-list">
                            <div class="hero-feature-item">
                                <div class="feature-icon-circle" style="background: rgba(13, 148, 136, 0.12); color: var(--med-primary);">
                                    <i class="fa fa-snowflake-o"></i>
                                </div>
                                <div>
                                    <strong style="color: var(--med-slate-900); font-size: 13px;">Cold-Chain Biologicals Storage (2°C - 8°C)</strong>
                                    <div style="font-size: 11.5px; color: var(--med-slate-500);">Refrigerated vaccines, insulins, and eye drops</div>
                                </div>
                            </div>

                            <div class="hero-feature-item">
                                <div class="feature-icon-circle" style="background: rgba(2, 132, 199, 0.12); color: var(--med-secondary);">
                                    <i class="fa fa-motorcycle"></i>
                                </div>
                                <div>
                                    <strong style="color: var(--med-slate-900); font-size: 13px;">Express Doorstep Delivery</strong>
                                    <div style="font-size: 11.5px; color: var(--med-slate-500);">Within 60-90 minutes across Midnapore town</div>
                                </div>
                            </div>

                            <div class="hero-feature-item">
                                <div class="feature-icon-circle" style="background: rgba(99, 102, 241, 0.12); color: var(--med-indigo);">
                                    <i class="fa fa-qrcode"></i>
                                </div>
                                <div>
                                    <strong style="color: var(--med-slate-900); font-size: 13px;">GST Printed Tax Invoices</strong>
                                    <div style="font-size: 11.5px; color: var(--med-slate-500);">Batch number, expiry dates & digital receipts</div>
                                </div>
                            </div>
                        </div>

                        <!-- Mini Rx Quick Order box -->
                        <div class="hero-rx-upload-mini">
                            <div style="font-size: 14px; font-weight: 700; color: var(--med-primary-dark); margin-bottom: 4px;">
                                <i class="fa fa-camera" style="margin-right: 5px;"></i> Order Medicines in 1 Step
                            </div>
                            <div style="font-size: 12px; color: var(--med-slate-600); margin-bottom: 12px;">
                                Snap your doctor's prescription & send directly via WhatsApp
                            </div>
                            <a href="https://wa.me/919382509991?text=Hello%20<?= urlencode($store_name) ?>%2C%20I%20want%20to%20send%20my%20prescription%20photo%20for%20medicine%20delivery." target="_blank" class="btn-whatsapp-order" style="width: 100%; justify-content: center;">
                                <i class="fa fa-whatsapp"></i> Send Prescription on WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Interactive Live Medicine Search & Stock Inquirer -->
    <section class="search-console-section" id="search-medicine">
        <div class="container">
            <div class="search-console-wrapper">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 8px;">
                    <div>
                        <strong style="font-size: 16px; color: var(--med-slate-900);"><i class="fa fa-search" style="color: var(--med-primary); margin-right: 6px;"></i> Live Medicine & Salt Finder</strong>
                        <span style="font-size: 12px; color: var(--med-slate-500); margin-left: 8px;">(Search among <?= number_format($medicine_count) ?> cataloged formulations)</span>
                    </div>
                    <span class="top-strip-badge" style="background: #f1f5f9; color: #475569; border-color: #cbd5e1;">Instant Store Stock Check</span>
                </div>

                <div class="search-input-box">
                    <i class="fa fa-search search-icon"></i>
                    <input type="text" id="liveMedSearch" class="medicine-search-field" placeholder="Search by medicine brand, salt name or health concern (e.g. Paracetamol, Azithral, Gluconorm, Telma, OneTouch)...">
                    <button class="search-action-btn" id="btnSearchTrigger"><i class="fa fa-arrow-right"></i> Search</button>
                </div>

                <div class="search-category-pills">
                    <span style="font-size: 12px; font-weight: 700; color: var(--med-slate-500); margin-right: 4px;">Quick Form:</span>
                    <span class="category-pill active" data-category="">All Medicines</span>
                    <span class="category-pill" data-category="TABLET">Tablets</span>
                    <span class="category-pill" data-category="CAPSULE">Capsules</span>
                    <span class="category-pill" data-category="SYRUP">Syrups</span>
                    <span class="category-pill" data-category="INJECTION">Injections</span>
                    <span class="category-pill" data-category="OINTMENT">Ointments</span>
                    <span class="category-pill" data-category="DROPS">Eye & Ear Drops</span>
                    <span class="category-pill" data-category="STRPS">Diabetes Strips</span>
                </div>

                <!-- Live Results Dropdown Box -->
                <div class="live-search-results" id="searchResultsBox">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <span style="font-size: 13px; font-weight: 700; color: var(--med-slate-700);" id="searchResultSummary">Found Medicines:</span>
                        <a href="javascript:void(0);" id="closeSearchResults" style="font-size: 12px; color: var(--med-primary); font-weight: 600;"><i class="fa fa-times"></i> Close</a>
                    </div>
                    <div class="results-grid" id="resultsGridContainer">
                        <!-- Populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Essential Healthcare Categories & Departments -->
    <section class="section-padding" id="categories" style="background: #ffffff;">
        <div class="container">
            <div class="section-header-center">
                <span class="section-badge">Store Catalog</span>
                <h2 class="section-title">Essential Healthcare Departments</h2>
                <p class="section-subtitle">We stock everything from daily maintenance medications to critical hospital biologicals, certified surgical equipment, and family nutrition.</p>
            </div>

            <div class="categories-grid">
                <!-- Category 1 -->
                <div class="category-box-card">
                    <div class="category-box-icon" style="background: rgba(13, 148, 136, 0.1); color: var(--med-primary);">
                        <i class="fa fa-medkit"></i>
                    </div>
                    <div class="category-box-title">Tablets & Capsules</div>
                    <div class="category-box-desc">Cardiology, blood pressure, neurological, gastro & antibiotic therapy.</div>
                    <span style="font-size: 12px; font-weight: 700; color: var(--med-primary);"><i class="fa fa-check-circle"></i> 10,000+ Brands Available</span>
                </div>

                <!-- Category 2 -->
                <div class="category-box-card">
                    <div class="category-box-icon" style="background: rgba(2, 132, 199, 0.1); color: var(--med-secondary);">
                        <i class="fa fa-flask"></i>
                    </div>
                    <div class="category-box-title">Pediatric & Syrups</div>
                    <div class="category-box-desc">Infant drops, fever syrups, multivitamins, and pediatric dry suspensions.</div>
                    <span style="font-size: 12px; font-weight: 700; color: var(--med-secondary);"><i class="fa fa-check-circle"></i> Child Safe Packaging</span>
                </div>

                <!-- Category 3 -->
                <div class="category-box-card">
                    <div class="category-box-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--med-accent);">
                        <i class="fa fa-heartbeat"></i>
                    </div>
                    <div class="category-box-title">Diabetes & Cardiac Care</div>
                    <div class="category-box-desc">Blood glucose strips, lancets, insulin pens, BP control, and lipid tablets.</div>
                    <span style="font-size: 12px; font-weight: 700; color: var(--med-accent);"><i class="fa fa-check-circle"></i> Complete Chronic Care</span>
                </div>

                <!-- Category 4 -->
                <div class="category-box-card">
                    <div class="category-box-icon" style="background: rgba(239, 68, 68, 0.1); color: var(--med-danger);">
                        <i class="fa fa-snowflake-o"></i>
                    </div>
                    <div class="category-box-title">Vaccines & Injections</div>
                    <div class="category-box-desc">Tetanus, rabies, hepatitis, insulin vials stored under continuous 2°C - 8°C.</div>
                    <span style="font-size: 12px; font-weight: 700; color: var(--med-danger);"><i class="fa fa-check-circle"></i> Certified Cold-Chain</span>
                </div>

                <!-- Category 5 -->
                <div class="category-box-card">
                    <div class="category-box-icon" style="background: rgba(99, 102, 241, 0.1); color: var(--med-indigo);">
                        <i class="fa fa-stethoscope"></i>
                    </div>
                    <div class="category-box-title">Surgical & Medical Devices</div>
                    <div class="category-box-desc">Digital BP monitors, pulse oximeters, nebulizers, thermometers, and dressings.</div>
                    <span style="font-size: 12px; font-weight: 700; color: var(--med-indigo);"><i class="fa fa-check-circle"></i> ISO/CE Certified</span>
                </div>

                <!-- Category 6 -->
                <div class="category-box-card">
                    <div class="category-box-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--med-amber);">
                        <i class="fa fa-smile-o"></i>
                    </div>
                    <div class="category-box-title">Mother & Baby Essentials</div>
                    <div class="category-box-desc">Infant milk formula, baby diapers, rash creams, feeding accessories & supplements.</div>
                    <span style="font-size: 12px; font-weight: 700; color: var(--med-amber);"><i class="fa fa-check-circle"></i> Gentle & Dermatologist Tested</span>
                </div>

                <!-- Category 7 -->
                <div class="category-box-card">
                    <div class="category-box-icon" style="background: rgba(20, 184, 166, 0.1); color: #0d9488;">
                        <i class="fa fa-shield"></i>
                    </div>
                    <div class="category-box-title">Dermatology & Topicals</div>
                    <div class="category-box-desc">Antifungal creams, wound ointments, burn gels, antiseptic lotions, and eye drops.</div>
                    <span style="font-size: 12px; font-weight: 700; color: #0d9488;"><i class="fa fa-check-circle"></i> Clinically Formulated</span>
                </div>

                <!-- Category 8 -->
                <div class="category-box-card">
                    <div class="category-box-icon" style="background: rgba(14, 165, 233, 0.1); color: #0284c7;">
                        <i class="fa fa-leaf"></i>
                    </div>
                    <div class="category-box-title">Ayurvedic & Nutrition</div>
                    <div class="category-box-desc">Herbal remedies, Chyawanprash, liver tonics, protein powders, and multivitamins.</div>
                    <span style="font-size: 12px; font-weight: 700; color: #0284c7;"><i class="fa fa-check-circle"></i> Natural Wellness Care</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Comprehensive Clinical Pharmacy Services -->
    <section class="section-padding" id="services" style="background: var(--med-slate-50); border-top: 1px solid var(--med-slate-200); border-bottom: 1px solid var(--med-slate-200);">
        <div class="container">
            <div class="section-header-center">
                <span class="section-badge">Clinical Excellence</span>
                <h2 class="section-title">Patient-First Pharmacy Services</h2>
                <p class="section-subtitle">More than just medicine selling — we provide licensed pharmaceutical dispensing, dosage safety checks, and personalized patient support.</p>
            </div>

            <div class="services-grid">
                <!-- Service 1 -->
                <div class="service-feature-card">
                    <div class="service-icon-wrap" style="background: rgba(13, 148, 136, 0.1); color: var(--med-primary);">
                        <i class="fa fa-file-text-o"></i>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 800; color: var(--med-slate-900); margin-bottom: 8px;">Prescription Verification</h3>
                    <p style="font-size: 13.5px; color: var(--med-slate-600); line-height: 1.6;">Every doctor's prescription is carefully checked by a licensed pharmacist for proper dosage, drug interactions, and course duration before dispensing.</p>
                </div>

                <!-- Service 2 -->
                <div class="service-feature-card">
                    <div class="service-icon-wrap" style="background: rgba(2, 132, 199, 0.1); color: var(--med-secondary);">
                        <i class="fa fa-calendar-check-o"></i>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 800; color: var(--med-slate-900); margin-bottom: 8px;">Monthly Chronic Refills</h3>
                    <p style="font-size: 13.5px; color: var(--med-slate-600); line-height: 1.6;">Never miss your blood pressure or diabetic dose. Enroll in our automatic monthly medicine refill program with prioritized home delivery.</p>
                </div>

                <!-- Service 3 -->
                <div class="service-feature-card">
                    <div class="service-icon-wrap" style="background: rgba(16, 185, 129, 0.1); color: var(--med-accent);">
                        <i class="fa fa-snowflake-o"></i>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 800; color: var(--med-slate-900); margin-bottom: 8px;">Dedicated Cold-Chain Storage</h3>
                    <p style="font-size: 13.5px; color: var(--med-slate-600); line-height: 1.6;">Specialized medical refrigerators backed by 24/7 power backup ensure insulins, vaccines, and biologics maintain 100% therapeutic potency.</p>
                </div>

                <!-- Service 4 -->
                <div class="service-feature-card">
                    <div class="service-icon-wrap" style="background: rgba(245, 158, 11, 0.1); color: var(--med-amber);">
                        <i class="fa fa-heartbeat"></i>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 800; color: var(--med-slate-900); margin-bottom: 8px;">Free Counter Health Screening</h3>
                    <p style="font-size: 13.5px; color: var(--med-slate-600); line-height: 1.6;">Walk into our Manikpur store anytime for complimentary Blood Pressure measurement, Oxygen Saturation (SpO2) check, and vital signs monitoring.</p>
                </div>

                <!-- Service 5 -->
                <div class="service-feature-card">
                    <div class="service-icon-wrap" style="background: rgba(99, 102, 241, 0.1); color: var(--med-indigo);">
                        <i class="fa fa-barcode"></i>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 800; color: var(--med-slate-900); margin-bottom: 8px;">Computerized Invoicing</h3>
                    <p style="font-size: 13.5px; color: var(--med-slate-600); line-height: 1.6;">100% transparent GST bills with manufacturer batch numbers, expiry dates, and MRP discounts printed clearly for medical insurance reimbursement.</p>
                </div>

                <!-- Service 6 -->
                <div class="service-feature-card">
                    <div class="service-icon-wrap" style="background: rgba(239, 68, 68, 0.1); color: var(--med-danger);">
                        <i class="fa fa-bell-o"></i>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 800; color: var(--med-slate-900); margin-bottom: 8px;">Emergency Night Counter</h3>
                    <p style="font-size: 13.5px; color: var(--med-slate-600); line-height: 1.6;">Urgent late-night medicines or life-saving injections needed? Ring our night counter bell or contact our emergency mobile hotline for prompt assistance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Prescription Upload / Online Medicine Order Section -->
    <div class="container" id="prescription-order">
        <section class="rx-upload-section">
            <div style="padding: 0 40px;">
                <div class="rx-upload-grid">
                    <div>
                        <span class="top-strip-badge" style="background: rgba(45, 212, 191, 0.2); color: #2dd4bf; margin-bottom: 12px; display: inline-block;">Express Prescription Ordering</span>
                        <h2 style="font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 16px;">Upload Prescription & Get Doorstep Delivery</h2>
                        <p style="font-size: 15.5px; color: #cbd5e1; line-height: 1.7; margin-bottom: 24px;">
                            Simply enter your details and upload your doctor's prescription. Our pharmacist will verify the medication, confirm prices, and pack your medicines promptly.
                        </p>

                        <div style="display: flex; flex-direction: column; gap: 14px;">
                            <div style="display: flex; align-items: center; gap: 12px; font-size: 14px;">
                                <i class="fa fa-check-circle" style="color: #2dd4bf; font-size: 18px;"></i>
                                <span>No minimum order value for home delivery</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 12px; font-size: 14px;">
                                <i class="fa fa-check-circle" style="color: #2dd4bf; font-size: 18px;"></i>
                                <span>Free dosage schedule & guidance sheet included</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 12px; font-size: 14px;">
                                <i class="fa fa-check-circle" style="color: #2dd4bf; font-size: 18px;"></i>
                                <span>Cash on Delivery (COD) & UPI QR payments accepted</span>
                            </div>
                        </div>
                    </div>

                    <div class="rx-form-card">
                        <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 6px;">Prescription Intake Form</h3>
                        <p style="font-size: 12.5px; color: #94a3b8; margin-bottom: 18px;">Fill out the form below or order directly via WhatsApp.</p>

                        <form id="rxOrderForm">
                            <input type="text" id="patientName" name="patient_name" class="rx-input" placeholder="Patient Full Name *" required>
                            <input type="tel" id="patientPhone" name="patient_phone" class="rx-input" placeholder="WhatsApp / Phone Number *" required>
                            <input type="text" id="deliveryAddress" name="delivery_address" class="rx-input" placeholder="Delivery Address / Landmark (Midnapore Area)">
                            <textarea id="medicineList" name="medicine_list" class="rx-textarea" placeholder="List medicine names & quantities, or doctor details..."></textarea>

                            <button type="submit" class="btn-primary-hero" style="width: 100%; justify-content: center; font-size: 15px; padding: 12px 20px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                <i class="fa fa-paper-plane"></i> Submit Prescription Order
                            </button>
                        </form>
                        <div id="rxSubmitStatus" style="margin-top: 12px; font-size: 13px; text-align: center; display: none;"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- 8. Prescribing Associated Doctors Network -->
    <section class="section-padding" id="doctors" style="background: #ffffff;">
        <div class="container">
            <div class="section-header-center">
                <span class="section-badge">Medical Network</span>
                <h2 class="section-title">Associated Consulting Physicians</h2>
                <p class="section-subtitle">We collaborate closely with top clinicians and medical specialists across Midnapore to ensure exact prescription compliance and seamless therapy.</p>
            </div>

            <div class="doctors-grid">
                <?php if (!empty($featured_doctors)): ?>
                    <?php foreach ($featured_doctors as $doc): ?>
                        <div class="doctor-card">
                            <div class="doctor-avatar-circle">
                                <i class="fa fa-user-md"></i>
                            </div>
                            <div>
                                <strong style="font-size: 15px; color: var(--med-slate-900); display: block; margin-bottom: 2px;">
                                    <?= htmlspecialchars($doc['doctor_name']) ?>
                                </strong>
                                <div style="font-size: 12px; color: var(--med-primary-dark); font-weight: 600;">Registered Medical Practitioner</div>
                                <?php if (!empty($doc['doctor_address'])): ?>
                                    <div style="font-size: 11.5px; color: var(--med-slate-500); margin-top: 2px;"><i class="fa fa-hospital-o"></i> <?= htmlspecialchars($doc['doctor_address']) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="doctor-card">
                        <div class="doctor-avatar-circle"><i class="fa fa-user-md"></i></div>
                        <div>
                            <strong style="font-size: 15px; color: var(--med-slate-900);">Consulting Physician Panel</strong>
                            <div style="font-size: 12px; color: var(--med-primary-dark);">General Medicine & Pediatrics</div>
                            <div style="font-size: 11.5px; color: var(--med-slate-500);">Midnapore Medical College Affiliated</div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Regulatory License Strip -->
            <div class="regulatory-banner">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(13, 148, 136, 0.12); color: var(--med-primary); display: flex; align-items: center; justify-content: center; font-size: 22px;">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <div>
                        <strong style="font-size: 15px; color: var(--med-slate-900); display: block;">Drugs & Cosmetics Act Compliance (Govt. of West Bengal)</strong>
                        <div style="font-size: 12.5px; color: var(--med-slate-600);">Drug License: <strong><?= htmlspecialchars($store_dl) ?></strong> | GSTIN: <strong><?= htmlspecialchars($store_gst) ?></strong></div>
                    </div>
                </div>
                <div>
                    <span class="label" style="background: #10b981; color: #fff; font-size: 12px; padding: 6px 14px; border-radius: 9999px; font-weight: 700;">
                        <i class="fa fa-check-circle"></i> BCDA Member <?= htmlspecialchars($store_bcda) ?>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. Store Hours & Contact Location Section -->
    <section class="section-padding" id="contact" style="background: var(--med-slate-50); border-top: 1px solid var(--med-slate-200);">
        <div class="container">
            <div class="section-header-center">
                <span class="section-badge">Visit Our Pharmacy</span>
                <h2 class="section-title">Store Location & Operating Hours</h2>
                <p class="section-subtitle">Conveniently situated in Manikpur, Midnapore with dedicated parking, wheelchair accessibility, and late night emergency dispensing counter.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                <div style="background: #ffffff; border: 1px solid var(--med-slate-200); border-radius: var(--med-radius-lg); padding: 24px;">
                    <div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(13, 148, 136, 0.1); color: var(--med-primary); display: flex; align-items: center; justify-content: center; font-size: 18px; margin-bottom: 14px;">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <h3 style="font-size: 16px; font-weight: 700; color: var(--med-slate-900); margin-bottom: 6px;">Pharmacy Address</h3>
                    <p style="font-size: 13.5px; color: var(--med-slate-600); line-height: 1.6; margin-bottom: 12px;">
                        <?= htmlspecialchars($store_address) ?>
                    </p>
                    <a href="https://maps.google.com/?q=<?= urlencode($store_address) ?>" target="_blank" style="font-size: 12.5px; color: var(--med-primary); font-weight: 700;">
                        Get Directions on Google Maps <i class="fa fa-arrow-right"></i>
                    </a>
                </div>

                <div style="background: #ffffff; border: 1px solid var(--med-slate-200); border-radius: var(--med-radius-lg); padding: 24px;">
                    <div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(2, 132, 199, 0.1); color: var(--med-secondary); display: flex; align-items: center; justify-content: center; font-size: 18px; margin-bottom: 14px;">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <h3 style="font-size: 16px; font-weight: 700; color: var(--med-slate-900); margin-bottom: 6px;">Working Hours</h3>
                    <div style="font-size: 13.5px; color: var(--med-slate-600); line-height: 1.7;">
                        <div><strong>Mon – Sat:</strong> 7:30 AM – 11:00 PM</div>
                        <div><strong>Sunday:</strong> 8:00 AM – 10:30 PM</div>
                        <div style="color: var(--med-primary-dark); font-weight: 700; margin-top: 6px;"><i class="fa fa-bell-o"></i> Emergency Night Counter: Available</div>
                    </div>
                </div>

                <div style="background: #ffffff; border: 1px solid var(--med-slate-200); border-radius: var(--med-radius-lg); padding: 24px;">
                    <div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(16, 185, 129, 0.1); color: var(--med-accent); display: flex; align-items: center; justify-content: center; font-size: 18px; margin-bottom: 14px;">
                        <i class="fa fa-phone"></i>
                    </div>
                    <h3 style="font-size: 16px; font-weight: 700; color: var(--med-slate-900); margin-bottom: 6px;">Direct Helplines</h3>
                    <div style="font-size: 13.5px; color: var(--med-slate-600); line-height: 1.7; margin-bottom: 12px;">
                        <div><strong>Primary:</strong> <?= htmlspecialchars($store_mobile) ?></div>
                        <div><strong>WhatsApp:</strong> +91 9382509991</div>
                    </div>
                    <a href="tel:<?= preg_replace('/[^0-9]/', '', explode('/', $store_mobile)[0]) ?>" class="btn-whatsapp-order" style="padding: 6px 14px; font-size: 12.5px;">
                        <i class="fa fa-phone"></i> Call Pharmacist Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. Modern Healthcare Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <!-- Col 1 -->
                <div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                        <div style="width: 36px; height: 36px; border-radius: 10px; background: var(--med-primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                            <i class="fa fa-plus-square"></i>
                        </div>
                        <strong style="font-size: 18px; color: #ffffff;"><?= htmlspecialchars($store_name) ?></strong>
                    </div>
                    <p style="font-size: 13px; line-height: 1.65; margin-bottom: 16px;">
                        Serving the Midnapore community with 100% authentic pharmaceuticals, verified expiration tracking, cold-chain vaccines, and dedicated clinical pharmacist guidance.
                    </p>
                    <div style="font-size: 12px; color: #64748b;">
                        Drug License: <?= htmlspecialchars($store_dl) ?><br>
                        BCDA Reg. Membership: <?= htmlspecialchars($store_bcda) ?>
                    </div>
                </div>

                <!-- Col 2 -->
                <div>
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="footer-links-list">
                        <li><a href="#hero">Home</a></li>
                        <li><a href="#search-medicine">Find Medicine</a></li>
                        <li><a href="#categories">Medicine Categories</a></li>
                        <li><a href="#services">Healthcare Services</a></li>
                        <li><a href="#prescription-order">Upload Prescription</a></li>
                        <li><a href="#doctors">Physicians Panel</a></li>
                    </ul>
                </div>

                <!-- Col 3 -->
                <div>
                    <h4 class="footer-heading">Healthcare Departments</h4>
                    <ul class="footer-links-list">
                        <li><a href="#categories">Tablets & Capsules</a></li>
                        <li><a href="#categories">Pediatric Syrups</a></li>
                        <li><a href="#categories">Insulin & Diabetes Strips</a></li>
                        <li><a href="#categories">Cold-Chain Vaccines</a></li>
                        <li><a href="#categories">Blood Pressure Monitors</a></li>
                        <li><a href="#categories">Baby Care Essentials</a></li>
                    </ul>
                </div>

                <!-- Col 4 -->
                <div>
                    <h4 class="footer-heading">Staff & Management</h4>
                    <p style="font-size: 12.5px; line-height: 1.6; margin-bottom: 16px;">
                        Authorized pharmacists, billing executives, and administrators can access the backoffice system below:
                    </p>
                    <a href="<?= console_url('user/login') ?>" class="btn-portal-login" style="background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2); color: #ffffff; width: 100%; justify-content: center;">
                        <i class="fa fa-lock" style="color: #2dd4bf;"></i> Access Staff POS & Portal
                    </a>
                </div>
            </div>

            <div class="footer-bottom-strip">
                <div>
                    © <?= date('Y') ?> <strong><?= htmlspecialchars($store_name) ?></strong>. All Rights Reserved. Regulated under Drugs and Cosmetics Act, 1940.
                </div>
                <div>
                    <span style="color: #64748b;">Schedule H & H1 warning: Medicines dispensed strictly against a valid registered doctor's prescription.</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive Live Search & Prescription JS -->
    <script type="text/javascript">
        $(document).ready(function() {
            var searchTimer = null;
            var activeCategory = '';

            // Category pills click handler
            $('.category-pill').on('click', function() {
                $('.category-pill').removeClass('active');
                $(this).addClass('active');
                activeCategory = $(this).data('category');
                triggerMedicineSearch();
            });

            // Search field input with debounce
            $('#liveMedSearch').on('keyup input', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function() {
                    triggerMedicineSearch();
                }, 300);
            });

            $('#btnSearchTrigger').on('click', function(e) {
                e.preventDefault();
                triggerMedicineSearch();
            });

            $('#closeSearchResults').on('click', function() {
                $('#searchResultsBox').slideUp(200);
            });

            function triggerMedicineSearch() {
                var q = $.trim($('#liveMedSearch').val());
                if (q.length < 2 && activeCategory === '') {
                    $('#searchResultsBox').slideUp(200);
                    return;
                }

                $.ajax({
                    url: '<?= base_url("landing/search_medicines") ?>',
                    type: 'GET',
                    data: {
                        q: q
                    },
                    dataType: 'json',
                    success: function(data) {
                        var $container = $('#resultsGridContainer');
                        $container.empty();

                        var filtered = data;
                        if (activeCategory !== '') {
                            filtered = data.filter(function(item) {
                                return (item.medicine_category || '').toUpperCase().indexOf(activeCategory.toUpperCase()) !== -1;
                            });
                        }

                        if (filtered.length === 0) {
                            $('#searchResultSummary').text('No matching medicines found for: "' + q + '"');
                            $container.html('<div style="grid-column: 1 / -1; padding: 20px; text-align: center; color: #64748b;">Medicine not found in catalog preview? Please send your prescription photo on WhatsApp at +91 9382509991 and we will source it for you!</div>');
                        } else {
                            $('#searchResultSummary').text('Found ' + filtered.length + ' Available Formulations:');
                            $.each(filtered, function(i, med) {
                                var waUrl = 'https://wa.me/919382509991?text=' + encodeURIComponent('Hello <?= addslashes($store_name) ?>, I want to order ' + med.medicine_name + ' (' + (med.medicine_unit || '') + ')');
                                var cardHtml =
                                    '<div class="med-result-card">' +
                                    '<div>' +
                                    '<div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:4px;">' +
                                    '<strong style="font-size:14px; color:#0f172a; line-height:1.3;">' + escapeHtml(med.medicine_name) + '</strong>' +
                                    '<span style="background:#ccfbf1; color:#0f766e; font-size:10.5px; font-weight:700; padding:2px 6px; border-radius:4px; flex-shrink:0; margin-left:6px;">In Stock</span>' +
                                    '</div>' +
                                    '<div style="font-size:11.5px; color:#64748b; margin-bottom:6px;"><i class="fa fa-building-o"></i> ' + escapeHtml(med.medicine_manufacturer || 'Certified Pharma') + '</div>' +
                                    '<div style="display:flex; gap:6px; margin-bottom:10px;">' +
                                    '<span style="background:#f1f5f9; color:#475569; font-size:10.5px; padding:2px 6px; border-radius:4px;">' + escapeHtml(med.medicine_category || 'Medicine') + '</span>' +
                                    (med.medicine_unit ? '<span style="background:#f1f5f9; color:#475569; font-size:10.5px; padding:2px 6px; border-radius:4px;">Pack: ' + escapeHtml(med.medicine_unit) + '</span>' : '') +
                                    '</div>' +
                                    '</div>' +
                                    '<div style="display:flex; justify-content:space-between; align-items:center; border-top:1px solid #e2e8f0; padding-top:8px; margin-top:4px;">' +
                                    '<span style="font-size:11px; color:#059669; font-weight:700;"><i class="fa fa-shield"></i> Verified Drug</span>' +
                                    '<a href="' + waUrl + '" target="_blank" style="background:#10b981; color:#ffffff; font-size:11px; font-weight:700; padding:4px 10px; border-radius:6px; display:inline-flex; align-items:center; gap:4px;">' +
                                    '<i class="fa fa-whatsapp"></i> Order' +
                                    '</a>' +
                                    '</div>' +
                                    '</div>';
                                $container.append(cardHtml);
                            });
                        }
                        $('#searchResultsBox').slideDown(250);
                    },
                    error: function() {
                        $('#searchResultsBox').slideUp(200);
                    }
                });
            }

            // Prescription Order Submission
            $('#rxOrderForm').on('submit', function(e) {
                e.preventDefault();
                var $btn = $(this).find('button[type="submit"]');
                var $status = $('#rxSubmitStatus');
                $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Submitting...');

                var pName = $('#patientName').val();
                var pPhone = $('#patientPhone').val();
                var pAddr = $('#deliveryAddress').val();
                var pList = $('#medicineList').val();

                $.ajax({
                    url: '<?= base_url("landing/upload_prescription") ?>',
                    type: 'POST',
                    data: {
                        patient_name: pName,
                        patient_phone: pPhone,
                        delivery_address: pAddr,
                        medicine_list: pList
                    },
                    dataType: 'json',
                    success: function(resp) {
                        $status.show().html('<span style="color:#2dd4bf; font-weight:700;"><i class="fa fa-check-circle"></i> ' + resp.message + '</span>');
                        // Also trigger WhatsApp with pre-filled prescription order
                        var waMsg = 'Hello <?= addslashes($store_name) ?>, I have submitted a prescription order:\n' +
                            'Patient: ' + pName + '\n' +
                            'Phone: ' + pPhone + '\n' +
                            'Address: ' + pAddr + '\n' +
                            'Medicines: ' + pList;
                        var waWindow = window.open('https://wa.me/919382509991?text=' + encodeURIComponent(waMsg), '_blank');
                        $('#rxOrderForm')[0].reset();
                        $btn.prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Submit Prescription Order');
                    },
                    error: function() {
                        $status.show().html('<span style="color:#ef4444;"><i class="fa fa-exclamation-triangle"></i> Submission error. Please call us directly at <?= htmlspecialchars($store_mobile) ?>.</span>');
                        $btn.prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Submit Prescription Order');
                    }
                });
            });

            function escapeHtml(text) {
                if (!text) return '';
                return text
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
        });
    </script>
</body>

</html>