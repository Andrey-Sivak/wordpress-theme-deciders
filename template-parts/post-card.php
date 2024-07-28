<?php
$ds_post_data = $args['post'];
?>

<a href="<?php echo $ds_post_data['permalink']; ?>" class="masonry-item group text-white">
    <span class="overflow-hidden rounded-[16px] block relative">
        <?php
        if (has_post_thumbnail($ds_post_data['id'])) {
            echo get_the_post_thumbnail(
                $ds_post_data['id'],
                'large',
                [
                    'class' => 'relative z-20 group-hover:scale-[1.1] transition-all duration-300 w-full'
                ]
            );
        }
        ?>
        <span class="absolute z-30 bg-black/50 inset-0 flex justify-center items-center text-center flex-col gap-4 p-5 translate-y-full transition-all duration-300 group-hover:translate-y-0">
            <span class="text-32 leading-1.2 font-semibold translate-y-5 transition-all duration-800 group-hover:translate-y-0"><?php echo $ds_post_data['title']; ?></span>
            <span class="text-18 leading-1.2 translate-y-10 transition-all duration-800 group-hover:translate-y-0"><?php echo $ds_post_data['excerpt']; ?></span>
        </span>
    </span>
</a>
