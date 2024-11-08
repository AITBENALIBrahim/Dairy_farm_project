<?php
function isActive($routeName) {
    return (current_url() == base_url($routeName)) ? 'active' : '';
}