<?php

/**
 * AssetHelper
 *
 */


/**
 * Return's admin assets directory
 *
 * CALLING PROCEDURE
 *
 * In controller call it like this:
 * $adminAssetsDirectory = adminAssetsDir() . $site_settings->site_logo;
 *
 * In View call it like this:
 * {{ asset(adminAssetsDir() . $site_settings->site_logo) }}
 *
 * @param $folder
 * @return bool
 */
function uploadsDir($folder = '')
{
    return 'uploads/' . $folder;
}

function uploadsUrl($folder, $file = '')
{
    return $file != '' && file_exists('uploads/' . $folder . '/' . $file) ? url('uploads') . '/' . $folder . '/' . $file : '';
}

function adminHasAssets($image)
{
    if (!empty($image) && file_exists(uploadsDir() . $image)) {
        return true;
    } else {
        return false;
    }
}

function defaultUserImage()
{
    return 'assets/admin/img/avatar.png';
}

function defaultStoreCoverUrl()
{
    return 'assets/front/images/store-cover.png';
}

///////////////////////////////////////////////////////

/**
 * Used to generate URL of the CSS file for front end
 */
function frontCss($file = '')
{
    return asset('assets/css/' . $file);
}
function frontVendors($file = '')
{
    return asset('assets/vendors/' . $file);
}

/**
 * Used to generate URL of the fonts file for front end
 */
function frontFont($file = '')
{
    return asset('assets/fonts/' . $file);
}

/**
 * Used to generate URL of the image file for front end
 */
function frontImage($file = '')
{
    return asset('assets/images/' . $file);
}

/**
 * Used to generate URL of the JavaScript file for front end
 */
function frontJs($file = '')
{
    return asset('assets/js/' . $file);
}

function getWorkDuration($checkInTime, $checkOutTime) {
    $checkIn = new \DateTime($checkInTime);
    $checkOut = new \DateTime($checkOutTime);
    $interval = $checkIn->diff($checkOut);

    // Get the total work hours in decimal format
    $hours = $interval->h + ($interval->days * 24);

    return $hours;
}