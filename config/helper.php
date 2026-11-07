<?php
// File helper fungsi keamanan
// Include setelah koneksi.php

/**
 * Sanitasi output untuk mencegah XSS
 */
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
