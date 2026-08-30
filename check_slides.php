<?php
$slides = json_decode(\App\Models\SiteSetting::where('key','homepage.hero_slides')->value('value'), true);
foreach($slides as $i => $s) {
    echo 'Slide '.($i+1).': bg='.($s['background'] ?? 'EMPTY')."\n";
    echo '  image='.($s['image'] ?? 'EMPTY')."\n";
}
