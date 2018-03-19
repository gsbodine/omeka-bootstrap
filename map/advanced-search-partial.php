<?php
// For improved geolocation (https://github.com/Daniel-KM/Omeka-plugin-Geolocation).

$request = Zend_Controller_Front::getInstance()->getRequest();

// Get the address, latitude, longitude, and the radius from parameters
$address = trim($request->getParam('geolocation-address'));
$description = trim($request->getParam('geolocation-description'));
$currentLat = trim($request->getParam('geolocation-latitude'));
$currentLng = trim($request->getParam('geolocation-longitude'));
$radius = trim($request->getParam('geolocation-radius'));

if (empty($radius)) {
    $radius = get_option('geolocation_default_radius');
}

if (get_option('geolocation_use_metric_distances')) {
   $distanceLabel =  __('Geographic Radius (kilometers)');
   } else {
   $distanceLabel =  __('Geographic Radius (miles)');
}
?>

<div class="field form-group">
    <?php echo $this->formLabel('geolocation-address', __('Geographic Address')); ?>
    <div class="col-sm-10">
    <div class="inputs input-group">
        <?php echo $this->formText('geolocation-address',  $address, array('size' => '40')); ?>
        <?php // echo $this->formText('geolocation-description', $description, array('size' => '40')); ?>
        <?php echo $this->formHidden('geolocation-latitude', $currentLat); ?>
        <?php echo $this->formHidden('geolocation-longitude', $currentLng); ?>
    </div>
    </div>
</div>

<div class="field form-group">
    <?php echo $this->formLabel('geolocation-radius', $distanceLabel); ?>
    <div class="col-sm-10">
    <div class="inputs input-group">
        <?php echo $this->formText('geolocation-radius', $radius, array('size' => '40')); ?>
    </div>
    </div>
</div>

<script type="text/javascript">
(function ($) {
    $(document).ready(function() {
        var pauseForm = true;
        $('#geolocation-address').parents('form').submit(function(event) {
            // Find the geolocation for the address
            if (!pauseForm) {
                return;
            }

            var form = this;
            var address = $('#geolocation-address').val();
            if ($.trim(address).length > 0) {
                event.preventDefault();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({'address': address}, function(results, status) {
                    // If the point was found, then put the marker on that spot
                    if (status == google.maps.GeocoderStatus.OK) {
                        var gLatLng = results[0].geometry.location;
                        // Set the latitude and longitude hidden inputs
                        $('#geolocation-latitude').val(gLatLng.lat());
                        $('#geolocation-longitude').val(gLatLng.lng());
                        pauseForm = false;
                        form.submit();
                    } else {
                        // If no point was found, give us an alert
                        alert(<?php echo json_encode(__('Error')); ?> + ': "' + address + '" ' + <?php echo json_encode(__('was not found!')); ?>);
                    }
                });
            }
        });
    });
})(jQuery);
</script>
