<?php
// For improved geolocation (https://github.com/Daniel-KM/Omeka-plugin-Geolocation).

queue_css_file('geolocation-items-map');

$title = __('Browse Items on the Map') . ' ' . __('(%s total)', $totalItems);
echo head(array('title' => $title, 'bodyclass' => 'map browse_tabular'));
?>

<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-globe"></span> <?php echo $title; ?></h1>
        </div>
    </div>

    <nav class="items-nav navigation secondary-nav">
        <?php echo public_nav_items()->setUlClass('nav nav-pills'); ?>
    </nav>

    <div class="row">
    <div id="geolocation-tabular" class="table-responsive col-xs-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><?php echo __('Title'); ?></th>
                    <th scope="col"><?php echo __('Longitude'); ?></th>
                    <th scope="col"><?php echo __('Latitude'); ?></th>
                    <th scope="col"><?php echo __('Address'); ?></th>
                    <th scope="col"><?php echo __('Description'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($items as $item):
                    foreach ($locations[$item->id] as $key => $location): ?>
                <tr>
                        <?php if ($key == 0): ?>
                             <?php if (count($locations[$item->id]) == 1): ?>
                    <td><?php echo link_to_item(null, array(), 'show', $item); ?></td>
                        <?php else: ?>
                    <td rowspan="<?php echo count($locations[$item->id]); ?>"><?php echo link_to_item(null, array(), 'show', $item); ?></td>
                        <?php endif; ?>
                    <?php endif; ?>
                    <td><?php echo $location->longitude; ?></td>
                    <td><?php echo $location->latitude; ?></td>
                    <td><?php echo $location->address; ?></td>
                    <td><?php echo $location->description; ?></td>
                </tr>
                    <?php endforeach; ?>
                <?php endforeach ?>
            </tbody>
        </table>
        <p>
            <a href="<?php echo absolute_url('items/map'); ?>"><?php echo __('View as a map'); ?></a>
        </p>
    </div>
    </div>
</div><?php // end primary. ?>
<?php echo foot();
