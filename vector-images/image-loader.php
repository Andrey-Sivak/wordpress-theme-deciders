<?php
$ds_color = $args['color'];
?>

<svg viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="224" height="224"
     style="display: block; position: absolute; z-index: 10; top: 50%; left: 50%; transform: translate(-50%, -50%); shape-rendering: auto;">
    <style>
        @keyframes spin { to { transform: rotate(360deg); } }
        @keyframes fade {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
        .spinner { animation: spin 1s linear infinite; transform-origin: 50px 50px; }
        .rect { animation: fade 1s linear infinite; }
        <?php for ($i = 0; $i < 8; $i++) : ?>
        .rect:nth-child(<?php echo $i + 1; ?>) { animation-delay: -<?php echo $i * 0.125; ?>s; }
        <?php endfor; ?>
    </style>
    <g class="spinner">
        <?php for ($i = 0; $i < 8; $i++) : ?>
            <g transform="rotate(<?php echo $i * 45; ?> 50 50)">
                <rect class="rect" fill="<?php echo $ds_color; ?>" height="8" width="6" ry="2.32" rx="2.32" y="24" x="47"></rect>
            </g>
        <?php endfor; ?>
    </g>
</svg>