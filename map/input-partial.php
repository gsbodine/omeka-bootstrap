<?php
// For improved geolocation (https://github.com/Daniel-KM/Omeka-plugin-Geolocation).
?>
<div class="geolocation-list">
    <label class="control-label col-sm-2"><?php echo $allowMultipleLocations ?  __('List of locations') : __('Current location'); ?></label>
    <div class="col-sm-10 table-responsive">
    <table id="geolocation-locations-<?php echo $item ? $item->id : '0'; ?>" class="geolocation-locations table">
        <colgroup><col /></colgroup>
        <thead>
            <tr>
                <th>
                    <?php if ($allowMultipleLocations): ?>
                    <button type="button" class="geolocation-locations-display btn btn-success btn-xs" name="geolocation_locations_display" id="geolocation_locations_display-<?php echo $item ? $item->id : '0'; ?>">
                        <?php echo __('All'); ?>
                    </button>
                    <?php endif; ?>
                </th>
                <th><?php echo __('Latitude'); ?></th>
                <th><?php echo __('Longitude'); ?></th>
                <th><?php echo __('Zoom Level'); ?></th>
                <th><?php echo __('Map Type'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($locations)):
                $key = 0;?>
                <tr id="geolocation-empty" class="geolocation-location location-empty">
                    <td colspan="5"><?php echo __('No location defined.'); ?></td>
                </tr>
            <?php else:
                foreach ($locations as $key => $location):
                    echo $this->partial('map/input-partial-row.php', array(
                        'location' => $location,
                        'key' => $key,
                        'allowMultipleLocations' => $allowMultipleLocations,
                    ));
                endforeach;
            endif;
            /*
            // New element.
            echo $this->partial('map/input-partial-row.php', array(
                'key' => $key + 1,
            ));
             */
          ?>
        </tbody>
    </table>
    </div>
</div>
<div class="geolocation-add-form">
    <label class="control-label col-sm-2"><?php echo $allowMultipleLocations ? __('Add a new location') : __('Set the location'); ?></label>
    <div class="col-sm-10">
        <div id="location_form">
            <input type="text" name="current-geolocation[address]" id="geolocation_address" value="" placeholder="<?php echo __('Address to find'); ?>" class="form-control" />
            <button type="button" name="geolocation_location_find" id="geolocation_location_find" class="btn btn-success btn-sm">
                <?php echo __('Find'); ?>
            </button>
            <?php if ($allowMultipleLocations): ?>
            <button type="button" name="geolocation_location_add" id="geolocation_location_add" class="btn btn-primary btn-sm">
                <?php echo __('Add'); ?>
            </button>
            <?php else: ?>
            <button type="button" name="geolocation_location_set" id="geolocation_location_set" class="btn btn-primary btn-sm">
                <?php echo __('Set'); ?>
            </button>
            <?php endif; ?>
            <p class="help-block"><?php echo __('Find by address or point to a location'); ?></p>
        </div>
    </div>
    <div class="col-sm-offset-2 col-sm-10">
        <div id="omeka-map-form"></div>
    </div>
</div>
