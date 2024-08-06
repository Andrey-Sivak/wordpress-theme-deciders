<?php
$ds_post_data = $args['post'];
$op_additional_thumbnail = get_post_meta( $ds_post_data['id'], 'mobile_image', true );
?>

<a href="<?php echo $ds_post_data['permalink']; ?>" class="masonry-item group text-white ds-post md:pb-6.5 pb-0">
    <span class="overflow-hidden rounded-[16px] block relative">
        <?php
        if (has_post_thumbnail($ds_post_data['id'])) {
            $ds_image_class = 'relative z-20 group-hover:scale-[1.1] transition-all duration-300 object-center md:object-cover object-contain w-full h-full';

            if ($op_additional_thumbnail) {
                $ds_image_class .= ' md:block hidden';
            }

            echo get_the_post_thumbnail(
                $ds_post_data['id'],
                'large',
                [
                    'class' => $ds_image_class,
                ]
            );
        }
        ?>

        <?php if ($op_additional_thumbnail) : ?>
            <img
                    src="<?php echo $op_additional_thumbnail; ?>"
                    alt="<?php echo $ds_post_data['title']; ?>"
                    class="block md:hidden relative z-20 object-center object-cover w-full h-full"
            >
        <?php endif; ?>
        <span
                class="absolute z-30 -left-1 -right-1 -bottom-1 top-[10%] md:flex hidden justify-end items-center flex-col gap-4 p-5 translate-y-full transition-all duration-300 group-hover:translate-y-0 pb-10"
                style="background-image: linear-gradient(to top, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0) 100%);"
        >
            <span class="xl:text-32 text-28 leading-1.2 font-semibold translate-y-5 transition-all duration-800 group-hover:translate-y-0"><?php echo $ds_post_data['title']; ?></span>
            <span class="text-18 leading-1.2 translate-y-10 transition-all duration-800 group-hover:translate-y-0 line-clamp-3"><?php echo $ds_post_data['excerpt']; ?></span>
        </span>

        <span
                class="md:hidden block px-5 pb-15 absolute z-30 top-auto bottom-0 w-full pt-30"
                style="background-image: linear-gradient(to top, rgba(25, 25, 25, 1) 50%, rgba(25, 25, 25, 0) 100%);"
        >
            <span class="text-22 leading-1.2 font-bold block mb-3"><?php echo $ds_post_data['title']; ?></span>
            <span class="text-16 leading-1.2 line-clamp-3"><?php echo $ds_post_data['excerpt']; ?></span>
        </span>
    </span>
</a>
