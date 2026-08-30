<?php
use App\Models\SiteSetting;

$setting = SiteSetting::where('key', 'blog.categories')->first();
$cats = json_decode($setting->value, true);
$cats[] = ['id' => uniqid(), 'name' => 'Modul Kepelatihan', 'slug' => 'modul-kepelatihan'];
$setting->value = json_encode($cats);
$setting->save();
echo "Category added";
