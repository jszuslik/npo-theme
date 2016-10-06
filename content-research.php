<table class="table">
    <tbody>
        <?php if( have_rows('researchers')): ?>
            <?php while ( have_rows('researchers')): the_row(); ?>
                <?php
                    $image = get_sub_field('photo');

                ?>
                <tr>
                    <td class="research_image_wrapper">
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" >
                    </td>
                    <td>
                        <h3><?php the_sub_field('name'); ?></h3>
                        <?php the_sub_field('info'); ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>

    </tbody>
</table>