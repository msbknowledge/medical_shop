<div class="ss-breadcrumb-container" style="margin: 0 0 20px 0;">
    <ul class="breadcrumb" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px 18px; margin: 0; display: flex; align-items: center; box-shadow: 0 1px 3px rgba(0,0,0,0.03); font-family: 'Plus Jakarta Sans', sans-serif; list-style: none;">
        <li style="display: inline-flex; align-items: center;">
            <a href="<?= console_url() ?>" style="color: #6366f1; text-decoration: none; font-weight: 600; font-size: 13px; display: inline-flex; align-items: center; gap: 5px;">
                <i class="fa fa-home" style="font-size: 15px;"></i> Home
            </a>
            <i class="fa fa-angle-right" style="color: #94a3b8; font-size: 13px; margin: 0 10px;"></i>
        </li>

        <?php if(isset($site_breadcrumb) && is_array($site_breadcrumb)) :
            $totalCrumbs = count($site_breadcrumb);
            $crumbIdx = 0;
            foreach($site_breadcrumb as $node_name => $node_link):
                $crumbIdx++;
                $isLast = ($crumbIdx === $totalCrumbs);
        ?>
        <li style="display: inline-flex; align-items: center;">
            <?php if (!$isLast): ?>
                <a href="<?=$node_link ?>" style="color: #64748b; text-decoration: none; font-weight: 500; font-size: 13px;"><?= ucfirst($node_name) ?></a>
                <i class="fa fa-angle-right" style="color: #94a3b8; font-size: 13px; margin: 0 10px;"></i>
            <?php else: ?>
                <span style="color: #1e293b; font-weight: 700; font-size: 13px;"><?= ucfirst($node_name) ?></span>
            <?php endif; ?>
        </li>
        <?php endforeach;
        endif;
        ?>

        <li style="margin-left: auto;">
            <a class="btn btn-default" href="javascript:void(0);" onclick="goBack();" style="border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #475569; font-size: 12px; font-weight: 600; padding: 5px 12px; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.04); text-decoration: none;">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </li>
    </ul>
</div>
<script>
    function goBack() {
        if (typeof $('ul.breadcrumb li:nth-last-child(2)').find('a').attr('href') !== 'undefined') {
            window.location.href = $('ul.breadcrumb li:nth-last-child(2)').find('a').attr('href');
        } else {
            window.history.back();
        }
    }
</script>